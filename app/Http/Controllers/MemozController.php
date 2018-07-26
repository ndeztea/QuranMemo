<?php

namespace App\Http\Controllers;

use DB;
use App\Notes;
use App\Quran;
use App\Users;
use App\Memo;
use App\MemoCorrection;
use App\Subscriptions;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Crypt;
use File;
use FFMPEG;
use Carbon\Carbon;


class MemozController extends Controller
{
    public $recordType = 'user';
    public $levelArr = array(1=>'islam',2=>'iman',3=>'ihsan');

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(request $request)
    {   
       // $surah_start='',$ayat_range='',$id='',$idCorrection=''
        $surah_start = $request->segment(3);
        $ayat_range = $request->segment(4);
        $id = $request->segment(5);
        $idCorrection = $request->segment(6);

        $sess_id_user = session('sess_id');
        $UsersModel = new Users;
        $level = $UsersModel->checkLevel($sess_id_user);
        // check subs
        if($request->segment(2)!='correction'){
            if($surah_start!=''){
                if($level<1){
                    if($surah_start < 78 && $surah_start !=1){
                        if($surah_start=='23' && $ayat_range=='12-15'){
                            
                        }else{
                            return redirect('dashboard?action=berlangganan');
                        }
                        
                    }
                }
            }
        }
        
        $messageErrors = $ayats = '';
        // get data hafalan
        $QuranModel = new Quran;
        $ayat_start = '';
        $ayat_end = '';
        if(strpos($ayat_range,'-')!==false){
            $ayatArr = explode('-', $ayat_range);
            $ayats = $QuranModel->getRangeAyat($surah_start,$ayatArr[0],$surah_start,$ayatArr[1]);
            $ayat_start = $ayatArr[0];
            $ayat_end = $ayatArr[1];
        }else{
            $ayats = $QuranModel->getOneAyat($surah_start,$ayat_range);
            $ayat_start = $ayat_range;
        }

        // get surah
        $surahs = $QuranModel->getSurah();

        // data header
        $data['header_top_title'] = $data['header_title'] = 'Menghafal';
        $data['body_class'] = 'body-memo';
        $data['on_memo'] = true;

        // data header
        if(!empty($ayats)){
            if(request()->segment(2)=='correction'){
                $data['header_title'] = 'Koreksi hafalan Surah '. $ayats[0]->surah_name.' : '.$ayat_range;
                $data['header_description'] = 'Koreksi hafalan Surah '. $ayats[0]->surah_name.' : '.$ayat_range.' '.$ayats[0]->text_indo;
            }else{
                $data['header_title'] = 'Menghafal Surah '. $ayats[0]->surah_name.' : '.$ayat_range;
                $data['header_description'] = 'Menghafal Surah '. $ayats[0]->surah_name.' : '.$ayat_range.' '.$ayats[0]->text_indo;
            }
            
        }

        $memoModel = new Memo;
        $UsersModel = new Users;
        $memoDetail = new \stdClass();
        $memoDetail->id = '';
        $memoDetail->id_user = '';
        if($id){
            // get detail memo
            $memoDetail = $memoModel->getDetail($id);
            // get detail user penghafal
            $userMemoz = $UsersModel->getDetail($memoDetail->id_user)[0];
            $SubscriptionsModel = new Subscriptions();
            $data['listSubscriptions'] = $SubscriptionsModel->getActiveSubscriptions($memoDetail->id_user);
            $data['userMemoz'] = $userMemoz;
        }

        // if correction there
        if($idCorrection){
            $MemoCorrection = new MemoCorrection;
            $correctionDetail = $MemoCorrection->getDetail($idCorrection);
            $correctionDetail->correction = json_decode($correctionDetail->correction);
            $data['correctionDetail'] = $correctionDetail;

            // update already opened
            if($memoDetail->id_user==$sess_id_user){
                $dataRecord['status'] = 1;
                $dataRecord['id'] = $idCorrection;
                $MemoCorrection->edit($dataRecord);
            }
            
        }
        
        $sess_id_user = session('sess_id');
        $counterRecord = $memoModel->getCountRecordedUser($sess_id_user);
        $level = $UsersModel->checkLevel($sess_id_user);


        //$data['fill_ayat_end'] = $fill_ayat_end;
        $data['level'] = $level;
        $data['levelArr'] = $this->levelArr;
        $data['memoDetail'] = $memoDetail;
        $data['counterRecord'] = $counterRecord;
        $data['ayats'] = $ayats;
        $data['idCorrection'] = $idCorrection;
        $data['id'] = $id;
        $data['surahs'] = $surahs;
        $data['surah_start'] = $surah_start;
        $data['ayat_start'] = $ayat_start;
        $data['ayat_range'] = $ayat_range;
        //$data['surah_end'] = $surah_end;
        $data['ayat_end'] = $ayat_end;
        $data['curr_page'] = 0;

        return view('memoz',$data);
    }


