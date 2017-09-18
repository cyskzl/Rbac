<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminUserRole extends Model
{
    protected $table = 'admin_user_role';
    protected $fillable = ['admin_user_id', 'role_id'];
}
