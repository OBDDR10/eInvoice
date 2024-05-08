<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'issued_date',
        'invoice_no',
        'total_amount',
        'client_company_id',
        'client_name',
        'client_email',
        'client_contact_number',
        'client_pic_name',
        'client_address_1',
        'client_address_2',
        'client_address_3',
        'client_bank_name',
        'client_bank_account_no',
        'status',
        'created_by',
        'updated_by',
        'emailed_by',
        'emailed_at',
    ];

    protected $casts = [
        'issued_date' => 'date',
        'total_amount' => 'decimal:2',
        'status' => 'integer',
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
