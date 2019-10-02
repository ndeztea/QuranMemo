<?php

namespace App\Http\Controllers;

use DB;
use App\Categories;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use File;

class AdminController extends Controller
{
    var $token_key = '5105131402';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {

    }

    public function set_token(Request $request){
      $token_key = $request->get('token_key');
      if($this->token_key == $token_key){
        $request->session()->put('sess_token_key',1);
        return redirect('admin/form');
      }
      return redirect('dashboard');
    }

    public function unset_token(Request $request){
      $request->session()->forget('sess_token_key');
      return redirect('dashboard');
    }

    public function form(Request $request){
      $id = $request->get('id');

      $Categories = new Categories();
      $listCategories = $Categories->getAll();

      $dataHtml['header_title'] = $dataHtml['header_top_title'] =  'Content Manajemen';
      $dataHtml['listCategories'] = $listCategories;
      $dataHtml['listTypes'] = array('video'=>'Video','audiobook'=>'Audio','library-books'=>'Image');

      return view('admin.form',$dataHtml);
    }

    public function post_save(Request $request){
      $Categories = new Categories();
      $title = $request->input('title');
      $id_category = $request->input('id_category');
      $file = $request->file('file');
      $is_active = $request->input('is_active');
      $type = $request->input('type');

      if($title){
        if($type=='audiobook'){
          $ext = '.mp3';
          $folder = 'audios';
        }elseif($type=='video'){
          $ext = '.mp4';
          $folder = 'videos';
        }

        $fileName = uniqid($type).$ext;
        $filePath = $file->move(public_path('assets/media/'.$folder), $fileName);

        if($filePath){
            $data['title'] = $title;
            $data['content'] = 'assets/media/'.$folder.'/'.$fileName;
            $data['is_active'] = $is_active;
            $data['type'] = $type;
            $data['id_category'] = $id_category;

            $is_save = $Categories->storeContentCategory($data);
            if($is_save){
              return redirect('admin/form')->with('messageSuccess', 'Data berhasil disimpan');
            }else{
              return redirect('admin/form')->with('messageFailed', 'Data gagal disimpan');
            }
        }else{
          return redirect('admin/form')->with('messageFailed', 'Data gagal diupload');
        }

      }

    }



}