    public function search(Request $request){
        $surah_start = $request->input('surah_start');
        $ayat_start = $request->input('ayat_start');
        $ayat_end = $request->input('ayat_end');
        $fill_ayat_end = $request->input('fill_ayat_end');

        $QuranModel = new Quran;
        $surah_detail = $QuranModel->getSurah($surah_start);
        // ayat checking
        if(isset($ayat_start) || isset($ayat_end)){
            if($surah_detail[0]->ayat < $ayat_start){
                return redirect('memoz')->with('messageError', 'Surah '.$surah_detail[0]->surah_name.' ada '.$surah_detail[0]->ayat.' ayat, ayat '.$ayat_start.' tidak ada!');
            }elseif($surah_detail[0]->ayat < $ayat_end){
                return redirect('memoz')->with('messageError', 'Surah '.$surah_detail[0]->surah_name.' ada '.$surah_detail[0]->ayat.' ayat, ayat '.$ayat_end.' tidak ada!');
            }
        }

        if($surah_start && !empty($ayat_start) && !empty($ayat_end)){
            setcookie('coo_last_memoz',url('memoz/surah/'.$surah_start.'/'.$ayat_start.'-'.$ayat_end));
            return redirect('memoz/surah/'.$surah_start.'/'.$ayat_start.'-'.$ayat_end);
        }elseif($surah_start && !empty($ayat_start)){
            setcookie('coo_last_memoz',url('memoz/surah/'.$surah_start.'/'.$ayat_start.'-'.$ayat_end));
            return redirect('memoz/surah/'.$surah_start.'/'.$ayat_start);
        }else{
            return redirect('memoz');
        }
    }

     public function config(){
        $sess_id_user = session('sess_id');

        $repeat = $_GET['repeat'];
        $muratal = $_GET['muratal'];
        $tajwid = $_GET['tajwid'];

        $UsersModel = new Users;
        $level = $UsersModel->checkLevel($sess_id_user);
        $data['level'] = $level;

        $data['arr_muratal_list'] = \Config::get('custom.muratal_list');
        $data['muratal'] = $muratal;
        $data['repeat'] = $repeat;
        $data['tajwid'] = $tajwid;

        $dataHTML['modal_title'] = 'Setting Memoz';
        $dataHTML['modal_body'] = view('memoz_config',$data)->render();
        $dataHTML['modal_footer'] = '<button class="btn btn-green-small info" data-dismiss="modal">Tutup</button>';
        
        return response()->json($dataHTML);
    }

     /**
    * show memoz list menu filter
    *
    */
    public function listing(Request $request){
        $MemoModel = new Memo();

        $dataHTML['modal_title'] = 'Daftar Hafalan';
        $dataHTML['modal_body'] = view('memoz_list')->render();
        $dataHTML['site_url'] = url('');
        $dataHTML['modal_footer'] = '<a class="btn btn-green-small info" href="'.url('memoz').'"><i class="fa fa-file"></i> Hafalan Baru</a> <button class="btn btn-green-small info" data-dismiss="modal"><i class="fa fa-cog fa-spin fa-3x fa-fw label-status-loading " style="display: none;"></i>  Tutup</button>';

        return response()->json($dataHTML);
    }

