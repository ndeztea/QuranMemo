<?php

namespace App\Http\Controllers;

use DB;
use Image;
use App\Users;
use App\Todo;
use App\Sholat;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Crypt;
use Illuminate\Support\Facades\Hash;
//use Ixudra\Curl\Facades\Curl;
use File;

use Carbon\Carbon;

use App\Libraries\QuizLib;

class TodoController extends Controller
{
    var $date;
    var $date_formatted;
    #var $location = 'pekanbaru';
    var $sholatTime;
    var $arrWaktu = array('Tepat waktu','+30 Menit');
    var $subDays = 0;
    var $idUser;
    var $role;

    public function __construct(Request $request){
      // auto login
        $coo_email = @$_COOKIE['coo_quranmemo_email'];
        $coo_password = @$_COOKIE['coo_quranmemo_password'];

        if($coo_email && $coo_password && empty($request->session()->get('sess_id'))){
            $data['email'] = $coo_email;
            $data['password'] = $coo_password;

            // auth by
            $objUsers = new Users;
            $dataLogin = $objUsers->login($data,'no-encrypt');
            if($dataLogin){
                $dataUser['last_login'] = date('Y-m-d h:i:s');
                $dataUser['id'] = $dataLogin->id;
                $objUsers->edit($dataUser);

                // set session
                $request->session()->put('sess_id', $dataLogin->id);
                $request->session()->put('sess_email', $dataLogin->email);
                $request->session()->put('sess_name', $dataLogin->name);
                $request->session()->put('sess_role', $dataLogin->role);
                $request->session()->put('sess_gender', $dataLogin->gender);
                $request->session()->put('sess_id_class', $dataLogin->id_class);
            }
        }

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        \Carbon\Carbon::setLocale('id');
        $subDays = $request->segment(2);
        $idUser = $request->segment(3);

        $this->idUser = empty($idUser)?session('sess_id'):$idUser;
        $this->idClass = session('sess_id_class');
        $this->role = session('sess_role');
        $this->city = session('sess_city');

        $this->subDays = empty($subDays)?0:$subDays;
        $this->date_formatted = \Carbon\Carbon::now()->subDays($this->subDays)->format('l, d F Y');
        $this->date = \Carbon\Carbon::now()->subDays($this->subDays)->format('Y-m-d');

        $SholatModel = new Sholat();
        $this->sholatTime = $SholatModel->getDetail($this->city, $this->date);
        if($this->sholatTime==false){
          /*$response = Curl::to('http://muslimsalat.com/'.$this->city.'/daily.json?key=d6062423a1d68dc9b9560c021572fac5&jsoncallback=?')
                  ->get();
                  print_r($response);*/

          #$response = file_get_contents('http://muslimsalat.com/'.$this->city.'/daily.json?key=d6062423a1d68dc9b9560c021572fac5&jsoncallback=?');
          #print_r($response);

          $c = curl_init();
          curl_setopt($c, CURLOPT_URL, 'http://muslimsalat.com/'.$this->city.'/daily.json?key=d6062423a1d68dc9b9560c021572fac5&jsoncallback=?');
          curl_setopt($c, CURLOPT_HEADER, 0);
          curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
          $response = curl_exec($c);

          if (curl_error($c))
              die(curl_error($c));

          // Get the status code
          $status = curl_getinfo($c, CURLINFO_HTTP_CODE);

          curl_close($c);
          //echo $response;
          //die('s');
          $response = str_replace('?(', '', $response);
          $response = str_replace('")', '', $response);
          $response = str_replace(';', '', $response);
          $response = str_replace('})', '}', $response);
          $objResponse = json_decode($response);
          $data['subuh'] = date('H:i', strtotime($objResponse->items[0]->fajr));
          $data['dzuhur'] = date('H:i',strtotime($objResponse->items[0]->dhuhr));
          $data['ashar'] = date('H:i',strtotime($objResponse->items[0]->asr));
          $data['maghrib'] = date('H:i',strtotime($objResponse->items[0]->maghrib));
          $data['isya'] = date('H:i',strtotime($objResponse->items[0]->isha));
          $data['date'] = $this->date;
          $data['location'] = $this->city;
          $SholatModel->store($data);

          $this->sholatTime = $SholatModel->getDetail($this->city, $this->date);
        }
        $this->sholatTime = (array) $this->sholatTime;
        $this->sholatTime =  array_values($this->sholatTime);

        // set function to another if admin or musyrif
        if(($this->role==2 || $this->role==1) && $request->segment(1)!='todo'){
          return $this->summary();
        }

        $TodoModel = new Todo();
        $listTodosOne = $TodoModel->getList(1,1,'');
        $listTodosTwo = $TodoModel->getList(2,1,session('sess_id_sub_class'));


        $data['header_top_title'] = 'Ibadah Harian';

        $dataList = $TodoModel->getData($this->idUser,$this->date);
        $data['dataList'] = $dataList;
        $data['date_now'] = $this->date_formatted;
        $data['date'] = $this->date;

        $data['listTodosOne'] = $listTodosOne;
        $data['listTodosTwo'] = $listTodosTwo;
        $data['sholatTime'] = $this->sholatTime;
        $data['prevDay'] = $this->subDays + 1;
        $data['nextDay'] = $this->subDays - 1;
        $data['idUser'] = $this->idUser;

        $UsersModel = new Users();
        $data['detailProfile'] = $UsersModel->getDetail($this->idUser);
        $data['idUser'] = $idUser;
        $data['idUserChecklist'] = $this->idUser;
        if(!empty($data['detailProfile'])){
            $data['detailProfile'] = $data['detailProfile'][0];
        }

        if(!empty($this->idClass)){
            $classDetail = $UsersModel->getClassDetail($data['detailProfile']->id_class);
            $subClassDetail = $UsersModel->getClassDetail($data['detailProfile']->id_sub_class);
            $data['classDetail'] = $classDetail;
            $data['subClassDetail'] = $subClassDetail;
        }

        return view('todo.todo_list',$data);
    }

