<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * @property string user_id
 * @property string shift_id
 * @property string department_id
 * @property string enter_time
 * @property string max_enter_time
 * @property string exit_time
 * @property string owner
 */
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

    public function department(){
        return $this->belongsTo(Department::class);
    }



}
