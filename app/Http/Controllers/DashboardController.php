<?php

namespace App\Http\Controllers;

use DB;
use App\Notes;
use App\Users;
use App\Quran;
use App\Memo;
use App\MemoCorrection;
use App\Subscriptions;
use App\Libraries\Points;
use App\Libraries\Hadits;
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

         $data['listClasses'] = $UsersModel->getClass();

         // get need correction memoz
         $data['listMemoz'] = $MemoModel->getAnotherList(session('sess_id'),0);
         $data['listDone'] = $MemoModel->getAnotherList(session('sess_id'),1);
         $data['detailProfile'] = $UsersModel->getDetail(session('sess_id'));
         $data['counterCorrection'] = $MemoCorrectionModel->getCountNew(session('sess_id'))->count;
         $data['counterMurajaah'] = $MemoModel->getCountList(session('sess_id'),3);
         $data['starting'] = $starting;
         $data['body_class'] = 'dashboard';
         $data['level'] = $this->level;
         if(session('sess_id_class')){
           $data['classDetail'] = $UsersModel->getClassDetail( session('sess_id_class'));
         }
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

         

         $objPoints = new Points();
         $total_points = $objPoints->totalPoints(session('sess_id'),'all');
         $data['total_points'] = $total_points;
         if(session('sess_id_sub_class')){
           $data['subClassDetail'] = $UsersModel->getClassDetail( session('sess_id_sub_class'));
         }
        return view('dashboard_index',$data);
     }


    public function setClass(Request $request){
        $id_class = $request->input('id_class');
        $lock_key = $request->input('lock_key');

        if(session('sess_id')){
            // save for temp action
            if(!empty($lock_key)){
              $UsersModel = new Users;
              $classDetail = $UsersModel->getClassDetail($id_class);
              if($lock_key!=$classDetail->lock_key){
                return redirect('dashboard')->with('messageError', 'Ganti halaqah gagal! Password halaqah salah.');
              }
            }
            $sess_role = session('sess_role');
            $sess_id_class = session('sess_id_class');
            // set session
            $request->session()->put('sess_id_class', $id_class);


            $dataUser['id'] = session('sess_id');
            $dataUser['id_class'] = $id_class;
            $UserModel = new Users();
            $UserModel->edit($dataUser);
        }

        return redirect('dashboard');
    }

    public function confirmClass(Request $request){
        $id_class = $request->input('id_class');
        $UsersModel = new Users;
        $classDetail = $UsersModel->getClassDetail($id_class);

        $dataHTML['modal_class'] = '';
        $dataHTML['modal_title'] = 'Halaqah '.$classDetail->class;
        $data['urlAction'] = url('dashboard/setClass?id_class='.$id_class.'&islock=true');
        $data['id_class'] = $id_class;
        $dataHTML['modal_body'] = view('class_change',$data)->render();
        $dataHTML['modal_footer'] = '<button class="btn btn-green-small" data-dismiss="modal">Tutup</button>';

        return response()->json($dataHTML);

    }

    public function randomHadits(){
      $objHadits = new Hadits();
      $dataHadits = $objHadits->getRandomHadits();

      $dataHTML['code'] = $dataHadits['code'];
      $dataHTML['simple'] = $dataHadits['simple'].' <a onclick="showHadits(\'full\')">[Lebih lanjut <i class="mdi mdi-chevron-double-down"></i>]</a> ';
      $dataHTML['full'] = '<br><br><span class="hadits-arabic">'.$dataHadits['full_arab'].'</span><br><br>'.$dataHadits['full_text'].'( '.$dataHadits['book_info'].' )  <a onclick="showHadits(\'simple\')">[Lebih ringkas <i class="mdi mdi-chevron-double-up"></i>]</a> ';

      return response()->json($dataHTML);
    }


}
