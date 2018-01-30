<?php

namespace App\Http\Controllers;

use App\RecipeDirection;
use App\RecipeIngredient;
use Illuminate\Http\Request;
use App\Recipe;
class RecipeController extends Controller
{



    /**
     * RecipeController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth:api')->except('index','show','edit');

    }

    public function index(){
        $recipe = Recipe::orderby('created_at','desc')->get(['name','image','id']);
        return response()->json([
            'recipes'=>$recipe
        ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $form = Recipe::form();

        return response()->json(['form'=>$form]);
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
        $this->validate($request,[
            'name'=>'required|max:255',
            'description'=>'required|max:3000',
            'image'=>'required|image',
            'ingredients'=>'required|array|min:1',
            'ingredients.*.name'=>'required|max:255',
            'ingredients.*.qty'=>'required|max:255',
            'directions'=>'required|array|min:1',
            'directions.*.description'=>'required|max:3000'
        ]);

        $ingredients = [];

        foreach ($request->ingredients as $item){
            $ingredients[] = new RecipeIngredient($item);
        }

        $directions = [];

        foreach ($request->directions as $item2){
            $directions[] = new RecipeDirection($item2);
        }

        if(!$request->hasFile('image') && $request->file('image')->isValid()){
            return abort(404,'Image not uploaded');
        }

        $filename  =$this->getFilename($request->image);
        $request->image->move(base_path('public/images'),$filename);

        $recipe = new Recipe($request->all());
        $recipe->image = $filename;
        $request->user()->recipes()->save($recipe);

        $recipe->directions()->saveMany($directions);

        $recipe->ingredients()->saveMany($ingredients);


        return response()->json([
            'saved'=>true,
            'id'=>$recipe->id,
            'message'=>'you have successfully created recipe ',

        ]);

    }

    protected function getFilename($file){

        return str_random(32).'-'.$file->extension();
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
        $recipe = Recipe::with(['user','ingredients','directions'])->findOrFail($id);
        return response()->json([
            'recipe'=>$recipe
        ]);
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
