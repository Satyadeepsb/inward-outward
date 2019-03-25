<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $fillable = [
        'name', 'subject','inward_no', 'mobile','address','district','taluka','documents','status','date','user_id','reference_no'
    ];
}
