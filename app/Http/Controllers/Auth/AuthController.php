<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\Users;
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
        $dataHTML['modal_title'] = 'Login';
        $dataHTML['modal_body'] = view('auth_login',$data)->render();
        $dataHTML['modal_footer'] = '<a href="javascript:;" onclick="QuranJS.callModal(\'auth/forget\')">Minta Password ?';

        return response()->json($dataHTML);
    }

    public function forget(){
        $data[''] = '';
        $dataHTML['modal_class'] = 'login-mode';
        $dataHTML['modal_title'] = 'Minta Password';
        $dataHTML['modal_body'] = view('auth_forget',$data)->render();
        $dataHTML['modal_footer'] = '<a href="javascript:;" onclick="QuranJS.callModal(\'auth/login\')">Login <i class="fa fa-angle-right"></i>';

        return response()->json($dataHTML);
    }

    public function logout(Request $request){
        // remove all sessions
        $request->session()->forget('sess_id');
        $request->session()->forget('sess_email');
        $request->session()->forget('sess_name');
        return redirect('mushaf');
    }

    /**
    * login action from modal
    *
    */
    public function loginAction(Request $request){
        $data['email'] = $request->input('email');
        $data['password'] = $request->input('password');

        // auth by
        $objUsers = new Users;
        $dataLogin = $objUsers->login($data);
        if ($dataLogin){
            $dataHTML['login'] = true;
            $dataHTML['redirect'] = url('dashboard');

            // set session
            $request->session()->put('sess_id', $dataLogin->id);
            $request->session()->put('sess_email', $dataLogin->email);
            $request->session()->put('sess_name', $dataLogin->name);
        }else{
            $dataHTML['login'] = false;
        }

        return response()->json($dataHTML);
    }

    /**
    * forget password action
    *
    */
    public function forgetProcess(Request $request){
        $data['email'] = $request->input('email');

        // auth by
        $objUsers = new Users;
        $dataLogin = $objUsers->checkEmail($data);
        if ($dataLogin){
            $dataHTML['return'] = true;
           // process random password
            $objUsers->setRandomPassword($data);
        }else{
            $dataHTML['return'] = false;
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
