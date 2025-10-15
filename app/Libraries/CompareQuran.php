<?php
namespace App\Libraries;

use DB;
use Carbon\Carbon;

class CompareQuran
{

  var $text_quran = 'قل أعوذ برب الناس ملك الناس إله الناس من شر الوسواس الخناس الذي يوسوس في صدور الناس من الجنة والناس';
  var $text_record = 'قل اعوذ برب الناس ملك الناس اله الناس من شر الوسواس الخناس الذي يوسوس في صدور الناس من الجنه والناس. ';

  public function __construct(){

  }

  public function generate(){
    $alif = 'ا';
    $alif_kashro = 'إ';
    $alif_fatha = 'أ';
    $ha = 'ه';
    $ta_marbutoh = 'ة';
    $dot = '.';
    // replace  string which hard to be detected
    $this->text_quran = str_replace($alif_kashro , $alif, $this->text_quran);
    $this->text_quran = str_replace($alif_fatha , $alif, $this->text_quran);
    $this->text_quran = str_replace($ta_marbutoh , $ha, $this->text_quran);
    $this->text_record = str_replace($dot ,' ', $this->text_record);

    // split the each word  into pieces array
    $split_record= (explode(' ', trim($this->text_record)));
    $split_quran= (explode(' ', trim($this->text_quran)));
    $text_correct = $total_percentage = 0;

    echo $this->text_quran;
    // use this if compare per ayat
    //for ($a=0;$a<count($split_quran);$a++){

    // use this if compare ayat per target
    for ($a=0;$a<count($split_record);$a++){
      echo '<br>';
      if(isset($split_record[$a])){
        // use this if compare per ayat
        //if($split_record[$a]==$split_quran[$a]){

        // use this if compare ayat per target
        if(strpos($this->text_quran, trim($split_record[$a].' '.@$split_record[$a+1]))>=0){
          $text_correct++;
          //echo $split_record[$a].'=>'.$split_quran[$a];
          echo $split_record[$a].' '.@$split_record[$a+1];
        }else{
          //echo $split_record[$a].'=>'.$split_quran[$a].' X ';
          echo $split_record[$a].' '.@$split_record[$a+1].' X ';
        }
      }
      echo '<br>';
    }
    echo 'Total correct : '.$text_correct;
    $total_percentage = floor(($text_correct/count($split_quran)) * 100);
    echo '  (<b>'.$total_percentage.'%</b>)';
  }

  private function callEndPoint($endpoint){

  }
}
