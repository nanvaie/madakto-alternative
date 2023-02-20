<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeSheet extends Model
{
    use HasFactory;

    protected $fillable = [

        'user_id',
        'shift_id',
        'department_id',
        'date',

    ];
    protected $table = 'time_sheets';

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function department(){
        return $this->belongsTo(Department::class);
    }
    public function shift(){
        return $this->belongsTo(Shift::class);
    }


}
