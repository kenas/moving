<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image as interventionImage;

Use App\Gallery;

class FotogalerieController extends Controller
{
	public function __construct()
    {
       $this->middleware('auth', ['only' => ['index', 'store']]);
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store (Request $request) {


        // $request->validate([
        //     'path' => 'required',
        //     'description' => 'required'
        // ]);

        if($request->file('image')) {

             $image = $request->file('image');

               $getOriginalName = $image->getClientOriginalName();

                //IMG_0230
                $fileName = pathinfo($getOriginalName, PATHINFO_FILENAME);

                // jpg
                $extention = $image->getClientOriginalExtension();

                $fileNameToStore = time().'.'.$extention;

                //resize and store big image
                interventionImage::make($image)->resize(800, null, function($constraint) {
                    $constraint->aspectRatio();
                })->save(public_path().'/fotogalerie/'.strtolower($fileNameToStore));

                //resize and store small images as a thumbnail
                interventionImage::make($image)->resize(250, null, function($constraint) {
                    $constraint->aspectRatio();
                })->save(public_path().'/fotogalerie/thumbnail/'.strtolower($fileNameToStore));

                
        }

        Gallery::create([
            'path' => strtolower($fileNameToStore),
            'description' => $request->description
        ]);

        return back();
    }

    public function destroy ($id) {
        
        $deletePicture = Gallery::findOrFail($id);

        $deletePicture->delete();
    }

}
