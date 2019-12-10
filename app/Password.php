<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Password extends Model
{
    protected $table = 'passwords';
    protected $fillable = ['title', 'password', 'id_category'];

    public function categories(){
        return $this->belongsTo('App\Categories');
    }

    public function create(Request $request, $category){
        $password = new Password();
        $password->title = $request->title;
        $password->password = $request->password;
        $password->id_category = $category->id;
        $password->save();
    }
}
