<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bulletin extends Model
{
    //
    protected $primaryKey = 'bulletin_id';

    protected $table = "bulletin";
    /*protected $fillable = [
        'bulletin_content',   //可控写入
    ];*/
    const UPDATED_AT = 'updated_at';

}
