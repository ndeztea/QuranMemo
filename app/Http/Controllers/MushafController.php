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

        // get surah
        $surahs = $QuranModel->getSurah();

        // showing paging
        if($page<=7){
            $pages = array_slice($pages, 0, 8); 
        }elseif($page>7 && $page<=592){
            $pages = array_slice($pages, $page - 4,7);
        }else{
            $pages = array_slice($pages, $page-4 , 8);
        }

        // send to view 
        $data['surahs'] = $surahs;
        $data['ayats'] = $ayats;
        $data['pages'] = $pages;
        $data['curr_page'] = $page;

        // data header
        $data['header_title'] = 'Mushaf Page '. $page;

        //print_r($pages);
        // show view template
       return view('mushaf',$data);
    }

    public function surah($id_surah,$ayat){
        if($id_surah=='' || $ayat==''){
            return redirect('mushaf');
        }

        $QuranModel = new Quran;
        $ayats = $QuranModel->getOneAyat($id_surah,$ayat);

        // name surah
        $surah = $QuranModel->getSurah($id_surah);

        $data['surah'] = $surah[0]->surah_name;
        $data['ayats'] = $ayats;
        $data['id_surah'] = $id_surah;
        $data['ayat'] = $ayat;
        $data['curr_page'] = $ayats[0]->page;

        // data header
        $data['header_title'] = 'Surah '. $surah[0]->surah_name.' : '.$ayat;
        $data['header_description'] = $ayats[0]->text_indo;

        return view('mushaf_detail',$data);
    }

    public function changeSurah($surah){
        $QuranModel = new Quran;
        $page = $QuranModel->getSurahPage($surah);

        return redirect('mushaf/page/'.$page);
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

    
}
