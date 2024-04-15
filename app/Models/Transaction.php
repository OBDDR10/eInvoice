<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\SoftDelete;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Transaction extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'ref_no',
        'receiving_company_id',
        'paying_company_id',
        'date',
        'transaction_id',
        'product_service_name',
        'description',
        'amount_payable',
        'amount_paid',
        'remark',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'date' => 'date',
        'amount_payable' => 'decimal:2',
        'amount_paid' => 'decimal:2',
    ];

    public function scopeFilter($query)
    {
        $queryParams = request()->query();

        if (isset($queryParams['company_id'])) {
            $query->where('receiving_company_id', $queryParams['company_id'])
                  ->orWhere('paying_company_id', $queryParams['company_id']);
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
