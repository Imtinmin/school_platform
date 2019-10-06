<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $table = 'categories';

    protected $primaryKey = 'category_id';


    public function challenges()
    {
        return $this->hasMany('App\Challenge', 'category_id');
    }

}

