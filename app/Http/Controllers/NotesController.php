<?php

namespace App\Http\Controllers;

use DB;
use App\Notes;
use App\Quran;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use File;

class NotesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        die('asd');

        $data['body_class'] = 'body-note';

        $data[] = '';
        return view('notes',$data);
    }

    public function create(){
        // get surah
        $QuranModel = new Quran;
        $surahs = $QuranModel->getSurah();

        $NotesModel = new Notes;


        // send to view 
        $data['surahs'] = $surahs;
        $data['notesDetail'] = $NotesModel->get();

        return view('notes_form',$data);
    }


    
}
