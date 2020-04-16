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

    public $sess_role;
    public $sess_gender;
    public $sess_id_class;

    protected $fillable = array('name', 'email', 'gender','password','city','address','hp','device_id','dob');


    public function __construct(){
        $this->sess_role = session('sess_role');
        $this->sess_gender = session('sess_gender');
        $this->sess_id_class = session('sess_id_class');
    }

    public function store($data){
        return DB::table($this->table)->insertGetId($data);
    }

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

    public function getList($id_class='',$gender='',$keyword='',$page=''){
        $skip = $page==1?0:($page - 1) *50;
        $users = DB::table($this->table)
                ->select('*')->where('id_class','=',$id_class)->where('role','!=',1);

        if($keyword){
            $users->where('name','like','%'.$keyword.'%');
        }
        if($gender){
            $users->where('gender','=',$gender);
        }

        $users->skip($skip)->take(50);
        $users->orderBy('name','asc');

        return $users->get();
    }
    public function getListFromSubClass($id_sub_class='',$gender='',$keyword='',$page=''){
      $skip = $page==1?0:($page - 1) *50;
      $users = DB::table($this->table)
              ->select('*')->where('id_sub_class','=',$id_sub_class)->where('role','!=',1);

      if($keyword){
          $users->where('name','like','%'.$keyword.'%');
      }
      if($gender){
          $users->where('gender','=',$gender);
      }

      $users->skip($skip)->take(50);
      $users->orderBy('role','desc');
      $users->orderBy('name','asc');

      return $users->get();
    }

    public function getCountList($id_class='',$gender='',$keyword=''){
        $users = DB::table($this->table)
                ->select('*')->where('role','!=',1);

        if($keyword){
            $users->where('name','like','%'.$keyword.'%');
        }
        if($id_class){
            $users->where('id_class','=',$id_class);
        }
        if($gender){
            $users->where('gender','=',$gender);
        }

        return $users->count();

    }

    public function getCountFromSubClass($id_sub_class='',$gender='',$keyword=''){
        $users = DB::table($this->table)
                ->select('*')->where('role','!=',1);

        if($keyword){
            $users->where('name','like','%'.$keyword.'%');
        }
        if($id_sub_class){
            $users->where('id_sub_class','=',$id_sub_class);
        }
        if($gender){
            $users->where('gender','=',$gender);
        }

        return $users->count();

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

    public function getClass($active=1){
        $classes = DB::table('class')
                ->select('*')
                ->where('active',1)
                ->where('id_parent_class',0)
                ->orderBy('class','asc')
                ->get();

        return $classes;
    }

    public function getSubClass($id_parent_class){
      $classes = DB::table('class')
              ->select('*')
              ->where('id_parent_class',$id_parent_class)
              ->orderBy('class','asc')
              ->get();

      return $classes;
    }

    public function getPublicClass(){
        $classes = DB::table('class')
                ->select('*')
                ->where('active',1)
                ->where('lock_key','=','')
                ->where('id_parent_class','=',0)
                ->orderBy('class','asc')
                ->get();

        return $classes;
    }

    public function getClassDetail($id_class){

        $classes = DB::table('class')
                ->select('*')
                ->where('id',$id_class)
                ->orderBy('id','asc')
                ->get();
        return $classes[0];
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


    public function topUser($days=0,$gender=''){
        $list = DB::table('users as u')
                ->selectRaw('u.name,u.avatar,u.gender,sum(up.points) as points,u.hp,u.id')
                ->join('user_points as up', 'up.id_user', '=', 'u.id')
                ->orderBy('points','desc')
                ->groupBy('up.id_user')
                //->where('u.role','=',0)
                ->offset(0)->limit(30);

        if($gender!=''){
            $list->where('u.gender','=',$gender);
        }

        if($days!=''){
            $list->whereRaw('date > NOW() - INTERVAL '.$days.' DAY');
        }

        return $list->get();
    }


}
