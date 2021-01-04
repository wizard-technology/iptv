<?php

namespace App\Http\Controllers;

use App\Categore;
use Illuminate\Http\Request;
use App\Http\Resources\CategoryResource;

class CategoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Categore::orderBy('created_at', 'DESC')->get();
        return view('setting.pages.category.index')->with(['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('setting.pages.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'state' => 'required|boolean',
        ]);
        $app = new Categore();
        $app->ct_name = $request->name;
        $app->ct_state = $request->state;
        $app->ct_admin = $request->user()->id;
        if ($app->save()) {
            return new CategoryResource($app);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Categore  $categore
     * @return \Illuminate\Http\Response
     */
    public function show(Categore $categore)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Categore  $categore
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Categore::findOrfail($id);
        $category->ct_state = !$category->ct_state;
        if ($category->save()) {
            return new CategoryResource($category);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Categore  $categore
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'state' => 'required|boolean',
        ]);
        $categore = Categore::findOrFail($id);
        $categore->ct_name = $request->name;
        $categore->ct_state = $request->state;
        $categore->ct_admin = $request->user()->id;
        if ($categore->save()) {
            return new CategoryResource($categore);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Categore  $categore
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $categore = Categore::findOrfail($id);
        if ($categore->delete()) {
            return new CategoryResource($categore);
        }
    }
}
