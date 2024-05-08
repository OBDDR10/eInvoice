<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InvoiceDetail extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'invoice_id',
        'description',
        'quantity',
        'unit_price',
        'amount',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'quantity' => 'integer',
        'unit_price' => 'decimal:2',
        'amount' => 'decimal:2',
    ];

    public function scopeFilter($query)
    {
        $queryParams = request()->query();

        // if (isset($queryParams['company_id'])) {
        //     $query->where('company_id', $queryParams['company_id']);
        // }
        
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
