<?php

namespace App\Http\Controllers;

use DB;
use App\Notes;
use App\Quran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Crypt;
use File;

class MemozController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($surah_start='',$ayat_range='',$message='')
    {   

        $messageErrors = $ayats = '';
        // get data hafalan
        $QuranModel = new Quran;
        $ayat_start = '';
        $ayat_end = '';
        if(strpos($ayat_range,'-')!==false){
            $ayatArr = explode('-', $ayat_range);
            $ayats = $QuranModel->getRangeAyat($surah_start,$ayatArr[0],$surah_start,$ayatArr[1]);
            $ayat_start = $ayatArr[0];
            $ayat_end = $ayatArr[1];
        }else{
            $ayats = $QuranModel->getOneAyat($surah_start,$ayat_range);
            $ayat_start = $ayat_range;
        }

        // get surah
        $surahs = $QuranModel->getSurah();

        // data header
        $data['header_title'] = 'Menghafal';
        $data['body_class'] = 'body-memo';
        $data['on_memo'] = true;

        // data header
        if(!empty($ayats)){
            $data['header_title'] = 'Menghafal Surah '. $ayats[0]->surah_name.' : '.$ayat_range;
            $data['header_description'] = 'Menghafal Surah '. $ayats[0]->surah_name.' : '.$ayat_range.' '.$ayats[0]->text_indo;
        }
        

        //$data['fill_ayat_end'] = $fill_ayat_end;
        $data['ayats'] = $ayats;
        $data['surahs'] = $surahs;
        $data['surah_start'] = $surah_start;
        $data['ayat_start'] = $ayat_start;
        $data['ayat_range'] = $ayat_range;
        //$data['surah_end'] = $surah_end;
        $data['ayat_end'] = $ayat_end;
        $data['curr_page'] = 0;

        return view('memoz',$data);
    }


    public function search(Request $request){
        $surah_start = $request->input('surah_start');
        $ayat_start = $request->input('ayat_start');
        $ayat_end = $request->input('ayat_end');
        $fill_ayat_end = $request->input('fill_ayat_end');

        $QuranModel = new Quran;
        $surah_detail = $QuranModel->getSurah($surah_start);
        // ayat checking
        if(isset($ayat_start) || isset($ayat_end)){
            if($surah_detail[0]->ayat < $ayat_start){
                return redirect('memoz')->with('messageError', 'Surah '.$surah_detail[0]->surah_name.' ada '.$surah_detail[0]->ayat.' ayat, ayat '.$ayat_start.' tidak ada!');
            }elseif($surah_detail[0]->ayat < $ayat_end){
                return redirect('memoz')->with('messageError', 'Surah '.$surah_detail[0]->surah_name.' ada '.$surah_detail[0]->ayat.' ayat, ayat '.$ayat_end.' tidak ada!');
            }
        }

        if($surah_start && !empty($ayat_start) && !empty($ayat_end)){
            setcookie('coo_last_memoz',url('memoz/surah/'.$surah_start.'/'.$ayat_start.'-'.$ayat_end));
            return redirect('memoz/surah/'.$surah_start.'/'.$ayat_start.'-'.$ayat_end);
        }elseif($surah_start && !empty($ayat_start)){
            setcookie('coo_last_memoz','coo_last_memoz',url('memoz/surah/'.$surah_start.'/'.$ayat_start.'-'.$ayat_end));
            return redirect('memoz/surah/'.$surah_start.'/'.$ayat_start);
        }else{
            return redirect('memoz');
        }
    }

    public function config(){
        $repeat = $_GET['repeat'];

        $data['repeat'] = $repeat;
        $dataHTML['modal_title'] = 'Setting Memoz';
        $dataHTML['modal_body'] = view('memoz_config',$data)->render();
        $dataHTML['modal_footer'] = '<button class="btn btn-green-small info" data-dismiss="modal">Tutup</button>';

        return response()->json($dataHTML);
    }

    public function create(){
        $data[''] = '';
        $dataHTML['modal_title'] = 'Simpan Hafalan';
        $dataHTML['modal_body'] = view('memoz_form',$data)->render();
        $dataHTML['modal_footer'] = '';

        return response()->json($dataHTML);
    }


    
}
