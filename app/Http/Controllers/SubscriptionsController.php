<?php

namespace App\Http\Controllers;

use DB;
use App\Subscriptions;
use App\Users;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use File;

use Carbon\Carbon;
use Mail;



class SubscriptionsController extends Controller
{
    var $price = array(
      'islam'=> array(
        '31'  => 10000,
        '90'  => 25000,
        '180' => 50000,
        '360' => 100000,
        ),
      'iman'=> array(
        '31'  => 20000,
        '90'  => 50000,
        '180' => 100000,
        '360' => 150000,
        ),
      'ihsan'=> array(
        '31'  => 50000,
        '90'  => 130000,
        '180' => 250000,
        '360' => 450000,
        ),
    );

    var $level = array('islam'=>1,'iman'=>2,'ihsan'=>3);

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function order(Request $request)
    {

       // save record
       $level =  $request->segment(3);
       $length =  $request->segment(4);
       if($level){
            $sess_id = $request->session()->get('sess_id');

            $created_date = (string) Carbon::now();

            $price = $this->price[$level][$length];
            $uniqPrice =  rand(100, 999);

            $SubscriptionsModel = new Subscriptions();

            $levelId = $this->level[$level];
            $data = array('id_user' => $sess_id,
                'level' => $levelId,
                'created_date' => $created_date,
                'length' => $length,
                'price' =>  $price+$uniqPrice);
            $subscriptions_id = $SubscriptionsModel->store($data);

            // send email
            $objUsers = new Users;
            $dataUser = $objUsers->getDetail($sess_id)[0];
            $emailData['level'] = $level;
            $emailData['name'] = $dataUser->name;
            $emailData['email'] = $dataUser->email;
            $emailData['active'] = 0;
            $emailData['price'] = $price+$uniqPrice;
            $emailData['url'] = url('subscription/confirmation/'.$subscriptions_id);

            /* Mail::send('emails.subscriptions_order', ['emailData' => $emailData], function ($m) use ($emailData) {
                $m->from('info@quranmemo.id', 'QuranMemo');
                $m->to($emailData['email'], $emailData['name'])->subject('Order QuranMemo');
                $m->to('quranmemo.id@gmail.com','Admin QuranMemo')->subject('New Order QuranMemo');
            });*/


            return redirect('subscription/confirmation/'.$subscriptions_id);
       }

       return redirect('dashboard')->with('messageError', 'Pesanan gagal di proses');


    }

  public function confirmation(Request $request){
      $sess_id = $request->session()->get('sess_id');
      $paid = $request->input('paid');
      $SubscriptionsModel = new Subscriptions();
      $subscriptions_id = $request->segment(3);

     $data['header_top_title'] = $data['header_title'] = 'Invoice';

     if($request->input('action')){
      // upload file
        if(!empty($request->file('file'))){
          $fileName = uniqid('file-').'.'.$request->file('file')->extension();
          $path = $request->file('file')->move(public_path('confirmation_file'), $fileName);

          // make sure upload sucess
            if(File::exists($path)){
              $dataRecord['file'] = 'confirmation_file/'.$fileName;
            }
        }

        $detail = $SubscriptionsModel->getDetail($subscriptions_id);
        // send email
        $objUsers = new Users;
        $dataUser = $objUsers->getDetail($detail->id_user)[0];
        $emailData['level'] =  array_keys($this->level, $detail->level)[0];
        $emailData['name'] = $dataUser->name;
        $emailData['email'] = $dataUser->email;
        $emailData['price'] = $detail->price;
        $emailData['active'] = 1;
        $emailData['url'] = '#';
        $dt = Carbon::now()->addDays($detail->length);
        $emailData['expired_date'] = $dt->format('d-m-Y');

        $dataRecord['id'] = $subscriptions_id;
        $dataRecord['status'] = 1;
        $dataRecord['paid'] = $paid;
        $dataRecord['active'] = 0;
        $dataRecord['expired_date'] = (string) Carbon::now()->addDays($detail->length);
        $isSuccess =  $SubscriptionsModel->edit($dataRecord);
        if($isSuccess){
          /*Mail::send('emails.subscriptions_order', ['emailData' => $emailData], function ($m) use ($emailData) {
              $m->from('info@quranmemo.id', 'QuranMemo');
              $m->to('quranmemo.id@gmail.com','Admin QuranMemo')->subject('New Butuh Approval berlangganan QuranMemo');
          });*/

          return redirect('subscription/confirmation/'.$subscriptions_id)->with('messageSuccess', 'Konfirmasi berhasil, kami akan cek Konfirmasi dalam 1x24 jam');
        }
       }


       $detail = $SubscriptionsModel->getDetail($subscriptions_id);
       if(empty($detail) || $detail->id_user != $sess_id){
            return redirect('dashboard')->with('messageError', 'Order tidak ditemukan');
       }
       $detail->level = array_keys($this->level, $detail->level)[0];

       $data['detail'] = $detail;
       return view('subscriptions_order',$data);
    }

