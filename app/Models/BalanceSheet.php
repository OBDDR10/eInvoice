<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class BalanceSheet extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'company_id',
        'date',
        'total_assets',
        'total_liabilities',
        'total_equities',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'date' => 'date',
        'total_assets' => 'decimal:2',
        'total_liabilities' => 'decimal:2',
        'total_equities' => 'decimal:2',
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
