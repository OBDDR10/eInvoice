<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Models\EntityPriceLog;
use App\Models\FinancialEntity;
use DateTime;
use Exception;

class EntityPriceLogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('user.roles:user');
    }
    
    public function index(Request $request)
    {
        $entries = $request->input('entries', 10);

        $data = EntityPriceLog::filter()
                    ->join('financial_entities', 'entity_price_logs.financial_entity_id', '=', 'financial_entities.id')
                    ->select('entity_price_logs.*','financial_entities.name as entity_name','financial_entities.entity_type as entity_type')
                    ->selectRaw("CASE 
                                WHEN financial_entities.entity_type = 1 THEN 'Assets'
                                WHEN financial_entities.entity_type = 2 THEN 'Liabilities'
                                WHEN financial_entities.entity_type = 3 THEN 'Equity'
                                ELSE ''
                                END as entity_type_text")
                    ->sort()
                    ->orderBy('financial_entities.entity_type')
                    ->orderByDesc('entity_price_logs.financial_entity_id')
                    ->orderByDesc('entity_price_logs.date')
                    ->paginate($entries);

        if ($request->ajax()) {
            $table = view('entity_price_logs.table', compact('data','entries'))->render();
            $pagination = view('layouts.pagination', compact('data','entries'))->render();

            return response()->json(['table' => $table, 'pagination' => $pagination]);
        }

        return view('entity_price_logs.index', compact('data','entries'));
    }

    public function create()
    {
        return view('entity_price_logs.create');
    }

    public function store(Request $request)
    {
        $this->validation($request); 

        try 
        {
            DB::beginTransaction();

            $price_log = new EntityPriceLog();
            $price_log->financial_entity_id = $request->financial_entity_id;
            $price_log->date = $request->date;
            $price_log->price = $request->price;

            $price_log->created_by = Auth::id();
            $price_log->updated_by = Auth::id();

            $price_log->save();

            DB::commit();
            Log::info(trans('messages.entity_price_log') . trans('messages.create_success'), ['entity_price_log_id' => $price_log->id]);
        }
        catch (Exception $e)
        {
            DB::rollBack();
            Log::error(trans('messages.create_failed') . trans('messages.entity_price_log'), ['error' => $e->getMessage()]);

            return api_response(false, trans('messages.create_failed') . trans('messages.entity_price_log'));
        }

        return api_response(true, trans('messages.entity_price_log') . trans('messages.create_success'));
    }

    public function show(Request $request)
    {
        $data = EntityPriceLog::join('financial_entities', 'entity_price_logs.financial_entity_id', '=', 'financial_entities.id')
                    ->select('entity_price_logs.*','financial_entities.name as entity_name','financial_entities.entity_type as entity_type', 'financial_entities.company_id as company_id')
                    ->selectRaw("CASE 
                                WHEN financial_entities.entity_type = 1 THEN 'Assets'
                                WHEN financial_entities.entity_type = 2 THEN 'Liabilities'
                                WHEN financial_entities.entity_type = 3 THEN 'Equity'
                                ELSE ''
                                END as entity_type_text")
                    ->where('entity_price_logs.id', $request->id)
                    ->first() ?? new EntityPriceLog();

        if ($request->add) 
        {
            $today = new DateTime();
            $data->date = $today->format('Y-m-d');
            $data->price = 0;
        }

        $modal = view('entity_price_logs.modal', compact('data'))->render();

        return response()->json(['modal' => $modal]);
    }

    public function edit($id)
    {
        $data = EntityPriceLog::findOrFail($id);
        return view('entity_price_logs.edit', compact('data'));
    }

    public function update(Request $request)
    {
        $this->validation($request); 

        try 
        {
            DB::beginTransaction();

            $price_log = EntityPriceLog::findOrFail($request->id);
            $price_log->date = $request->date;
            $price_log->price = $request->price;

            $price_log->created_by = Auth::id();
            $price_log->updated_by = Auth::id();

            $price_log->save();

            DB::commit();
            Log::info(trans('messages.entity_price_log') . trans('messages.update_success'), ['entity_price_log_id' => $price_log->id]);
        }
        catch (Exception $e)
        {
            DB::rollBack();
            Log::error(trans('messages.update_failed') . trans('messages.entity_price_log'), ['error' => $e->getMessage()]);

            return api_response(false, trans('messages.update_failed') . trans('messages.entity_price_log'));
        }

        return api_response(true, trans('messages.entity_price_log') . trans('messages.update_success'));
    }

    public function destroy(Request $request)
    {
        try
        {
            DB::beginTransaction();

            $data = EntityPriceLog::findOrFail($request->id);
            $data->delete();

            DB::commit();
            Log::info(trans('messages.entity_price_log') . trans('messages.delete_success'), ['entity_price_log_id' => $request->id]);
        }
        catch (Exception $e)
        {
            DB::rollBack();
            Log::error(trans('messages.delete_failed') . trans('messages.entity_price_log'), ['error' => $e->getMessage()]);

            return api_response(false, trans('messages.delete_failed') . trans('messages.entity_price_log'));
        }
        
        return api_response(true, trans('messages.entity_price_log') . trans('messages.delete_success'));
    }

    protected function validation(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'financial_entity_id' => 'required|numeric',
            'date' => 'required|date',
            'price' => 'required|numeric',
        ]);
    
        if ($validator->fails()) {
            return api_response(false, $validator->errors()->first());
        }  
    }
}
