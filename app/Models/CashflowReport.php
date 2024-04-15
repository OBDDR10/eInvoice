<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class CashflowReport extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'company_id',
        'date',
        'net_cashflow_operation',
        'net_cashflow_investing',
        'net_cashflow_financing',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'date' => 'date',
        'net_cashflow_operation' => 'decimal:2',
        'net_cashflow_investing' => 'decimal:2',
        'net_cashflow_financing' => 'decimal:2',
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
