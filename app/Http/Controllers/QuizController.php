<?php

namespace App\Http\Controllers;

use DB;
use Image;
use App\Users;
use App\Quran;
use App\Quiz;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Crypt;
use Illuminate\Support\Facades\Hash;
use File;

use Carbon\Carbon;

use App\Libraries\QuizLib;

class QuizController extends Controller
{
    public $total_questions = 8;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function form(Request $request)
    {
        $QuranModel = new Quran();
        $listSurah = $QuranModel->getSurah();

        $dataHTML['listSurah'] = $listSurah;
        $dataHTML['modal_title'] = 'Buat Quiz';
        $dataHTML['modal_body'] = view('quiz_form',$dataHTML)->render();
        $dataHTML['modal_footer'] = ' <button style="width:200px" class="btn btn-green-small info" onclick="$(\'#formQuiz\').submit()">Mulai Quiz!</button> <button class="btn btn-green-small info" data-dismiss="modal">Tutup</button>';

        return response()->json($dataHTML);
    }

    public function number(Request $request,$number=1)
    {
        Carbon::setLocale('id');

        $data['header_top_title'] = $data['header_title'] = 'Quiz';
        $idSurahs = $request->input('id_surah');
        $answer = $request->input('answer');
        $correct_answer = $request->input('correct_answer');

        // can back to old number
        $sess_old_number = $request->session()->get('sess_old_number');
        if($number<=$sess_old_number){
            return redirect('quiz/number/'.$sess_old_number++);
        }

        if(!empty($idSurahs)){
            $request->session()->put('sess_quiz',$idSurahs);
        }else{
            $sess_quiz = $request->session()->get('sess_quiz');
            $idSurahs = $sess_quiz;
        }

        if(empty($idSurahs)){
            return redirect('dashboard')->with('messageError', 'Mohon pilih surah yang akan di quiz kan');
        }

        // answer the question
        if($answer){
            $sess_answer = $request->session()->get('sess_answer');
            $ency_answer = md5($answer);
            if($ency_answer==$correct_answer){
                $data['messageSuccess'] = '<div class="quiz-message"><p>Alhamdulillah </p><br><i class="fa fa-check-circle quiz-correct"></i><br><strong class="text-correct">BENAR</strong></div>';
                $points = 4;
                addPoints(session('sess_id'),'quiz.correct',$points);

                $right_answer = $request->session()->get('sess_right_answer');
                $right_answer = $right_answer + 1;
                $request->session()->put('sess_right_answer',$right_answer);
            }else{
                $data['messageSuccess'] = '<div class="quiz-message"><p>Subhanallah </p><br><i class="fa fa-times-circle quiz-false"></i><br><strong class="text-false">SALAH</strong></div>';
                $points = -2;
                addPoints(session('sess_id'),'quiz.wrong',$points);
                $right_answer = $request->session()->get('sess_right_answer');
                $right_answer = empty($right_answer)?0:$right_answer;
            }

            $curr_points = $request->session()->get('sess_quiz_total_points');
            $new_points = $curr_points + $points;

            $request->session()->put('sess_quiz_total_points',$new_points);


        }

        $QuranModel = new Quran();
        if($number>$this->total_questions){
            foreach ($idSurahs as $idSurah) {
                $surah_detail = $QuranModel->getSurah($idSurah);
                $quizName[] = $surah_detail[0]->surah_name;
            }

            // store for history
            $dataRecord['id_user'] = session('sess_id');
            $dataRecord['name'] = 'Surah : '.implode(', ', $quizName);
            $dataRecord['score'] = $right_answer.'/'.$this->total_questions;
            $dataRecord['points'] = $new_points;
            $dataRecord['date'] = (string) Carbon::now();
            $QuizModel = new Quiz();
            $QuizModel->store($dataRecord);

            $request->session()->forget('sess_quiz');
            $request->session()->forget('sess_answer');
            $request->session()->forget('sess_quiz_total_points');
            $request->session()->forget('sess_right_answer');
            $messageFinish = $data['messageSuccess'];
            $messageFinish .= '<div class="quiz-points"><div class="total-points">'.$new_points.'</div><br><div class="text-points">Points</div><small>Benar '.$right_answer.' dari '.$this->total_questions.' pertanyaan </small></div><br>';
            return redirect('dashboard')->with('messageSuccess', $messageFinish);
        }

        #get random surah to be quiz-ed
        $randomSurah = array_rand($idSurahs,1);
        $surah = $idSurahs[$randomSurah];

        $data['surah_detail'] = $QuranModel->getSurah($surah);

        $QuizLib = new QuizLib();
        #get random ayat to be quiz-ed
        $type = 'next';
        $QAyats = $QuizLib->getQuestions($surah,$type);

        $data['question_offset'] = $QAyats['question_offset'] < 0? str_replace('-', '', $data['question_offset']) :$QAyats['question_offset'];
        $data['question_text'] = $type=='next'?'setelah':'sesudah';
        $data['question'] = $QAyats['question'];
        $data['answer'] = $QAyats['answer'];
        $data['answer_type'] = $QAyats['answer_type'];
        $data['question_type'] = $QAyats['question_type'];

        $choices = $QuizLib->getChoices($idSurahs);
        $choices[3] = $data['answer'];
        shuffle($choices);

        $data['list_answers'] = $choices;
        $data['total_questions'] = $this->total_questions;
        $data['number'] = $number;
        $data['next_number'] = $number + 1;
        $data['correct_answer'] = md5($QAyats['answer']->id);

        // this is the answer put it on flash session
        $request->session()->get('sess_old_number', $number);

        return view('quiz',$data);

    }


}
