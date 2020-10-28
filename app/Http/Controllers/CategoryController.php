<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest ;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $cat = Category::all();
        return $cat;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        try{

            $us = $request->all();
            $category = new Category;

            $category->name = $us['name'];



            $category->save();
            return response('Categoria cadastrada com sucesso', 201);

        }catch(\Exception $erro) {

            return $erro->getMessage();;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(int $list_id)
    {
        //
        $category = Category::where('list_id',$list_id)->get();
        return $category; 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        //
        try{

            $category = Category::find($id);

            $category->name = $request->name;
            
            $category->save();

            //return $category;
            return response('Categoria atualizada com sucesso', 200);

        }
        catch(\Exception $erro) {
            return $erro->getMessage();       
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $category = Category::find($id);
        $category->delete();
    }
}
