<?php

namespace App\Http\Controllers;

use DB;
use App\Notes;
use App\Users;
use App\Quran;
use App\Memo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Crypt;
use File;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        $data['header_title'] = 'Dashboard';
        $MemoModel = new Memo;
        $UsersModel = new Users;

        // get need correction memoz
        $data['needCorrections'] = $MemoModel->getNeedCorrection();
        $data['detailProfile'] = $UsersModel->getDetail(session('sess_id'))[0];

        return view('dashboard_index',$data);
    }

    
}