    public function summary(){

      $UsersModel = new Users();
      $data['detailProfile'] = $UsersModel->getDetail($this->idUser);
      if(!empty($data['detailProfile'])){
          $data['detailProfile'] = $data['detailProfile'][0];
      }

      $classDetail = $UsersModel->getClassDetail($this->idClass);
      $data['classDetail'] = $classDetail;


      $TodoModel = new Todo();
      $listTodosOne = $TodoModel->getList(1,1,'');
      $listTodosTwo = $TodoModel->getList(2,1,session('sess_id_sub_class'));
      /*echo $this->idClass;
      print_r($classDetail);*/
      // count siswa
      $countSiswa = $UsersModel->getCountList($this->idClass);
      $a=0;
      foreach ($listTodosOne as $todoOne) {
        $summaryDone = $TodoModel->getSummary($todoOne->id,$this->idClass,$this->date,1)[0]->count;
        $summaryNotDone = $TodoModel->getSummary($todoOne->id,$this->idClass,$this->date,0)[0]->count;
        $left = $countSiswa - ($summaryDone + $summaryNotDone);
        $listTodosOne[$a]->done = $summaryDone;
        $listTodosOne[$a]->not_done = $summaryNotDone;
        $listTodosOne[$a]->left = $left;
        $a++;
      }

      $a=0;
      foreach ($listTodosTwo as $todoTwo) {
        $summaryDone = $TodoModel->getSummary($todoTwo->id,$data['detailProfile']->id_class,$this->date,1)[0]->count;
        $summaryNotDone = $TodoModel->getSummary($todoTwo->id,$data['detailProfile']->id_class,$this->date,0)[0]->count;
        $left = $countSiswa - ($summaryDone + $summaryNotDone);
        $listTodosTwo[$a]->done = $summaryDone;
        $listTodosTwo[$a]->not_done = $summaryNotDone;
        $listTodosTwo[$a]->left = $left;
        $a++;
      }

      $data['listTodosOne'] = $listTodosOne;
      $data['listTodosTwo'] = $listTodosTwo;

      $data['prevDay'] = $this->subDays + 1;
      $data['nextDay'] = $this->subDays - 1;

      $data['header_top_title'] = 'Summary Report';
      $data['date_now'] = $this->date_formatted;

      $data['listClasses'] = $UsersModel->getClass();

      return view('todo.todo_summary',$data);
    }

