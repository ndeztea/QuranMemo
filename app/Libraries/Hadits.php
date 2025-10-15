<?php
namespace App\Libraries;

use DB;
use Carbon\Carbon;

class Hadits
{
  var $curl_end_points = 'https://api.hadith.sutanlab.id/books';
  var $list_riwayat = array();

  public function __construct(){
    $this->list_riwayat[] = array('muslim','HR Muslim',4930);
    //$this->list_riwayat[] = array('abu-daud','HR Abu Dawud',4419);
    //$this->list_riwayat[] = array('ahmad','HR Ahmad',4305);
    $this->list_riwayat[] = array('bukhari','HR Bukhari',6638);
    //$this->list_riwayat[] = array('darimi','HR Darimi',2949);
    //$this->list_riwayat[] = array('ibnu-majah',4285);
    //$this->list_riwayat[] = array('tirmidzi','HR Tirmidzi',3625);
  }

  public function getRandomHadits(){
    $rand_book = array_rand($this->list_riwayat,1);
    $rand_book_no = rand(1,$this->list_riwayat[$rand_book][2]);
    $end_point = $this->curl_end_points.'/'.$this->list_riwayat[$rand_book][0].'/'.$rand_book_no;

    $end_point_response = $this->callEndPoint($end_point);

    if(isset($end_point_response->data->contents->id)){
      $data['code'] = $end_point_response->code;
      $data['full_arab'] = $end_point_response->data->contents->arab;
      $data['full_text'] = $end_point_response->data->contents->id;

      $temp_simple = explode('"', $end_point_response->data->contents->id);
      $simple = substr($temp_simple[1], 0, 150);
      $data['simple'] = $simple.' ...';
      $data['book_info'] = $this->list_riwayat[$rand_book][1].' No.'.$rand_book_no;

      return $data;
    }

    return false;
  }

  private function callEndPoint($endpoint){
    $c = curl_init();
    curl_setopt($c, CURLOPT_URL, $endpoint);
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

    return $objResponse;
  }
}
