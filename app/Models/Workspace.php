<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workspace extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'user_id'

    ];
    protected $table = 'work_spaces';

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function Shifts(){
        return $this->hasMany(Shift::class);
    }
    public function departmentUser(){
        return $this->hasOne(DepartmentUser::class);
    }
}
