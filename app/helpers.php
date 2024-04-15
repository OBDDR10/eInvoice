<?php

use App\Models\Admin;
use App\Models\Group;
use App\Models\GroupTransaction;
use App\Models\Company;
use App\Models\SystemParameter;
use Illuminate\Support\Facades\Lang;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

function status($status = null)
{
    switch ($status) {
        case 1:
            return '<span class="badge rounded-pill bg-success">Active</span>';
            break;
        case 2:
            return '<span class="badge rounded-pill bg-danger">Inactive</span>';
            break;
        default:
            return '<span class="badge rounded-pill bg-secondary">Unknown</span>';
            break;
    }
}

function verified_status($status = null)
{
    switch ($status) {
        case 1:
            return '<span class="badge rounded-pill bg-success">' . __("messages.verified") . '</span>';
            break;
        case 2:
            return '<span class="badge rounded-pill bg-danger">' . __("messages.not") . " " . __("messages.verified") . '</span>';
            break;
        default:
            return '<span class="badge rounded-pill bg-secondary">Unknown</span>';
            break;
    }
}

function copy_text($text)
{
    return '<span>' . $text . '</span><i class="fas fa-copy copy-text ml-1" data-text="' . $text . '" style="background:#dcdcdc; padding:5px;border-radius:5px; cursor: pointer"></i> ';
}

function array_response($status = false, $message = 'Something Went Wrong', $data = array())
{
    return [
        'status'    => $status,
        'message'   => $message,
        'data'      => $data,
    ];
}

// function api_response($status = false, $message = null, $data = [], $code = null)
// {
//     if ($message == null) $message = __('messages.somethingWentWrong');
//     return response()->json([
//         'status'        => $status ? 1 : 0,
//         'message'       => $message,
//         'data'          => $data,
//     ], $code ? $code : ($status ? 200 : 400));
// }

function datatable_text($array = array())
{
    $text = '<div>';

    if (!empty($array)) {
        foreach ($array as $key => $value) {
            $text .= trans('messages.' . $key) . ':' . ($value ? $value : '--') . '<br>';
        }
    }

    $text .= '</div>';

    return $text;
}

function status_html($status)
{
    switch ($status) {
        case 1:
            return '<span class="badge bg-success badge-pill">' . trans('messages.active') . '</span>';
            break;
        case 2:
            return '<span class="badge bg-danger badge-pill">' . trans('messages.inactive') . '</span>';
            break;
        default:
            return '<span class="badge bg-secondary badge-pill">' . trans('messages.unknown') . '</span>';
            break;
    }
}


function status_html_order($status)
{
    switch ($status) {
        case 1:
            return '<span class="badge bg-warning badge-pill">' . trans('messages.pending') . '</span>';
            break;
        case 2:
            return '<span class="badge bg-success badge-pill">' . trans('messages.complete') . '</span>';
            break;
        default:
            return '<span class="badge bg-secondary badge-pill">' . trans('messages.reject') . '</span>';
            break;
    }
}

// Function to get the client IP address
function get_client_ip()
{
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if (isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if (isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if (isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if (isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';

    if (strpos($ipaddress, ",")) $ipaddress = explode(",", $ipaddress)[0];
    return $ipaddress;
}

function get_client_location($ipAddress)
{
    $json     = file_get_contents("http://ipinfo.io/$ipAddress/geo");
    $json     = json_decode($json, true);

    if (!empty($json['country'])) {
        if (Lang::hasForLocale('location.' . $json['country'])) $country = @trans('location.' . $json['country']);
        else $country = $json['country'];
    }
    if (!empty($json['region'])) {
        if (Lang::hasForLocale('location.' . $json['region'])) $region = @trans('location.' . $json['region']);
        else $region = $json['region'];
    }
    if (!empty($json['city'])) {
        if (Lang::hasForLocale('location.' . $json['city'])) $city = @trans('location.' . $json['city']);
        else $city = $json['city'];
    }

    return [
        'country'   => $country ?? "-",
        'region'    => $region ?? "-",
        'city'      => $city ?? "-"
    ];
}

function getQueries(Builder $builder)
{
    $addSlashes = str_replace('?', "'?'", $builder->toSql());
    return vsprintf(str_replace('?', '%s', $addSlashes), $builder->getBindings());
}

function permission_list($permissions, $seperate = 6)
{
    $text = '';
    $counter = 0;
    foreach ($permissions as $key => $value) {
        $text .= @trans("permission." . $value->name);
        if ($key != (sizeof($permissions) - 1)) $text .= ", ";

        $counter++;

        if ($counter % $seperate === 0 && $counter !== 0) {
            $text .= '<br>';
        }
    }
    if (substr($text, -2) === ',') {
        $text = substr($text, 0, -1);
    }
    return $text;
}

function api_response($status = false, $message = null, $data = [], $code = null)
{
    if ($message == null) $message = __('messages.success');
    return response()->json([
        'status'        => $status ? 1 : 0,
        'message'       => $message,
        'data'          => $data,
    ], $code ? $code : ($status ? 200 : 400));
}

function getCurrencyCode() 
{
    return SystemParameter::getCurrencyCode();
}

function generateRefNo($company_id)
{
    $date = date('ymd');
    $companyId = str_pad($company_id ?? '0', 4, '0', STR_PAD_LEFT);
    $counter = (int)SystemParameter::getRefNoCounter();

    $refNo = str_pad($counter ?? '0', 6, '0', STR_PAD_LEFT);
    $next_counter = (int)$counter + 1;
    SystemParameter::updateRefNoCounter($next_counter);

    return (string)"$date$companyId$refNo";
}

function getCompanies()
{
    $companies = Company::getCompanies();

    return $companies;
}
