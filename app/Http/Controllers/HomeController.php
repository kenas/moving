<?php

namespace App\Http\Controllers;

use App\Article;
use App\Category;
use Session;
use Image;
use App\Tag;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       $this->middleware('auth', ['only' => ['search', 'destroy']]);
    }



    public function search(Request $request)
    {
        $search = $request->get('q');
        $result = Article::where('title', 'LIKE', "%$search%")->get();

        return $result;
        //return view('dashboard', compact('search','result'));
    }


    public function updatePublish(Request $request, $id) {
        //dd($request->publish);
        $this->validate(request(), [
            'publish' => 'required|numeric',
        ]);

        $changeStatus = Article::findOrFail($id);
        
        $changeStatus->publish = $request->publish;
        $changeStatus->save();

        //return redirect('/dashboard');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   //dd($id)
        $deleteRecordByTrash = Article::findOrFail($id);
        //remove all tags relate to the article
        //$deleteRecordByTrash->tags()->detach();

        //delete the cover picture from the images storage
        $pictureDeleteFromStorage = $deleteRecordByTrash->cover_picture;
        Storage::delete($pictureDeleteFromStorage);

        //and update database with NULL because the article is still there (soft delete)
        $deleteRecordByTrash->cover_picture = null;
        $deleteRecordByTrash->save();
        
        $deleteRecordByTrash->delete();

        return ['message' => 'Článk byl odstraněn webu, nikoliv však z databáze.'];
    }

}