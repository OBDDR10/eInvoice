<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'pic_name',
        'pic_contact_number',
        'checker',
        'checker_name',
        'checker_contact_number',
        'bank_name',
        'bank_account',
        'remark',
        'created_by',
        'updated_by',
    ];

    public static function getCompanies()
    {
        $companies = Company::get();

        return $companies ? $companies : [];
    }
}
