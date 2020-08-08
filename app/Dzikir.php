<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;


class Dzikir extends Model
{
    protected $table = 'dzikir';

    public function __construct(){
        $this->sess_id = session('sess_id');
    }

    public function getList($type){
        $DList = DB::table($this->table.' as d')
                ->select('d.*');
                //->where('type',$type);


        return $DList->get();
    }
}
