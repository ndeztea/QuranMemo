<?php

namespace App\Http\Middleware;

use Closure;
use App\Users;
use Illuminate\Contracts\Auth\Guard;

class Administration
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
        
        $sess_id = $request->session()->get('sess_id');
        $usersModel = new Users;
        $dataAdmin = $usersModel->getDetail($sess_id);
        if(!empty($dataAdmin)){
            if ($dataAdmin[0]->role!=1) {
                return redirect('dashboard');
            }
        }
        

        return $next($request);
    }
}
