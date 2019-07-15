<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;


class Content extends Model
{
    protected $table = 'assets';
    public $id;
    public $folder;
    public $level;
    public $ayat_start;
    public $ayat_end;
    public $date_start;
    public $date_end;
    public $status;
    public $count_correction;
    public $note;

    protected $fillable = array('folder', 'level');



    public function getAssetsContent(){
        $memoList = DB::table($this->table)
                ->select('*');

        return $memoList->get();
    }

    public function getAssetDetail($folder){
        $memoList = DB::table($this->table)
                ->select('*')->where('folder','=',$folder);

        return $memoList->first();
    }

}