    /**
    * show memoz list via ajax
    *
    */
    public function list_ajax(Request $request){
        $MemoModel = new Memo();
        $sess_user_id = $request->session()->get('sess_id');
        $filter = $request->input('filter');
        $start = $request->input('start');
        $start = empty($start)?0:$start;

        $data['list']  = $MemoModel->getList($sess_user_id,$filter,$start,10);
        $data['filter'] = $filter;
        $data['start'] = $start;

        $dataHTML['html'] = view('memoz_list_ajax',$data)->render();
        $dataHTML['start'] = $start;
        $dataHTML['count'] = count($data['list']);

        return response()->json($dataHTML);
    }

     /**
    * show memoz list via ajax
    *
    */
    public function list_others_ajax(Request $request){
        $MemoModel = new Memo();
        $sess_user_id = $request->session()->get('sess_id');
        $filter = $request->input('filter');
        $start = $request->input('start');
        $start = empty($start)?0:$start;

        $data['list']  = $MemoModel->getAnotherList(session('sess_id'),$filter,$start,10);
        $data['listCount'] = $MemoModel->getCountAnotherList(session('sess_id'));

        $data['filter'] = $filter;
        $data['start'] = $start;

        $dataHTML['html'] = view('memoz_list_others_ajax',$data)->render();
        $dataHTML['start'] = $start;
        $dataHTML['count'] = count($data['list']);

        return response()->json($dataHTML);
    }

     /**
    * show memoz list via ajax
    *
    */
    public function summary(Request $request){
        $MemoModel = new Memo();
        $QuranModel = new Quran();

        $sess_user_id = $request->session()->get('sess_id');

        $listSurah  = $QuranModel->getSurah();
        $summaryTargetMemo = $MemoModel->getSummaryTargetMemo($sess_user_id);

        // get progress
        if(!empty($summaryTargetMemo)){
            foreach ($summaryTargetMemo as $summary) {
                $arrAyat = array();
               // get summary length
               $arrAyat = range($summary->ayat_start,$summary->ayat_end);
               if(!empty($tempSummaries[$summary->surah_start])){
                    $tempSummaries[$summary->surah_start] .=  implode(',',$arrAyat).',';
               }else{
                    $tempSummaries[$summary->surah_start] =  implode(',',$arrAyat).',';
               }
               
            }
            $summaries = array();
            foreach ($tempSummaries as $key=>$val) {
                $arr = explode(',', $val);
                $arrPop = array_pop($arr);
                $summaries[$key] = $arr;
                $summaries[$key] = array_unique($summaries[$key]);
            }
        }
        //print_r($summaries);die();
        // merge progress with list surah
        $a=0;
        foreach ($listSurah as $surah) {
            $listSurah[$a]->countAyat = isset($summaries[$surah->id])?count($summaries[$surah->id]):0;
            $listSurah[$a]->percent = number_format((($listSurah[$a]->countAyat / $surah->ayat) * 100),0);
            $a++;
        }
        

        $data['listSurah'] = $listSurah;
        $dataHTML['modal_title'] = 'To Hafidz';
        $dataHTML['modal_body'] = view('memoz_goal',$data)->render();
        $dataHTML['modal_footer'] = '<button class="btn btn-green-small info" data-dismiss="modal">Tutup</button>';

        return response()->json($dataHTML);
    }


    /**
    * to show memoz form on modal
    *
    */
    public function form(Request $request){
        $this->middleware('subscription:save_memoz');

        $data['surah_start'] = $request->input('surah_start');
        $data['ayat_start'] = $request->input('ayat_start');
        $data['ayat_end'] = $request->input('ayat_end');

        $QuranModel = new Quran;
        $surahs = $QuranModel->getSurah();
        $data['surahs'] = $surahs;
        $data['date_start'] = '';
        $timestamp = time()-86400;
        $target = strtotime("+7 day", $timestamp);
        $data['date_end'] = date('Y-m-d',$target);
        $data['note'] = '';

        $id = $request->input('id');
        $data['id'] = $id;

        if(!empty($id)){
            $MemoModel = new Memo();
            $memoDetail = $MemoModel->getDetail($id);
            $data['surah_start'] = $memoDetail->surah_start;
            $data['ayat_start'] = $memoDetail->ayat_start;
            $data['ayat_end'] = $memoDetail->ayat_end;
            $data['date_start'] = $memoDetail->date_start;
            $data['date_end'] = $memoDetail->date_end;
            $data['note'] = $memoDetail->note;
        }

        $dataHTML['modal_title'] = 'Simpan Hafalan';
        $dataHTML['modal_body'] = view('memoz_form',$data)->render();
        $dataHTML['modal_footer'] = '<button class="btn btn-green-small info" data-dismiss="modal">Tutup</button>';

        return response()->json($dataHTML);
    }

