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

        if($this->create($request->all())){
            // send email
            $data = $request->all();
            $contentsEmail = '';
            foreach ($data as $key=>$value) {
                $contentsEmail .= $key.'='.$value.'<br>';
            }

            mail('quranmemo.id@gmail.com', 'Daftar QuranMemo', $contentsEmail);

            return redirect('register')->with('messageSuccess', 'Terima kasih telah berpartisipai, kami akan kontak Antum jika terpilih untuk mendapatkan T-Shirt Tematik QuranMemo. Jazakallah Khairan');
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
        ]);
    }
}
