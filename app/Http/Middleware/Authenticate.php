<?php

namespace App\Http\Middleware;

use Closure;
use App\Users;
use Illuminate\Contracts\Auth\Guard;

class Authenticate
{
    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * Create a new filter instance.
     *
     * @param  Guard  $auth
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!$request->segment('2')=='edit'){
            $UsersModel = new Users;
            $data['detailProfile'] = $UsersModel->getDetail(session('sess_id'));
            if(!empty($data['detailProfile'])){
                $data['detailProfile'] = $data['detailProfile'][0];
                if(empty($data['detailProfile']->dob) || $data['detailProfile']->dob=='0000-00-00'){
                    return redirect('profile/edit')->with('messageError', 'Mohon lengkapi data tanggal lahir terlebih dahulu')->withInput();
                }
            }
        }
        

        if (empty($request->session()->get('sess_id'))) {
            return redirect('dashboard')->with('messageError', 'Tidak bisa akses, harus login dahulu');
        }

        return $next($request);
    }
}
