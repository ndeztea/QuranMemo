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

        return view('events.event_detail',$data);
    }

    public function join(Request $request){
      $id_event = $request->segment(3);
      //  process the event here

      $dataHTML['modal_title'] = 'Kode akses';
      $dataHTML['modal_body'] = view('events.event_join_code',$dataHTML)->render();
      $dataHTML['modal_footer'] = ' <button class="btn btn-green-small info" data-dismiss="modal">Tutup</button>';


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


}
