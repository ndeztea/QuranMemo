<?php

namespace App\Http\Controllers;

use DB;
use App\Quran;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

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
        
        $data['ayats'] = $ayats;
        $data['pages'] = $pages;
        $data['curr_page'] = $page;

        //print_r($pages);
        // show view template
       return view('mushaf',$data);
    }

    
}
