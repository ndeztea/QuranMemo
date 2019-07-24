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
          ->orderby('position','asc')
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
          //->where('type','!=','library-books')
          ->where('id_category',$id_category)
          ->orderby('title','asc')
          ->get();

        return $datas;
    }

    public function searchContent($keyword){
      $datas = DB::table('category_content')
          ->select('category_content.*','category.category')
          ->join('category','category.id','=','category_content.id_category')
          //->where('type','!=','library-books')
          ->where('title','like','%'.$keyword.'%')
          ->get();

        return $datas;
    }

    public function getContentOrder($sorting,$by){
      $datas = DB::table('category_content')
          ->select('category_content.*','category.category')
          ->join('category','category.id','=','category_content.id_category')
          //->where('type','!=','library-books')
          ->orderby($sorting,$by)
          ->limit(5)
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

    public function counter($id){
      $detail = $this->contentDetail($id);
      $data['id'] = $detail->id;
      $data['counter'] = $detail->counter  + 1;
      DB::table('category_content')->where('id',$data['id'])->update($data);
    }
}
