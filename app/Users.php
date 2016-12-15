<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;


class Users extends Model
{
    //
    protected $table = 'users';
    public $id;
    public $name;
    public $email;
    public $password;
    public $state;
    public $id_surah;
    public $id_ayat;
    public $is_active;
    public $city;
    public $address;

    protected $fillable = array('name', 'email', 'password','city','address','hp','device_id');

    public function login($data){
    	// login code
         $user = DB::table($this->table)
                ->select('*')
                ->where('email','=',$data['email'])
                ->first();
        if(!empty($user)){
            if(Hash::check($data['password'],$user->password))
                return $user;
        }
        return false;
    }

    public function checkEmail($data){
        // login code
         $user = DB::table($this->table)
                ->select('*')
                ->where('email','=',$data['email'])
                ->first();

        if(!empty($user)){
            return $user;
        }
        return false;
    }

    public function getUsersDevicetId($deviceId){
         $juz = DB::table($this->table)
                ->select('*')
                ->where('device_id','=',$deviceId)
                ->orderBy('id','asc')
                ->get();


        return $juz;
    }

    public function edit($dataUser){
        return DB::table($this->table)->where('id',$dataUser['id'])->update($dataUser);
    }

    /**
    *  get random password based on random ayat
    *
    */
    public function setRandomPassword($data){
        $password = DB::table('quran')
                ->select('*')
                ->orderByRaw('RAND()')->first();

        $newpassword = str_replace(' ', '-', $password->surah_name);
        $newPassword = $newpassword.':'.$password->ayat;

        // update now
        $dataUser['password'] = Hash::make($newPassword);
        $dataUser['email'] = $data['email'];
        $sucess = DB::table($this->table)->where('email',$dataUser['email'])->update($dataUser);
        if($sucess){
            return $newPassword;
        }else{
            return false;
        }
        
        
        
    }

}
