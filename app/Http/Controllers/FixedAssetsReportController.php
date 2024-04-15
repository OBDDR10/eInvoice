<?php

namespace App\Http\Controllers;

use App\Models\FixedAsset;
use Illuminate\Http\Request;
use App\Models\FixedAssetsReport;

class FixedAssetsReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('user.roles:admin');
    }
    
    public function index(Request $request)
    {
        $data = FixedAsset::filter()
                    ->select('name')
                    ->selectRaw('SUM(purchase_price) as cost_opening_balance')
                    ->selectRaw('SUM(CASE WHEN useful_life = 0 THEN purchase_price ELSE 0 END) as cost_disposal')
                    ->selectRaw('(SUM(purchase_price) - SUM(CASE WHEN useful_life = 0 THEN purchase_price ELSE 0 END)) as cost_closing_balance')
                    ->selectRaw('SUM(depreciation) as depreciation_opening_balance')
                    ->selectRaw('SUM(CASE WHEN useful_life = 0 THEN depreciation ELSE 0 END) as depreciation_disposal')
                    ->selectRaw('(SUM(depreciation) - SUM(CASE WHEN useful_life = 0 THEN depreciation ELSE 0 END)) as depreciation_closing_balance')
                    ->selectRaw('SUM(net_book_value) as net_book_value_opening_balance')
                    ->selectRaw('SUM(CASE WHEN useful_life = 0 THEN net_book_value ELSE 0 END) as net_book_value_disposal')
                    ->selectRaw('(SUM(net_book_value) - SUM(CASE WHEN useful_life = 0 THEN net_book_value ELSE 0 END)) as net_book_value_closing_balance')
                    ->groupBy('name')
                    ->orderBy('name', 'ASC')
                    ->get();

        $totals = [
            'total_cost_opening_balance'            => $data->sum('cost_opening_balance'),
            'total_depreciation_opening_balance'    => $data->sum('depreciation_opening_balance'),
            'total_net_book_value_opening_balance'  => $data->sum('net_book_value_opening_balance'),
            'total_cost_disposal'                   => $data->sum('cost_disposal'),
            'total_depreciation_disposal'           => $data->sum('depreciation_disposal'),
            'total_net_book_value_disposal'         => $data->sum('net_book_value_disposal'),
            'total_cost_closing_balance'            => $data->sum('cost_closing_balance'),
            'total_depreciation_closing_balance'    => $data->sum('depreciation_closing_balance'),
            'total_net_book_value_closing_balance'  => $data->sum('net_book_value_closing_balance')
        ];

        if ($request->ajax()) 
        {
            $table = view('fixed_assets_reports.table', compact('data','totals'))->render();

            return response()->json(['table' => $table]);
        }

        return view('fixed_assets_reports.index', compact('data','totals'));
    }

    public function create()
    {
        return view('fixed_assets_reports.create');
    }

    public function store(Request $request)
    {
        FixedAssetsReport::create($request->all());
        return redirect()->route('fixed_assets_reports.index');
    }

    public function show($id)
    {
        $report = FixedAssetsReport::findOrFail($id);
        return view('fixed_assets_reports.show', compact('report'));
    }

    public function edit($id)
    {
        $report = FixedAssetsReport::findOrFail($id);
        return view('fixed_assets_reports.edit', compact('report'));
    }

    public function update(Request $request, $id)
    {
        $report = FixedAssetsReport::findOrFail($id);
        $report->save();
        return redirect()->route('fixed_assets_reports.index');
    }

    public function destroy($id)
    {
        $report = FixedAssetsReport::findOrFail($id);
        $report->delete();
        return redirect()->route('fixed_assets_reports.index');
    }
}
