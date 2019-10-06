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
        'title', 'url', 'description','score','flag','category_name','category_id'    //可控写入
    ];

    /*protected $hidden = [
        'updated_at','created_at','flag'
    ];*/

    protected $attributes = [
        'url' => null,
    ];

    protected $casts = [
        //'email_verified_at' => 'datetime',
        'score' => 'integer',
    ];



}
