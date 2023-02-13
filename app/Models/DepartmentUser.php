<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepartmentUser extends Model
{
    use HasFactory;

    protected $fillable = [

        'user_id',
        'shift_id',
        'department_id',
        'enter_time',
        'max_enter_time',
        'exit_time',
        'owner',

    ];
    protected $table = 'department_users';

    public function  users(){
        return $this->hasMany(User::class);
    }

    public function Shift(){
        return $this->hasOne(Shift::class);
    }

    public function workspace(){
        return $this->belongsTo(Workspace::class);
    }


}
