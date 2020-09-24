<?php
namespace App\Libraries;

use DB;
use Carbon\Carbon;
use App\Quiz;
use App\Quran;


class QuizLib
{
	public $types;

	public function getQuestions($surah, $type='next'){
		$QuranModel = new Quran();
		$ayats = $QuranModel->getAyatSurah($surah);
	    $countAyat = count($ayats);
	    $offset = rand(0,2);
	    /*$offset = -2;
	    echo $countAyat .'+' .$offset;
	    echo '<br>';
	    echo '='.(int) $countAyat + (int) $offset;*/
	    if($offset >= 0 ){
	    	$qIndex = rand(0,$countAyat - $offset);
	    }else{
	    	$qIndex = rand($countAyat + $offset,$countAyat);
	    }

	    // get questions
			if(empty($ayats[$qIndex])){
				$ayats[$qIndex] = 1;
			}
	    $return['question'] = $ayats[$qIndex];
	    $return['question_offset'] = $offset;

	    $qType = rand(1,2);
	    if($qType==1)
	    	$return['question_type'] = 'text';
	    else
	    	$return['question_type'] = 'audio';


	    // get answers
	    $aIndex = $qIndex + $offset;
	    if(empty($ayats[$aIndex]) || $offset==0){
	    	$return['answer'] = $ayats[$qIndex];
	    	$return['answer_type'] = 'number_ayat';
	    }else{
	    	$ayats[$aIndex]->is_correct = true;
	    	$return['answer'] = $ayats[$aIndex];
	    	$return['answer_type'] = 'arabic';
	    }

		return $return;
	}

	public function getChoices($surahs){
		$QuranModel = new Quran();
		$ayats = $QuranModel->getAyatSurah($surahs,3);

		return $ayats;
	}


}