    public function approve(Request $request){
      $SubscriptionsModel = new Subscriptions();
      $subscriptions_id = $request->segment(3);

        $detail = $SubscriptionsModel->getDetail($subscriptions_id);
      // send email
        $objUsers = new Users;
        $dataUser = $objUsers->getDetail($detail->id_user)[0];
        $emailData['level'] =  array_keys($this->level, $detail->level)[0];
        $emailData['name'] = $dataUser->name;
        $emailData['email'] = $dataUser->email;
        $emailData['price'] = $detail->price;
        $emailData['active'] = 1;
        $emailData['url'] = '#';
        $dt = Carbon::now()->addDays($detail->length);
        $emailData['expired_date'] = $dt->format('d-m-Y');
        // update subscriptions
        $dataRecord['id'] = $subscriptions_id;
        $dataRecord['active'] = 1;
        $dataRecord['expired_date'] = $dt->format('Y-m-d');
        $isSuccess =  $SubscriptionsModel->edit($dataRecord);
        if($isSuccess){
          /*  Mail::send('emails.subscriptions_order', ['emailData' => $emailData], function ($m) use ($emailData) {
              $m->from('info@quranmemo.id', 'QuranMemo');
              $m->to($emailData['email'], $emailData['name'])->subject('Approval berlangganan QuranMemo berhasil');
              $m->to('quranmemo.id@gmail.com','Admin QuranMemo')->subject('New Approval berlangganan QuranMemo berhasil');
          });*/
          return redirect('subscription/listing?status=approval')->with('messageSuccess', 'Konfirmasi sukses');
        }

        return redirect('subscription/listing')->with('messageError', 'Konfirmasi gagal');
    }

    public function notvalid(Request $request){
      $SubscriptionsModel = new Subscriptions();
      $subscriptions_id = $request->segment(3);

        $detail = $SubscriptionsModel->getDetail($subscriptions_id);
      // send email
        // update subscriptions
        $dataRecord['id'] = $subscriptions_id;
        $dataRecord['active'] = 0;
        $dataRecord['status'] = 0;
        $isSuccess =  $SubscriptionsModel->edit($dataRecord);
        if($isSuccess){
          return redirect('subscription/listing?status=approval')->with('messageSuccess', 'Update ke notvalid berhasil');
        }

        return redirect('subscription/listing?status=approval')->with('messageError', 'Update ke notvalid gagal');
    }

    public function cancel(Request $request){
      $SubscriptionsModel = new Subscriptions();
      $subscriptions_id = $request->segment(3);

        $detail = $SubscriptionsModel->getDetail($subscriptions_id);

        if($detail->id_user == session('sess_id') || session('sess_role')==1){
          $isSuccess =  $SubscriptionsModel->remove($subscriptions_id);
          if($isSuccess){
            return redirect('subscription/listing')->with('messageSuccess', 'Pesanan berhasil di cancel');
          }

          return redirect('subscription/listing')->with('messageError', 'Pesanan gagal di cancel');
        }

        return redirect('subscription/listing')->with('messageError', 'Tidak punya akses');
      // send email
        // update subscriptions
        $dataRecord['id'] = $subscriptions_id;
        $dataRecord['active'] = 0;
        $dataRecord['status'] = 0;
        $isSuccess =  $SubscriptionsModel->edit($dataRecord);
        if($isSuccess){
          return redirect('subscription/listing')->with('messageSuccess', 'Update ke notvalid berhasil');
        }

        return redirect('subscription/listing')->with('messageError', 'Update ke notvalid gagal');
    }

    public function listing(Request $request){
        $SubscriptionsModel = new Subscriptions();
        $sessRole = session('sess_role');
        if($sessRole==1){
          if($request->input('status')=='approval'){
            $orderList = $SubscriptionsModel->getAllApprovalSubscriptions();
          }elseif($request->input('status')=='active'){
            $orderList = $SubscriptionsModel->getAllActiveSubscriptions();
          }else{
            $orderList = $SubscriptionsModel->getAllPendingSubscriptions();
          }

        }else{
          $orderList = $SubscriptionsModel->getPendingSubscriptions(session('sess_id'));
        }

        $data['header_top_title'] = $data['header_title'] = 'Daftar Order';

        $data['orderList'] = $orderList;
        $data['level'] = $this->level;
        return view('subscriptions_list',$data);
    }

    public function counter(){
      $SubscriptionsModel = new Subscriptions();
      $sessRole = session('sess_role');
      if($sessRole==1){
        $counter = $SubscriptionsModel->getAllPendingSubscriptions();
      }else{
        $counter = $SubscriptionsModel->getPendingSubscriptions(session('sess_id'));
      }

      $dataHTML['counter'] = 0;
      if(count($counter)>0){
        $dataHTML['counter'] = count($counter);
      }

      echo json_encode($dataHTML);
      die();
    }

}
