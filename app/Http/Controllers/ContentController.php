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
        $dataHTML['modal_class'] = 'content-mode';
        $dataHTML['modal_title'] = 'Hubungi Kami';
        $dataHTML['modal_body'] = view('content_contact')->render();
        $dataHTML['modal_footer'] = '';

        return response()->json($dataHTML);
    }

    public function about()
    {
        $dataHTML['modal_class'] = 'content-mode';
        $dataHTML['modal_title'] = 'Tentang QuranMemo';
        $dataHTML['modal_body'] = view('content_about')->render();
        $dataHTML['modal_footer'] = '';

        return response()->json($dataHTML);
    }
}
