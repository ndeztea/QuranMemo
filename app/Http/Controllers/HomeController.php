<?php

namespace App\Http\Controllers;

use DB;
use App\Quran;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use File;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // data header
        $data['header_title'] = 'Home';
        $data['body_class'] = 'body-home';

        //print_r($pages);
        // show view template
       return view('home_index',$data);
    }
    
}
