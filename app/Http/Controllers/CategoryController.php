<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Category;
use App\User;
use App\Helpers\Token;

class CategoryController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $token_header = $request->header('Authorization');
        $token = new Token();
        $data = $token->decode($token_header);
        $user = User::where('email',$data->email)->first();

        $category = Category::where('name', $request->name)->first();

        if($category == null){
            $newCategory = new Category();
            $newCategory->create($request, $user);
    
            return response()->json([
                "Token válido" => "Categoría creada"
            ],200);
        }else{
            return response()->json([
                "Token no válido" => "Categoría no creada"
            ],401);
        }   
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $token_header = $request->header('Authorization');
        $token = new Token();
        $data = $token->decode($token_header);
        $user = User::where('email',$data->email)->first();

        $categories = Category::all();
        return response()->json([
            "categorias" => $user->categories
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
