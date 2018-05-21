<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Employees;
use App\Departments;


class IndexController extends Controller
    {
        public function index() {

            $employees = Employees::all();
            $departments = Departments::all();

            return view('index', compact ('employees', 'departments'));
        }



    public function chart1()
    {
        $result = \DB::table('dept_emp' )
            ->join('departments', 'dept_emp.dept_no', '=', 'departments.dept_no')
            ->select('departments.dept_no as numbers', 'departments.dept_name', \DB::raw('count(dept_emp.emp_no) as user_count'))
            ->groupBy('departments.dept_no')
            ->get();
        return response()->json($result);
    }

    public function chart2()
    {
        $result = \DB::table('salaries' )
            ->join('dept_emp', 'salaries.emp_no', '=', 'dept_emp.emp_no')
            ->select('dept_emp.dept_no as department', \DB::raw('avg(salaries.salary) as salary'))
            ->groupBy('dept_emp.dept_no')
            ->get();
        return response()->json($result);
    }

    public function male()
    {
        $result = \DB::table('dept_emp' )
            ->join('employees', 'employees.emp_no', '=', 'dept_emp.emp_no')
            ->select('dept_emp.dept_no', 'employees.gender', \DB::raw('count(dept_emp.emp_no) as employees'))
            ->where('employees.gender', '=', 'M')
            ->groupBy('dept_emp.dept_no', 'employees.gender')
            ->get();
        return response()->json($result);
    }

    public function female()
    {
        $result = \DB::table('dept_emp' )
            ->join('employees', 'employees.emp_no', '=', 'dept_emp.emp_no')
            ->select('dept_emp.dept_no', 'employees.gender', \DB::raw('count(dept_emp.emp_no) as employees'))
            ->where('employees.gender', '=', 'F')
            ->groupBy('dept_emp.dept_no', 'employees.gender')
            ->get();
        return response()->json($result);
    }

    public static function table() {
                $result = \DB::table('employees')
                ->join('dept_emp', 'employees.emp_no', '=', 'dept_emp.emp_no')
                ->join('departments', 'departments.dept_no', '=', 'dept_emp.dept_no')
                    ->select('employees.last_name', 'employees.first_name', 'departments.dept_name')
                ->get();
            return view('index')->with('employees', $result)->with('departments', $result)->with('dept_emp', $result);
        }









}

