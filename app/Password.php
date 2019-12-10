<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Password extends Model
{
    protected $table = 'passwords';
    protected $fillable = ['title', 'password'];

    public function categories(){
        return $this->hasTo('App\Categories');
    }

    public function create($request){
        $password = new Password();
        $password->title = $request->title;
        $password->password = $request->password;
        $password->id_category = $category->id;
        $password->save();
    }
}
