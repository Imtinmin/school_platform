<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SelectChallenge extends Model
{
    //
    protected $table = "choice_question";

    protected $fillable = [
        "title","option1","option2","option3","option4","answer","exam_id"
    ];
}
