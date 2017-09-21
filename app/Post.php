<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    //
//    use SoftDeletes;
//    protected $dates = ['deleted_at'];
//    protected $table = "posts";
//    protected $primaryKey = "id";

protected $fillable = [
    'name',
    'title',
    'description',
    'path'

];

public function user(){
    return $this->belongsTo('App\User')->withDefault([
        'name' => 'Guest Author',
    ]);
}

    public function photos(){
        return $this->morphMany('App\Photo', 'imageable');
    }

    public function getNameAttribute($value){
        return strtolower($value);
    }

    public function setNameAttribute($value){
        $this->attributes['name'] = strtolower($value);
    }




}
