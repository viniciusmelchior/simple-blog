<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){
        $title = 'Index';
        return view('pages.index',['title' => $title]);
    }

    public function about(){
        $title = 'about';
        return view('pages.about', compact('title'));
    }

    public function services(){
        $data = array(
            'title' => 'Services',
            'services' => ['php', 'javascript', 'react','node js']
        );
        return view('pages.services')->with($data);
    }
}
