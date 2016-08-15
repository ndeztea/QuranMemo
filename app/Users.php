<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    //
    protected $table = 'users';
    public $id;
    public $name;
    public $email;
    public $password;
    public $state;
    public $id_surah;
    public $id_ayat;
    public $is_active;
    public $city;
    public $address;

    protected $fillable = array('name', 'email', 'password','city','address','device_id');

    public function login($data){
    	// login code
    }
}
