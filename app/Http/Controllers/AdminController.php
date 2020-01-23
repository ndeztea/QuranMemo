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

      return view('md.admin.form',$dataHtml);
    }

    public function post_save(Request $request){
      $Categories = new Categories();
      $title = $request->input('title');
      $id_category = $request->input('id_category');
      $file = $request->file('file');
      $yotube_link = $request->input('yotube_link');
      $is_active = $request->input('is_active');
      $type = $request->input('type');
      if($title){
        if($type=='audiobook'){
          $ext = '.mp3';
          $folder = 'audios';
          $fileName = uniqid($type).$ext;
          $filePath = $file->move(public_path('assets/media/'.$folder), $fileName);
          $content = $filePath?'assets/media/'.$folder.'/'.$fileName:'';
        }
        elseif($type=='library-books'){
          $contens = array();
          foreach ($file as $oneFile) {
            $folder = 'images';
            $fileName = uniqid($type).'.jpg';
            $filePath = $oneFile->move(public_path('assets/media/'.$folder), $fileName);
            $contents[] = $filePath?'assets/media/'.$folder.'/'.$fileName:'';
          }
          $content = json_encode($contents);
        }elseif($type=='video'){
          $content = $yotube_link;
        }

        if($content!=''){
            $data['title'] = $title;
            $data['content'] = $content;
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
