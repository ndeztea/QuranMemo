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
    public $count_correction;
    public $note;

    protected $fillable = array('id_user', 'surah_start','ayat_end','ayat_start','date_start','note');


    public function store($data){
        return DB::table($this->table)->insertGetId($data);
    }

    public function edit($data){
        DB::table($this->table)->where('id',$data['id'])->update($data);
        return $data['id'];
    }

    public function remove($id){
        return DB::table($this->table)->where('id', '=', $id)->delete();

    }

    public function getDetail($id){
        $memoDetail = DB::table($this->table)
                ->select('*')
                ->where('id',$id)
                ->first();


        return $memoDetail;
    }

    public function getList($id_user,$filter){
        $memoList = DB::table($this->table.' as memo')
                ->select('memo.*','s.name_indonesia as surah')
                ->join('surah as s', 's.id', '=', 'memo.surah_start')
                ->where('id_user',$id_user);

        if($filter!='all'){
            $memoList = $memoList->where('status',$filter);
        }
        $memoList = $memoList->orderby('date_end','asc')->get();


        return $memoList;
    }

    public function getNeedCorrection(){
        $memoList = DB::table($this->table.' as memo')
                ->select('memo.*','s.name_indonesia as surah','u.name','u.gender','u.avatar')
                ->join('users as u', 'u.id', '=', 'memo.id_user')
                ->join('surah as s', 's.id', '=', 'memo.surah_start')
                ->where('status',1)
                ->orderby('updated_at','desc')
                ->get();

        return $memoList;
    }
}
