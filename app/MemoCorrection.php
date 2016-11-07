<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class MemoCorrection extends Model
{
    protected $table = 'memo_target_correction';
    public $id;
    public $id_user;
    public $id_user_memo;
    public $correction;
    public $note;

    protected $fillable = array('id_user', 'id_memo_target','note','correction');


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
        $memoDetail = DB::table($this->table.' as memo')
                ->select('u.name','u.email','memo.*')
                ->join('users as u', 'u.id', '=', 'memo.id_user')
                ->where('memo.id',$id)
                ->first();


        return $memoDetail;
    }

    public function getList($id_user){
        $memoList = DB::table($this->table.' as memo')
                ->select('memo.*','s.name_indonesia as surah')
                ->join('surah as s', 's.id', '=', 'memo.surah_start')
                ->where('id_user',$id_user)
                ->orderby('date_end','asc')
                ->get();



        return $memoList;
    }

    public function getMemoCorrection($id_memo_target){
        $memoList = DB::table($this->table.' as memo')
                ->select('u.name','u.email','memo.*','mt.surah_start','mt.ayat_start','mt.ayat_end')
                ->join('users as u', 'u.id', '=', 'memo.id_user')
                ->join('memo_target as mt', 'mt.id', '=', 'memo.id_memo_target')
                ->where('id_memo_target',$id_memo_target)
                ->orderby('id','desc')
                ->get();


        return $memoList;
    }
}
