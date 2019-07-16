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
use Illuminate\Support\Facades\Storage;



class GeneratorController extends Controller
{

    var $mainPath = '/Users/dimas/Works/www/QuranMemo';
    var $targetPath = '/content';
     public function content(Request $request)
     {

        $directory = $this->mainPath.'/public/generate_data';
        $files = array_map('basename',File::directories($directory));
        $Categories = new Categories();
        foreach ($files as $value) {
          $category_name = preg_replace('/[0-9]+/', '', $value);
          $category_name = str_replace('.', '', $category_name);
          $category_name = trim($category_name);

          // check category exist or not
          $CategoryDetail = $Categories->getDetailByName($category_name);
          if(empty($CategoryDetail)){
            $dataCategory['category'] = $category_name;
            $dataCategory['is_active'] = 1;
            $data['id_category'] = $Categories->storeCategory($dataCategory);
          }else{
            $data['id_category'] = $CategoryDetail->id;
          }


          $arrContents['audio'] = 'Audio';
          $arrContents['video'] = 'Video';
          $arrContents['infografis'] = 'Infografis';

          foreach ($arrContents as $keyContent => $valueContent) {
            $directoryAudio = $this->mainPath.'/public/generate_data/'.$value.'/'.$valueContent;
            $audios = array_map('basename',File::files($directoryAudio));
            echo '<br>'.$data['id_category'].'==>';
            foreach ($audios as $valueAudio) {
              $data['title'] = preg_replace('/\\.[^.\\s]{3,4}$/', '', $valueAudio);
              $data['content'] = $this->targetPath.'/'.$keyContent.'/'.$valueAudio;
              $data['is_active'] = 1;
              $data['type'] = $keyContent;
              //echo $directoryAudio;
              //echo file_exists($directoryAudio.'/'.$valueAudio);die();
              $isMoving = rename($directoryAudio.'/'.$valueAudio,
                $this->mainPath.'/'.$this->targetPath.'/'.$keyContent.'/'.$valueAudio);
              if($isMoving){
                $Categories->storeContentCategory($data);
              }


              print_r($data);
              echo '<hr>';
            }
          }
        }
     }

}
