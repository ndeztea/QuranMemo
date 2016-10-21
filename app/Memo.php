<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class Memo extends Model
{
    protected $table = 'memo_target';
    public $id;
    public $id_user;
    public $surah_start;
    public $ayat_start;
    public $ayat_end;
    public $date_start;
    public $date_end;
    public $status;
    public $note;

    protected $fillable = array('id','id_user', 'surah_start','ayat_end','ayat_start','date_start','note');


    public function store($data){
        return DB::table($this->table)->insertGetId($data);
    }

    public function edit($data){
        DB::table($this->table)->where('id',$data['id'])->update($data);
        return $data['id'];
    }

}
