<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;
use App\Http\Requests;


class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    public function login(){
        $data[''] = '';
        $dataHTML['modal_class'] = 'login-mode';
        $dataHTML['modal_title'] = 'Masuk dahulu';
        $dataHTML['modal_body'] = view('auth_login',$data)->render();
        $dataHTML['modal_footer'] = 'Lupa Password ?';

        return response()->json($dataHTML);
    }

    /**
    * login action from modal
    *
    */
    public function loginAction(Request $request){
        $data['email'] = $request->input('email');
        $data['password'] = Hash::make($request->input('password'));
        // auth by using auth lib from laravel
        if (Auth::attempt($data)){
            $dataHTML['login'] = true;
        }else{
            $dataHTML['login'] = false;
        }

        return response()->json($dataHTML);
    }

    public function registerProcess(Request $request){
        $validator = $this->validator($request->all());

        // validation
        if ($validator->fails()) {
            $messageErrors = $validator->errors();
            $errorHtml = '<ul>';
            foreach($messageErrors as $error){
                $errorHtml .= '<li>'.$error.'</li>';
            }
            $errorHtml .= '</ul>';

            $dataHTML['modal_error'] = $errorHtml;
            $dataHTML['success'] = false;

            return response()->json($dataHTML);
        }

        // save now
        Auth::login($this->create($request->all()));
        $dataHTML['success'] = true;

        return response()->json($dataHTML);
    }

    
}
