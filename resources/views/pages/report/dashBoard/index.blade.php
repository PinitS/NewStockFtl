@extends('layouts.master')

@section('content')


    <div class="row">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header border-0 pb-0">
                    <h4 class="card-title">Timeline History</h4>
                </div>
                <div class="card-body">
                    <div id="DZ_W_TimeLine1" class="widget-timeline dz-scroll style-1" style="height:320px;">
                        <ul class="timeline text-card-timeline">
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-7">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">History Parts</h4>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <select class="form-control pnt-sel-filter-branch"></select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <select class="form-control pnt-sel-filter-parts"></select>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="card-body">
                    <div class="chartjs-size-monitor">
                        <div class="chartjs-size-monitor-expand">
                            <div class=""></div>
                        </div>
                        <div class="chartjs-size-monitor-shrink">
                            <div class=""></div>
                        </div>
                    </div>
                    <canvas id="myChart" width="414" height="207" class="chartjs-render-monitor"
                            style="display: block; width: 414px; height: 207px;"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Products Chart</h4>
                </div>
                <div class="card-body">
                    <div class="chartjs-size-monitor">
                        <div class="chartjs-size-monitor-expand">
                            <div class=""></div>
                        </div>
                        <div class="chartjs-size-monitor-shrink">
                            <div class=""></div>
                        </div>
                    </div>
                    <canvas id="myChart_doughnut" width="414" height="207" class="chartjs-render-monitor"
                            style="display: block; width: 414px; height: 207px;"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header border-0 pb-0">
                    <h4 class="card-title">All users</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="userData">
                            <thead>
                            <tr>
                                <th class="text-dark">#</th>
                                <th class="text-dark">Username</th>
                                <th class="text-dark">Status</th>
                            </tr>
                            </thead>
                            <tbody class="data-section-users">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header border-0 pb-0">
                    <h4 class="card-title">All Parts</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="partsData">
                            <thead>
                            <tr>
                                <th><strong>#</strong></th>
                                <th><strong>NAME</strong></th>
                                <th><strong>Category</strong></th>
                                <th><strong>Quantity</strong></th>
                                <th><strong>Branch</strong></th>
                                <th><strong>sku</strong></th>
                            </tr>
                            </thead>
                            <tbody class="data-section-parts">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection



@section('script')



    <script>

        var filter_dropdown_branch = $('.pnt-sel-filter-branch');
        var filter_dropdown_parts = $('.pnt-sel-filter-parts');
        var text_card_timeline = $('.text-card-timeline');
        var branch_id = 0;
        var parts_id = 0;
        var parts_name = '';
        var data_line_chart = [];

        var color_set = [];
        var product_name = [];
        var data_donut_chart = [];

        var tableUsers = $('#userData').DataTable({
            "pageLength": 5,
            "searching": false,
            "lengthChange": false
        });
        var tableParts = $('#partsData').DataTable();



        function getBranch() {
            $.ajax({
                type: "get",
                url: '{!! url('manage/branches/getBranches') !!}',

                success: function (data) {
                    console.log(data)
                    window.filter_dropdown_branch.empty();
                    if (data.status) {
                        var branch = "<option value=" + 0 + "> <strong>" + "All Branch" + "</strong></option>";
                        $.each(data.branch, function (index, value) {
                            branch += "<option value=" + value.id + "> <strong>" + value.name + "</strong></option>"
                        });
                        window.filter_dropdown_branch.append(branch);
                        window.filter_dropdown_branch.selectpicker('refresh');
                    }
                }
            });
        }

        function getDashBoard() {
            $.ajax({
                type: "get",
                url: '{!! url('report/dashBoard/getDashBoard') !!}',

                success: function (data) {
                    console.log(data)
                    var dataTimeline = '';
                    var cnt = 0;
                    var date ='';
                    const color = ["primary", "info", "danger", "success", "warning"];

                    //timeline
                    $.each(data.dataSet.dataTimeline, function (index, value) {
                        if (cnt > color.length - 1) {
                            cnt = 0;
                        }
                        date = moment(value.created_at).fromNow();
                        dataTimeline += "<li><div class='timeline-badge " + color[cnt] + "'></div><a class='timeline-panel text-muted'><span>" + date +"<strong>"+" By "+value.user.name+"</strong>"+ "</span><h6 class='mb-0'>" + value.detail + "</h6></a></li>"
                        cnt++;
                    });
                    window.text_card_timeline.append(dataTimeline);

                    //userDash
                    tableUsers.destroy();
                    $('.data-section-users').html(null);
                    $.each(data.dataSet.dataUsers, function (index, value) {
                        $('.data-section-users').append(
                                "<tr><td>" +
                                (index + 1) +
                                "</td><td>" +
                                value.name +
                                "</td><td>" +
                                (value.status > 0 ? "<span class='badge badge-pill badge-danger'>Admin</span>" : "<span class='badge badge-pill badge-primary'>Member</span>") +
                                "</td></tr>"
                            )
                    });
                    tableUsers = $('#userData').DataTable({
                        "pageLength": 5,
                        "searching": false,
                        "lengthChange": false
                    });



                    //userDash
                    tableParts.destroy();
                    $('.data-section-parts').html(null);
                    $.each(data.dataSet.dataParts, function (index, value) {
                        $('.data-section-parts').append(
                                "<tr><td>" +
                                (index + 1) +
                                "</td><td>" +
                                value.name +
                                "</td><td>" +
                                (value.category == null ? "-" : value.category.name) +
                                "</td><td>" +
                                value.quantity +
                                "</td><td>" +
                                (value.branch == null ? "-" : value.branch.name) +
                                "</td><td>" +
                                value.sku +
                                "</td></tr>"
                            )
                    });
                    tableParts = $('#partsData').DataTable();

                    console.log("test");
                    console.log(data.dataSet.cntProduct);
                    console.log(data.dataSet.productNameSet);
                    console.log(data.dataSet.color);

                    window.color_set = data.dataSet.color;
                    window.product_name = data.dataSet.productNameSet;
                    window.data_donut_chart = data.dataSet.cntProduct;


                    console.log(window.color_set);
                    console.log(window.product_name);
                    console.log(window.data_donut_chart);

                    callDoughnutChart(window.product_name,window.color_set,window.data_donut_chart);

                }
            });
        }

        $(document).off('click', '.pnt-sel-filter-branch').on('click', '.pnt-sel-filter-branch', (e) => {
            window.branch_id = $(".pnt-sel-filter-branch option:selected").val();
            console.log(branch_id)
            if (window.branch_id > 0) {
                $.ajax({
                    type: "get",
                    url: '{!! url('report/dashBoard/getPartsByBranch') !!}/' + window.branch_id,

                    success: function (data) {
                        console.log(data)
                        window.filter_dropdown_parts.empty();
                        if (data.status) {
                            var parts = "<option value=" + 0 + "> <strong>" + "All Parts" + "</strong></option>";
                            $.each(data.parts, function (index, value) {
                                parts += "<option value=" + value.id + "> <strong>" + value.name + "</strong></option>"
                            });
                            window.filter_dropdown_parts.append(parts);
                            window.filter_dropdown_parts.selectpicker('refresh');
                        }
                    }
                });
            }
        });

        $(document).off('click', '.pnt-sel-filter-parts').on('click', '.pnt-sel-filter-parts', (e) => {
            window.parts_id = $('.pnt-sel-filter-parts option:selected').val();
            window.parts_name = $('.pnt-sel-filter-parts option:selected').text();
            console.log(parts_id)
            if (window.parts_id > 0) {
                $.ajax({
                    type: "get",
                    url: '{!! url('report/dashBoard/getDataHistory') !!}/' + window.parts_id,
                    success: function (data) {
                        window.data_line_chart = data.data;
                        console.log(window.data_line_chart)
                        callLineChart();
                    }
                });
            } else {
                window.data_line_chart = [];
                callLineChart();
            }
        });


        $(document).ready(function () {
            getBranch();
            getDashBoard();

        });


        function callLineChart() {
            var ctx = document.getElementById('myChart').getContext('2d');
            var chart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Fab', 'Mach', 'April', 'May', 'June', 'July', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                    datasets: [{
                        label: window.parts_name,
                        backgroundColor: 'rgba(75, 192, 192 , 0.2)',
                        borderColor: 'rgba(75, 192, 192)',
                        data: window.data_line_chart
                    }]
                },
                // Configuration options go here
                options: {}
            });
        }

        function callDoughnutChart (name , color , data) {
            console.log(name);
                    console.log(color);
                    console.log(data);

            var ctx_Dough = document.getElementById('myChart_doughnut').getContext('2d');
            var chart_DoughnutChart = new Chart(ctx_Dough, {
                type: 'doughnut',
                data: {
                    labels: name,
                    datasets: [{
                        label: name,
                        backgroundColor: color,
                        data: data
                    }]
                },
                // Configuration options go here
                options: {}
            });
        }


    </script>
@endsection
