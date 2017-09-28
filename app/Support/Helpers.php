<?php 
function arabicNum($str){
	$western_arabic = array('0','1','2','3','4','5','6','7','8','9');
	$eastern_arabic = array('٠','١','٢','٣','٤','٥','٦','٧','٨','٩');

	$str = str_replace($western_arabic, $eastern_arabic, $str);

	return $str;
}

function getCookie(){
	$return['coo_footer_action'] = @$_COOKIE['coo_footer_action'];
	$return['coo_mushaf_layout'] = @$_COOKIE['coo_mushaf_layout'];
	$return['coo_automated_play'] = @$_COOKIE['coo_automated_play'];

	return $return;
}

function dayDiff($dateStart,$dateEnd){
	$dateStart = date('Y-m-d');
	$date1=date_create($dateStart);
	$date2=date_create($dateEnd);
	$diff=date_diff($date1,$date2);

	return $diff;
}

function urlMp3($file){
	$mp3_url = config('app.mp3_url');
	return $mp3_url.$file;

}
function getAvatar($data){
	if(empty($data)){
		return url('assets/images/avatar/guest.png');
	}
	if(!is_file(public_path('assets/images/avatar/'.$data->avatar))){
        $avatar = $data->gender=='F'?url('assets/images/avatar/default_female.png'):url('assets/images/avatar/default_male.png');
    }else{
        $avatar = url('assets/images/avatar/'.$data->avatar);
    }

    return $avatar;
}

function getAge($data){
	return !empty($data->dob)?Carbon::parse($data->dob)->age.'thn':'';
}