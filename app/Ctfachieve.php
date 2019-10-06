<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ctfachieve extends Model
{
    //
    /*
     * +---------------+---------+-----+---------------------+
        | ctfachieve_id | user_id | qid | AchieveTime         |
        +---------------+---------+-----+---------------------+
        |             1 |       2 |   1 | 2019-09-30 11:04:19 |
        +---------------+---------+-----+---------------------+
     *
     *
     */
    public $timestamps = false;

    protected $primaryKey = "ctfachieve_id";

    protected $table = "ctfachieve";

    public function users()
    {
        return $this->belongsTo('App\User','user_id','user_id');
    }



}
