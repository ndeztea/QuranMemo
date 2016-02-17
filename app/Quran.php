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
    	$ayats = DB::table('quran_arabic as qar')
                ->leftJoin('quran_indonesia as qid', 'qar.id', '=', 'qid.id')
    			->select('qid.text as text_indo','qar.text','qar.ayat','qar.surah','qar.page')
                ->where('page',$page);


        return $ayats->get();
    }

    /**
    * get range surah for hafalan
    *
    */
    public function getRangeAyat($surah_start,$ayat_start,$surah_end,$ayat_end){
        $ayats = DB::table('quran_arabic as qar')
                ->leftJoin('quran_indonesia as qid', 'qar.id', '=', 'qid.id')
                ->select('qid.text as text_indo','qar.text','qar.ayat','qar.surah','qar.page');
        if($surah_start==$surah_end){
            $ayats->where('qar.surah','=',$surah_start)
                    ->where('qar.ayat','>=',$ayat_start)
                    ->where('qar.ayat','<=',$ayat_end);
        }elseif($surah_start!=$surah_end){
            $ayats->where('qar.surah','>=',$surah_start)
                    ->where('qar.ayat','>=',$ayat_start);
                    /*->orWhere(function ($subQuery){
                            global $surah_end,$ayat_end;
                            $subQuery->where('surah','<=',$surah_end)
                                        ->where('ayat','<=',$ayat_end);
                            });*/
        }       

        return $ayats->get();
    }

    /**
    * get range surah for hafalan
    *
    */
    public function getOneAyat($id_surah,$ayat){
        $ayats = DB::table('quran_arabic as qar')
                ->leftJoin('quran_indonesia as qid', 'qar.id', '=', 'qid.id')
                ->select('qid.text as text_indo','qar.text','qar.ayat','qar.surah','qar.page');
        
        $ayats->where('qar.surah','=',$id_surah)
                ->where('qar.ayat','=',$ayat);

        return $ayats->get();
    }

    /**
    * get surah list
    * 
    */
    public function getSurah($id_surah=0){
        $surah = DB::table('quran_indonesia')
                ->select('surah as id','surah_name');

        if($id_surah!=0){
            $surah->where('surah','=',$id_surah);
        }
        $surah->groupBy('surah')
                ->orderBy('id','asc');
        //dd($surah->toSql());
        return $surah->get();
    }

    /**
    * get surah page
    * 
    */
    public function getSurahPage($surah){
        $page = DB::table('quran_arabic')
                ->select('page')
                ->where('surah',$surah)
                ->groupBy('surah')
                ->orderBy('id','asc')
                ->get();


        return $page[0]->page;
    }




}
