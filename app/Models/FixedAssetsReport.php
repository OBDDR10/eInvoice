<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class FixedAssetsReport extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'company_id',
        'date',
        'cost_opening_balance',
        'depreciation_opening_balance',
        'net_book_value_opening_balance',
        'cost_addition',
        'depreciation_addition',
        'net_book_value_addition',
        'cost_disposal',
        'depreciation_disposal',
        'net_book_value_disposal',
        'cost_closing_balance',
        'depreciation_closing_balance',
        'net_book_value_closing_balance',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'date' => 'date',
        'cost_opening_balance' => 'decimal:2',
        'depreciation_opening_balance' => 'decimal:2',
        'net_book_value_opening_balance' => 'decimal:2',
        'cost_addition' => 'decimal:2',
        'depreciation_addition' => 'decimal:2',
        'net_book_value_addition' => 'decimal:2',
        'cost_disposal' => 'decimal:2',
        'depreciation_disposal' => 'decimal:2',
        'net_book_value_disposal' => 'decimal:2',
        'cost_closing_balance' => 'decimal:2',
        'depreciation_closing_balance' => 'decimal:2',
        'net_book_value_closing_balance' => 'decimal:2',
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
