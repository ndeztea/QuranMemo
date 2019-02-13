<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Users;
use Validator;


class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function index(){
        $data['header_top_title']  = $data['header_title'] = 'Daftar';
        $data['body_class'] = 'body-register';

        return view('register_index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function process(Request $request )
    {
        $validator = $this->validator($request->all());

        // validation

        if ($validator->fails()) {
            $messageErrors = $validator->errors()->all();
            foreach($messageErrors as $error){
                $errorHtml[] = $error;
            }
            $errorHtml = implode($errorHtml, ", ");

            return redirect('register')->with('messageError',$errorHtml)->withInput();
        }

        $lastId = $this->create($request->all());
        if($lastId){
            // send email
            $data = $request->all();
            $contentsEmail = '';
            foreach ($data as $key=>$value) {
                $contentsEmail .= $key.'='.$value.'<br>';
            }

            mail('quranmemo.id@gmail.com', 'Daftar '.config('app.app_name'), $contentsEmail);

            $UsersModel = new Users();
            #$lastRecord = $UsersModel->checkEmail($request->all());

            $request->session()->put('sess_id', $lastId);
            $request->session()->put('sess_email', $request->input('email'));
            $request->session()->put('sess_name', $request->input('name'));
            $request->session()->put('sess_role', 0);
            $request->session()->put('sess_gender', $request->input('gender'));
            $request->session()->put('sess_id_class', 1);

            return redirect('dashboard')->with('messageSuccess', 'Ahlah wa sahlan di '.config('app.app_name'));
        }else{
            return redirect('register')->with('messageError', 'Email sudah di pakai, gunakan email yang lain')->withInput();
        }
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {

        $errorMessages = [
            'name.required' => 'Nama harus diisi',
            'email.unique' => 'Email sudah dipakai, gunakan email yang lain',
            'email.email' => 'Email yang di masukan salah',
            'email.required' => 'Email harus diisi',
            'gender.required' => 'Jenis kelamin harus diisi',
            'password.required' => 'Password harus diisi',
            'password.confirmed' => 'Password tidak sama',
            'password_confirmation.required' => 'Password konfirmasi harus diisi',
            'city.required' => 'Kota harus di isi',
            'address.required' => 'Alamat lengkap harus diisi',
            'hp.required' => 'No handphone harus diisi',
            'dob.required' => 'Tanggal lahir harus diisi',
        ];

        return Validator::make($data, [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
            'gender' => 'required',
            'city' => 'required',
            'address' => 'required',
            'hp' => 'required',
            'dob' => 'required',
        ],$errorMessages);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        if(Users::where('email', '=', $data['email'])->count()>=1){
            return false;
        }
        //print_r($data);
        //die();
        $dataRecord = array(
            'name' => $data['name'],
            'gender' => $data['gender'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'city'  => $data['city'],
            'address' => $data['address'],
            'hp'    => $data['hp'],
            'dob'    => $data['dob'],
            //'id_ayat'   =>  $data['id_ayat'],
            //'id_surah'  =>  $data['id_surah'],
            'device_id' =>  $data['device_id'],
            'is_active' =>  0);
        $objUsers = new Users();
        $lastId = $objUsers->store($dataRecord);
        return $lastId;
        /*
        return Users::create([
            'name' => $data['name'],
            'gender' => $data['gender'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'city'  => $data['city'],
            'address' => $data['address'],
            'hp'    => $data['hp'],
            'dob'    => $data['dob'],
            //'id_ayat'   =>  $data['id_ayat'],
            //'id_surah'  =>  $data['id_surah'],
            'device_id' =>  $data['device_id'],
            'is_active' =>  0
        ]);*/
    }
}
