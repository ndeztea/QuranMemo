<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class Notes extends Model
{
    //
    public $surah_start = '';
    public $surah_end = '';
    public $ayat_start = '';
    public $ayat_end = '';
    public $subject = '';
    public $note = '';
    public $flag = '';

    /**
    * get list page
    *
    */
    public function getMyNotes(){
    	$pages = DB::table('quran_arabic')
    			->select('page')
                ->groupBy('page')
                ->get();


        return $pages;
    }

    public function stored(){
        if($this->id){
            // update
        }else{
            // insert
        }
    }

    public function get($id=0){
        if($id==0){
            return $this;
        }else{
            // query to get detail
        }
        
    }
}
