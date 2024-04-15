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

class FinancialEntityController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('user.roles:user');
    }
    
    public function index(Request $request)
    {
        $entries = $request->input('entries', 10);

        $data = FinancialEntity::filter()
                    ->join('companies', 'financial_entities.company_id', '=', 'companies.id')
                    ->select('financial_entities.*','companies.name as company_name')
                    ->selectRaw("CASE 
                                WHEN financial_entities.entity_type = 1 THEN 'Assets'
                                WHEN financial_entities.entity_type = 2 THEN 'Liabilities'
                                WHEN financial_entities.entity_type = 3 THEN 'Equity'
                                ELSE ''
                                END as entity_type_text")
                    ->sort()
                    ->orderBy('financial_entities.entity_type')
                    ->paginate($entries);

        if ($request->ajax()) {
            $table = view('financial_entities.table', compact('data','entries'))->render();
            $pagination = view('layouts.pagination', compact('data','entries'))->render();

            return response()->json(['table' => $table, 'pagination' => $pagination]);
        }

        return view('financial_entities.index', compact('data','entries'));
    }

    public function create()
    {
        return view('financial_entities.create');
    }

    public function store(Request $request)
    {
        $this->validation($request);     

        try 
        {
            DB::beginTransaction();

            // financial entity
            $financial_entity = new FinancialEntity();
            $financial_entity->company_id = $request->company_id;
            $financial_entity->name = $request->name;
            $financial_entity->entity_type = $request->entity_type;
            $financial_entity->is_current = $request->is_current;
            $financial_entity->description = $request->description;
            $financial_entity->remark = $request->remark;

            $financial_entity->created_by = Auth::id();
            $financial_entity->updated_by = Auth::id();

            $financial_entity->save();

            // entity price log
            $price_log = new EntityPriceLog();
            $price_log->financial_entity_id = $financial_entity->id;
            $price_log->date = $request->date;
            $price_log->price = $request->price;

            $price_log->created_by = Auth::id();
            $price_log->updated_by = Auth::id();

            $price_log->save();

            DB::commit();
            Log::info(trans('messages.financial_entity') . trans('messages.create_success'), ['financial_entity_id' => $financial_entity->id]);
        }
        catch (Exception $e)
        {
            DB::rollBack();
            Log::error(trans('messages.create_failed') . trans('messages.financial_entity'), ['error' => $e->getMessage()]);

            return api_response(false, trans('messages.create_failed') . trans('messages.financial_entity'));
        }

        return api_response(true, trans('messages.financial_entity') . trans('messages.create_success'));
    }

    public function show(Request $request)
    {
        $today = new DateTime();
        $data = FinancialEntity::firstOrNew(['id' => $request->id]);
        $price_logs = EntityPriceLog::where('financial_entity_id', $request->id)
                        ->orderBy('date')
                        ->get() ?? new EntityPriceLog();

        $modal = view('financial_entities.modal', compact('data','price_logs'))->render();

        return response()->json(['modal' => $modal]);
    }

    public function edit($id)
    {
        $data = FinancialEntity::findOrFail($id);
        return view('financial_entities.edit', compact('data'));
    }

    public function update(Request $request)
    {
        $this->validation($request);  

        try 
        {
            DB::beginTransaction();

            $financial_entity = FinancialEntity::findOrFail($request->id);
            $financial_entity->company_id = $request->company_id;
            $financial_entity->name = $request->name;
            $financial_entity->entity_type = $request->entity_type;
            $financial_entity->is_current = $request->is_current;
            $financial_entity->description = $request->description;
            $financial_entity->remark = $request->remark;

            $financial_entity->created_by = Auth::id();
            $financial_entity->updated_by = Auth::id();

            $financial_entity->save();

            DB::commit();
            Log::info(trans('messages.financial_entity') . trans('messages.update_success'), ['financial_entity_id' => $financial_entity->id]);
        }
        catch (Exception $e)
        {
            DB::rollBack();
            Log::error(trans('messages.update_failed') . trans('messages.financial_entity'), ['error' => $e->getMessage()]);

            return api_response(false, trans('messages.update_failed') . trans('messages.financial_entity'));
        }

        return api_response(true, trans('messages.financial_entity') . trans('messages.update_success'));
    }

    public function destroy(Request $request)
    {
        try
        {
            DB::beginTransaction();

            // delete all entity price log
            $price_logs = EntityPriceLog::where('financial_entity_id', $request->id)->get();

            foreach($price_logs as $price_log) 
            {
                $price_log->delete();
            }

            // delete financial entity
            $data = FinancialEntity::findOrFail($request->id);
            $data->delete();

            DB::commit();
            Log::info(trans('messages.financial_entity') . trans('messages.delete_success'), ['financial_entity_id' => $request->id]);
        }
        catch (Exception $e)
        {
            DB::rollBack();
            Log::error(trans('messages.delete_failed') . trans('messages.financial_entity'), ['error' => $e->getMessage()]);

            return api_response(false, trans('messages.delete_failed') . trans('messages.financial_entity'));
        }
        
        return api_response(true, trans('messages.financial_entity') . trans('messages.delete_success'));
    }

    protected function validation(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'company_id' => 'required|numeric',
            'name' => 'required|string|max:255',
            'entity_type' => 'required|numeric',
            'is_current' => 'required|numeric',
            'description' => 'nullable|string|max:255',
            'remark' => 'nullable|string|max:255',
            'date' => 'required|date',
            'price' => 'required|numeric',
        ]);
    
        if ($validator->fails()) {
            return api_response(false, $validator->errors()->first());
        }    
    }
}
