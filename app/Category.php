<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $table = 'categories';

    protected $primaryKey = 'category_id';
    /*public function __construct()
    {

    }*/

    protected $fillable = [
        'category_name',   //可控写入
    ];


}
