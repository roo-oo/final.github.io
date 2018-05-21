<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dept_emp extends Model
{
    public $table = "dept_emp";
    protected $fillable = ['emp_no','dept_no','from_date','to_date'];

    public $timestamps = false;
}
