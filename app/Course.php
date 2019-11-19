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
        "course_name" , "image_url","course_category_id","Introduction"
    ];

    protected $primaryKey = "course_id";

    public function category(){
        return $this->hasMany('App\Coursecategory', 'course_category_id');
    }

    public function chapter(){
        return $this->hasMany('App\Chapter', 'course_id','course_id');
    }

    /*public function catalogue(){
        return $this->hasManyThrough(
            'App\Video',    //target table
            'App\Chapter',   //through table
            'course_id',
            'chapter_id',
            'course_id',
            'chapter_id');
    }*/





}
