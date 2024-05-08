<?php

namespace App\Http\Controllers;

use App\Mail\InvoiceEmail;
use App\Models\Company;
use App\Models\Invoice;
use App\Models\InvoiceDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use DateTime;
use Dompdf\Dompdf;
use Dompdf\Options;
use Exception;

class InvoiceController extends Controller
{
    public function __construct()
    {
        
    }
    
    public function index(Request $request)
    {
        $entries = $request->input('entries', 10);

        $data = Invoice::filter()
                    ->sort()
                    ->orderByDesc('issued_date')
                    ->orderByDesc('id')
                    ->paginate($entries);

        if ($request->ajax()) {
            $table = view('invoices.table', compact('data','entries'))->render();
            $pagination = view('layouts.pagination', compact('data','entries'))->render();

            return response()->json(['table' => $table, 'pagination' => $pagination]);
        }

        return view('invoices.index', compact('data','entries'));
    }

    public function create(Request $request)
    {
        return view('invoices.create');
    }

    public function store(Request $request)
    {
        $this->validation($request);    

        try 
        {
            DB::beginTransaction();

            // invoice
            $invoice = new Invoice();
            $invoice->issued_date = $request->issued_date;
            $invoice->invoice_no = generateRefNo($request->client_name);
            $invoice->client_name = $request->client_name;
            $invoice->client_email = $request->client_email;
            $invoice->client_address_1 = $request->client_address_1;
            $invoice->client_address_2 = $request->client_address_2;
            $invoice->client_address_3 = $request->client_address_3;
            $invoice->total_amount = $request->total_amount;

            // $invoice->created_by = Auth::id();
            // $invoice->updated_by = Auth::id();

            $invoice->save();

            // invoice details
            $total_amount = 0;

            foreach ($request->description as $key => $description) {
                $invoiceDetail = new InvoiceDetail();
                $invoiceDetail->invoice_id = $invoice->id;
                $invoiceDetail->description = $description;
                $invoiceDetail->quantity = $request->quantity[$key];
                $invoiceDetail->unit_price = $request->unit_price[$key];
                $invoiceDetail->amount = $request->amount[$key];
                $invoiceDetail->save();

                $total_amount += $invoiceDetail->amount;
            }

            if (!$invoice->total_amount || $invoice->total_amount <= 0)
            {
                $invoice->total_amount = $total_amount;
            }

            DB::commit();
            Log::info(trans('messages.invoice') . trans('messages.create_success'), ['invoice_id' => $invoice->id]);
        }
        catch (Exception $e)
        {
            DB::rollBack();
            Log::error(trans('messages.create_failed') . trans('messages.invoice'), ['error' => $e->getMessage()]);

            return api_response(false, $e->getMessage());
            //return api_response(false, trans('messages.create_failed') . trans('messages.invoice'));
        }

        return api_response(true, trans('messages.invoice') . trans('messages.create_success'));
    }

    public function show(Request $request)
    {
        $today = new DateTime();
        $data = Invoice::firstOrNew(['id' => $request->id], ['issued_date' => $today->format('Y-m-d')]);
        $details = InvoiceDetail::where('invoice_id', $data->id)->get();
        $modal = view('invoices.modal', compact('data','details'))->render();

        return response()->json(['modal' => $modal]);
    }

    public function export(Request $request, $send = false)
    {
        $company = Company::findOrFail(1);
        $data = Invoice::findOrFail($request->id);
        $details = InvoiceDetail::where('invoice_id', $data->id)->get();
        $filename = $data->invoice_no . '.pdf';
        $htmlContent = view('invoices.pdf', compact('company','data','details'))->render();

        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($htmlContent);
        $dompdf->render();

        if ($send)
        {
            return $dompdf->output();
        }

        // return $dompdf->stream($filename);
        return view('invoices.pdf', compact('company','data','details'));
    }

    public function destroy(Request $request)
    {
        try
        {
            DB::beginTransaction();

            // delete all items
            // $invoiceDetails = InvoiceDetail::where('invoice_id', $request->id)->get();

            // foreach($invoiceDetails as $detail) 
            // {
            //     $detail->delete();
            // }

            // delete record
            $data = Invoice::findOrFail($request->id);
            $data->status = 2;
            $data->save();

            DB::commit();
            Log::info(trans('messages.invoice') . trans('messages.withdraw_success'), ['invoice_id' => $request->id]);
        }
        catch (Exception $e)
        {
            DB::rollBack();
            Log::error(trans('messages.withdraw_failed') . trans('messages.invoice'), ['error' => $e->getMessage()]);

            return api_response(false, trans('messages.withdraw_failed') . trans('messages.invoice'));
        }
        
        return api_response(true, trans('messages.invoice') . trans('messages.withdraw_success'));
    }

    public function send(Request $request)
    {
        try
        {
            DB::beginTransaction();

            // send email
            $data = Invoice::findOrFail($request->input('send_id'));
            $company = Company::findOrFail(1);
            $details = InvoiceDetail::where('invoice_id', $data->id)->get();

            $filename = $data->invoice_no . '.pdf';
            $request->id = $request->input('send_id');
            $pdfContent = $this->export($request, true);
            Mail::to($data->client_email)->send(new InvoiceEmail(
                $pdfContent, $filename, $data, $company, $details
            ));

            // status
            $data->emailed_at = now();
            $data->save();

            DB::commit();
            Log::info(trans('messages.invoice') . trans('messages.send_success'), ['invoice_id' => $request->id]);
        }
        catch (Exception $e)
        {
            DB::rollBack();
            Log::error(trans('messages.send_failed') . trans('messages.invoice'), ['error' => $e->getMessage()]);

            return api_response(false, $e->getMessage());
            //return api_response(false, trans('messages.send_failed') . trans('messages.invoice'));
        }
        
        return api_response(true, trans('messages.invoice') . trans('messages.send_success'));
    }

    protected function validation(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'issued_date' => 'required|date',
            'client_name' => 'required|string|max:255',
            'client_email' => 'nullable|email',
            'client_address_1' => 'nullable|string|max:255',
            'client_address_2' => 'nullable|string|max:255',
            'client_address_3' => 'nullable|string|max:255',

            'description' => ['required', 'array'],
            'description.*' => ['string', 'max:255'],
            'quantity' => ['required', 'array'],
            'quantity.*' => ['numeric'],
            'unit_price' => ['required', 'array'],
            'unit_price.*' => ['numeric'],
            'amount' => ['required', 'array'],
            'amount.*' => ['numeric'],
        ]);
    
        if ($validator->fails()) {
            return api_response(false, $validator->errors()->first());
        }  
    }
}
