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
        $dataHTML['modal_title'] = 'Donasi, Infaq dan Sedekah';
        $dataHTML['modal_body'] = view('content_donasi')->render();
        $dataHTML['modal_footer'] = '<button class="btn btn-green-small" data-dismiss="modal">Tutup</button>';

        return response()->json($dataHTML);
    }
}
