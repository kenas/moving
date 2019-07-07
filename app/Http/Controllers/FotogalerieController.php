<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

Use App\Gallery;

class FotogalerieController extends Controller
{
	public function __construct()
    {
       $this->middleware('auth', ['only' => ['index']]);
    }

    //this method is for dashboard
    public function index () {

    	$all = Gallery::all();

    	return view('manage.fotogalerie.index', compact('all'));
    }

    //this method is for public page
    public function show () {

    	$all = Gallery::all();

    	return view('pages.fotogalerie', compact('all'));
    }

    public function destroy ($id) {
        
        $deletePicture = Gallery::findOrFail($id);

        $deletePicture->delete();
    }

}
