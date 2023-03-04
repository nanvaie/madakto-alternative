<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * @property string user_id
 * @property string name
 */
class Department extends Model
{
    use HasFactory;
    protected $fillable = [

        'user_id',
        'name',
    ];
    protected $table = 'departments';

    public function  timeSheets(){
        return $this->hasMany(TimeSheet::class);
    }
    public function departmentUser(){
        return $this->hasOne(DepartmentUser::class);
    }
}
