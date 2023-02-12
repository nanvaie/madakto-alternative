<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workspace_user extends Model
{
    use HasFactory;
    protected $fillable = [

        'user_id',
        'workspace_id',
        'owner',

    ];
    protected $table = 'work_spaces_users';
}
