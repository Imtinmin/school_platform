<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bulletin;

class BulletinController extends Controller
{
    //
    private $bulletin;

    public function __construct(Bulletin $bulletin)
    {
        $this->bulletin = $bulletin;
    }

    public function add(Request $request){

    }

    public function del(Request $request){

    }

    public function list(Request $request){

    }

    public function edit(Request $request){

    }

}
