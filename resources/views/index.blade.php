@extends('layouts.app')

@section('content')

    <div class="span9">
        <div class="content">
            <div class="btn-controls">
                <div class="btn-box-row row-fluid">
                    <a href="#" class="btn-box big span4"><i class=" icon-random"></i><b>
                            {{ $departments->count('dept_no') }}
                        </b>
                        <p class="text-muted">
                            Departments</p>
                    </a><a href="#" class="btn-box big span4"><i class="icon-user"></i><b>{{$employees->count('emp_no')}}</b>
                        <p class="text-muted"></p></b>
                        <p class="text-muted">
                            Employees</p>
                    </a><a href="#" class="btn-box big span4"><i class="icon-money"></i><b>{{$avr_salary = DB::table('salaries')->groupBy('emp_no')->avg('salary')}} KZT</b>
                        <p class="text-muted"></p></b>
                        <p class="text-muted">
                            Average salary</p>
                    </a>
                </div>

                <div class="btn-box-row row-fluid">

                    <a href="#" class="btn-box big span4"><canvas id="chart1" width="400" height="380"></canvas></a>
                    <a href="#" class="btn-box big span4"><canvas id="chart3" height="550" width="600"></canvas></a>
                    <a href="#" class="btn-box big span4"><canvas id="chart2" height="550" width="600"></canvas></a>
                </div>

            </div>


            <!--/.module-->
            <div class="module hide">
                <div class="module-head">
                    <h3>
                        Adjust Budget Range</h3>
                </div>
                <div class="module-body">
                    <div class="form-inline clearfix">
                        <a href="#" class="btn pull-right">Update</a>
                        <label for="amount">
                            Price range:</label>
                        &nbsp;
                        <input type="text" id="amount" class="input-" />
                    </div>
                    <hr />
                    <div class="slider-range">
                    </div>
                </div>
            </div>
            <div class="module">
                <div class="module-head">
                    <h3>
                        DataTables</h3>
                </div>
                <div class="module-body table">
                    <table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped	 display"
                           width="100%">
                        <thead>
                        <tr>
                            <th>
                                Last name
                            </th>
                            <th>
                                First name
                            </th>
                            <th>
                                Departments
                            </th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($employees as $e)
                        <tr class="odd gradeX">
                            <td>
                                {{$e -> last_name}}
                            </td>
                            <td>
                                {{$e -> first_name}}
                            </td>
                            <td>
                                {{$e -> dept_name}}
                            </td>

                        </tr>
                        @endforeach

                    </table>
                </div>
            </div>
            <!--/.module-->


        </div>
        <!--/.content-->
    </div>
    <!--/.span9-->

@endsection

<script src="/final/scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
<script src="/final/scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
<script src="/final/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="/final/scripts/flot/jquery.flot.js" type="text/javascript"></script>
<script src="/final/scripts/flot/jquery.flot.resize.js" type="text/javascript"></script>
<script src="/final/scripts/datatables/jquery.dataTables.js" type="text/javascript"></script>
<script src="/final/scripts/common.js" type="text/javascript"></script>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.3/js/bootstrap-select.min.js" charset="utf-8"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.js" charset="utf-8"></script>

<script>
    var url = "{{url('index/chart1')}}";
    var Departments = new Array();
    var Numbers = new Array();
    var Employees = new Array();
    var color = new Array();
    $(document).ready(function(){
        $.get(url, function(response){
            response.forEach(function(data){
                Departments.push(data.dept_name);
                Numbers.push(data.numbers);
                Employees.push(data.user_count);
                color.push('rgba('
                    + Math.round(Math.random() *255) + ','
                    + Math.round(Math.random() *255) + ','
                    + Math.round(Math.random() *255) + ','
                    + '0.7'
                    + ')');
        });


            var ctx = document.getElementById("chart1").getContext('2d');
            var Chart1 = new Chart(ctx, {
                type: 'horizontalBar',
                data: {
                    labels:Departments,
                    datasets: [{
                        label: 'Employees\' number for each Department',
                        data: Employees,
                        backgroundColor: color,
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero:true
                            }
                        }]
                    }
                }
            });
        });
    });

    var url2 = "{{url('index/chart2')}}";
    var Salaries = new Array();
    $(document).ready(function(){
        $.get(url2, function(response2){
            response2.forEach(function(data2){
                Salaries.push(data2.salary);
        });


            var ctx2 = document.getElementById("chart2").getContext('2d');
            var Chart2 = new Chart(ctx2, {
                type: 'bar',
                data: {
                    labels:Departments,
                    datasets: [{
                        label: 'Average salaries',
                        data: Salaries,
                        backgroundColor: color,
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero:true
                            }
                        }]
                    }
                }
            });
        });
    });

    var url3 = "{{url('index/male')}}";
    var Males = new Array();
    var url4 = "{{url('index/female')}}";
    var Females = new Array();
    $(document).ready(function(){
        $.get(url3, function(response3){
            response3.forEach(function(data3){
                Males.push(data3.employees);
            });


            var ctx3 = document.getElementById("chart3").getContext('2d');
            var Chart3 = new Chart(ctx3, {
                type: 'line',
                data: {
                    labels:Departments,
                    datasets: [{
                        label: 'Number of males and females',
                        data: Males,
                        backgroundColor: color,
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero:true
                            }
                        }]
                    }
                }
            });
        });

        $.get(url4, function(response4){
            response4.forEach(function(data4){
                Females.push(data4.employees);

            });


            var ctx4 = document.getElementById("chart3").getContext('2d');
            var Chart4 = new Chart(ctx4, {
                type: 'line',
                data: {
                    labels:Departments,
                    datasets: [{
                        label: 'Number of males and females',
                        data: Females,
                        backgroundColor: color,
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero:true
                            }
                        }]
                    }
                }
            });
        });
    });

</script>
