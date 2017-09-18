<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = ['pid', 'name', 'display_name', 'description', 'is_menu', 'sort'];
}
