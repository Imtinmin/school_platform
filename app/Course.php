<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    //
    /*  course_id course_name
     *
     *
     */
    protected $fillable = [
        "course_name" , "image_url","course_category_id"
    ];

    protected $primaryKey = "course_id";

    public function category(){
        return $this->hasMany('App\Coursecategory', 'course_category_id');
    }
}
