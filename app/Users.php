<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;


class Users extends Model
{
    //
    protected $table = 'users';
    public $id;
    public $name;
    public $gender;
    public $email;
    public $password;
    public $state;
    public $id_surah;
    public $id_ayat;
    public $is_active;
    public $city;
    public $address;
    public $dob;

    protected $fillable = array('name', 'email', 'gender','password','city','address','hp','device_id','dob');

    public function login($data,$encyrpt=''){
    	// login code
         $user = DB::table($this->table)
                ->select('*')
                ->where('email','=',$data['email'])
                ->first();
        if(!empty($user)){
            if($encyrpt){
                if($data['password']==$user->password)
                    return $user;
            }else{
                if(Hash::check($data['password'],$user->password))
                    return $user;
            }
            
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
    * get detail data
    */ 
    public function getDetail($id){
        $detailUser = DB::table($this->table)
                ->select('*')
                ->where('id','=',$id)
                ->get();


        return $detailUser;
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

    public function checkLevel($id_user){
        $now = (string) Carbon::now();

        $level = DB::table('user_subscriptions')
                ->select('*')
                ->where('id_user','=',$id_user)
                ->where('expired_date','>',$now)
                ->where('active','=',1)
                ->orderBy('id','asc')
                ->get();

        if(!empty($level)){
            return $level[0]->level;
        }
        return 0;
    }

    public function topUser($days=0){
        $list = DB::table('users as u')
                ->selectRaw('u.name,u.avatar,u.gender,sum(up.points) as points,u.hp')
                ->join('user_points as up', 'up.id_user', '=', 'u.id')
                ->orderBy('points','desc')
                ->groupBy('up.id_user')
                ->where('u.role','=',0)
                ->offset(0)->limit(20);

        if($days!=''){
            $list->whereRaw('date > NOW() - INTERVAL '.$days.' DAY');
        }

        return $list->get();
    }

}
