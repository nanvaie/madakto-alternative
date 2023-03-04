<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property string user_id
 * @property string shift_id
 * @property string department_id
 * @property string date
 */
class TimeSheet extends Model
{
    use HasFactory;
    use SoftDeletes;

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
