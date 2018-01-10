<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;


class Subscriptions extends Model
{
    //
    protected $table = 'user_subscriptions';
    public $id;
    public $id_user;
    public $level;
    public $created_date;
    public $expired_date;
    public $active;
    public $status;
    public $price;
    public $paid;
    public $length;

    protected $fillable = array('id_user','level', 'created_date', 'expired_date','status','price','paid','length');

    public function store($data){
        return DB::table($this->table)->insertGetId($data);
    }

    public function edit($data){
        return DB::table($this->table)->where('id',$data['id'])->update($data);
    }

    public function remove($id){
        return DB::table($this->table)->where('id',$id)->delete();
    }

     public function getDetail($id){
        $memoDetail = DB::table($this->table)
                ->select('*')
                ->where('id',$id)
                ->first();


        return $memoDetail;
    }

    public function getActiveSubscriptions($id_user){
        $now = (string) Carbon::now();
        $list = DB::table($this->table)
                ->select('*')
                ->where('id_user',$id_user)
                ->where('active',1)
                ->where('expired_date','>',$now)
                ->get();


        return $list;
    }

    public function getPendingSubscriptions($id_user){
        $list = DB::table($this->table)
                ->select('*')
                ->where('id_user',$id_user)
                ->where('active',0)
                ->orderBy('id','desc')
                ->get();


        return $list;
    }

    public function getAllPendingSubscriptions(){
        $list = DB::table($this->table.' as sub')
                ->select('sub.*','user.name','user.hp')
                ->join('users as user', 'user.id', '=', 'sub.id_user')
                ->where('sub.active',0)
                ->where('sub.status',0)
                ->orderBy('sub.id','desc')
                ->get();


        return $list;
    }

    public function getAllApprovalSubscriptions(){
        $list = DB::table($this->table.' as sub')
                ->select('sub.*','user.name','user.hp')
                ->join('users as user', 'user.id', '=', 'sub.id_user')
                ->where('sub.active',0)
                ->where('sub.status',1)
                ->orderBy('sub.id','desc')
                ->get();


        return $list;
    }

    public function getAllActiveSubscriptions(){
        $now = (string) Carbon::now();
        $list =DB::table($this->table.' as sub')
                ->select('sub.*','user.name','user.hp')
                ->join('users as user', 'user.id', '=', 'sub.id_user')
                ->where('sub.active',1)
                ->where('sub.expired_date','>',$now)
                ->get();


        return $list;
    }

    

}