    /**
    * save memoz
    *
    */
    public function save(Request $request){
        $dataRecord['id'] = $request->input('id');
        $dataRecord['surah_start'] = $request->input('surah_start');
        $dataRecord['ayat_start'] = $request->input('ayat_start');
        $dataRecord['ayat_end'] = $request->input('ayat_end');
        $dataRecord['date_start'] = $request->input('date_start');
        $dataRecord['date_end'] = $request->input('date_end');
        $dataRecord['note'] = $request->input('note');
        $dataRecord['id_user'] = $request->session()->get('sess_id');
        $updated_at = (string) Carbon::now();
        $dataRecord['updated_at'] = $updated_at;
        // saving to DB
        $Memo = new Memo;
        if(empty($dataRecord['id'])){
            $save = $Memo->store($dataRecord);
        }else{
            $save = $Memo->edit($dataRecord);
        }

        // check the process and send as json
        if($save){
            $dataHTML['id'] = $save;
            $dataHTML['surah_start'] = $dataRecord['surah_start'] ;
            $dataHTML['ayat_start'] = $dataRecord['ayat_start'];
            $dataHTML['ayat_end'] = $dataRecord['ayat_end'];
            $dataHTML['siteUrl'] = url('');
            $dataHTML['status'] = true;
            $dataHTML['message'] = 'Hafalan berhasil disimpan';
        }else{
            $dataHTML['id'] = '';
            $dataHTML['status'] = false;
            $dataHTML['message'] = 'Hafalan gagal disimpan';
        }

        return response()->json($dataHTML);
    }

    /**
    * remove memoz
    *
    */
    public function remove(Request $request){
        $id = $request->input('id');
        $MemoModel = new Memo();
        $memoDetail = $MemoModel->getDetail($id);

       
        $dataHTML['message'] = 'Hafalan gagal dihapus';
        $dataHTML['status'] = false;
        if($memoDetail->id_user == $request->session()->get('sess_id')){
            if($MemoModel->remove($id)){
                $dataHTML['message'] = 'Hafalan berhasil dihapus';
                $dataHTML['status'] = true;
                $dataHTML['id'] = $id;

                // remove recorded file if available
                File::delete($memoDetail->record);
            }
        }
        return response()->json($dataHTML);
    }

    /**
    * Update status memoz
    *
    * 0 = on process, 1 = need correction, 2 = DONE
    */
    public function updateStatus(Request $request){
        $id = $request->input('id');
        $status = $request->input('status');

        $MemoModel = new Memo;
        $memoDetail = $MemoModel->getDetail($id);

        $dataHTML['message'] = 'Status gagal di update';
        $dataHTML['status'] = false;
        $dataHTML['status_memoz'] = $status;
        $dataHTML['id'] = $id;

        $dataRecord['id'] = $id;
        $dataRecord['status'] = $status;
        $updated_at = (string) Carbon::now();
        $dataRecord['updated_at'] = $updated_at;
        
        $save = $MemoModel->edit($dataRecord);
        // send ajax response
        if($save){
            $dataHTML['message'] = 'Status berhasil di update';
            $dataHTML['status'] = true;
            $dataHTML['status_memoz'] = $memoDetail->status;
        }

        switch ($dataHTML['status_memoz']) {
            case 1:
                $dataHTML['text_confirm'] = 'Hafalan ini sudah hafal? dan ingin dipublikasikan untuk di test oleh pengguna lain?';
                break;
            
             case 0:
                $dataHTML['text_confirm'] = 'Hafalan ini belum di hafal dengan benar?';
                break;

            default:
                # code...
                break;
        }

        return response()->json($dataHTML);
    }

