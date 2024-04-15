<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class AgingReport extends Model
{
    use SoftDeletes;

    const account_type_receivable       = 1;
    const account_type_payable          = 2;

    protected $fillable = [
        'company_id',
        'date',
        'account_type',
        'current_amount',
        '1_to_30_amount',
        '31_to_60_amount',
        '61_to_90_amount',
        'over_90_amount',
        'total_amount',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'date' => 'date',
        'current_amount' => 'decimal:2',
        '1_to_30_amount' => 'decimal:2',
        '31_to_60_amount' => 'decimal:2',
        '61_to_90_amount' => 'decimal:2',
        'over_90_amount' => 'decimal:2',
        'total_amount' => 'decimal:2',
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

    public function scopeSort($query)
    {
        $queryParams = request()->query();

        if (isset($queryParams['sort_by']) && isset($queryParams['sort_dir'])) {
            $query->orderBy($queryParams['sort_by'], $queryParams['sort_dir']);
        }

        return $query;
    }
}
