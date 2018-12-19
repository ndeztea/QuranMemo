<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    //
    protected $table = 'quiz';
    public $id = '';
    public $id_user = '';
    public $name = '';
    public $questions = '';
    public $answer = '';
    public $params = '';
    public $date = '';

    protected $fillable = array('id_user','name','score','points','params');

    public function store($data){
        return DB::table($this->table)->insertGetId($data);
    }

    public function getQuestionsRange($arrSurah){
        $surah = implode(',', $arrSurah);
        return DB::table('surah')->where($data);
    }

    public function getList($id_user){
        $quiz = DB::table($this->table)
                ->select('*')
                ->where('id_user',$id_user);
        return $quiz->get();
    }
}
