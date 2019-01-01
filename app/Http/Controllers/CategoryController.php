<?php

namespace App\Http\Controllers;

use App\Article;
use App\Category;

use Illuminate\Http\Request;
//use Symfony\Component\HttpFoundation\Exception\HttpException;

class CategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['only' => 'allCategoryForDashboard']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($slug)
    {

        $category = Category::where('name', $slug)->firstOrFail();

        //dd($category->name);
        $categories = Category::orderBy('name', 'ASC')->get();

        $articles = Article::where('category_id',  '=', $category->id)
            ->where('publish', 1)
            ->orderBy('created_at', 'DESC')
            ->simplePaginate(3);
            
        $title = $category->name;

        
        return view('pages.category', compact('articles', 'categories', 'title'));
  
    }

    public function getAllCategories () {

        $getAllCategories = Category::all();

        //dd($getAllCategories);
        return view('navbar.navbar', compact('getAllCategories'));
    }


    public function allCategoryForDashboard() {

        $categories = Category::all();

        //return response()->json($categories);
        return view('manage.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
