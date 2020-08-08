<?php

namespace App\Http\Controllers;

use DB;
use App\Quran;
use App\Dzikir;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use File;

class DzikirController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $page=1)
    {
        // get pages mushaf quran
        $DzikirModel = new Dzikir;

        // data header
        $data['header_title'] = 'Al-Matsurats';
        $data['header_top_title'] = 'Al-Matsurats';
        $data['body_class'] = 'body-mushaf';
        $data['cookies'] = getCookie();

        $data['dzikirs'] = $DzikirModel->getList('pagi');
        assignPoints(session('sess_id'),'read.dzikir');
        // show view template
       return view('dzikir',$data);

    }

}
