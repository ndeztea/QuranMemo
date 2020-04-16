<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    //
    protected $table = 'todo_action';
    public $id = '';
    public $id_user = '';
    public $id_todo = '';
    public $date = '';
    public $done = '';
    public $params = '';
    protected $fillable = array('id_user','id_todo','date','done','params');

    public function store($data){
        if(!empty($data['id'])){
          return DB::table($this->table)->where('id',$data['id'])->update($data);
        }else{
          return DB::table($this->table)->insertGetId($data);
        }

    }

    public function getQuestionsRange($arrSurah){
        $surah = implode(',', $arrSurah);
        return DB::table('surah')->where($data);
    }

    public function getDetail($id){
      $detail = DB::table('todo')
              ->select('*')
              ->where('id','=',$id)
              ->get()[0];
      return $detail;
    }

    public function isAlreadyStored($data){
      $detail = DB::table($this->table)
              ->select('*')
              ->where('id_todo','=',$data['id_todo'])
              ->where('id_user','=',$data['id_user'])
              ->where('date','=',$data['date'])
              ->get();
      if(!empty($detail)){
        return $detail[0];
      }
      return false;

    }

    public function getList($priority,$is_active=1,$id_sub_class=''){
        $list = DB::table('todo')
                ->select('*')
                ->where('is_active',$is_active)
                ->where('priority',$priority);

        if ($id_sub_class!=''){
          $list = $list->where('id_class',session('sess_id_class'));
        }elseif ($priority==2){
          $list->whereRaw('id_class is null');
        }
        $list->orderBy('seq','asc');
        return $list->get();
    }

    public function getData($id_user,$date){
        $list = DB::table($this->table)
                ->select('*')
                ->whereRaw('date="'.$date.'"')
                ->where('id_user',$id_user)
                ->orderBy('id','asc');
        return $list->get();
    }

    public function getSummary($idTodo,$idClass,$date,$done){
      $list = DB::table('todo_action')
              ->selectRaw('count(*) as count')
              ->join('users','users.id','=','todo_action.id_user')
              ->where('users.id_class',$idClass)
              ->where('todo_action.date',$date)
              ->where('todo_action.id_todo',$idTodo)
              ->where('users.role',0)
              ->where('done',$done);


      return $list->get();
      //$sql = "select count(*) as count FROM todo_action as a inner join users as b on a.id_user=b.id where done=1 And id_class=4 and a.date='2018-12-30'"
    }

    public function getSummaryRange($idTodo,$idUser,$dateStart,$dateEnd,$done){
      DB::enableQueryLog();
      $list = DB::table('todo_action')
              ->selectRaw('count(*) as count')
              ->join('users','users.id','=','todo_action.id_user')
              ->whereRaw('users.id='.$idUser)
              ->whereRaw('todo_action.date>="'.$dateStart.'"')
              ->whereRaw('todo_action.date<="'.$dateEnd.'"')
              ->where('todo_action.id_todo',$idTodo)
              ->where('users.role',0)
              ->where('done',$done);
              //echo $dateStart.'-'.$dateEnd;
              //dd($list->toSql());

      return $list->get();
      //$sql = "select count(*) as count FROM todo_action as a inner join users as b on a.id_user=b.id where done=1 And id_class=4 and a.date='2018-12-30'"
    }

    public function getSummaryRangeWajib($idTodo,$idUser,$dateStart,$dateEnd,$done){
      DB::enableQueryLog();
      $list = DB::table('todo_action')
              ->selectRaw('done,params')
              ->join('users','users.id','=','todo_action.id_user')
              ->whereRaw('users.id='.$idUser)
              ->whereRaw('todo_action.date>="'.$dateStart.'"')
              ->whereRaw('todo_action.date<="'.$dateEnd.'"')
              ->where('todo_action.id_todo',$idTodo)
              ->where('users.role',0)
              ->where('done',$done);
              //echo $dateStart.'-'.$dateEnd;
              //dd($list->toSql());

      return $list->get();
      //$sql = "select count(*) as count FROM todo_action as a inner join users as b on a.id_user=b.id where done=1 And id_class=4 and a.date='2018-12-30'"
    }

    public function getCountStar($idUser,$type){
      $counter = DB::table('todo_action')
              ->selectRaw('count(*) as count')
              ->join('users','users.id','=','todo_action.id_user')
              ->whereRaw('users.id='.$idUser)
              ->whereRaw('todo_action.done=1');
      switch ($type) {
        case 'day':
            $counter = $counter->whereRaw('todo_action.date>="'.date('Y-m-d').'"');
          break;
        case 'week':
          $counter = $counter->whereRaw('YEARWEEK(todo_action.date, 1) = YEARWEEK(CURDATE(), 1)');
          break;

        default:
          $counter = $counter->whereRaw('MONTH(todo_action.date) = "'.date('m').'"')
                            ->whereRaw('YEAR(todo_action.date) = "'.date('Y').'"');
          break;
      }

      $counterList = $counter->get();
      return empty($counterList)?0:$counterList[0]->count;
    }

    public function getCountTodo(){
      $counter = DB::table('todo')
              ->selectRaw('count(*) as count')
              ->whereRaw('is_active=1');
      $counterList = $counter->get();
      return empty($counterList)?0:$counterList[0]->count;
    }
}
