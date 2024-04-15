<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BalanceSheet;
use App\Models\EntityPriceLog;
use App\Models\FinancialEntity;
use App\Models\FixedAsset;
use App\Models\Transaction;

class BalanceSheetController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('user.roles:admin');
    }
    
    public function index(Request $request)
    {
        $data = FinancialEntity::filter()
                            ->select('entity_type', 'is_current', 'name')
                            ->selectRaw("CASE WHEN entity_type = 1 THEN 'assets' 
                                                WHEN entity_type = 2 THEN 'liabilities'
                                                WHEN entity_type = 3 THEN 'equity'
                                                ELSE '' END AS entity_type_text")
                            ->selectSub(function ($query) {
                                $query->select('price')
                                    ->from('entity_price_logs')
                                    ->whereColumn('financial_entity_id', 'financial_entities.id')
                                    ->orderByDesc('date')
                                    ->limit(1);
                            }, 'latest_price')
                            ->orderBy('entity_type')
                            ->orderByDesc('is_current')
                            ->orderBy('name')
                            ->get();

        $fixed_assets = FixedAsset::filter()
                            ->selectRaw('name, sum(net_book_value) as total_net_book_value')
                            ->groupBy('name')
                            ->orderBy('name', 'asc')
                            ->get();

        $aging_report = Transaction::filter()->selectRaw('SUM(transactions.amount_payable - transactions.amount_paid) AS total');
        
        $account_receivable                 = $aging_report->where('receiving_company_id', 1)->limit(1)->value('total');
        $account_payable                    = $aging_report->where('paying_company_id', 1)->limit(1)->value('total');
        
        $total_current_assets               = $data->where('entity_type', FinancialEntity::entity_type_asset)
                                                    ->where('is_current',1)->sum('latest_price') + $account_receivable;
        
        $total_non_current_assets           = $data->where('entity_type', FinancialEntity::entity_type_asset)
                                                    ->where('is_current',0)->sum('latest_price') + $fixed_assets->sum('total_net_book_value');
        
        $total_current_liabilities          = $data->where('entity_type', FinancialEntity::entity_type_liability)
                                                   ->where('is_current',1)->sum('latest_price') + $account_payable;
        
        $total_non_current_liabilities      = $data->where('entity_type', FinancialEntity::entity_type_liability)
                                                   ->where('is_current',0)->sum('latest_price');

        $total_assets                       = $total_current_assets + $total_non_current_assets;
        $total_liabilities                  = $total_current_liabilities + $total_non_current_liabilities;
        $total_shareholder_equity           = $total_assets - $total_liabilities;
        $retained_earnings                  = $total_shareholder_equity - $data->where('entity_type', FinancialEntity::entity_type_equity)->sum('latest_price');

        $totals = [
            'account_receivable'                        => $account_receivable,
            'account_payable'                           => $account_payable,
            'total_current_assets'                      => $total_current_assets,
            'total_non_current_assets'                  => $total_non_current_assets,
            'total_assets'                              => $total_assets,
            'total_current_liabilities'                 => $total_current_liabilities,
            'total_non_current_liabilities'             => $total_non_current_liabilities,
            'total_liabilities'                         => $total_liabilities,
            'retained_earnings'                         => $retained_earnings,
            'total_shareholder_equity'                  => $total_shareholder_equity,
        ];

        if ($request->ajax()) 
        {
            $table = view('balance_sheets.table', compact('data','fixed_assets','totals'))->render();

            return response()->json(['table' => $table]);
        }

        return view('balance_sheets.index', compact('data','fixed_assets','totals'));
    }

    public function create()
    {
        return view('balance_sheets.create');
    }

    public function store(Request $request)
    {
        BalanceSheet::create($request->all());
        return redirect()->route('balance_sheets.index');
    }

    public function show($id)
    {
        $report = BalanceSheet::findOrFail($id);
        return view('balance_sheets.show', compact('report'));
    }

    public function edit($id)
    {
        $report = BalanceSheet::findOrFail($id);
        return view('balance_sheets.edit', compact('report'));
    }

    public function update(Request $request, $id)
    {
        $report = BalanceSheet::findOrFail($id);
        $report->save();
        return redirect()->route('balance_sheets.index');
    }

    public function destroy($id)
    {
        $report = BalanceSheet::findOrFail($id);
        $report->delete();
        return redirect()->route('balance_sheets.index');
    }
}
