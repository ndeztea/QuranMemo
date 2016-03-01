<?php

namespace App\Http\Controllers;

use DB;
use App\Notes;
use App\Quran;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use File;

class BookmarksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $url = $request->input('url');
        $data['url'] = $url;

        $dataHTML['modal_class'] = 'share-mode';
        $dataHTML['modal_title'] = 'Mari berbagi';
        $dataHTML['modal_body'] = view('bookmarks',$data)->render();
        $dataHTML['modal_footer'] = '';

        return response()->json($dataHTML);
    }
}
