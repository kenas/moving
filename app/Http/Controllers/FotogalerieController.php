<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

Use App\Gallery;

class FotogalerieController extends Controller
{
    public function index () {

    	$all = Gallery::all();

    	return view('pages.fotogalerie', compact('all'));
    }

}
