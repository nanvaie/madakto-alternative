<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string title
 * @property string workspace_id
 * @property string enter_time
 * @property string max_enter_time
 * @property string exit_time
 */
class Shift extends Model
{
    use HasFactory;
    protected $fillable = [

        'workSpace_id',
        'title',
        'enter_time',
        'max_enter_time',
        'exit_time',

    ];
    protected $table = 'shifts';

    public function workspace(){
        return $this->belongsTo(Workspace::class);
    }
    public function departmentUser(){
        return $this->belongsTo(DepartmentUser::class);
    }
    public function  timeSheets(){
        return $this->hasMany(TimeSheet::class);
    }
}
