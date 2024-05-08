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
        'registration_no',
        'email',
        'contact_number',
        'pic_name',
        'address_1',
        'address_2',
        'address_3',
        'bank',
        'bank_name',
        'bank_account_no',
        'created_by',
        'updated_by',
    ];

    public static function getCompanies()
    {
        $companies = Company::get();

        return $companies ? $companies : [];
    }
}
