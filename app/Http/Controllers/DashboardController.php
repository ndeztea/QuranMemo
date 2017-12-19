<?php

namespace App\Http\Controllers;

use DB;
use App\Notes;
use App\Users;
use App\Quran;
use App\Memo;
use App\MemoCorrection;
use App\Subscriptions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Crypt;
use File;
use Carbon\Carbon;


class DashboardController extends Controller
{
    var $level = array(1=>'islam',2=>'iman',3=>'ihsan');

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        Carbon::setLocale('id');
        $data['header_top_title'] = $data['header_title'] = 'Dashboard';

        $starting = $request->input('starting');

        $MemoModel = new Memo;
        $UsersModel = new Users;
        $MemoCorrectionModel = new MemoCorrection;

        // get active subscritption information
        $SubscriptionsModel = new Subscriptions();
        $data['listSubscriptions'] = $SubscriptionsModel->getActiveSubscriptions(session('sess_id'));

        // get need correction memoz
        $data['listMemoz'] = $MemoModel->getAnotherList(session('sess_id'),0);
        $data['listDone'] = $MemoModel->getAnotherList(session('sess_id'),1);
        $data['detailProfile'] = $UsersModel->getDetail(session('sess_id'));
        $data['counterCorrection'] = $MemoCorrectionModel->getCountNew(session('sess_id'))->count;
        $data['starting'] = $starting;
        $data['body_class'] = 'dashboard';
        $data['level'] = $this->level;
        if(!empty($data['detailProfile'])){
            $data['detailProfile'] = $data['detailProfile'][0];
            if(empty($data['detailProfile']->dob) || $data['detailProfile']->dob=='0000-00-00'){
                return redirect('profile/edit')->with('messageError', 'Mohon lengkapi data tanggal lahir terlebih dahulu')->withInput();
            }
        }

        $listCorrections = $MemoModel->getNeedCorrection();
        // get correction user subscriptions
        $a=0;
        if(!empty($listCorrections)){
            foreach ($listCorrections as $correction) {
                $listCorrections[$a]->listSubscriptions = $SubscriptionsModel->getActiveSubscriptions($correction->id_user);
                $a++;
            }
        }
        $data['needCorrections'] = $listCorrections;

        return view('dashboard_index',$data);
    }

    
}
