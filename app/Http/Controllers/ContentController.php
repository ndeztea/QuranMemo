<?php

namespace App\Http\Controllers;

use DB;
use App\Notes;
use App\Users;
use App\Quran;
use App\Content;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use File;

class ContentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function contact()
    {
        $dataHTML['modal_class'] = '';
        $dataHTML['modal_title'] = 'Hubungi Kami';
        $dataHTML['modal_body'] = view('content_contact')->render();
        $dataHTML['modal_footer'] = '<button class="btn btn-green-small" data-dismiss="modal">Tutup</button>';

        return response()->json($dataHTML);
    }

    public function subscription()
    {
        $dataHTML['modal_class'] = '';
        $dataHTML['modal_title'] = 'Berlangganan';
        $dataHTML['modal_body'] = view('subscription_info')->render();
        $dataHTML['modal_footer'] = '<button class="btn btn-green-small" data-dismiss="modal">Tutup</button>';

        return response()->json($dataHTML);
    }

    public function about()
    {
        $dataHTML['modal_class'] = '';
        $dataHTML['modal_title'] = 'Tentang QuranMemo';
        $dataHTML['modal_body'] = view('content_about')->render();
        $dataHTML['modal_footer'] = '<button class="btn btn-green-small" data-dismiss="modal">Tutup</button>';

        return response()->json($dataHTML);
    }

    public function donasi()
    {
        $dataHTML['modal_class'] = '';
        $dataHTML['modal_title'] = 'Donasi, Infaq dan Sedekah';
        $dataHTML['modal_body'] = view('content_donasi')->render();
        $dataHTML['modal_footer'] = '<button class="btn btn-green-small" data-dismiss="modal">Tutup</button>';

        return response()->json($dataHTML);
    }

    public function promo()
    {
        $dataHTML['modal_class'] = '';
        $dataHTML['modal_title'] = 'Tahfidz Gratis';
        $dataHTML['modal_body'] = view('content_promo')->render();
        $dataHTML['modal_footer'] = '<button class="btn btn-green-small" data-dismiss="modal">Tutup</button>';

        return response()->json($dataHTML);
    }

    public function alkahfi()
    {
        $dataHTML['modal_class'] = '';
        $dataHTML['modal_title'] = 'Baca Al-Kahfi';
        $dataHTML['modal_body'] = view('content_alkahfi')->render();
        $dataHTML['modal_footer'] = '<button class="btn btn-green-small" data-dismiss="modal">Tutup</button>';

        return response()->json($dataHTML);
    }

    public function buku(Request $request)
    {   
        $email = $request->input('email');
        $clientId = $request->input('clientId');
        if(!empty($email)){
            mail('quranmemo.id@gmail.com, ndeztea@gmail.com', 'Email buku', $email.' - '.$clientId);

            return redirect('mushaf/page/1')->with('messageSuccess', 'Terima kasih, kami akan memproses email antum :)');
        }

        $dataHTML['modal_class'] = '';
        $dataHTML['modal_title'] = 'Berbagi Buku';
        $dataHTML['modal_body'] = view('content_buku')->render();
        $dataHTML['modal_footer'] = '<button class="btn btn-green-small" data-dismiss="modal">Tutup</button>';

        return response()->json($dataHTML);
    }

    public function info()
    {
        $dataHTML['modal_class'] = '';
        $dataHTML['modal_title'] = 'Info';
        $dataHTML['modal_body'] = view('content_info')->render();
        $dataHTML['modal_footer'] = '<button class="btn btn-green-small" data-dismiss="modal">Tutup</button>';
        return response()->json($dataHTML);
    }

    public function info_memoz()
    {
        $dataHTML['modal_class'] = '';
        $dataHTML['modal_title'] = 'Info';
        $dataHTML['modal_body'] = view('content_info_memoz')->render();
        $dataHTML['modal_footer'] = '<span class="cont_hide_memoz_info"> <input type="checkbox" name="hide_memoz_info" onclick="hideInfo()" value="1"> Jangan tampilkan lagi <br></span><button  data-dismiss="modal" class="btn btn-green-small info">Bismillah mulai menghafal</button></div>';
        return response()->json($dataHTML);
    }

    public function muratal(Request $request)
    {   
        $dataHTML['modal_class'] = '';
        $dataHTML['modal_title'] = 'Fitur Muratal';
        $dataHTML['modal_body'] = view('content_muratal')->render();
        $dataHTML['modal_footer'] = '<button class="btn btn-green-small" data-dismiss="modal">Tutup</button>';

        return response()->json($dataHTML);
    }

    public function learning(){
        $data['header_top_title'] = $data['header_title'] = 'Konten';

        $Users = new Users;
        $level = $Users->checkLevel(session('sess_id'));

        $contentModel = new Content;
        $listFolder = $contentModel->getAssetsContent();
        $data['listFolder'] = $listFolder;
        $data['level'] = $level;
        return view('content_learning',$data);
    }

    public function file_learning($folder){
        $data['header_top_title'] = $data['header_title'] = ucfirst($folder);

        $Users = new Users;
        $level = $Users->checkLevel(session('sess_id'));

        $contentModel = new Content;
        $detail  = $contentModel->getAssetDetail($folder);
        if($level<$detail->level){
            return redirect('learning')->with('messageError', 'Tidak mempunyai akses')->withInput();
        }

        $directory = public_path('learning/'.$folder);
        $listFiles = File::allFiles($directory);
       
        $data['listFiles'] = $listFiles;
        $data['detail'] = $detail;
        $data['folder'] = $folder;
        return view('content_learning_file',$data);
    }
}
