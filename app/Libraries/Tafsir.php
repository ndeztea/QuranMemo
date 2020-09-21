<?php
namespace App\Libraries;

use DB;
use Carbon\Carbon;

class Tafsir
{
  var $curl_end_points = 'https://api.quran.sutanlab.id/surah';
  var $list_riwayat = array();

  public function __construct(){

  }

  public function getTafsir($surah, $ayat){
    $end_point = $this->curl_end_points.'/'.$surah.'/'.$ayat;
    $end_point_response = $this->callEndPoint($end_point);

    if(isset($end_point_response->data->tafsir->id->long)){
      $data['code'] = $end_point_response->code;
      $data['tafsir'] = $end_point_response->data->tafsir->id->long;
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