    public function form_wajib(Request $request){
      $id_todo = $request->segment(3);
      $type = $request->segment(2);
      $date = $request->segment(4);
      $TodoModel = new Todo();
      $detailTodo = $TodoModel->getDetail($id_todo);

      $data['id_user'] = session('sess_id');
      $data['id_todo'] = $id_todo;
      $data['date'] = $date;
      $isAlreadyStored = $TodoModel->isAlreadyStored($data);

      $dataHTML['currentData'] = $isAlreadyStored;
      $dataHTML['id_todo'] = $id_todo;
      $dataHTML['type'] = $type;
      $dataHTML['detailTodo'] = $detailTodo;
      $dataHTML['arrWaktu'] = $this->arrWaktu;
      $dataHTML['date'] = $date;
      $dataHTML['modal_title'] = 'Laporan '.$detailTodo->todo;
      /*if(session('sess_role')==0){
        $dataHTML['modal_body'] = view('todo.form_wajib',$dataHTML)->render();;
        $dataHTML['modal_footer'] = '<button class="btn btn-green-small info" onclick="submitTodo()"><i class="fa fa-cog fa-spin fa-3x fa-fw label-todo-loading " style="display: none;"></i>Laporkan</button> <button class="btn btn-green-small info" data-dismiss="modal">Tutup</button>';
      }else{
        $dataHTML['modal_body'] = 'Tidak bisa diubah, hanya bisa oleh siswa';
        $dataHTML['modal_footer'] = '<button class="btn btn-green-small info" data-dismiss="modal">Tutup</button>';

      }*/
      $dataHTML['modal_body'] = view('todo.form_wajib',$dataHTML)->render();;
      $dataHTML['modal_footer'] = '<button class="btn btn-green-small info" onclick="submitTodo()" style="width: 75%;"><i class="fa fa-cog fa-spin fa-3x fa-fw label-todo-loading " style="display: none;"></i>Simpan</button> <button class="btn btn-green-small info" data-dismiss="modal">Tutup</button>';


      return response()->json($dataHTML);
    }

    public function save(Request $request){
      $data['id_user'] = session('sess_id');
      $data['id_todo'] = $request->input('id_todo');
      $data['done'] = $request->input('done');
      $data['date'] = $request->input('date');

      // set $params
      $params = array();
      if($data['done']==1){
        $dataParam['waktu'] = $request->input('waktu');
        $dataParam['qobliyah'] = $request->input('qobliyah');
        $dataParam['badiyah'] = $request->input('badiyah');
        $dataParam['masjid'] = $request->input('masjid');
      }
      $dataParam['note'] = $request->input('note');
      $data['params'] = json_encode($dataParam);

      $TodoModel = new Todo();
      // check data
      $isAlreadyStored = $TodoModel->isAlreadyStored($data);
      if(!empty($isAlreadyStored)){
        $data['id'] = $isAlreadyStored->id;
      }

      $TodoModel->store($data);
      $data['qobliyah'] = @$dataParam['qobliyah'];
      $data['badiyah'] = @$dataParam['badiyah'];
      $data['masjid'] = @$dataParam['masjid'];
      $data['note'] = @$dataParam['note'];
      $data['waktu'] = @$dataParam['waktu'];
      return response()->json($data);
    }

    public function get_all_data(){
      $TodoModel = new Todo();
      $dataList = $TodoModel->getData($this->idUser,$this->date);

      return response()->json($data);
    }

