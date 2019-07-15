<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{

    /**
    * get list page
    *
    */
    public function getAll(){
    	$datas = DB::table('category')
    			->select('*')
                ->get();


        return $datas;
    }

    public function getDetail($id=0){
      $detail = DB::table('category')
          ->select('*')->where('id',$id)
          ->get();


        return !empty($detail)?$detail[0]:null;
    }

    public function storeContentCategory($data){
        return DB::table('category_content')->insertGetId($data);
    }

    public function storeCategory($data){
        return DB::table('category')->insertGetId($data);
    }

    public function getDetailByName($name=0){
      $detail = DB::table('category')
          ->select('*')->where('category',$name)
          ->get();


        return !empty($detail)?$detail[0]:null;
    }

    public function categoryContent($id_category){
      $datas = DB::table('category_content')
          ->select('category_content.*','category.category')
          ->join('category','category.id','=','category_content.id_category')
          ->where('id_category',$id_category)
          ->get();

        return $datas;
    }

    public function contentDetail($id){
      $datas = DB::table('category_content')
          ->select('category_content.*','category.category')
          ->join('category','category.id','=','category_content.id_category')
          ->where('category_content.id',$id)
          ->get();

        return $datas[0];
    }
}
