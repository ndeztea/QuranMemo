<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;


class Events extends Model
{
    //
    protected $table = 'events';
    public $id = '';
    public $id_user = '';
    public $name = '';
    public $questions = '';
    public $answer = '';
    public $params = '';
    public $date = '';

    protected $fillable = array('event','location','speaker','date','time','image','is_special');

    public function store($data){
        return DB::table($this->table)->insertGetId($data);
    }

    public function edit($data){
        return DB::table($this->table)->where('id',$data['id'])->update($data);
    }

    public function remove($data){
        return DB::table($this->table)->where('id',$data['id'])->update($data);
    }

    public function getDetail($id){
        $quiz = DB::table($this->table)
                ->select('*')->where('id',$id);

        $detail = $quiz->get();

        return !empty($detail)?$detail[0]:'';
    }

    public function getList($activeOnly=true,$isSpecial=false){
        $quiz = DB::table($this->table)
                ->select('*');
        if($activeOnly==true){
          $date_now = \Carbon\Carbon::now()->format('Y-m-d');
          $quiz->whereRaw('date>='.$date_now);
        }
        if($isSpecial==true){
          $quiz->where('is_special',1);
        }
        return $quiz->get();
    }

    public function getAttend($id_event,$code_access='',$gender=''){
        $events = DB::table('users as a')
                ->select('b.id','a.name','b.code_access','b.attend')
                ->join('events_join as b','a.id','=','b.id_user')
                ->where('b.id_event',$id_event);
        if($code_access!=''){
          $events->where('b.code_access',$code_access);
        }
        if($gender!=''){
          $events->where('a.gender',$gender);
        }

        return $events->get();
    }

    public function joinEvent($data){

      return DB::table('events_join')->insertGetId($data);
    }

    public function attendEvent($code_access,$attend=1){
      $data['attend'] = $attend;
      return DB::table('events_join')->where('code_access',$code_access)->update($data);
    }

    public function removeAttend($code_access){
      return DB::table('events_join')->where('code_access',$code_access)->delete();
    }

    public function myAttend($id_event,$id_user){
      return DB::table('events_join')
        ->where('id_event',$id_event)
        ->where('id_user',$id_user)
        ->get();
    }

    public function attendDetail($code_access){
      return DB::table('events_join')
        ->where('code_access',$code_access)
        ->get()[0];
    }

    public function sortAttend($id_event,$id){
      return DB::table('events_join')
        ->where('id_event',$id_event)
        ->where('id','<=',$id)
        ->count();
    }

}
