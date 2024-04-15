<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Models\Transaction;
use DateTime;
use Exception;

class TransactionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('user.roles:user');
    }

    public function index(Request $request)
    {
        $entries = $request->input('entries', 10);

        $data = Transaction::filter()
                    ->join('companies as receiving_company', 'transactions.receiving_company_id', '=', 'receiving_company.id')
                    ->join('companies as paying_company', 'transactions.paying_company_id', '=', 'paying_company.id')
                    ->select('transactions.*','receiving_company.name as receiving_company_name','paying_company.name as paying_company_name')
                    ->sort()
                    ->orderByDesc('transactions.date')
                    ->paginate($entries);

        if ($request->ajax()) {
            $table = view('transactions.table', compact('data','entries'))->render();
            $pagination = view('layouts.pagination', compact('data','entries'))->render();

            return response()->json(['table' => $table, 'pagination' => $pagination]);
        }

        return view('transactions.index', compact('data','entries'));
    }

    public function create()
    {
        return view('transactions.create');
    }

    public function store(Request $request)
    {
        $this->validation($request);   

        try 
        {
            DB::beginTransaction();

            $transaction = new Transaction();
            $transaction->date = $request->date;
            $transaction->receiving_company_id = $request->receiving_company_id;
            $transaction->paying_company_id = $request->paying_company_id;
            $transaction->product_service_name = $request->name;
            $transaction->description = $request->description;
            $transaction->remark = $request->remark;
            $transaction->amount_payable = $request->amount_payable;
            $transaction->amount_paid = $request->amount_paid;

            $transaction->ref_no = generateRefNo($request->paying_company_id);
            $transaction->created_by = Auth::id();
            $transaction->updated_by = Auth::id();

            $transaction->save();

            DB::commit();
            Log::info(trans('messages.transaction') . trans('messages.create_success'), ['transaction_id' => $transaction->id]);
        }
        catch (Exception $e)
        {
            DB::rollBack();
            Log::error(trans('messages.create_failed') . trans('messages.transaction'), ['error' => $e->getMessage()]);

            //return api_response(false, trans('messages.create_failed') . trans('messages.transaction'));
            return api_response(false, $e->getMessage());
        }

        return api_response(true, trans('messages.transaction') . trans('messages.create_success'));
    }

    public function show(Request $request)
    {
        $today = new DateTime();
        $data = Transaction::firstOrNew(['id' => $request->id], ['date' => $today->format('Y-m-d')]);
        $modal = view('transactions.modal', compact('data'))->render();
        
        return response()->json(['modal' => $modal]);
    }

    public function edit($id)
    {
        $data = Transaction::findOrFail($id);
        return view('transactions.edit', compact('data'));
    }

    public function update(Request $request)
    {
        $this->validation($request);  

        try 
        {
            DB::beginTransaction();

            $transaction = Transaction::findOrFail($request->id);
            $transaction->date = $request->date;
            $transaction->receiving_company_id = $request->receiving_company_id;
            $transaction->paying_company_id = $request->paying_company_id;
            $transaction->product_service_name = $request->name;
            $transaction->description = $request->description;
            $transaction->remark = $request->remark;
            $transaction->amount_payable = $request->amount_payable;
            $transaction->amount_paid = $request->amount_paid;

            $transaction->created_by = Auth::id();
            $transaction->updated_by = Auth::id();

            $transaction->save();

            DB::commit();
            Log::info(trans('messages.transaction') . trans('messages.update_success'), ['transaction_id' => $transaction->id]);
        }
        catch (Exception $e)
        {
            DB::rollBack();
            Log::error(trans('messages.update_failed') . trans('messages.transaction'), ['error' => $e->getMessage()]);

            return api_response(false, trans('messages.update_failed') . trans('messages.transaction'));
        }

        return api_response(true, trans('messages.transaction') . trans('messages.update_success'));
    }

    public function destroy(Request $request)
    {
        try
        {
            DB::beginTransaction();

            $data = Transaction::findOrFail($request->id);
            $data->delete();

            DB::commit();
            Log::info(trans('messages.transaction') . trans('messages.delete_success'), ['transaction_id' => $request->id]);
        }
        catch (Exception $e)
        {
            DB::rollBack();
            Log::error(trans('messages.delete_failed') . trans('messages.transaction'), ['error' => $e->getMessage()]);

            return api_response(false, trans('messages.delete_failed') . trans('messages.transaction'));
        }
        
        return api_response(true, trans('messages.transaction') . trans('messages.delete_success'));
    }

    protected function validation(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'date' => 'required|date',
            'receiving_company_id' => 'required|numeric',
            'paying_company_id' => 'required|numeric',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'remark' => 'nullable|string|max:255',
            'amount_payable' => 'required|numeric',
            'amount_paid' => 'nullable|numeric',
        ]);
    }
}
