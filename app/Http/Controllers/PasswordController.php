<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PasswordController extends Controller
{
    public function store(Request $request)
    {
        $token_header = $request->header('Authorization');
        $token = new Token();
        $data = $token->decode($token_header);
        $user = User::where('email',$data->email)->first();

        $password = new Password;
        $password->create($request, $user);
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
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $token_header = $request->header('Authorization');
        $token = new Token();
        $data = $token->decode($token_header);
        $user = User::where('email',$data->email)->first();

        $passwords = Password::all();
        foreach ($passwords as $key => $password){
            print($password);
        }
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
    public function destroy($id)
    {
        $token_header = $request->header('Authorization');
        $token = new Token();
        $data = $token->decode($token_header);
        $user = User::where('email',$data->email)->first();
        
        $password = Password::find($id);
        $password -> destroy();
    }
}
