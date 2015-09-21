<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class Quran extends Model
{
    //

    /**
    * get list page
    *
    */
    public function getPage(){
    	$pages = DB::table('quran_arabic')
    			->select('page')
                ->groupBy('page')
                ->get();


        return $pages;
    }

    /**
    * get ayat on the page
    * 
    * @param $page INT
    */
    public function getAyat($page){
    	$pages = DB::table('quran_arabic as qar')
                ->leftJoin('quran_indonesia as qid', 'qar.id', '=', 'qid.id')
    			->select('qid.text as text_indo','qar.text','qar.ayat','qar.surah')
                ->where('page',$page)
                ->get();


        return $pages;
    }

    /**
    * get surah list
    * 
    */
    public function getSurah(){
        $surah = DB::table('quran_indonesia')
                ->select('id','surah_name')
                ->get();


        return $surah;
    }
}
