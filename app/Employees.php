<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employees extends Model
{
    public $table = "employees";
    protected $primaryKey = "emp_no";
    protected $fillable = ['emp_no','birth_date','first_name','last_name','gender', 'hire_date'];

    public $timestamps = false;
}
