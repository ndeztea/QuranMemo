<?php

namespace App\Http\Controllers;

use DB;
use App\Notes;
use App\Users;
use App\Subscriptions;
use App\Libraries\Points;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Crypt;
use File;
use Carbon\Carbon;


class EventController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        Carbon::setLocale('id');
        $data['header_top_title'] = $data['header_title'] = 'Event Dashboard';


        return view('events.event_index',$data);
    }


}
