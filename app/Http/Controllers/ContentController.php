<?php

namespace App\Http\Controllers;

use DB;
use App\Notes;
use App\Quran;
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
        $dataHTML['modal_title'] = 'QuranMemo Community';
        $dataHTML['modal_body'] = view('content_donasi')->render();
        $dataHTML['modal_footer'] = '<button class="btn btn-green-small" data-dismiss="modal">Tutup</button>';

        return response()->json($dataHTML);
    }

     public function store()
    {
        $dataHTML['modal_class'] = '';
        $dataHTML['modal_title'] = 'QuranMemo Store';
        $dataHTML['modal_body'] = view('content_store')->render();
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

    public function info()
    {
        $dataHTML['modal_class'] = '';
        $dataHTML['modal_title'] = 'Info';
        $dataHTML['modal_body'] = view('content_info')->render();
        $dataHTML['modal_footer'] = '<button class="btn btn-green-small" data-dismiss="modal">Tutup</button>';

        return response()->json($dataHTML);
    }

    public function tshirt()
    {
        $dataHTML['modal_class'] = '';
        $dataHTML['modal_title'] = 'T-Shirt QuranMemo';
        $dataHTML['modal_body'] = view('content_tshirt')->render();
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

    public function muratal(Request $request)
    {   
        $dataHTML['modal_class'] = '';
        $dataHTML['modal_title'] = 'Fitur Mushaf Madinah Utsmani';
        $dataHTML['modal_body'] = view('content_muratal')->render();
        $dataHTML['modal_footer'] = '<button class="btn btn-green-small" data-dismiss="modal">Tutup</button>';

        return response()->json($dataHTML);
    }

    public function alkahfi(){
        $dataHTML['modal_class'] = '';
        $dataHTML['modal_title'] = 'Baca Surah Al-Kahfi';
        $dataHTML['modal_body'] = view('content_alkahfi')->render();
        $dataHTML['modal_footer'] = '<button class="btn btn-green-small" data-dismiss="modal">Tutup</button>';

        return response()->json($dataHTML);
    }
}
