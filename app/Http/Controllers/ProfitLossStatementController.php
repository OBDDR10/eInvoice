<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProfitLossStatement;
use App\Models\FinancialActivity;
use App\Models\Revenue;
use App\Models\SystemParameter;

class ProfitLossStatementController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('user.roles:admin');
    }
    
    public function index(Request $request)
    {
        $data = Revenue::filter()
                        ->select('sales_type')
                        ->selectRaw('SUM(sales_amount) as total_sales_amount')
                        ->selectRaw('SUM(cost_of_sales) as total_cost_of_sales')
                        ->selectRaw("CASE 
                            WHEN sales_type = 1 THEN 'Product'
                            WHEN sales_type = 2 THEN 'Service'
                            WHEN sales_type = 3 THEN 'Other'
                            ELSE ''
                            END as sales_type_text")
                        ->groupBy('sales_type')
                        ->orderBy('sales_type')
                        ->get();

        $operations = FinancialActivity::filter()
                        ->select('name')
                        ->selectRaw('SUM(amount) as total_amount')
                        ->where('activity_type', FinancialActivity::activity_type_operation)
                        ->where('action_type', FinancialActivity::action_type_paid_for)
                        ->groupBy('name')
                        ->orderBy('name')
                        ->get();

        $total_data                         = Revenue::filter()->get();
        $total_net_sales                    = $total_data->sum('sales_amount');
        $total_cost_of_sales                = $total_data->sum('cost_of_sales');
        $total_operation_expenses           = FinancialActivity::filter()
                                                ->where('activity_type', FinancialActivity::activity_type_operation)
                                                ->where('action_type', FinancialActivity::action_type_paid_for)
                                                ->sum('amount');

        $income_before_tax                  = $total_net_sales - $total_cost_of_sales - $total_operation_expenses;
        $tax_rate                           = SystemParameter::getTaxRate();
        $tax_paid                           = $income_before_tax * $tax_rate / 100;
        $net_income                         = $income_before_tax - $tax_paid;

        $totals = [
            'total_net_sales'               => $total_net_sales,
            'total_cost_of_sales'           => $total_cost_of_sales,
            'total_operation_expenses'      => $total_operation_expenses,
            'income_before_tax'             => $income_before_tax,
            'tax_rate'                      => $tax_rate,
            'tax_paid'                      => $tax_paid,
            'net_income'                    => $net_income
        ];

        if ($request->ajax()) 
        {
            $table = view('profit_loss_statements.table', compact('data','operations','totals'))->render();

            return response()->json(['table' => $table]);
        }

        return view('profit_loss_statements.index', compact('data','operations','totals'));
    }

    public function create()
    {
        return view('profit_loss_statements.create');
    }

    public function store(Request $request)
    {
        ProfitLossStatement::create($request->all());
        return redirect()->route('profit_loss_statements.index');
    }

    public function show($id)
    {
        $report = ProfitLossStatement::findOrFail($id);
        return view('profit_loss_statements.show', compact('report'));
    }

    public function edit($id)
    {
        $report = ProfitLossStatement::findOrFail($id);
        return view('profit_loss_statements.edit', compact('report'));
    }

    public function update(Request $request, $id)
    {
        $report = ProfitLossStatement::findOrFail($id);
        $report->save();
        return redirect()->route('profit_loss_statements.index');
    }

    public function destroy($id)
    {
        $report = ProfitLossStatement::findOrFail($id);
        $report->delete();
        return redirect()->route('profit_loss_statements.index');
    }
}
