<?php

namespace App\Http\Controllers;

use DB;
use App\Events;
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
        $UsersModel = new Users();

        $objPoints = new Points();
        $total_points = $objPoints->totalPoints(session('sess_id'),'all');
        $data['total_points'] = $total_points;

        $data['detailProfile'] = $UsersModel->getDetail(session('sess_id'));
        $data['detailProfile'] = empty($data['detailProfile'])?null:$data['detailProfile'][0];
        $data['total_points'] = $total_points;
        return view('events.event_index',$data);
    }

    public function listing(Request $request)
    {
        Carbon::setLocale('id');
        $data['header_top_title'] = $data['header_title'] = 'Jadwal Kajian';
        $eventsModel = new Events();

        $events = $eventsModel->getList(true);
        $data['events'] = $events;

        return view('events.event_list',$data);
    }

    public function detail(Request $request)
    {
        Carbon::setLocale('id');
        $data['header_top_title'] = $data['header_title'] = 'Event Detail';
        $id_event = $request->segment(2);
        $eventsModel = new Events();

        if($id_event=='kssm'){
          // get KSSM event
          $event = $eventsModel->getList(true,true);

          if(empty($event)){
            return redirect('dashboard')->with('messageError','Tidak ada kajian TSSM');
          }
          $data['event'] = $event[0];
        }else{
          //get event based on idea
          $event = $eventsModel->getDetail($id_event);
          $data['event'] = $event;
        }

        $id_user = session('sess_id');
        $myAttend = $eventsModel->myAttend($id_event,$id_user);
        $data['myAttend'] = $myAttend;

        $mytime = Carbon::now();
        $data['timenow'] = intVal($mytime->format('H'));
        return view('events.event_detail',$data);
    }

    public function join(Request $request){
      $id_event = $request->segment(3);
      $Events = new Events();
      //  process the event here
      $id_user = session('sess_id');
      if($id_user){
        $myAttend = $Events->myAttend($id_event,$id_user);

        if(empty($myAttend)){
          $code_access = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyz", 5)), 0, 5);
          $dataSave['id_event'] = $id_event;
          $dataSave['id_user'] = $id_user;
          $dataSave['date'] = (string) Carbon::now();
          $dataSave['code_access'] = strtoupper($code_access);

          assignPoints(session('sess_id'),'events.attend');
          $id = $Events->joinEvent($dataSave);
        }else{
          $code_access = $myAttend[0]->code_access;
          $id = $myAttend[0]->id;
        }
      }

      $eventDetail = $Events->getDetail($id_event);
      $attendList = $Events->getAttend($id_event);
      $sortID = $Events->sortAttend($id_event,$id);

      $dataHTML['sortID'] = $sortID;
      $dataHTML['attendList'] = $attendList;
      $dataHTML['eventDetail'] = $eventDetail;
      $dataHTML['code_access'] = strtoupper($code_access);
      $dataHTML['modal_title'] = 'Kode akses';
      $dataHTML['modal_body'] = view('events.event_join_code',$dataHTML)->render();
      $dataHTML['modal_footer'] = '<a class="btn btn-warning info" href="'.url('event/cancelAttend/'.$id_event.'?code_access='.$code_access).'">Batal Hadir</a>  <button class="btn btn-green-small info" data-dismiss="modal">Tutup</button> ';



      return response()->json($dataHTML);
    }

    public function join_code(Request $request){
      $id_event = $request->segment(3);

      //  process the event here
      $dataHTML['modal_title'] = 'Kode akses';
      $dataHTML['modal_body'] = view('events.event_join_code',$dataHTML)->render();
      $dataHTML['modal_footer'] = ' <button class="btn btn-green-small info" data-dismiss="modal">Tutup</button>';


      return response()->json($dataHTML);
    }

    public function attend(Request $request){
      $code_access = $request->input('code_access','');
      $gender = $request->input('gender','');

      $id_event = $request->segment(3);
      $eventsModel = new Events();

      $event = $eventsModel->getDetail($id_event);
      $data['event'] = $event;
      $data['header_top_title'] = $data['header_title'] = 'Attend';
      $data['attendList'] = $eventsModel->getAttend($id_event,$code_access,$gender);
      $data['code_access'] = $code_access;
      $data['gender'] = $gender;


      return view('events.event_attend',$data);
    }

    public function absent(Request $request){
      $code_access = $request->segment(3);
      $eventsModel = new Events();
      $detailAttend = $eventsModel->attendDetail($code_access);

      $eventsModel->attendEvent($code_access,1);

      assignPoints($detailAttend->id_user,'events.absent');

      return redirect('event/attend/'.$detailAttend->id_event)->with('messageSuccess', 'Absensi berhasil');
    }

    public function cancelAbsent(Request $request){
      $code_access = $request->segment(3);
      $eventsModel = new Events();
      $detailAttend = $eventsModel->attendDetail($code_access);

      $eventsModel->attendEvent($code_access,0);

      return redirect('event/attend/'.$detailAttend->id_event);
    }

    public function cancelAttend(Request $request){
      $code_access = $request->input('code_access','');
      $eventsModel = new Events();
      $detailAttend = $eventsModel->attendDetail($code_access);
      $eventsModel->removeAttend($code_access);
      assignPoints($detailAttend->id_user,'events.decline');

      return redirect()->back();
    }


}
