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
    var $price = array('islam'=>10000,'iman'=>20000,'ihsan'=>50000);
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
       if($level){
            $sess_id = $request->session()->get('sess_id');

            $created_date = (string) Carbon::now();
            
            $price = $this->price[$level];
            $uniqPrice =  rand(100, 999);

            $SubscriptionsModel = new Subscriptions();

            $levelId = $this->level[$level];
            $data = array('id_user' => $sess_id,
                'level' => $levelId,
                'created_date' => $created_date,
                'price' =>  $price+$uniqPrice);
            $subscriptions_id = $SubscriptionsModel->store($data);

            // send email
            $objUsers = new Users;
            $dataUser = $objUsers->getDetail($sess_id)[0];
            $emailData['level'] = $level;
            $emailData['name'] = $dataUser->name;
            $emailData['email'] = $dataUser->email;
            $emailData['price'] = $price+$uniqPrice;
            $emailData['url'] = url('subscription/confirmaation/'.$subscriptions_id);

             Mail::send('emails.subscriptions_order', ['emailData' => $emailData], function ($m) use ($emailData) {
                $m->from('info@quranmemo.id', 'QuranMemo');
                $m->to($emailData['email'], $emailData['name'])->subject('Order QuranMemo');
                $m->to('ndeztea@gmail.com','Admin QuranMemo')->subject('New Order QuranMemo');
            });


            return redirect('subscription/confirmation/'.$subscriptions_id);
       }

       return redirect('dashboard')->with('messageError', 'Pesanan gagal di proses');

      
    }

  public function confirmation(Request $request){
      $sess_id = $request->session()->get('sess_id');
      $SubscriptionsModel = new Subscriptions();
      $subscriptions_id = $request->segment(3);
       
     $data['header_top_title'] = $data['header_title'] = 'Konfirmasi  Pembayaran';

     if($request->input('action')){
      // upload file
        if(!empty($request->file('file'))){
          $fileName = uniqid('file-').'.'.$request->file('file')->extension();
          $path = $request->file('file')->move(public_path('file'), $fileName);

          // make sure upload sucess
            if(File::exists($path)){
              $data['file'] = 'confirmation_file/'.$fileName;
            } 
        }
        $dataRecord['id'] = $subscriptions_id;
        $dataRecord['status'] = 1;
        $dataRecord['active'] = 0;
        $dataRecord['expired_date'] = (string) Carbon::now()->addDays(31);
        $isSuccess =  $SubscriptionsModel->edit($dataRecord);
        if($isSuccess){
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

    public function approve(){
      $detail = $SubscriptionsModel->getDetail($subscriptions_id);
      // send email
        $objUsers = new Users;
        $dataUser = $objUsers->getDetail($sess_id)[0];
        $emailData['level'] =  array_keys($this->level, $detail->level)[0];
        $emailData['name'] = $dataUser->name;
        $emailData['email'] = $dataUser->email;
        $emailData['price'] = $detail->price;
        $emailData['active'] = 1;
        $dt = Carbon::now()->addDays(31);
        $emailData['expired_date'] = $dt->format('%A, %d %B %Y');    

        Mail::send('emails.subscriptions_order', ['emailData' => $emailData], function ($m) use ($emailData) {
            $m->from('info@quranmemo.id', 'QuranMemo');
            $m->to($emailData['email'], $emailData['name'])->subject('Konfirmasi berlangganan QuranMemo berhasil');
            $m->to('ndeztea@gmail.com','Admin QuranMemo')->subject('New Konfirmasi berlangganan QuranMemo berhasil');
        });

    }

}
