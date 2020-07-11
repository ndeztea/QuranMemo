<?php
namespace App\Libraries;

use DB;
use Carbon\Carbon;

class Points
{
	var $roles;
	var $table = 'user_points';

	public function __construct(){
		$this->roles = array(
				"auth.login" => 2,
				"auth.logout" => 0,

				"memoz.create" => 5,
				"memoz.delete" => -2,
				"memoz.done" => 5,
				"memoz.murajaah" => 5,
				"memoz.good"	=> 30,
				"memoz.ok"		=> 20,
				"memoz.enough"	=> 10,
				"memoz.bad"		=> 0,
				"memoz.setor"	=> 7,
				"memoz.record"	=> 5,
				"memoz.correction" => 10,

				"memoz.alkahfi"	=> 10,

				"profile.edit"	=> 2,
				"profile.avatar"=> 5,

				"read.alkahfi"	=> 10,
				"read.quran"	=> 1,

				"quiz.correct"	=> 4,
				"quiz.wrong"	=> -2,
				"read.dzikir"=> 2,
			);
	}

	public function assignPoints($id,$action){
		if(empty($id))
			return false;

		$updated_at = (string) Carbon::now();
        $dataRecord['date'] = $updated_at;
        $dataRecord['action'] = $action;
        $dataRecord['points'] = $this->roles[$action];
        $dataRecord['id_user'] = $id;

        return DB::table($this->table)->insertGetId($dataRecord);
	}

	public function addPoints($id,$action,$points){
		$updated_at = (string) Carbon::now();
        $dataRecord['date'] = $updated_at;
        $dataRecord['action'] = $action;
        $dataRecord['points'] = $points;
        $dataRecord['id_user'] = $id;

        return DB::table($this->table)->insertGetId($dataRecord);
	}

	public function totalPoints($id_user,$type='all'){

		switch ($type) {
			case 'all':
				$totalPoints =  DB::table($this->table)
					 ->selectRaw('sum(points) as points')
	                ->where('id_user',$id_user)
	                ->first();
				break;

			default:
				# code...
				break;
		}

		return empty($totalPoints)?0:$totalPoints->points;
	}
}
