<?php

namespace App\Http\Controllers;

use DB;
use App\Notes;
use App\Quran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use File;

class MemozController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        $messageErrors = $ayats = '';
        // get data hafalan
        $surah_start = $request->input('surah_start');
        $ayat_start = $request->input('ayat_start');
        $surah_end = $request->input('surah_end');
        $ayat_end = $request->input('ayat_end');
        $fill_ayat_end = $request->input('fill_ayat_end');
        
        // validation
        $errorMessages = [
            'surah_start.required' => 'Surah awal harus di isi',
            //'surah_end.required' => 'Surah akhir harus di isi',
            'ayat_start.required' => 'Ayat pada surah awal harus di isi',
            //'ayat_end.required' => 'Ayat pada surah akhir harus di isi',
            'ayat_start.numeric'   => 'Ayat pada surah awal harus berupa angka',
            //'ayat_end.numeric'   => 'Ayat pada surah awal harus berupa angka'
        ];

        $validator = Validator::make($request->all(), [
            'surah_start' => 'required',
            'ayat_start' => 'required|numeric',
            //'surah_end' => 'required',
           // 'ayat_end' => 'required|numeric'
        ],$errorMessages);

        
        $QuranModel = new Quran;

        if($validator->fails()){
            $messageErrors = $validator->errors();
        }else{
            // get list quran
            if(empty($fill_ayat_end)){
                $surah_end = $surah_start;
                $ayat_end = $ayat_start;
            }
            
            $ayats = $QuranModel->getRangeAyat($surah_start,$ayat_start,$surah_end,$ayat_end);
        }
        // end validation


        // get surah
        $surahs = $QuranModel->getSurah();

        // data header
        $data['header_title'] = 'Menghafal';
        $data['body_class'] = 'body-memo';

        $data['fill_ayat_end'] = $fill_ayat_end;
        $data['ayats'] = $ayats;
        $data['surahs'] = $surahs;
        $data['surah_start'] = $surah_start;
        $data['ayat_start'] = $ayat_start;
        $data['surah_end'] = $surah_end;
        $data['ayat_end'] = $ayat_end;
        $data['messageErrors'] = $messageErrors;
        $data['curr_page'] = 0;

        return view('memoz',$data);
    }

    public function create(){
        $data[''] = '';
        $dataHTML['modal_title'] = 'Simpan Hafalan';
        $dataHTML['modal_body'] = view('memoz_create',$data)->render();
        $dataHTML['modal_footer'] = '';

        return response()->json($dataHTML);
    }


    
}
