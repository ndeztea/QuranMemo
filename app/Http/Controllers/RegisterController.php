<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
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
        $data['header_title'] = 'Daftar';
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
            $errorHtml = '<p>';
            foreach($messageErrors as $error){
                $errorHtml .= $error.'<br>';
            }
            $errorHtml .= '</p>';

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

            return redirect('register')->with('messageSuccess', 'Terima kasih telah berpartisipai, kami akan kontak Antum jika terpilih untuk mendapatkan buku pilihan QuranMemo. Jazakallah Khairan');
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
            'name.required' => 'Nama harus di isi',
            'email.unique' => 'Email sudah di pakai, gunakan email yang lain',
            'email.email' => 'Email yang di masukan salah',
            'email.required' => 'Email harus di isi',
            //'password.required' => 'Password harus di isi',
            'city.required' => 'Kota harus di isi',
            'address.required' => 'Alamat lengkap harus di isi',
        ];
        
        return Validator::make($data, [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            //'password' => 'required|confirmed',
            'city' => 'required',
            'address' => 'required',
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
        
        return Users::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt('alfatihah'),
            'city'  => $data['city'],
            'address' => $data['address'],
            //'id_ayat'   =>  $data['id_ayat'],
            //'id_surah'  =>  $data['id_surah'],
            'device_id' =>  $data['device_id'],
            'is_active' =>  0
        ]);
    }
}