    /**
    * Upload recorded video and import to mp3
    *
    */
    public function uploadRecorded(Request $request){
        $audio = $request->input('audioBase64');
        $id = $request->input('id');
        $MemoModel = new Memo();
        $memoDetail = $MemoModel->getDetail($id);

        $audio = str_replace('data:audio/wav;base64,', '', $audio);
        $decoded = base64_decode($audio);
        $uniqfile = uniqid('rec_');
        $fileName = $uniqfile.'_'.$request->session()->get('sess_id').'_'.$id.'.wav';
        $dataRecord['record'] = "recorded/".$fileName;

        //$dataRecord['record'] = $fileName;    

        $fileName = public_path($dataRecord['record']);
        $dataHTML['status'] = false;
        $dataHTML['message'] = 'Hasil rekaman gagal di upload.';

        $saveAudio = file_put_contents($fileName, $decoded);
        if($saveAudio){
            $dataRecord['id'] = $id;
            $save = $MemoModel->edit($dataRecord);
            if($save){
                $dataHTML['status'] = true;
                $dataHTML['message'] = 'Hasil rekaman berhasil di upload';

                // convert to mp3
                $fileNameMp3 =  str_replace('wav', 'mp3', $dataRecord['record']);
                $convert = FFMPEG::convert()->input($fileName)->output($fileNameMp3)->go();
                
                $dataRecord['record'] = str_replace('wav', 'mp3', $dataRecord['record']);
                $MemoModel->edit($dataRecord);

                File::delete(public_path($fileName));
                

                // remove the old file
                File::delete(public_path($memoDetail->record));
            }

        }
        return response()->json($dataHTML);
    }

    public function uploadRecordedMobile(Request $request ){
        //$file = public_path('debugUploader.txt');

        //$current = file_get_contents($file);
        $idMemo = $request->segment(3);

        /*ob_start();
        print_r($_FILES);
        echo 'idmemo:'.$idMemo;
        print_r($_FILES);
        print_r($_POST);*/
        $MemoModel = new Memo;
        $fileName = $idMemo.'_'.uniqid('').'.mp3';

        $recordFolder = 'record';
        if($this->recordType=='ustadz'){
            $recordFolder = 'record_ustadz';
        }

        $dataRecord[$recordFolder] = $recordFolder."/".$fileName;
        $path = $request->file('file')->move(public_path($recordFolder.'/'), $fileName);
        
        // delete the old file
        $detailMemo = $MemoModel->getDetail($idMemo);
        $oldRecord = public_path($detailMemo->record);
        if(File::exists($oldRecord)){
            File::delete($oldRecord);
        }

        if(File::exists(public_path($recordFolder.'/'.$fileName))){
           if($detailMemo->status==1 || $detailMemo->status==2){
                $updated_at = (string) Carbon::now();
                $dataRecord['updated_at'] = $updated_at;
           }
            $dataRecord['id'] = $idMemo;
            // dont save if file from ustadz, same from corrections
            if($this->recordType!='ustadz'){
                $MemoModel->edit($dataRecord);
            }
            echo $dataRecord['record'];
        }else{
            echo 'no';
        }

        //$output = ob_get_clean();
        //file_put_contents($file, $output);
    }   

    public function uploadRecordedUstadzMobile(Request $request){
        //$file = public_path('debugUploader.txt');

        //$current = file_get_contents($file);
        $idMemo = $request->segment(3);

        /*ob_start();
        print_r($_FILES);
        echo 'idmemo:'.$idMemo;
        print_r($_FILES);
        print_r($_POST);*/
        $MemoModel = new Memo;
        $fileName = $idMemo.'_'.session('sess_id').'_correction.mp3';

        $recordFolder = 'record_ustadz';

        $dataRecord[$recordFolder] = $recordFolder."/".$fileName;
        $path = $request->file('file')->move(public_path($recordFolder.'/'), $fileName);
        

        if(File::exists(public_path($recordFolder.'/'.$fileName))){
            echo 'correction_file';
        }else{
            echo 'no';
        }

        //$output = ob_get_clean();
        //file_put_contents($file, $output);

    }

    /**
    * for showing the correction form
    *
    */
    public function formCorrection(){
        $dataHTML['modal_title'] = 'Kirim Koreksi';
        $dataHTML['modal_body'] = view('memoz_correction_form')->render();
        $dataHTML['modal_footer'] = '<button class="btn btn-green-small info" data-dismiss="modal">Tutup</button>';

        return response()->json($dataHTML);
    }

