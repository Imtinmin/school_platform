<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Challenge extends Model
{
    //
    protected $primaryKey = 'qid';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'url', 'description','score'    //可控写入
    ];

    protected $hidden = [

    ];

    protected $attributes = [
        'url' => null,
    ];


}
