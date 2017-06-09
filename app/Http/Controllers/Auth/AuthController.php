<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\Users;
use Validator;
use Cookie;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;
use App\Http\Requests;

use Mail;


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
        return redirect('mushaf')->withCookie(Cookie::forget('coo_quranmemo_email'))->withCookie(Cookie::forget('coo_quranmemo_password'));
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
            $dataHTML['coo_quranmemo_email'] = $dataLogin->email;
            $dataHTML['coo_quranmemo_password'] = $dataLogin->password;

            // update last login
            $dataUser['last_login'] = date('Y-m-d h:i:s');
            $dataUser['id'] = $dataLogin->id;
            $objUsers->edit($dataUser);

            // set session
            $request->session()->put('sess_id', $dataLogin->id);
            $request->session()->put('sess_email', $dataLogin->email);
            $request->session()->put('sess_name', $dataLogin->name);

            // set cookie
            /*setcookie('coo_quranmemo_email',$dataLogin->email);
            setcookie('coo_quranmemo_password',$dataLogin->password);
            Cookie::forever('coo_quranmemo_email', $dataLogin->email);
            Cookie::forever('coo_quranmemo_password', $dataLogin->password);*/

        }else{
            $dataHTML['login'] = false;
            $dataHTML['errorMessage'] = 'Login salah';
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
        $dataUser = $objUsers->checkEmail($data);
        if ($dataUser){
            $dataHTML['return'] = true;

            // process random password
            $newPassword = $objUsers->setRandomPassword($data);
            $emailData['newPassword'] = $newPassword;
            $emailData['name'] = $dataUser->name;
            $emailData['email'] = $dataUser->email;

            $dataHTML['newPassword'] = $newPassword;

             Mail::send('emails.forget_password', ['emailData' => $emailData], function ($m) use ($emailData) {
                $m->from('info@quranmemo.id', 'QuranMemo');
                $m->to($emailData['email'], $emailData['name'])->subject('Password baru QuranMemo!');
            });

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
