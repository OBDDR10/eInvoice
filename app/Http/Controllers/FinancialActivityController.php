<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Models\FinancialActivity;
use App\Models\FinancialEntity;
use DateTime;
use Exception;

class FinancialActivityController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('user.roles:user');
    }
    
    public function index(Request $request)
    {
        $currency_code = getCurrencyCode();
        $entries = $request->input('entries', 10);

        $data = FinancialActivity::filter()
                    ->join('companies', 'financial_activities.company_id', '=', 'companies.id')
                    ->select('financial_activities.*','companies.name as company_name')
                    ->selectRaw("CASE 
                                WHEN financial_activities.activity_type = 1 THEN 'Operation'
                                WHEN financial_activities.activity_type = 2 THEN 'Investing'
                                WHEN financial_activities.activity_type = 3 THEN 'Financing'
                                ELSE ''
                                END as activity_type_text")
                    ->selectRaw("CASE 
                                WHEN financial_activities.action_type = 1 THEN 'Received From'
                                WHEN financial_activities.action_type = 2 THEN 'Paid For'
                                ELSE ''
                                END as action_type_text")
                    ->sort()
                    ->orderByDesc('financial_activities.date')
                    ->paginate($entries);

        if ($request->ajax()) {
            $table = view('financial_activities.table', compact('data','entries'))->render();
            $pagination = view('layouts.pagination', compact('data','entries'))->render();

            return response()->json(['table' => $table, 'pagination' => $pagination]);
        }

        return view('financial_activities.index', compact('data','entries'));
    }

    public function create()
    {
        return view('financial_activities.create');
    }

    public function store(Request $request)
    {
        $this->validation($request);   

        try 
        {
            DB::beginTransaction();

            $financial_activity = new FinancialActivity();
            $financial_activity->company_id = $request->company_id;
            $financial_activity->date = $request->date;
            $financial_activity->name = $request->name;
            $financial_activity->amount = $request->amount;
            $financial_activity->activity_type = $request->activity_type;
            $financial_activity->action_type = $request->action_type;
            $financial_activity->description = $request->description;
            $financial_activity->remark = $request->remark;

            $financial_activity->created_by = Auth::id();
            $financial_activity->updated_by = Auth::id();

            $financial_activity->save();

            DB::commit();
            Log::info(trans('messages.financial_activity') . trans('messages.create_success'), ['financial_activity_id' => $financial_activity->id]);
        }
        catch (Exception $e)
        {
            DB::rollBack();
            Log::error(trans('messages.create_failed') . trans('messages.financial_activity'), ['error' => $e->getMessage()]);

            return api_response(false, trans('messages.create_failed') . trans('messages.financial_activity'));
        }

        return api_response(true, trans('messages.financial_activity') . trans('messages.create_success'));
    }

    public function show(Request $request)
    {
        $today = new DateTime();
        $data = FinancialActivity::firstOrNew(['id' => $request->id], ['date' => $today->format('Y-m-d')]);
        $modal = view('financial_activities.modal', compact('data'))->render();

        return response()->json(['modal' => $modal]);
    }

    public function edit($id)
    {
        $data = FinancialActivity::findOrFail($id);
        return view('financial_activities.edit', compact('data'));
    }

    public function update(Request $request)
    {
        $this->validation($request); 

        try 
        {
            DB::beginTransaction();

            $financial_activity = FinancialActivity::findOrFail($request->id);
            $financial_activity->company_id = $request->company_id;
            $financial_activity->date = $request->date;
            $financial_activity->name = $request->name;
            $financial_activity->amount = $request->amount;
            $financial_activity->activity_type = $request->activity_type;
            $financial_activity->action_type = $request->action_type;
            $financial_activity->description = $request->description;
            $financial_activity->remark = $request->remark;

            $financial_activity->created_by = Auth::id();
            $financial_activity->updated_by = Auth::id();

            $financial_activity->save();

            DB::commit();
            Log::info(trans('messages.financial_activity') . trans('messages.update_success'), ['financial_activity_id' => $financial_activity->id]);
        }
        catch (Exception $e)
        {
            DB::rollBack();
            Log::error(trans('messages.update_failed') . trans('messages.financial_activity'), ['error' => $e->getMessage()]);

            return api_response(false, trans('messages.update_failed') . trans('messages.financial_activity'));
        }

        return api_response(true, trans('messages.financial_activity') . trans('messages.update_success'));
    }

    public function destroy(Request $request)
    {
        try
        {
            DB::beginTransaction();

            $data = FinancialActivity::findOrFail($request->id);
            $data->delete();

            DB::commit();
            Log::info(trans('messages.financial_activity') . trans('messages.delete_success'), ['transaction_id' => $request->id]);
        }
        catch (Exception $e)
        {
            DB::rollBack();
            Log::error(trans('messages.delete_failed') . trans('messages.financial_activity'), ['error' => $e->getMessage()]);

            return api_response(false, trans('messages.delete_failed') . trans('messages.financial_activity'));
        }
        
        return api_response(true, trans('messages.financial_activity') . trans('messages.delete_success'));
    }

    protected function validation(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'date' => 'required|date',
            'company_id' => 'required|numeric',
            'name' => 'required|string|max:255',
            'activity_type' => 'required|numeric',
            'action_type' => 'required|numeric',
            'description' => 'nullable|string|max:255',
            'amount' => 'required|numeric',
            'remark' => 'nullable|string|max:255',
        ]);
    
        if ($validator->fails()) {
            return api_response(false, $validator->errors()->first());
        }  
    }
}
