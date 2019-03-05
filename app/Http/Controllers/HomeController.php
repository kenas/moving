<?php

namespace App\Http\Controllers;

use App\Article;
use App\Category;
use Session;
use Image;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }



    public function search(Request $request)
    {
        $search = $request->get('q');
        $result = Article::where('title', 'LIKE', "%$search%")->get();

        return $result;
        //return view('dashboard', compact('search','result'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::orderBy('created_at', 'DESC')->paginate(5);
        
        return view('dashboard', compact('articles'));
        //return $articles;
    }

   /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   

        $edit = Article::findOrFail($id);
        $categories = Category::pluck('name', 'id');
        $selected = $edit->category_id;
        $publish = $edit->publish;

        $tags = Tag::all();
        $tagsInArray = array();
        foreach ($tags as $tag) {
            $tagsInArray[$tag->id] = $tag->name;
        }

        //return dd($edit);//$json_encode($tagsInArray));
        return view('manage.articles.edit', compact('edit', 'categories', 'selected', 'publish', 'tagsInArray'));
    }

    public function updatePublish(Request $request, $id) {

        $this->validate(request(), [
            'publish' => 'required|numeric',
        ]);

        $changeStatus = Article::findOrFail($id);
        
        $changeStatus->publish = $request->publish;
        $changeStatus->save();

        //return redirect('/dashboard');

    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateArticle(Request $request, $id)
    {
    
        $this->validate(request(), [
            'title'         => 'required|max:255',
            'category_id'   => 'required|numeric',
            'publish'       => 'required|numeric',
            'content'       => 'required',
        ]);

        $update = Article::findOrFail($id);

        if($request->hasFile('coverImage')) {

            $coverImage = $request->file('coverImage');
            $renameImage = time().'.'.$coverImage->getClientOriginalExtension();

            $location = public_path('images/'. $renameImage);

            Image::make($coverImage)->resize(180, 130)->save($location);

            //delete the old cover picture from the images storage
            $oldImage = $update->cover_picture;
            Storage::delete($oldImage);

            $update->cover_picture = $renameImage;
        }

        $update->title          = $request->title;
        $update->category_id    = $request->category_id;
        $update->publish        = $request->publish;
        $update->content        = $request->content;

        $update->save();
        $update->tags()->sync($request->tags);

        //return $update;
        return redirect('/dashboard');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
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

        return ['message' => 'Clank byl odstranen z dashboardu a webu, nikoliv vsak z databaze.'];
    }

}