    public function summary_stars(Request $request){
      $idUser = $request->segment(3);

      $TodoModel = new Todo();
      $data['countDay'] = $TodoModel->getCountStar($idUser,'day');
      $data['countWeek'] = $TodoModel->getCountStar($idUser,'week');
      $data['countMonth'] = $TodoModel->getCountStar($idUser,'month');
      $data['countStarDay'] = $TodoModel->getCountTodo();

      $dataHTML['modal_class'] = '';
      $dataHTML['modal_title'] = 'Bintang saya';
      $dataHTML['modal_body'] = view('todo.todo_stars',$data)->render();
      $dataHTML['modal_footer'] = '<button class="btn btn-green-small" data-dismiss="modal">Tutup</button>';

      return response()->json($dataHTML);
    }

    public function set_class(Request $request){
      $idClass = $request->input('id_class');
      $request->session()->put('sess_id_class', $idClass);
      return redirect('dashboard');
    }

    public function summary_ranges_personal(Request $request){
      $this->idUser = $request->segment(2);
      $this->idClass = session('sess_id_class');

      $date_start = $request->input('date_start');
      $date_end = $request->input('date_end');

      $UsersModel = new Users();
      $data['detailProfile'] = $UsersModel->getDetail($this->idUser);
      if(!empty($data['detailProfile'])){
          $data['detailProfile'] = $data['detailProfile'][0];
      }

      $classDetail = $UsersModel->getClassDetail($this->idClass);
      $data['classDetail'] = $classDetail;


      $TodoModel = new Todo();
      $listTodosOne = $TodoModel->getList(1,1,'');
      $listTodosTwo = $TodoModel->getList(2,1,session('sess_id_sub_class'));
      /*echo $this->idClass;
      print_r($classDetail);*/
      // count siswa
      $countDiffDate = date_diff(date_create($date_start),date_create($date_end))->days;//$UsersModel->getCountList($this->idClass);
      //print_r($countDiffDate->days);die();
      if($date_start && $date_end){
        $a=0;
        foreach ($listTodosOne as $todoOne) {
          $summaryDone = $TodoModel->getSummaryRangeWajib($todoOne->id,$this->idUser,$date_start,$date_end,1);
          //print_r($summaryDone);
          $onTime = $late30 = 0;
          if(!empty($summaryDone)){
            foreach ($summaryDone as $doneOnly) {
              $params = json_decode($doneOnly->params);

              if($params->waktu=='Tepat waktu'){
                $onTime++;
              }else{
                $late30++;
              }
            }
          }

          $summaryNotDone = $TodoModel->getSummaryRange($todoOne->id,$this->idUser,$date_start,$date_end,0)[0]->count;
          $left = $countDiffDate - (count($summaryDone) + $summaryNotDone);
          $listTodosOne[$a]->done = $onTime;
          $listTodosOne[$a]->done_late = $late30;
          $listTodosOne[$a]->not_done = $summaryNotDone;
          $listTodosOne[$a]->left = $left;
          $a++;
        }

        $a=0;
        foreach ($listTodosTwo as $todoTwo) {
          $summaryDone = $TodoModel->getSummaryRange($todoTwo->id,$this->idUser,$date_start,$date_end,1)[0]->count;
          $summaryNotDone = $TodoModel->getSummaryRange($todoTwo->id,$this->idUser,$date_start,$date_end,0)[0]->count;
          //print_r($summaryDone);
          $left = $countDiffDate - ($summaryDone + $summaryNotDone);
          $listTodosTwo[$a]->done = $summaryDone;
          $listTodosTwo[$a]->not_done = $summaryNotDone;
          $listTodosTwo[$a]->left = $left;
          $a++;
        }
      }


      $data['listTodosOne'] = $listTodosOne;
      $data['listTodosTwo'] = $listTodosTwo;

      $data['prevDay'] = $this->subDays + 1;
      $data['nextDay'] = $this->subDays - 1;

      $data['header_top_title'] = 'Summary Report';
      $data['date_now'] = $this->date_formatted;
      $data['idUser'] = $this->idUser;

      $data['listClasses'] = $UsersModel->getClass();
      $data['date_start'] = $date_start;
      $data['date_end'] = $date_end;

      return view('todo.todo_range',$data);
    }



}
