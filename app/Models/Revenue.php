<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\SoftDelete;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Revenue extends Model
{
    use SoftDeletes;

    const sales_type_product        = 1;
    const sales_type_service        = 2;
    const sales_type_other          = 3;

    protected $fillable = [
        'company_id',
        'date',
        'sales_type',
        'sales_name',
        'sales_amount',
        'cost_of_sales',
        'description',
        'remark',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'date' => 'date',
        'sales_type' => 'integer',
        'sales_amount' => 'decimal:2',
        'cost_of_sales' => 'decimal:2',
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
