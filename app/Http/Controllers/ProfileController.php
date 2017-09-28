<?php

namespace App\Http\Controllers;

use DB;
use Image; 
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
        $data['header_top_title'] = $data['header_title'] = 'Edit Profile';
        $data['body_class'] = 'body-editprofile';
        $UsersModel = new Users;

        if($request->get('action')!=''){
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
            $dataProfile['id'] = session('sess_id');
            $dataProfile['name'] = $request->get('name');
            $dataProfile['city'] = $request->get('city');
            $dataProfile['address'] = $request->get('address');
            $dataProfile['gender'] = $request->get('gender');
            $dataProfile['hp'] = $request->get('hp');
            $dataProfile['dob'] = $request->get('dob');
            $UsersModel->edit($dataProfile);

            return redirect('profile/edit')->with('messageSuccess', 'Profile berhasil disimpan')->withInput();

        }

        // avatar
        $data['detailUser'] = $UsersModel->getDetail(session('sess_id'))[0];


        return view('profile_edit',$data);
    }

    public function uploadAvatar(Request $request){
        $UsersModel = new Users;
        $detailUser = $UsersModel->getDetail(session('sess_id'))[0];

        if(!empty($request->file('avatar'))){
            if ($request->file('avatar')->isValid()) {
                $fileName = session('sess_id').uniqid('_avatar_').'.jpg';
                $path = $request->file('avatar')->move(public_path('assets/images/avatar'), $fileName);
                // make sure upload sucess
                if(File::exists($path)){
                    // resize
                    Image::make($path)->resize(null,200, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($path);

                    // remove old photo
                    File::delete(public_path('assets/images/avatar/'.$detailUser->avatar));

                    // store to DB
                    $dataProfile['avatar'] = $fileName;
                    $dataProfile['id'] = session('sess_id');
                    $UsersModel->edit($dataProfile);

                }else{
                    return 'false';
                }
            }else{
                return 'false';
            }
        }else{
            return 'false';
        }
        
        return url('assets/images/avatar/'.$fileName);
    }

    
}
