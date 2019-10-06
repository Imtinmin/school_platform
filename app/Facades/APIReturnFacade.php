<?php
/**
 * Created by phpstorm
 * User: tinmin
 * Date: 2019/9/20
 * Time: 9:31am
 */

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class APIReturnFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return "APIReturnService";
    }
}
