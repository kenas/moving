<?php

namespace App\Http\Controllers;

use App\Article;
use App\Category;
use Session;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB; 
use Illuminate\Http\Request;
//use Symfony\Component\HttpFoundation\Exception\HttpException;

class CategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['only' => 'allCategoryForDashboard', 'store']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($slug)
    {
        //return $slug;
        $category = Category::where('slug', $slug)->firstOrFail();

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
           
         $getAllCategories = Category::with('articles')
            ->orderBy('created_at', 'DESC')
            ->get();

          // dd($getAllCategories);
       
        
        return view('pages.categories', compact('getAllCategories'));
    }


    public function allCategoryForDashboard() {

        //$categories = Category::all();
        $categories = Category::orderBy('created_at', 'DESC')->paginate(7);
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
       //return $request;
        $validateData = $request->validate([

            'category'  => 'required',
            'slug'      => 'required|unique:categories'
        ]);

        $newCategory = new Category;

        $newCategory->name = $request->category;
        $newCategory->slug = str_slug($request->slug);
        $newCategory->save();

        return back();
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
        $delete = Category::findOrFail($id);
        
        if($delete->articles()->count() > 0) {

           return ['message_error' => 'This category is linked to an article or more. Please remove the article or artiles then remove the category.'];
        } else {

            $delete->delete();
            return ['message_success' => 'The category was successfully delete.'];
        }
        
    }
}
