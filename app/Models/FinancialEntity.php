<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\SoftDelete;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class FinancialEntity extends Model
{
    use SoftDeletes;

    const entity_type_asset         = 1;
    const entity_type_liability     = 2;
    const entity_type_equity        = 3;

    protected $fillable = [
        'name',
        'entity_type',
        'company_id',
        'description',
        'is_current',
        'remark',
        'created_by',
        'updated_by',
    ];

    public function scopeFilter($query)
    {
        $queryParams = request()->query();

        if (isset($queryParams['company_id'])) {
            $query->where('company_id', $queryParams['company_id']);
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
