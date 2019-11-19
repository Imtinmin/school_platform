<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coursecategory extends Model
{
    //
    protected $table = "course_category";

    public function course(){
        return $this->hasMany('App\Course','course_category_id');
    }

    protected $primaryKey = "course_category_id";

    public function test(){
        return $this->hasManyThrough('App\Chapter','App\Course','course_id','course_id');
    }

}
