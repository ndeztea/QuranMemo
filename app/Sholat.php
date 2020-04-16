<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class Sholat extends Model
{
    //
    protected $table = 'sholat';
    public $id = '';
    public $location = '';
    public $subuh = '';
    public $dzuhur = '';
    public $ashar = '';
    public $maghrib = '';
    public $isya = '';
    protected $fillable = array('location','subuh','dzuhur','ashar','maghrib','isya','date');

    public function store($data){
        if(!empty($data['id'])){
          return DB::table($this->table)->where('id',$data['id'])->update($data);
        }else{
          return DB::table($this->table)->insertGetId($data);
        }
    }

    public function getDetail($location,$date){
      $detail = DB::table($this->table)
              ->select('location','subuh','dzuhur','ashar','maghrib','isya')
              ->where('location','=',$location)
              ->where('date','=',$date)
              ->get();
      if (!empty($detail)){
        return $detail[0];
      }
      return false;
    }
}
