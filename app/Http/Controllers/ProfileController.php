<?php

namespace App\Http\Controllers;

use DB;
use App\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Crypt;
use File;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {   
        $data['header_title'] = 'Edit Profile';
        $UsersModel = new Users;

        if($request->get('action')){
            // change password
            $password = $request->get('password');
            $password_confirmation = $request->get('password');
            if($password!=''){
                if($password==$password_confirmation){
                    $dataPass['password'] = $password;
                    $dataPass['id'] = session('sess_id');
                    $UsersModel->edit($dataPass);
                }else{
                    return redirect('profile/edit')->with('messageError', 'Password tidak sama')->withInput();
                }
            }

            // change profile data
            $dataProfile['id'] = session('sess_id')
            $dataProfile['name'] = $request->get('name');
            $dataProfile['city'] = $request->get('city');
            $dataProfile['address'] = $request->get('address');
            $dataProfile['gender'] = $request->get('gender');
            $dataProfile['hp'] = $request->get('hp');
            $UsersModel->edit($dataPass);

            return redirect('profile/edit')->with('messageSuccess', 'Profile berhasil disimpan')->withInput();

        }

        // get need correction memoz
        $data['detailUser'] = $UsersModel->getDetail(session('sess_id'))[0];


        return view('profile_edit',$data);
    }

    
}
