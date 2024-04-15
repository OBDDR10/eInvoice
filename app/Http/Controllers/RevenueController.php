<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Models\Revenue;
use DateTime;
use Exception;

class RevenueController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('user.roles:user');
    }
    
    public function index(Request $request)
    {
        $entries = $request->input('entries', 10);

        $data = Revenue::filter()
                    ->join('companies', 'revenues.company_id', '=', 'companies.id')
                    ->select('revenues.*','companies.name as company_name')
                    ->selectRaw("CASE 
                        WHEN revenues.sales_type = 1 THEN 'Product'
                        WHEN revenues.sales_type = 2 THEN 'Service'
                        WHEN revenues.sales_type = 3 THEN 'Other'
                        ELSE ''
                        END as sales_type_text")
                    ->sort()
                    ->orderByDesc('revenues.date')
                    ->paginate($entries);

        if ($request->ajax()) {
            $table = view('revenues.table', compact('data','entries'))->render();
            $pagination = view('layouts.pagination', compact('data','entries'))->render();

            return response()->json(['table' => $table, 'pagination' => $pagination]);
        }

        return view('revenues.index', compact('data','entries'));
    }

    public function create()
    {
        return view('revenues.create');
    }

    public function store(Request $request)
    {
        $this->validation($request);    

        try 
        {
            DB::beginTransaction();

            $revenue = new Revenue();
            $revenue->company_id = $request->company_id;
            $revenue->date = $request->date;
            $revenue->sales_type = $request->sales_type;
            $revenue->sales_name = $request->sales_name;
            $revenue->sales_amount = $request->sales_amount;
            $revenue->cost_of_sales = $request->cost_of_sales;
            $revenue->description = $request->description;
            $revenue->remark = $request->remark;

            $revenue->created_by = Auth::id();
            $revenue->updated_by = Auth::id();

            $revenue->save();

            DB::commit();
            Log::info(trans('messages.revenue') . trans('messages.create_success'), ['revenue_id' => $revenue->id]);
        }
        catch (Exception $e)
        {
            DB::rollBack();
            Log::error(trans('messages.create_failed') . trans('messages.revenue'), ['error' => $e->getMessage()]);

            return api_response(false, trans('messages.create_failed') . trans('messages.revenue'));
        }

        return api_response(true, trans('messages.revenue') . trans('messages.create_success'));
    }

    public function show(Request $request)
    {
        $today = new DateTime();
        $data = Revenue::firstOrNew(['id' => $request->id], ['date' => $today->format('Y-m-d')]);
        $modal = view('revenues.modal', compact('data'))->render();

        return response()->json(['modal' => $modal]);
    }

    public function edit($id)
    {
        $data = Revenue::findOrFail($id);
        return view('revenues.edit', compact('data'));
    }

    public function update(Request $request)
    {
        $this->validation($request);   

        try 
        {
            DB::beginTransaction();

            $revenue = Revenue::findOrFail($request->id);
            $revenue->company_id = $request->company_id;
            $revenue->date = $request->date;
            $revenue->sales_type = $request->sales_type;
            $revenue->sales_name = $request->sales_name;
            $revenue->sales_amount = $request->sales_amount;
            $revenue->cost_of_sales = $request->cost_of_sales;
            $revenue->description = $request->description;
            $revenue->remark = $request->remark;

            $revenue->created_by = Auth::id();
            $revenue->updated_by = Auth::id();

            $revenue->save();

            DB::commit();
            Log::info(trans('messages.revenue') . trans('messages.update_success'), ['revenue_id' => $revenue->id]);
        }
        catch (Exception $e)
        {
            DB::rollBack();
            Log::error(trans('messages.update_failed') . trans('messages.revenue'), ['error' => $e->getMessage()]);

            return api_response(false, trans('messages.update_failed') . trans('messages.revenue'));
        }

        return api_response(true, trans('messages.revenue') . trans('messages.update_success'));
    }

    public function destroy(Request $request)
    {
        try
        {
            DB::beginTransaction();

            $data = Revenue::findOrFail($request->id);
            $data->delete();

            DB::commit();
            Log::info(trans('messages.revenue') . trans('messages.delete_success'), ['revenue_id' => $request->id]);
        }
        catch (Exception $e)
        {
            DB::rollBack();
            Log::error(trans('messages.delete_failed') . trans('messages.revenue'), ['error' => $e->getMessage()]);

            return api_response(false, trans('messages.delete_failed') . trans('messages.revenue'));
        }
        
        return api_response(true, trans('messages.revenue') . trans('messages.delete_success'));
    }

    protected function validation(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'date' => 'required|date',
            'company_id' => 'required|numeric',
            'sales_type' => 'required|numeric',
            'sales_name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'sales_amount' => 'required|numeric',
            'cost_of_sales' => 'required|numeric',
            'remark' => 'nullable|string|max:255',
        ]);
    
        if ($validator->fails()) {
            return api_response(false, $validator->errors()->first());
        }  
    }
}
