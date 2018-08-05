<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;


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
    public $visitor;

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

    public function getList($id_user,$filter,$start=0,$limit=5){
        $memoList = DB::table($this->table.' as memo')
                ->select('memo.*','s.name_indonesia as surah')
                ->join('surah as s', 's.id', '=', 'memo.surah_start')
                ->where('id_user',$id_user)
                ->offset($start)
                ->limit($limit);

        if($filter!='all'){
            // murajaah query
            if($filter==3){
                $expDate = Carbon::now()->subDays(14);
                $memoList = $memoList->whereRaw('(status=1 AND (murajaah_date is null or DATEDIFF(current_date,murajaah_date) >= 14))');
            }else{
                $memoList = $memoList->where('status',$filter);
            }
            
        }

        if($filter==1){
            $memoList = $memoList->orderby('updated_at','DESC');
        }else{
            $memoList = $memoList->orderby('in_progress','desc')->orderby('date_end','asc');
        }
        //echo $id_user;
        //dd($memoList->toSql());

        return $memoList->get();
    }

    public function getCountList($id_user,$filter){
        $memoList = DB::table($this->table.' as memo')
                ->selectRaw('count(*) as counter')
                ->join('surah as s', 's.id', '=', 'memo.surah_start')
                ->where('id_user',$id_user);
        if($filter!='all'){
            // murajaah query
            if($filter==3){
                $expDate = Carbon::now()->subDays(14);
                $memoList = $memoList->whereRaw('(status=1 AND (murajaah_date is null or DATEDIFF(current_date,murajaah_date) >= 14))');
            }else{
                $memoList = $memoList->where('status',$filter);
            }
            
        }

        return $memoList->get()[0]->counter;
    }

    public function getSummaryTargetMemo($id_user){
        $memoList = DB::table($this->table.' as memo')
                ->select('surah_start','ayat_start','ayat_end')
                ->where('id_user',$id_user)
                ->where('status','!=',0)->get();

        return $memoList;
    }

    public function getAnotherList($id_user,$filter=0,$start=0,$limit=5){
        $memoList = DB::table($this->table.' as memo')
                ->select('memo.*','s.name_indonesia as surah','u.name','u.gender','u.avatar','u.dob')
                ->join('surah as s', 's.id', '=', 'memo.surah_start')
                ->join('users as u', 'u.id', '=', 'memo.id_user')
                ->where('id_user','!=',$id_user)
                ->offset($start)
                ->limit($limit);

        if($filter===0 || $filter===1){
            $memoList = $memoList->where('status','=',$filter);
        }
        //echo $id_user.'-'.$filter;
        //dd($memoList->toSql());


        $memoList = $memoList->orderby('updated_at','desc')->get();
        //dd(DB::getQueryLog());

        return $memoList;
    }

    public function getCountAnotherList($id_user,$filter=0){
        $memoList = DB::table($this->table.' as memo')
                ->select(DB::raw('count(*) as count'))->join('surah as s', 's.id', '=', 'memo.surah_start')
                ->join('users as u', 'u.id', '=', 'memo.id_user')
                ->where('id_user','!=',$id_user);
              
        if($filter!='all'){
            $memoList = $memoList->where('status',$filter);
        }

        $memoList  = $memoList->get();

        return $memoList[0]->count;
    }

    public function getNeedCorrection($start=0,$limit=5,$id_user=''){
        $memoList = DB::table($this->table.' as memo')
                ->select('memo.*','s.name_indonesia as surah','u.name','u.gender','u.avatar','u.dob')
                ->join('users as u', 'u.id', '=', 'memo.id_user')
                ->join('surah as s', 's.id', '=', 'memo.surah_start')
                ->where('status','=',1)
                ->where('record','!=','')
                ->orderby('updated_at','desc')
                ->offset($start)
                ->limit($limit)
                ->get();

        return $memoList;
    }

    public function getCountNeedCorrection(){
         $memoList = DB::table($this->table.' as memo')
                ->select(DB::raw('count(*) as count'))
                ->join('users as u', 'u.id', '=', 'memo.id_user')
                ->join('surah as s', 's.id', '=', 'memo.surah_start')
                ->where('status','=',1)
                ->get();

        return $memoList[0]->count;
    }

     public function getCountRecordedUser($id_user){
         $memoList = DB::table($this->table.' as memo')
                ->select(DB::raw('count(*) as count'))
                ->where('record','!=','')
                ->where('id_user','=',$id_user)
                ->get();

        return $memoList[0]->count;
    }

    public function setInProgress($id,$id_user){
        $updated_at = (string) Carbon::now();
        $dataRecord['updated_at'] = $updated_at;
        $dataRecord['in_progress'] = 1;
        DB::table($this->table)->where('id_user',$id_user)->update(array('in_progress'=>0));
        return DB::table($this->table)->where('id_user',$id_user)->where('id',$id)->update($dataRecord);

    }
}
