<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    //
    protected $primaryKey = "chapter_id";

    public function video(){
        return $this->hasMany('App\Video','chapter_id');
    }


}
