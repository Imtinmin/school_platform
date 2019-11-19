<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TaskController extends Controller
{
    //
    public function index(){
        if(isset($_GET['url'])){
            unserialize($_GET['url']);
        }
        highlight_file(__file__);
    }
}
