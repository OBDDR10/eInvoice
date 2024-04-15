<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Models\FixedAsset;
use DateTime;
use Exception;

class FixedAssetController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('user.roles:user');
    }
    
    public function index(Request $request)
    {
        $entries = $request->input('entries', 10);

        $data = FixedAsset::filter()
                    ->join('companies', 'fixed_assets.company_id', '=', 'companies.id')
                    ->select('fixed_assets.*','companies.name as company_name')
                    ->sort()
                    ->orderByDesc('fixed_assets.purchase_date')
                    ->paginate($entries);

        if ($request->ajax()) {
            $table = view('fixed_assets.table', compact('data','entries'))->render();
            $pagination = view('layouts.pagination', compact('data','entries'))->render();

            return response()->json(['table' => $table, 'pagination' => $pagination]);
        }

        return view('fixed_assets.index', compact('data','entries'));
    }

    public function create()
    {
        return view('fixed_assets.create');
    }

    public function store(Request $request)
    {
        $this->validation($request);  

        try 
        {
            DB::beginTransaction();

            $fixed_asset = new FixedAsset();
            $fixed_asset->company_id = $request->company_id;
            $fixed_asset->name = $request->name;
            $fixed_asset->purchase_date = $request->purchase_date;
            $fixed_asset->purchase_price = $request->purchase_price;
            $fixed_asset->depreciation = $request->depreciation;
            $fixed_asset->net_book_value = $request->net_book_value;
            $fixed_asset->useful_life = $request->useful_life;

            $fixed_asset->created_by = Auth::id();
            $fixed_asset->updated_by = Auth::id();

            $fixed_asset->save();

            DB::commit();
            Log::info(trans('messages.fixed_assets') . trans('messages.create_success'), ['fixed_assets_id' => $fixed_asset->id]);
        }
        catch (Exception $e)
        {
            DB::rollBack();
            Log::error(trans('messages.create_failed') . trans('messages.fixed_assets'), ['error' => $e->getMessage()]);

            return api_response(false, trans('messages.create_failed') . trans('messages.fixed_assets'));
        }

        return api_response(true, trans('messages.fixed_assets') . trans('messages.create_success'));
    }

    public function show(Request $request)
    {
        $today = new DateTime();
        $data = FixedAsset::firstOrNew(['id' => $request->id], ['purchase_date' => $today->format('Y-m-d')]);
        $modal = view('fixed_assets.modal', compact('data'))->render();

        return response()->json(['modal' => $modal]);
    }

    public function edit($id)
    {
        $data = FixedAsset::findOrFail($id);
        return view('fixed_assets.edit', compact('data'));
    }

    public function update(Request $request)
    {
        $this->validation($request);   

        try 
        {
            DB::beginTransaction();

            $fixed_asset = FixedAsset::findOrFail($request->id);
            $fixed_asset->company_id = $request->company_id;
            $fixed_asset->name = $request->name;
            $fixed_asset->purchase_date = $request->purchase_date;
            $fixed_asset->purchase_price = $request->purchase_price;
            $fixed_asset->depreciation = $request->depreciation;
            $fixed_asset->net_book_value = $request->net_book_value;
            $fixed_asset->useful_life = $request->useful_life;

            $fixed_asset->created_by = Auth::id();
            $fixed_asset->updated_by = Auth::id();

            $fixed_asset->save();

            DB::commit();
            Log::info(trans('messages.fixed_assets') . trans('messages.update_success'), ['fixed_assets_id' => $fixed_asset->id]);
        }
        catch (Exception $e)
        {
            DB::rollBack();
            Log::error(trans('messages.updated_failed') . trans('messages.fixed_assets'), ['error' => $e->getMessage()]);

            return api_response(false, trans('messages.updated_failed') . trans('messages.fixed_assets'));
        }

        return api_response(true, trans('messages.fixed_assets') . trans('messages.update_success'));
    }

    public function destroy(Request $request)
    {
        try
        {
            DB::beginTransaction();

            $data = FixedAsset::findOrFail($request->id);
            $data->delete();

            DB::commit();
            Log::info(trans('messages.fixed_assets') . trans('messages.delete_success'), ['fixed_assets_id' => $request->id]);
        }
        catch (Exception $e)
        {
            DB::rollBack();
            Log::error(trans('messages.delete_failed') . trans('messages.fixed_assets'), ['error' => $e->getMessage()]);

            return api_response(false, trans('messages.delete_failed') . trans('messages.fixed_assets'));
        }
        
        return api_response(true, trans('messages.fixed_assets') . trans('messages.delete_success'));
    }

    protected function validation(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'company_id' => 'required|numeric',
            'name' => 'required|string|max:255',
            'purchase_date' => 'required|date',
            'purchase_price' => 'required|numeric',
            'depreciation' => 'required|numeric',
            'net_book_value' => 'required|numeric',
            'useful_life' => 'nullable|numeric',
        ]);
    
        if ($validator->fails()) {
            return api_response(false, $validator->errors()->first());
        } 
    }
}
