<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Application_Remark extends Model
{
    protected $fillable = ['inward_id', 'user_id', 'action', 'department', 'remark', 'role'];
}
