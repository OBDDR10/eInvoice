<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\SoftDelete;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class FinancialActivity extends Model
{
    use SoftDeletes;

    const activity_type_operation     = 1;
    const activity_type_investing     = 2;
    const activity_type_financing     = 3;

    const action_type_received_from   = 1;
    const action_type_paid_for        = 2;

    protected $fillable = [
        'company_id',
        'date',
        'name',
        'activity_type',
        'action_type',
        'description',
        'amount',
        'remark',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'date' => 'date',
        'activity_type' => 'integer',
        'action_type' => 'integer',
        'amount' => 'decimal:2',
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
