<?php

namespace App\Http\Controllers;

use DB;
use App\Users;
use App\Quran;
use App\Memo;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class QuranController extends Controller
{
    public function index(){

    }

    public function qmap(){
        $data['header_top_title'] = $data['header_title'] = 'Quran Mapping';

        $Quran = new Quran;
        $list = $Quran->getQuranMapping('perintah');

        $data['list'] = $list;
        $data['menu_perintah'] = 'active';
        $data['menu_doa'] = '';
        return view('quran_mapping',$data);
    }

    public function doa(){
        $data['header_top_title'] = $data['header_title'] = 'Quran Mapping';

        $MemoModel = new Memo;
        $data['list'] = $MemoModel->getMemoRecommendation();
        $data['menu_perintah'] = '';
        $data['menu_doa'] = 'active';
        return view('quran_mapping',$data);
    }
}
