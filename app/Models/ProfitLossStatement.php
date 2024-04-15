<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class ProfitLossStatement extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'company_id',
        'date',
        'total_net_sales',
        'total_cost_of_sales',
        'gross_margin',
        'other_income_expense',
        'income_before_tax',
        'tax_rate',
        'tax_paid',
        'net_income',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'date' => 'date',
        'total_net_sales' => 'decimal:2',
        'total_cost_of_sales' => 'decimal:2',
        'gross_margin' => 'decimal:2',
        'other_income_expense' => 'decimal:2',
        'income_before_tax' => 'decimal:2',
        'tax_rate' => 'decimal:2',
        'tax_paid' => 'decimal:2',
        'net_income' => 'decimal:2',
    ];

    public function scopeFilter($query)
    {
        $queryParams = request()->query();

        if (isset($queryParams['company_id'])) {
            $query->where('company_id', $queryParams['company_id']);
        }
        
        if (isset($queryParams['start_date'])) {
            $query->where('date', '>=', $queryParams['start_date']);
        }
    
        if (isset($queryParams['end_date'])) {
            $query->where('date', '<=', $queryParams['end_date']);
        }

        return $query;
    }

}
