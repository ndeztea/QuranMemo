<?php

namespace App\Http\Controllers;

use DB;
use App\Categories;
use App\Users;
use App\Libraries\Points;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Crypt;
use File;
use Carbon\Carbon;


class CategoryController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index(Request $request)
     {
         Carbon::setLocale('id');

        $data['header_top_title'] = $data['header_title'] = 'Dashboard';

        $objCategories = new Categories();
        $objUsers = new Users();
        $data['contentNewest'] = $objCategories->getContentOrder('id','desc');
        $data['contentVisitor'] = $objCategories->getContentOrder('counter','desc');
        $data['categories'] = $objCategories->getAll();
        $detailProfile = $objUsers->getDetail(session('sess_id'));
        $data['detailProfile'] = empty($detailProfile)?null:$detailProfile[0];
        return view('md.category',$data);
     }

     public function categoryContent(Request $request)
     {
        $id = $request->segment(2);

        $objCategories = new Categories();
        $category = $objCategories->getDetail($id);
        $data['header_top_title'] = $data['header_title'] = $category->category;

        $data['listContent'] = $objCategories->categoryContent($id);

        return view('md.category_content',$data);
     }

     public function searchContent(Request $request)
     {
        $keyword = $request->input('keyword');

        $objCategories = new Categories();
        $data['header_top_title'] = $data['header_title'] = 'Pencarian';
        $data['listContent'] = $objCategories->searchContent($keyword);
        $data['keyword'] = $keyword;

        return view('md.category_content',$data);
     }

     public function detailContent(Request $request){
       $id = $request->segment(2);

       $objCategories = new Categories();
       $data['header_top_title'] = $data['header_title'] = 'Detail';
       $data['content'] = $objCategories->contentDetail($id);
       $objCategories->counter($id);

       return view('md.detail_content',$data);
     }



}
