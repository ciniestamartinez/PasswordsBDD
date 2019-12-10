<?php

namespace App\Http\Controllers;
use App\Helpers\Token;
use App\Password;
use App\User;
use App\Category;

use Illuminate\Http\Request;

class PasswordController extends Controller
{
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
        $token_header = $request->header('Authorization');
        $token = new Token();
        $data = $token->decode($token_header);
        $user = User::where('email',$data->email)->first();

        $category = Category::where('name', $request->name)->where('id_user', $user->id)->first();
        
        if(isset($category)){
            $newPassword = new Password();
            $newPassword->create($request, $category);
            return response()->json([
                "Token válido" => "Contraseña creada"
            ],200);
        }else{
            return response()->json([
                "Token no válido" => "Contraseña no creada"
            ],401);
        }
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

        $passwords = Password::all();
        return response()->json([
            "contraseñas" => $passwords
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
        $token_header = $request->header('Authorization');
        $token = new Token();
        $data = $token->decode($token_header);
        $user = User::where('email',$data->email)->first();

        $password = Password::find($id);
        $password->title = $request->title;
        $password->password = $request->password;
        $user->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $token_header = $request->header('Authorization');
        $token = new Token();
        $data = $token->decode($token_header);
        $user = User::where('email',$data->email)->first();
        
        $password = Password::find($id);
        $password -> destroy();
    }
}
