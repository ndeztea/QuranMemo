<?php

namespace App\Http\Controllers;

use DB;
use App\Quran;
use App\Users;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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
    public function index(Request $request, $page=1)
    {
        /*$directory = '/Volumes/Jobs/www/QuranNote/public/quran-uthmani.sql';
        $contents = File::get($directory);

        //$files = File::allFiles($directory);
        $arr1 = explode(';', $contents);
        foreach ($arr1 as $arr11) {
            $arr2 = explode('VALUES ', $arr11);
            //print_r($arr2);
            //echo @$arr2[1].'<br>';
            if(isset($arr2[0])){
                $arr3 = explode(',', @$arr2[0]);
                //echo '<pre>';
                //print_r($arr3);
                $arr3_3 = str_replace(')','',@$arr3[6]);
                //$arr3_3 = str_replace('\'','',@$arr3_3);
                if(@$arr3[4]!=1 && @$arr3[5]==1){
                    echo 'in';
                    $arr3_3 = str_replace('بِسْمِ ٱللَّهِ ٱلرَّحْمَٰنِ ٱلرَّحِيمِ', '', $arr3_3);
                }

                $sql = "UPDATE quran SET text_arabic=".$arr3_3." WHERE surah=".@$arr3[4]." AND ayat=".@$arr3[5].";";
                echo $sql.'<br>';
            }
        }

        $directory = '/Volumes/Jobs/www/QuranNote/tafsir_syihab.json';
        $contents = File::get($directory);
        $arrArabics = json_decode($contents);

        foreach ($arrArabics as $arrArabic) {
             foreach ($arrArabic as $arabic) {
                $sql = "INSERT tafsir(`surah`,`ayat`,`tafsir`,`type`)
                    VALUES('".$arabic->surah."','".$arabic->ayah."','".addslashes($arabic->verse)."','al-misbah');";
                echo $sql.'<br>';

             }

        }
        die();*/
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
        $data['header_title'] = 'Mushaf Hal '. $page.', Juz '.$ayats[0]->juz.', Surah '.$ayats[0]->surah_name;
        $data['header_top_title'] = 'Mushaf';
        $data['body_class'] = 'body-mushaf';

        $data['ayat_start'] = '';
        $data['ayat_end'] = '';
        //echo $_COOKIE['coo_mushaf_bookmark_url'].'=='.$_SERVER['REQUEST_URI'];
        //die();
        $data['cookies'] = getCookie();
        //setcookie('coo_muratal_new',1);
        if(empty($_COOKIE['coo_promo_3_tafsir'])){
            setcookie('coo_promo_3_tafsir',1);
        }
        $data['bookmarked'] = @$_COOKIE['coo_mushaf_bookmark_url']==$_SERVER['REQUEST_URI']?'fa-bookmark':'fa-bookmark-o';

        // for REST API output
        $restAPI = $request->input('restAPI');
        if($restAPI=='JSON'){
            header('Access-Control-Allow-Origin: *');
            $output['ayats'] = $ayats;
            $output['pages'] = $pages;
            $output['curr_page'] = $page;
            $output['next_page'] = $page+1;
            $output['prev_page'] = $page-1;
            $output['juz'] = $ayats[0]->juz;
            $output['surah'] = $ayats[0]->surah_name;
            return json_encode($output);
        }

        assignPoints(session('sess_id'),'read.quran');
        // show view template
       return view('mushaf',$data);

    }

    public function surah(Request $request,$id_surah,$ayat){
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

        $arrAyat = explode('-', $ayat);
        $data['ayat_start'] = !empty($arrAyat[0])?$arrAyat[0]:'';
        $data['ayat_end'] = !empty($arrAyat[1])?$arrAyat[1]:'';

        $data['cookies'] = getCookie();
        $data['on_memo'] = true;

        // data header
        $data['header_title'] = 'Surah '. $surah[0]->surah_name.' : '.$ayat;
        $data['header_top_title'] = 'Mushaf';
        $data['header_description'] = $ayats[0]->text_indo;
        $data['bookmarked'] = @$_COOKIE['coo_mushaf_bookmark_url']==$_SERVER['REQUEST_URI']?'fa-bookmark':'fa-bookmark-o';

        if($id_surah==17){
            assignPoints(session('sess_id'),'read.alkahfi');
        }

        // for REST API output
        $restAPI = $request->input('restAPI');
        if($restAPI=='JSON'){
            header('Access-Control-Allow-Origin: *');
            $output['ayats'] = $ayats;
            $output['surah'] = $ayats[0]->surah_name;
            $output['ayat'] = $ayat;
            return json_encode($output);
        }


        return view('mushaf',$data);
    }

    public function filter_surah(){
        $QuranModel = new Quran;
        $surahs = $QuranModel->getSurah();

        $data['surahs'] = $surahs;
        $dataHTML['modal_title'] = 'Surah';
        $dataHTML['modal_body'] = view('mushaf_filter_surah',$data)->render();
        $dataHTML['modal_footer'] = '<button class="btn btn-green-small" data-dismiss="modal">Tutup</button>';

        return response()->json($dataHTML);
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
    * detect page when change surah
    *
    */
    public function jump_page(){
        $dataHTML['modal_title'] = 'Pindah Halaman';
        $dataHTML['modal_body'] = view('mushaf_jump_page')->render();
        $dataHTML['modal_footer'] = '<button class="btn btn-green-small" data-dismiss="modal">Tutup</button>';

        return response()->json($dataHTML);
    }

    public function search_form(){
        $QuranModel = new Quran;
        $surahs = $QuranModel->getSurah();

        $data['surahs'] = $surahs;
        $dataHTML['modal_title'] = 'Cari Ayat';
        $dataHTML['modal_body'] = view('mushaf_search_form',$data)->render();
        $dataHTML['modal_footer'] = '<button class="btn btn-green-small" data-dismiss="modal">Tutup</button>';

        return response()->json($dataHTML);
    }

    /**
    * select juz
    *
    */
    public function muqodimah(Request $request,$surah){
        $QuranModel = new Quran;
        $surahs = $QuranModel->getSurah($surah);

        $data['muqodimah'] = $surahs[0]->muqodimah;
        $dataHTML['modal_title'] = 'Muqodimah Surah '.$surahs[0]->surah_name;
        $dataHTML['modal_body'] = view('mushaf_muqodimah',$data)->render();
        $dataHTML['modal_footer'] = '<button class="btn btn-green-small" data-dismiss="modal">Tutup</button>';

        // for REST API output
        $restAPI = $request->input('restAPI');
        if($restAPI=='JSON'){
            header('Access-Control-Allow-Origin: *');
            $output['surah'] = $surahs[0]->surah_name;
            $output['muqodimah'] = $surahs[0]->muqodimah;
            return json_encode($output);
        }

        return response()->json($dataHTML);
    }

    /**
    * select juz
    *
    */
    public function juz(){
        $QuranModel = new Quran;
        $juzs = $QuranModel->getJuz();

        $data['juzs'] = $juzs;
        $dataHTML['modal_title'] =  'Juz';
        $dataHTML['modal_body'] = view('mushaf_juz',$data)->render();
        $dataHTML['modal_footer'] = '<button class="btn btn-green-small" data-dismiss="modal">Tutup</button>';

        return response()->json($dataHTML);
    }

    /**
    * select juz
    *
    */
    public function juzPage(Request $request,$juz){
        $QuranModel = new Quran;
        $pages = $QuranModel->getJuzPage($juz);
        $page = $pages[0]->page;
        // get pages mushaf quran
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
        $data['header_title'] = $data['header_top_title'] = 'Mushaf Hal '. $page.', Juz '.$ayats[0]->juz.', Surah '.$ayats[0]->surah_name;
        $data['body_class'] = 'body-mushaf';

        $data['ayat_start'] = '';
        $data['ayat_end'] = '';

        $data['cookies'] = getCookie();
        $data['bookmarked'] = @$_COOKIE['coo_mushaf_bookmark_url']==$_SERVER['REQUEST_URI']?'fa-bookmark':'fa-bookmark-o';

        // for REST API output
        $restAPI = $request->input('restAPI');
        if($restAPI=='JSON'){
            header('Access-Control-Allow-Origin: *');
            $output['ayats'] = $ayats;
            $output['pages'] = $pages;
            $output['curr_page'] = $page;
            $output['next_page'] = $page+1;
            $output['prev_page'] = $page-1;
            $output['juz'] = $ayats[0]->juz;
            $output['surah'] = $ayats[0]->surah_name;
            return json_encode($output);
        }

        // show view template
       return view('mushaf',$data);
    }

    /**
    * search surah depend the keyword
    *
    */
    public function searchKeyword(Request $request){
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
        // for REST API output
        $restAPI = $request->input('restAPI');
        if($restAPI=='JSON'){
            header('Access-Control-Allow-Origin: *');
            $output['search_result'] = 0;
            $output['search_count'] = 0;
            $output['page'] = 1;
            if(!empty($search_result)){
                $output['search_result'] = $search_result;
                $output['total_result'] = count($search_result);
                $output['search_count'] = $count_search;
                $output['page'] = $page + 1;
            }
            return json_encode($output);
        }

        if(empty($surahs)){
            if(empty($keyword)){
                return redirect('mushaf')->with('messageError', 'Masukan kata yang ingin dicari!');
            }
            return redirect('mushaf')->with('messageError', 'Data tidak ditemukan!');
        }
        $data['keyword'] = $keyword;

        $data['pages'] = $pages;
        $data['header_top_title'] = $data['header_title'] = 'Cari Kata \''.$keyword.'\'';
        $data['header_description'] = $header_description_add.'Cari kata dalam Al-Quran dan Tafsir Al-Quran';

        return view('mushaf_search',$data);
    }

    function int($s){return(int)preg_replace('/[^\-\d]*(\-?\d*).*/','$1',$s);}


    public function generate(){
        $filename = '/Volumes/Jobs/www/QuranNote/AnalyticsJunJul17.csv';
        if (($handle = fopen($filename, 'r')) !== FALSE)
        {
            $a = 0;
            while (($row = fgetcsv($handle, 1000, ',')) !== FALSE)
            {
                $a++;
                $UsersModel = new Users;
                echo '<pre>';
                $dataUsers = $UsersModel->getUsersDevicetId($row[0]);
                if(!empty($dataUsers)){
                    echo $row[1].'<br>';
                    echo $row[0].'<br>';
                    echo $dataUsers[0]->email.'<br>';
                    echo 'Nama : '.$dataUsers[0]->name.'<br>';
                    echo 'Alamat : '.$dataUsers[0]->address.'<br>';
                    echo 'No.HP :'.$dataUsers[0]->hp;
                    echo '<hr>';
                }

            }
            fclose($handle);
        }
       /*echo '<pre>';
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
        }*/

    }

    public function config(){
        $sess_id_user = session('sess_id');

        $mushaf_layout = $_GET['mushaf_layout'];
        $automated_play = $_GET['automated_play'];
        $footer_action = $_GET['footer_action'];
        $muratal = $_GET['muratal'];
        $tajwid = $_GET['tajwid'];

        $UsersModel = new Users;
        $level = $UsersModel->checkLevel($sess_id_user);
        $data['level'] = $level;

        $data['arr_muratal_list'] = \Config::get('custom.muratal_list');
        $data['mushaf_layout'] = $mushaf_layout;
        $data['automated_play'] = $automated_play;
        $data['footer_action'] = $footer_action;
        $data['muratal'] = $muratal;
        $data['tajwid'] = $tajwid;

        $dataHTML['modal_title'] = 'Setting Mushaf';
        $dataHTML['modal_body'] = view('mushaf_config',$data)->render();
        $dataHTML['modal_footer'] = '<button class="btn btn-green-small" data-dismiss="modal">Tutup</button>';

        return response()->json($dataHTML);
    }


    public function set_muratal($qori){
        setcookie('coo_muratal',$qori);
        //die($qori);
        return redirect('mushaf');
    }

    public function tafsir(Request $request,$surah, $ayat){
        $QuranModel = new Quran;
        $tafsir = $QuranModel->getTafsir($surah,$ayat);
        $surah = $QuranModel->getSurah($surah);
        $data['tafsir'] = $tafsir;
        $data['tafsir_header'] = $surah[0]->surah_name.' : '.$ayat;

         // for REST API output
        $restAPI = $request->input('restAPI');
        if($restAPI=='JSON'){
            header('Access-Control-Allow-Origin: *');
            $output['tafsir'] = $tafsir;
            $output['tafsir_header'] = $surah[0]->surah_name.' : '.$ayat;

            return json_encode($output);
        }

        $dataHTML['modal_title'] = 'Tafsir';
        $dataHTML['modal_body'] = view('mushaf_tafsir',$data)->render();
        $dataHTML['modal_footer'] = '<button class="btn btn-green-small" data-dismiss="modal">Tutup</button>';

        return response()->json($dataHTML);

    }

}
