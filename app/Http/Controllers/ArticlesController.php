<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Exception\HttpException;
use Illuminate\Support\Facades\DB;


use App\Article;
use App\Category;
use Session;
use Image;
use App\Tag;
use App\Mail\sendContactForm;
use Illuminate\Support\Facades\Storage;


class ArticlesController extends Controller
{
    public function __construct() {

        $this->middleware('auth', ['only' => ['index', 'create', 'edit', 'update', 'store', 'delete']]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::orderBy('created_at', 'DESC')->paginate(5);
        
        $activeInactive = Article::pluck('publish', 'id');
        return view('dashboard', compact('articles', 'activeInactive'));
        //return $activeInactive;
    }

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

        /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
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
    // public function destroy($id)
    // {
    //     $deleteRecordByTrash = Article::find($id);
    //     $deleteRecordByTrash->tags()->detach();
    //     //delete the cover picture from the images storage
    //     $pictureDeleteFromStorage = $deleteRecordByTrash->cover_picture;
    //     Storage::delete($pictureDeleteFromStorage);

    //     //and update database with NULL because the article is still there (soft delete)
    //     $deleteRecordByTrash->cover_picture = null;
    //     $deleteRecordByTrash->save();
        
    //     $deleteRecordByTrash->delete();

    //     return redirect('/dashboard')->with('status', 'The article was successfully deleted!');
    // }
}