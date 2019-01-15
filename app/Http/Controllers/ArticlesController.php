<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Exception\HttpException;


use App\Article;
use App\Category;
use Session;
use Image;
use App\Tag;
use App\Mail\sendContactForm;


class ArticlesController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::orderBy('name', 'ASC')->pluck('name', 'id');
        $tags = Tag::all();

       return view('manage.articles.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        $this->validate(request(), [
            'title'         => 'required|unique:articles|max:255',
            'category_id'   => 'required|numeric',
            'publish'       => 'required|numeric',
            'content'       => 'required',
        ]);

        $newArticle = new Article;

        $newArticle->title = $request->title;
        $newArticle->slug = str_slug($request->title);
        $newArticle->category_id = $request->category_id;
        $newArticle->author = $request->author;
        $newArticle->publish = $request->publish;
        $newArticle->content = $request->content;

        //Chek if there is a image and if there is ...
        if($request->hasFile('coverImage'))
        {
            $coverImage = $request->file('coverImage');
            $renameImage = time().'.'.$coverImage->getClientOriginalExtension();

            $location = public_path('images/'. $renameImage);

            Image::make($coverImage)->resize(180, 130)->save($location);

            $newArticle->cover_picture = $renameImage;
        }

        $newArticle->save();

        $newArticle->tags()->sync($request->tags, false);
 
       return redirect('/dashboard')->with('status', 'The article was successfully save into database, please check if is publish.');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($category, $slug)
    {   

        $articles = Article::whereNotIn('publish', [0])
            ->where('slug', $slug)->firstOrFail();

        $categories = Category::where('name', $category)->firstOrFail();
       
        return view('pages.article', compact('articles', 'categories'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleteRecordByTrash = Article::find($id);
        $deleteRecordByTrash->tags()->detach();
        //delete the cover picture from the images storage
        $pictureDeleteFromStorage = $deleteRecordByTrash->cover_picture;
        Storage::delete($pictureDeleteFromStorage);

        //and update database with NULL because the article is still there (soft delete)
        $deleteRecordByTrash->cover_picture = null;
        $deleteRecordByTrash->save();
        
        $deleteRecordByTrash->delete();

        return redirect('/dashboard')->with('status', 'The article was successfully deleted!');
    }
}