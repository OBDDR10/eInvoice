<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AgingReport;
use App\Models\Transaction;

class AgingReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('user.roles:admin');
    }
    
    public function index(Request $request)
    {
        $entries = $request->input('entries', 10);

        $data = Transaction::filter()
                        ->select('transactions.paying_company_id', 'companies.name')
                        ->selectRaw('SUM(CASE WHEN DATEDIFF(CURDATE(), transactions.date) = 0 THEN (transactions.amount_payable - transactions.amount_paid) ELSE 0 END) AS current')
                        ->selectRaw('SUM(CASE WHEN DATEDIFF(CURDATE(), transactions.date) > 0 AND DATEDIFF(CURDATE(), transactions.date) <= 30 THEN (transactions.amount_payable - transactions.amount_paid) ELSE 0 END) AS over_one')
                        ->selectRaw('SUM(CASE WHEN DATEDIFF(CURDATE(), transactions.date) > 30 AND DATEDIFF(CURDATE(), transactions.date) <= 60 THEN (transactions.amount_payable - transactions.amount_paid) ELSE 0 END) AS over_thirty')
                        ->selectRaw('SUM(CASE WHEN DATEDIFF(CURDATE(), transactions.date) > 60 AND DATEDIFF(CURDATE(), transactions.date) <= 90 THEN (transactions.amount_payable - transactions.amount_paid) ELSE 0 END) AS over_sixty')
                        ->selectRaw('SUM(CASE WHEN DATEDIFF(CURDATE(), transactions.date) > 90 THEN (transactions.amount_payable - transactions.amount_paid) ELSE 0 END) AS over_ninety')
                        ->selectRaw('SUM(transactions.amount_payable - transactions.amount_paid) AS total')
                        ->join('companies', 'transactions.paying_company_id', '=', 'companies.id')
                        //->where('transactions.receiving_company_id', 1)
                        ->groupBy('transactions.paying_company_id', 'companies.name')
                        ->sort()
                        ->orderBy('transactions.paying_company_id')
                        ->paginate($entries);

        $totals = Transaction::filter()
                        ->selectRaw('SUM(CASE WHEN DATEDIFF(CURDATE(), transactions.date) = 0 THEN (transactions.amount_payable - transactions.amount_paid) ELSE 0 END) AS current')
                        ->selectRaw('SUM(CASE WHEN DATEDIFF(CURDATE(), transactions.date) > 0 AND DATEDIFF(CURDATE(), transactions.date) <= 30 THEN (transactions.amount_payable - transactions.amount_paid) ELSE 0 END) AS over_one')
                        ->selectRaw('SUM(CASE WHEN DATEDIFF(CURDATE(), transactions.date) > 30 AND DATEDIFF(CURDATE(), transactions.date) <= 60 THEN (transactions.amount_payable - transactions.amount_paid) ELSE 0 END) AS over_thirty')
                        ->selectRaw('SUM(CASE WHEN DATEDIFF(CURDATE(), transactions.date) > 60 AND DATEDIFF(CURDATE(), transactions.date) <= 90 THEN (transactions.amount_payable - transactions.amount_paid) ELSE 0 END) AS over_sixty')
                        ->selectRaw('SUM(CASE WHEN DATEDIFF(CURDATE(), transactions.date) > 90 THEN (transactions.amount_payable - transactions.amount_paid) ELSE 0 END) AS over_ninety')
                        ->selectRaw('SUM(transactions.amount_payable - transactions.amount_paid) AS total')
                        ->join('companies', 'transactions.paying_company_id', '=', 'companies.id')
                        //->where('transactions.receiving_company_id', 1)
                        ->first();

        if ($request->ajax()) 
        {
            $table = view('aging_reports.table', compact('data'))->render();
            $banner = view('aging_reports.banner', compact('totals'))->render();
            $pagination = view('layouts.pagination', compact('data','entries'))->render();

            return response()->json(['table' => $table, 'banner' => $banner, 'pagination' => $pagination]);
        }

        return view('aging_reports.index', compact('data','totals'));
    }

    public function create()
    {
        return view('aging_reports.create');
    }

    public function store(Request $request)
    {
        AgingReport::create($request->all());
        return redirect()->route('aging_reports.index');
    }

    public function show($id)
    {
        $report = AgingReport::findOrFail($id);
        return view('aging_reports.show', compact('report'));
    }

    public function edit($id)
    {
        $report = AgingReport::findOrFail($id);
        return view('aging_reports.edit', compact('report'));
    }

    public function update(Request $request, $id)
    {
        $report = AgingReport::findOrFail($id);
        $report->save();
        return redirect()->route('aging_reports.index');
    }

    public function destroy($id)
    {
        $report = AgingReport::findOrFail($id);
        $report->delete();
        return redirect()->route('aging_reports.index');
    }
}
