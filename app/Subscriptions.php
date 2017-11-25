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

    protected $fillable = array('id_user','level', 'created_date', 'expired_date','status','price','paid');

    public function store($data){
        return DB::table($this->table)->insertGetId($data);
    }

    public function edit($data){
        return DB::table($this->table)->where('id',$data['id'])->update($data);
    }

     public function getDetail($id){
        $memoDetail = DB::table($this->table)
                ->select('*')
                ->where('id',$id)
                ->first();


        return $memoDetail;
    }

    

}
