<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Experience;

class ExperiencesController extends Controller
{

    public function __construct() {

        $this->middleware('auth', ['only' => ['index', 'create', 'edit', 'update', 'store', 'destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $experiences = Experience::orderBy('year', 'DESC')->paginate(5);
        // $experiences = Experience::selectRaw('count(*) AS cnt, year')->groupBy('year')->orderBy('year', 'DESC')->get(['year', 'description']);

        // $experiences = \DB::table('experiences')->select('year', \DB::raw('count(*) as total'))
        //     ->groupBy('year')
        //     ->orderBy('year', 'DESC')
        //     ->get();

        return view('manage.experiences.index', compact('experiences'));
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
        $experience = $request->validate([

            'year' => 'required',
            'description' => 'required'
        ]);

        Experience::create($request->all());


        return ['message' => 'Nová Zkušenost byla úspěšně uložena.'];

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $delete = Experience::findOrFail($id);

        $delete->delete();

        return ['message' => 'Zkušenost byla úspěšně vymazána.'];
    }
}
