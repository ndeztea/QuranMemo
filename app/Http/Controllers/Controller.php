<?php

namespace App\Http\Controllers;

use App\Users;
use App\MemoCorrection;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Illuminate\Http\Request;
use App\Http\Requests;

abstract class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct(Request $request){
    	// auto login
        $coo_email = @$_COOKIE['coo_quranmemo_email'];
        $coo_password = @$_COOKIE['coo_quranmemo_password'];
        if($coo_email && $coo_password && empty($request->session()->get('sess_id'))){
            $data['email'] = $coo_email;
            $data['password'] = $coo_password;

            // auth by
            $objUsers = new Users;
            $dataLogin = $objUsers->login($data,'no-encrypt');
            if($dataLogin){
                $dataUser['last_login'] = date('Y-m-d h:i:s');
                $dataUser['id'] = $dataLogin->id;
                $objUsers->edit($dataUser);

                // set session
                $request->session()->put('sess_id', $dataLogin->id);
                $request->session()->put('sess_email', $dataLogin->email);
                $request->session()->put('sess_name', $dataLogin->name);
                $request->session()->put('sess_role', $dataLogin->role);
                $request->session()->put('sess_gender', $dataLogin->gender);
                $request->session()->put('sess_id_class', $dataLogin->id_class);
            }
        }

        $MemoCorrectionModel = new MemoCorrection;
        $counterCorrection = $MemoCorrectionModel->getCountNew(session('sess_id'))->count;
        $request->session()->put('sess_counter_correction', $counterCorrection);
    }
}
