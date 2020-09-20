<?php

namespace App\Http\Middleware;

use Closure;
use App\Users;
use App\Memo;
use App\Quiz;


class Subscription
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        $sess_id_user = $request->session()->get('sess_id');
        $sess_role = $request->session()->get('sess_role');
        $UsersModel = new Users;
        $level = $UsersModel->checkLevel($sess_id_user);

        // check URL access
        $url1 = $request->segment(1);
        $url2 = $request->segment(2);
        $url3 = $request->segment(3);
        /// role tafsir
        switch ($role) {
            /*case 'tafsir':
                if($url3<78){
                    if($level<=0 || empty($level)){
                        return $this->showSubscriptions();
                    }
                }
                break;*/
            case 'save_memoz':
                $MemoModel = new Memo;
                $list = $MemoModel->getList($sess_id_user,'all');

                $id = $request->input('id');
                if($level<=0 && count($list)>=5 && empty($id)){
                    return $this->showSubscriptions();
                }
                break;
            case 'quiz_form':
                $QuizModel = new Quiz();
                $listQuiz = $QuizModel->getList($sess_id_user);
                if($level<=0 && count($listQuiz)>0 && empty($id)){
                    return $this->showSubscriptions();
                }
                break;

            /*case 'record':
                $MemoModel = new Memo;
                $counter = $MemoModel->getCountRecordedUser($sess_id_user);
                if($counter>=5){
                    return $this->showSubscriptions();
                }
                break;*/
            default:
                # code...
                break;
        }



        return $next($request);
    }

    public function showSubscriptions(){
        // redirect to popup
        $dataHTML['modal_title'] = 'Berlangganan';
        $dataHTML['modal_body'] = view('subscription_info')->render();
        $dataHTML['modal_footer'] = '<button class="btn btn-green-small" data-dismiss="modal">Tutup</button>';

        return response()->json($dataHTML);
    }
}
