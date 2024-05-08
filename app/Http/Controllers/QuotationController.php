<?php

namespace App\Http\Controllers;

use App\Mail\QuotationEmail;
use App\Models\Company;
use App\Models\Quotation;
use App\Models\QuotationDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use DateTime;
use Dompdf\Dompdf;
use Dompdf\Options;
use Exception;

class QuotationController extends Controller
{
    public function __construct()
    {
        
    }
    
    public function index(Request $request)
    {
        $entries = $request->input('entries', 10);

        $data = Quotation::filter()
                    ->sort()
                    ->orderByDesc('issued_date')
                    ->orderByDesc('id')
                    ->paginate($entries);

        if ($request->ajax()) {
            $table = view('quotations.table', compact('data','entries'))->render();
            $pagination = view('layouts.pagination', compact('data','entries'))->render();

            return response()->json(['table' => $table, 'pagination' => $pagination]);
        }

        return view('quotations.index', compact('data','entries'));
    }

    public function create(Request $request)
    {
        return view('quotations.create');
    }

    public function store(Request $request)
    {
        $this->validation($request);    

        try 
        {
            DB::beginTransaction();

            // quotation
            $quotation = new quotation();
            $quotation->issued_date = $request->issued_date;
            $quotation->quotation_no = generateQuotationNo($request->client_name);
            $quotation->client_name = $request->client_name;
            $quotation->client_email = $request->client_email;
            $quotation->client_address_1 = $request->client_address_1;
            $quotation->client_address_2 = $request->client_address_2;
            $quotation->client_address_3 = $request->client_address_3;
            $quotation->total_amount = $request->total_amount;

            // $quotation->created_by = Auth::id();
            // $quotation->updated_by = Auth::id();

            $quotation->save();

            // quotation details
            $total_amount = 0;
            
            foreach ($request->description as $key => $description) {
                $quotationDetail = new quotationDetail();
                $quotationDetail->quotation_id = $quotation->id;
                $quotationDetail->description = $description;
                $quotationDetail->quantity = $request->quantity[$key];
                $quotationDetail->unit_price = $request->unit_price[$key];
                $quotationDetail->amount = $request->amount[$key];
                $quotationDetail->save();

                $total_amount += $quotationDetail->amount;
            }

            if (!$quotation->total_amount || $quotation->total_amount <= 0)
            {
                $quotation->total_amount = $total_amount;
            }

            DB::commit();
            Log::info(trans('messages.quotation') . trans('messages.create_success'), ['quotation_id' => $quotation->id]);
        }
        catch (Exception $e)
        {
            DB::rollBack();
            Log::error(trans('messages.create_failed') . trans('messages.quotation'), ['error' => $e->getMessage()]);

            return api_response(false, $e->getMessage());
            //return api_response(false, trans('messages.create_failed') . trans('messages.quotation'));
        }

        return api_response(true, trans('messages.quotation') . trans('messages.create_success'));
    }

    public function show(Request $request)
    {
        $today = new DateTime();
        $data = Quotation::firstOrNew(['id' => $request->id], ['issued_date' => $today->format('Y-m-d')]);
        $details = QuotationDetail::where('quotation_id', $data->id)->get();
        $modal = view('quotations.modal', compact('data','details'))->render();

        return response()->json(['modal' => $modal]);
    }

    public function export(Request $request, $send = false)
    {
        $company = Company::findOrFail(1);
        $data = Quotation::findOrFail($request->id);
        $details = QuotationDetail::where('quotation_id', $data->id)->get();
        $filename = $data->quotation_no . '.pdf';
        $htmlContent = view('quotations.pdf', compact('company','data','details'))->render();

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
        return view('quotations.pdf', compact('company','data','details'));
    }

    public function destroy(Request $request)
    {
        try
        {
            DB::beginTransaction();

            // delete all items
            // $quotationDetails = QuotationDetail::where('quotation_id', $request->id)->get();

            // foreach($quotationDetails as $detail) 
            // {
            //     $detail->delete();
            // }

            // delete record
            $data = Quotation::findOrFail($request->id);
            $data->status = 2;
            $data->save();

            DB::commit();
            Log::info(trans('messages.quotation') . trans('messages.withdraw_success'), ['quotation_id' => $request->id]);
        }
        catch (Exception $e)
        {
            DB::rollBack();
            Log::error(trans('messages.withdraw_failed') . trans('messages.quotation'), ['error' => $e->getMessage()]);

            return api_response(false, trans('messages.withdraw_failed') . trans('messages.quotation'));
        }
        
        return api_response(true, trans('messages.quotation') . trans('messages.withdraw_success'));
    }

    public function send(Request $request)
    {
        try
        {
            DB::beginTransaction();

            // send email
            $data = Quotation::findOrFail($request->input('send_id'));
            $company = Company::findOrFail(1);
            $details = QuotationDetail::where('quotation_id', $data->id)->get();

            $filename = $data->quotation_no . '.pdf';
            $request->id = $request->input('send_id');
            $pdfContent = $this->export($request, true);
            Mail::to($data->client_email)->send(new QuotationEmail(
                $pdfContent, $filename, $data, $company, $details
            ));

            // status
            $data->emailed_at = now();
            $data->save();

            DB::commit();
            Log::info(trans('messages.quotation') . trans('messages.send_success'), ['quotation_id' => $request->id]);
        }
        catch (Exception $e)
        {
            DB::rollBack();
            Log::error(trans('messages.send_failed') . trans('messages.quotation'), ['error' => $e->getMessage()]);

            return api_response(false, $e->getMessage());
            //return api_response(false, trans('messages.send_failed') . trans('messages.quotation'));
        }
        
        return api_response(true, trans('messages.quotation') . trans('messages.send_success'));
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
