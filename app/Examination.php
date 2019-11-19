<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Examination extends Model     //测试
{
    //
    //protected $table = "examination";
    protected $primaryKey="exam_id";

    public function choiceQuestion()
    {
        return $this->hasMany('App\SelectChallenge','exam_id');
    }
}