    /**
    * saving the correction
    *
    */
    public function saveCorrection(Request $request){
        $dataRecord['id_memo_target'] = $request->input('id_memo_target');
        $dataRecord['id_user'] = $request->session()->get('sess_id');
        $dataRecord['note'] = $request->input('note');
        $dataRecord['correction'] = $request->input('correction');
        $dataRecord['record_file'] = $request->input('record_file');

        $dataRecord['correction'] = array_filter(explode('|', $dataRecord['correction']));
        $dataRecord['correction'] = json_encode($dataRecord['correction']);
        $date_updated = (string) Carbon::now();
        $dataRecord['date_updated'] = $date_updated;
        // memo detail
        $MemoModel = new Memo;
        $memoDetail = $MemoModel->getDetail($dataRecord['id_memo_target']);
        $countCorrection = $memoDetail->count_correction;

        $MemoCorrection = new MemoCorrection;
        $save = $MemoCorrection->store($dataRecord);
        if($save){
            $dataHTML['id'] = $save;
            $dataHTML['status'] = true;
            $dataHTML['message'] = 'Koreksi berhasil di kirimkan';
            $countCorrection++;

            $dataUpdate['updated_at'] = $date_updated;
            $dataUpdate['count_correction'] = $countCorrection;
            $dataUpdate['id'] = $dataRecord['id_memo_target'];
            // update stats
            $MemoModel->edit($dataUpdate);
        }else{
            $dataHTML['id'] = '';
            $dataHTML['status'] = false;
            $dataHTML['message'] = 'Koreksi gagal  di kirimkan';
        }

         return response()->json($dataHTML);
    }       

    public function listCorrection(Request $request){
        Carbon::setLocale('id');
        $MemoCorrectionModel = new MemoCorrection();
        $start = $request->input('start',0);
        $idMemo = $request->input('idMemo','');
        
        if($idMemo!=''){
            $data['list']  = $MemoCorrectionModel->getMemoCorrection($idMemo,$start,10);
        }else{
            $id_user = $request->session()->get('sess_id');
            $data['list']  = $MemoCorrectionModel->getMemoCorrectionByUser($id_user,$start,10);

        }

        $QuranModel = new Quran;
        $data['start'] = $start;
        $data['idMemo'] = $idMemo;
        $data['QuranModel'] = $QuranModel;
        $dataHTML['modal_title'] = 'Daftar koreksi';
        $dataHTML['modal_body'] = view('memoz_correction_list',$data)->render();
       
        $dataHTML['modal_footer'] = '<button class="btn btn-green-small info" data-dismiss="modal">Tutup</button>';
        $dataHTML['start'] = $start;
        $dataHTML['count'] = count($data['list']);

        return response()->json($dataHTML);
    }

    public function list_need_corrections_ajax(Request $request){
        Carbon::setLocale('id');
        $MemoCorrectionModel = new MemoCorrection();
        $start = $request->input('start',0);
        
        $MemoModel = new Memo();
        $SubscriptionsModel = new Subscriptions();
        $listCorrections  = $MemoModel->getNeedCorrection($start,10);
        $data['listCount']  = $MemoModel->getCountNeedCorrection();
        $a=0;
        if(!empty($listCorrections)){
            foreach ($listCorrections as $correction) {
                $listCorrections[$a]->listSubscriptions = $SubscriptionsModel->getActiveSubscriptions($correction->id_user);
                $a++;
            }
        }
        $data['list']  = $listCorrections;
        $data['start'] = $start;
        $data['level'] = $this->levelArr;
        $dataHTML['html'] = view('memoz_need_correction_list',$data)->render();
        $dataHTML['start'] = $start;
        $dataHTML['count'] = count($data['list']);
        
        
        return response()->json($dataHTML);
    }

    public function inProgress(Request $request){
        $MemoModel = new Memo();
        $id = $request->input('id');
        $MemoModel->setInProgress($id,$request->session()->get('sess_id'));
        $dataHTML['status'] = 1;
        $dataHTML['id'] = $id;
        return response()->json($dataHTML);
    }

   
}
