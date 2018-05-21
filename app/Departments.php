<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Departments extends Model
{
    public $table = "departments";
    protected $primaryKey = "dept_no";
    protected $fillable = ['dept_no', 'dept_name'];

    public $timestamps = false;
}
