<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Type\Decimal;

class SystemParameter extends Model
{
    protected $table = 'system_parameters';
    public $timestamps = false;

    protected $fillable = [
        'param_category',
        'param_key',
        'param_value',
    ];

    public static function getTaxRate()
    {
        $systemParameter = SystemParameter::where('param_key', 'tax_rate')->first();

        return $systemParameter ? (double) $systemParameter->param_value : 0.0;
    }

    public function getTaxRateAttribute()
    {
        return self::getTaxRate();
    }

    public static function getRefNoCounter()
    {
        $systemParameter = SystemParameter::where('param_key', 'ref_no_counter')->first();

        return $systemParameter ? (int) $systemParameter->param_value : 0.0;
    }

    public function getRefNoCounterAttribute()
    {
        return self::getgetRefNoCounter();
    }

    public static function getCurrencyCode()
    {
        $systemParameter = SystemParameter::where('param_key', 'currency_code')->first();

        return $systemParameter ? (string) $systemParameter->param_value : 'MYR';
    }

    public function getCurrencyCodeAttribute()
    {
        return self::getCurrencyCode();
    }

    public static function updateRefNoCounter($counter)
    {
        self::where('param_key', 'ref_no_counter')->update(['param_value' => $counter]);
    }
}
