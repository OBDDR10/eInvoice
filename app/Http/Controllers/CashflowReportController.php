<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CashflowReport;
use App\Models\FinancialActivity;

class CashflowReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('user.roles:admin');
    }
    
    public function index(Request $request)
    {
        $data = FinancialActivity::filter()
                    ->selectRaw('activity_type, name, action_type, SUM(amount) as total_amount')
                    ->groupBy('activity_type', 'name', 'action_type')
                    ->orderBy('activity_type')
                    ->orderBy('name')
                    ->orderBy('action_type')
                    ->get();

        $total_operation_received_from          = FinancialActivity::filter()->where('activity_type', 1)->where('action_type', 1)->sum('amount');
        $total_operation_paid_for               = FinancialActivity::filter()->where('activity_type', 1)->where('action_type', 2)->sum('amount');
        $total_investing_received_from          = FinancialActivity::filter()->where('activity_type', 2)->where('action_type', 1)->sum('amount');
        $total_investing_paid_for               = FinancialActivity::filter()->where('activity_type', 2)->where('action_type', 2)->sum('amount');
        $total_financing_received_from          = FinancialActivity::filter()->where('activity_type', 3)->where('action_type', 1)->sum('amount');
        $total_financing_paid_for               = FinancialActivity::filter()->where('activity_type', 3)->where('action_type', 2)->sum('amount');
        $total_operation_net_cashflow           = $total_operation_received_from - $total_operation_paid_for;
        $total_investing_net_cashflow           = $total_investing_received_from - $total_investing_paid_for;
        $total_financing_net_cashflow           = $total_financing_received_from - $total_financing_paid_for;
        $total_net_cashflow                     = $total_operation_net_cashflow + $total_investing_net_cashflow + $total_financing_net_cashflow;

        $totals = [
            'total_operation_received_from'     => $total_operation_received_from,
            'total_operation_paid_for'          => $total_operation_paid_for,
            'total_operation_net_cashflow'      => $total_operation_net_cashflow,
            'total_investing_received_from'     => $total_investing_received_from,
            'total_investing_paid_for'          => $total_investing_paid_for,
            'total_investing_net_cashflow'      => $total_investing_net_cashflow,
            'total_financing_received_from'     => $total_financing_received_from,
            'total_financing_paid_for'          => $total_financing_paid_for,
            'total_financing_net_cashflow'      => $total_financing_net_cashflow,
            'total_net_cashflow'                => $total_net_cashflow
        ];

        if ($request->ajax()) 
        {
            $table = view('cashflow_reports.table', compact('data','totals'))->render();

            return response()->json(['table' => $table, 'data' => $data, 'totals' => $totals]);
        }

        return view('cashflow_reports.index', compact('data','totals'));
    }

    public function create()
    {
        return view('cashflow_reports.create');
    }

    public function store(Request $request)
    {
        CashflowReport::create($request->all());
        return redirect()->route('cashflow_reports.index');
    }

    public function show($id)
    {
        $report = CashflowReport::findOrFail($id);
        return view('cashflow_reports.show', compact('report'));
    }

    public function edit($id)
    {
        $report = CashflowReport::findOrFail($id);
        return view('cashflow_reports.edit', compact('report'));
    }

    public function update(Request $request, $id)
    {
        $report = CashflowReport::findOrFail($id);
        $report->save();
        return redirect()->route('cashflow_reports.index');
    }

    public function destroy($id)
    {
        $report = CashflowReport::findOrFail($id);
        $report->delete();
        return redirect()->route('cashflow_reports.index');
    }
}
