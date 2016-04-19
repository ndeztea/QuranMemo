<?php

namespace App\Http\Controllers;

use DB;
use App\Quran;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use File;

class MushafController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($page=1)
    {
        // get pages mushaf quran
        $QuranModel = new Quran;
        $pages = $QuranModel->getPage();

        // get mushaf per page
        $ayats = $QuranModel->getAyat($page);

        if(empty($ayats)){
            return redirect('mushaf');
        }

        // get surah
        $surahs = $QuranModel->getSurah();

        // showing paging
        if($page<=4){
            $pages = array_slice($pages, 0, 4); 
        }elseif($page>4 && $page<=592){
            $pages = array_slice($pages, $page - 3,5);
        }else{
            $pages = array_slice($pages, $page-3 , 5);
        }

        // send to view 
        $data['surahs'] = $surahs;
        $data['ayats'] = $ayats;
        $data['pages'] = $pages;
        $data['curr_page'] = $page;

        // data header
        $data['header_title'] = 'Mushaf Halaman '. $page;
        $data['body_class'] = 'body-mushaf';

        //print_r($pages);
        // show view template
       return view('mushaf',$data);
    }

    public function surah($id_surah,$ayat){
        $QuranModel = new Quran;

        if(strpos($ayat,'-')!==false){
            $ayatArr = explode('-', $ayat);
            $ayats = $QuranModel->getRangeAyat($id_surah,$ayatArr[0],$id_surah,$ayatArr[1]);
        }else{
            $ayats = $QuranModel->getOneAyat($id_surah,$ayat);
        }
        

        if($id_surah=='' || $ayat=='' || empty($ayats)){
            return redirect('mushaf')->with('messageError', 'Data tidak ada!');
        }

        // name surah
        $surah = $QuranModel->getSurah($id_surah);

        // get surah
        $surahs = $QuranModel->getSurah();

        $data['body_class'] = 'body-mushaf';
        
        $data['surahs'] = $surahs;
        $data['selected_surah'] = $surah[0]->surah_name;
        $data['ayats'] = $ayats;
        $data['id_surah'] = $id_surah;
        $data['ayat'] = $ayat;
        $data['curr_page'] = $ayats[0]->page;

        // data header
        $data['header_title'] = 'Surah '. $surah[0]->surah_name.' : '.$ayat;
        $data['header_description'] = $ayats[0]->text_indo;

        return view('mushaf',$data);
    }

    /**
    * search surah 
    *
    */
    public function search(Request $request){
        $surah = $request->input('surah');
        $ayat_start = $request->input('ayat_start');
        $ayat_end = $request->input('ayat_end');
        $fill_ayat_end = $request->input('fill_ayat_end');

        $QuranModel = new Quran;
        $surah_detail = $QuranModel->getSurah($surah);

        // ayat checking
        if(isset($ayat_start) || isset($ayat_end)){
            if($surah_detail[0]->ayat < $ayat_start){
                return redirect('mushaf')->with('messageError', 'Surah '.$surah_detail[0]->surah_name.' ada '.$surah_detail[0]->ayat.' ayat, ayat '.$ayat_start.' tidak ada!');
            }elseif($surah_detail[0]->ayat < $ayat_end){
                return redirect('mushaf')->with('messageError', 'Surah '.$surah_detail[0]->surah_name.' ada '.$surah_detail[0]->ayat.' ayat, ayat '.$ayat_end.' tidak ada!');
            }
        }

        if($surah && !empty($ayat_start) && !empty($ayat_end)){
            return redirect('mushaf/surah/'.$surah.'/'.$ayat_start.'-'.$ayat_end);
        }elseif($surah && !empty($ayat_start)){
            return redirect('mushaf/surah/'.$surah.'/'.$ayat_start);
        }elseif($surah){
            return redirect('mushaf/changeSurah/'.$surah);
        }else{
            return redirect('mushaf');
        }
    }

    /**
    * detect page when change surah
    *
    */
    public function changeSurah($surah){
        $QuranModel = new Quran;
        $page = $QuranModel->getSurahPage($surah);


        return redirect('mushaf/page/'.$page)->with('searchSurah', $surah);
    }

    /**
    * search surah depend the keyword
    *
    */
    public function searchKeyword(){
        $keyword = isset($_GET['keyword'])?$_GET['keyword']:'';
        $surah = isset($_GET['surah'])?$_GET['surah']:'';
        $page = isset($_GET['page'])?$_GET['page']:1;
        $header_description_add = $pages = '';
        if(!empty($keyword)){
            $QuranModel = new Quran;
            $search_result = $QuranModel->searchKeyword($keyword,$surah,$page);
            $data['search_result'] = $search_result;

            $count_search = $QuranModel->countSearchKeyword($keyword,$surah);
            $data['count_search'] = $count_search;

            // devide the search page
            if(is_int($count_search)){
                $pages = round($count_search / 10);
                $data['pages'] = $pages;
                $data['page'] = $page;
            }  

            // list surah
            $surahs = $QuranModel->surahSearchKeyword($keyword,$surah);
            $data['surahs'] = $surahs;
            $data['selected_surah'] = $surah;
            $header_description_add = '\''.$keyword.'\' ditemukan dalam '.$count_search.' ayat. ';
        }

        if(empty($surahs)){
            if(empty($keyword)){
                return redirect('mushaf')->with('messageError', 'Masukan kata yang ingin dicari!');
            }
            return redirect('mushaf')->with('messageError', 'Data tidak ditemukan!');
        }
        $data['keyword'] = $keyword;
        
        $data['pages'] = $pages;
        $data['header_title'] = 'Cari Kata \''.$keyword.'\'';
        $data['header_description'] = $header_description_add.'Cari kata dalam Al-Quran dan Tafsir Al-Quran';

        return view('mushaf_search',$data);
    }

    function int($s){return(int)preg_replace('/[^\-\d]*(\-?\d*).*/','$1',$s);}


    public function generate(){
       echo '<pre>';
        $list = File::allFiles('/Volumes/Jobs/www/QuranNote/public/sound');
        $folders  = File::directories('/Volumes/Jobs/www/QuranNote/public/sound');
        $arrFolder = array();
        $b = 0;
        foreach($folders as $folder){
            $b++;
            $folder = (string) $folder;
            $folder = explode('/', $folder);
            //echo $folder[7].'<br>';
            $arrFolder[$b] = $this->int($folder[7]);
        }

        sort($arrFolder);

        $fileTmp = '';
        $a=0;
        $arrTmpFile = array();
        foreach($arrFolder as $fol){
            $list = File::allFiles('/Volumes/Jobs/www/QuranNote/public/sound/hal_'.$fol);
            foreach ($list as $row) {
                $file = (string) $row;
                $file =  explode('.', $file);
                $file = explode('/', $file[0]);
                if($file[8]=='Al' || $file[8]=='Ad-dukhan') continue ;

                $file[8] = ucfirst($file[8]);
                if(!in_array($file[8],$arrTmpFile)){
                     $arrTmpFile[] = $file[8];
                }
            }
          
        }
        
        foreach($arrTmpFile as $tmpFile){
            $a++;
            echo '$surahMuratal['.$a.'] = "'.$tmpFile.'";';
            echo '<br>';
        }
        
    }

    public function config(){
        $data[''] = '';
        $dataHTML['modal_title'] = 'Setting Mushaf';
        $dataHTML['modal_body'] = 'asd';
        $dataHTML['modal_footer'] = '';

        return response()->json($dataHTML);
    }

    
}
