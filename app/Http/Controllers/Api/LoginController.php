<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username'          => 'required|min:5|max:40|unique:members|regex:/^[A-Za-z0-9_]+$/',
            'name'              => 'required|min:5|max:255',
            'email'             => 'nullable|email',
            'contact_number'    => 'required|digits_between:9,13|unique:members',
            'password'          => 'required|min:8|max:40|same:confirm_password',
            'confirm_password'  => 'required|min:8|max:40',
        ], [
            'username.unique'               => @trans("validation.unique", ["attribute" => @trans("messages.username")]),
            'username.required'             => @trans("validation.required", ["attribute" => @trans("messages.username")]),
            'username.regex'                => @trans("validation.regex", ["attribute" => @trans("messages.username")]),
            'username.min'                  => @trans("validation.minlength", ["attribute" => @trans("messages.username"), "min" => 5]),
            'username.max'                  => @trans("validation.maxlength", ["attribute" => @trans("messages.username"), "max" => 40]),
            'name.unique'                   => @trans("validation.unique", ["attribute" => @trans("messages.name")]),
            'name.required'                 => @trans("validation.required", ["attribute" => @trans("messages.name")]),
            'name.min'                      => @trans("validation.minlength", ["attribute" => @trans("messages.name"), "min" => 5]),
            'name.max'                      => @trans("validation.maxlength", ["attribute" => @trans("messages.name"), "max" => 255]),
            'email.regex'                   => @trans("validation.regex", ["attribute" => @trans("messages.email")]),
            'contact_number.required'       => @trans("validation.required", ["attribute" => @trans("messages.contactNumber")]),
            'contactNumber.digits_between'  => @trans("validation.digits_between", ["attribute" => @trans("messages.contactNumber"), "min" => 9, "max" => 13]),
            'contact_number.unique'         => @trans("validation.unique", ["attribute" => @trans("messages.contact_number")]),
            'password.required'             => @trans("validation.required", ["attribute" => @trans("messages.password")]),
            'password.min'                  => @trans("validation.minlength", ["attribute" => @trans("messages.password"), "min" => 8]),
            'password.max'                  => @trans("validation.maxlength", ["attribute" => @trans("messages.password"), "max" => 40]),
            'password.same'                 => @trans("validation.confirmation", ["attribute" => @trans("messages.password")]),
            'confirm_password.required'     => @trans("validation.required", ["attribute" => @trans("messages.confirmpassword")]),
            'confirm_password.min'          => @trans("validation.minlength", ["attribute" => @trans("messages.confirmpassword"), "min" => 8]),
            'confirm_password.max'          => @trans("validation.maxlength", ["attribute" => @trans("messages.confirmpassword"), "max" => 40]),
        ]);

        if ($validator->fails())
            return api_response(false, $validator->errors()->first(), null, 422);

        DB::beginTransaction();
        try {
            $member                 = new Member();
            $member->username       = $request->username;
            $member->name           = $request->name;
            $member->contact_number = $request->contact_number;
            $member->password       = Hash::make($request->password);
            $member->status         = Member::status_active;
            $member->register_ip    = get_client_ip();

            $member->email          = $request->email ?? NULl;
            $member->getMemberCode();

            DB::commit();
            return api_response(true, __("messages.success"));
        } catch (\Exception $e) {
            DB::rollback();
            return api_response(false, $e->getMessage());
        }
    }

    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        $member = Auth::guard('api')->getProvider()->retrieveByCredentials($credentials);

        if (!is_null($member) && Auth::guard('api')->getProvider()->validateCredentials($member, $credentials)) {
            if ($member->status === Member::status_inactive)
                return api_response(false, 'inactiveAccount', null, 400);

            if ($member->tokens->isNotEmpty()) {
                foreach ($member->tokens as $token) {
                    $token->revoke();
                    $token->delete();
                }
            }


            $token = $member->createToken('API Token')->accessToken;
            if (empty($member->first_login_ip)) $member->first_login_ip = get_client_ip();
            $member->last_login_ip  = get_client_ip();
            $member->last_login = now();
            $member->save();

            $data = [
                'token'         => $token,
                'member'        => $member->getMemberProfile(),
            ];

            return api_response(true, __("messages.success"), $data);
        } else {
            return api_response(false, __("messages.usernameOrPasswordFail"), null, 400);
        }
    }

    public function logout(Request $request)
    {
        if (Auth::guard('api')->check()) {
            $user = Auth::guard('api')->user();
            if (!empty($user))
                $user->token()->revoke();
        }
        return api_response(true, __("messages.success"));
    }
}
