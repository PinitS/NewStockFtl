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
        <div class="col-md-4">
            <div class="card">
                <div class="card-header border-0 pb-0">
                    <h4 class="card-title">All product</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-responsive-sm mb-0">
                            <thead>
                            <tr>
                                <th style="width:20px;">
                                    <div class="custom-control custom-checkbox checkbox-primary check-lg mr-3">
                                        <input type="checkbox" class="custom-control-input" id="checkAll" required="">
                                        <label class="custom-control-label" for="checkAll"></label>
                                    </div>
                                </th>
                                <th><strong>STATUS.</strong></th>
                                <th><strong>NAME</strong></th>
                                <th><strong>DATE</strong></th>
                                <th><strong>STATUS</strong></th>
                                <th style="width:85px;"><strong>EDIT</strong></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                    <div class="custom-control custom-checkbox check-lg mr-3">
                                        <input type="checkbox" class="custom-control-input" id="customCheckBox2"
                                               required="">
                                        <label class="custom-control-label" for="customCheckBox2"></label>
                                    </div>
                                </td>
                                <td><b>$542</b></td>
                                <td>Dr. Jackson</td>
                                <td>01 August 2020</td>
                                <td class="recent-stats d-flex align-items-center"><i
                                        class="fa fa-circle text-success mr-1"></i>Successful
                                </td>
                                <td>
                                    <a href="#" class="btn btn-primary shadow btn-xs sharp mr-1"><i
                                            class="fa fa-pencil"></i></a>
                                    <a href="#" class="btn btn-danger shadow btn-xs sharp"><i
                                            class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="custom-control custom-checkbox check-lg mr-3">
                                        <input type="checkbox" class="custom-control-input" id="customCheckBox3"
                                               required="">
                                        <label class="custom-control-label" for="customCheckBox3"></label>
                                    </div>
                                </td>
                                <td><b>$2000</b></td>
                                <td>Dr. Jackson</td>
                                <td>01 August 2020</td>
                                <td class="recent-stats d-flex align-items-center"><i
                                        class="fa fa-circle text-danger mr-1"></i>Canceled
                                </td>
                                <td>
                                    <a href="#" class="btn btn-primary shadow btn-xs sharp mr-1"><i
                                            class="fa fa-pencil"></i></a>
                                    <a href="#" class="btn btn-danger shadow btn-xs sharp"><i
                                            class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="custom-control custom-checkbox check-lg mr-3">
                                        <input type="checkbox" class="custom-control-input" id="customCheckBox4"
                                               required="">
                                        <label class="custom-control-label" for="customCheckBox4"></label>
                                    </div>
                                </td>
                                <td><b>$300</b></td>
                                <td>Dr. Jackson</td>
                                <td>01 August 2020</td>
                                <td class="recent-stats d-flex align-items-center"><i
                                        class="fa fa-circle text-warning mr-1"></i>Pending
                                </td>
                                <td>
                                    <a href="#" class="btn btn-primary shadow btn-xs sharp mr-1"><i
                                            class="fa fa-pencil"></i></a>
                                    <a href="#" class="btn btn-danger shadow btn-xs sharp"><i
                                            class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="custom-control custom-checkbox check-lg mr-3">
                                        <input type="checkbox" class="custom-control-input" id="customCheckBox5"
                                               required="">
                                        <label class="custom-control-label" for="customCheckBox5"></label>
                                    </div>
                                </td>
                                <td><b>$2000</b></td>
                                <td>Dr. Jackson</td>
                                <td>01 August 2020</td>
                                <td class="recent-stats d-flex align-items-center"><i
                                        class="fa fa-circle text-danger mr-1"></i>Canceled
                                </td>
                                <td>
                                    <a href="#" class="btn btn-primary shadow btn-xs sharp mr-1"><i
                                            class="fa fa-pencil"></i></a>
                                    <a href="#" class="btn btn-danger shadow btn-xs sharp"><i
                                            class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header border-0 pb-0">
                    <h4 class="card-title">All user</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-responsive-sm mb-0">
                            <thead>
                            <tr>
                                <th style="width:20px;">
                                    <div class="custom-control custom-checkbox checkbox-primary check-lg mr-3">
                                        <input type="checkbox" class="custom-control-input" id="checkAll" required="">
                                        <label class="custom-control-label" for="checkAll"></label>
                                    </div>
                                </th>
                                <th><strong>STATUS.</strong></th>
                                <th><strong>NAME</strong></th>
                                <th><strong>DATE</strong></th>
                                <th><strong>STATUS</strong></th>
                                <th style="width:85px;"><strong>EDIT</strong></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                    <div class="custom-control custom-checkbox check-lg mr-3">
                                        <input type="checkbox" class="custom-control-input" id="customCheckBox2"
                                               required="">
                                        <label class="custom-control-label" for="customCheckBox2"></label>
                                    </div>
                                </td>
                                <td><b>$542</b></td>
                                <td>Dr. Jackson</td>
                                <td>01 August 2020</td>
                                <td class="recent-stats d-flex align-items-center"><i
                                        class="fa fa-circle text-success mr-1"></i>Successful
                                </td>
                                <td>
                                    <a href="#" class="btn btn-primary shadow btn-xs sharp mr-1"><i
                                            class="fa fa-pencil"></i></a>
                                    <a href="#" class="btn btn-danger shadow btn-xs sharp"><i
                                            class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="custom-control custom-checkbox check-lg mr-3">
                                        <input type="checkbox" class="custom-control-input" id="customCheckBox3"
                                               required="">
                                        <label class="custom-control-label" for="customCheckBox3"></label>
                                    </div>
                                </td>
                                <td><b>$2000</b></td>
                                <td>Dr. Jackson</td>
                                <td>01 August 2020</td>
                                <td class="recent-stats d-flex align-items-center"><i
                                        class="fa fa-circle text-danger mr-1"></i>Canceled
                                </td>
                                <td>
                                    <a href="#" class="btn btn-primary shadow btn-xs sharp mr-1"><i
                                            class="fa fa-pencil"></i></a>
                                    <a href="#" class="btn btn-danger shadow btn-xs sharp"><i
                                            class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="custom-control custom-checkbox check-lg mr-3">
                                        <input type="checkbox" class="custom-control-input" id="customCheckBox4"
                                               required="">
                                        <label class="custom-control-label" for="customCheckBox4"></label>
                                    </div>
                                </td>
                                <td><b>$300</b></td>
                                <td>Dr. Jackson</td>
                                <td>01 August 2020</td>
                                <td class="recent-stats d-flex align-items-center"><i
                                        class="fa fa-circle text-warning mr-1"></i>Pending
                                </td>
                                <td>
                                    <a href="#" class="btn btn-primary shadow btn-xs sharp mr-1"><i
                                            class="fa fa-pencil"></i></a>
                                    <a href="#" class="btn btn-danger shadow btn-xs sharp"><i
                                            class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="custom-control custom-checkbox check-lg mr-3">
                                        <input type="checkbox" class="custom-control-input" id="customCheckBox5"
                                               required="">
                                        <label class="custom-control-label" for="customCheckBox5"></label>
                                    </div>
                                </td>
                                <td><b>$2000</b></td>
                                <td>Dr. Jackson</td>
                                <td>01 August 2020</td>
                                <td class="recent-stats d-flex align-items-center"><i
                                        class="fa fa-circle text-danger mr-1"></i>Canceled
                                </td>
                                <td>
                                    <a href="#" class="btn btn-primary shadow btn-xs sharp mr-1"><i
                                            class="fa fa-pencil"></i></a>
                                    <a href="#" class="btn btn-danger shadow btn-xs sharp"><i
                                            class="fa fa-trash"></i></a>
                                </td>
                            </tr>
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

        function getTimelinme() {
            $.ajax({
                type: "get",
                url: '{!! url('report/dashBoard/getTimeline') !!}',

                success: function (data) {
                    console.log(data)
                    var dataTimeline = '';
                    var cnt = 0;
                    var date ='';
                    const color = ["primary", "info", "danger", "success", "warning"];
                    $.each(data.dataTimeline, function (index, value) {
                        if (cnt > color.length - 1) {
                            cnt = 0;
                        }
                        date = moment(value.created_at).fromNow();
                        dataTimeline += "<li><div class='timeline-badge " + color[cnt] + "'></div><a class='timeline-panel text-muted'><span>" + date +"<strong>"+" By "+value.user.name+"</strong>"+ "</span><h6 class='mb-0'>" + value.detail + "</h6></a></li>"
                        cnt++;
                        console.log(value.created_at)
                    });
                    window.text_card_timeline.append(dataTimeline);
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
            getTimelinme();
        });


        function callLineChart() {
            var ctx = document.getElementById('myChart').getContext('2d');
            var chart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Fab', 'Mach', 'April', 'May', 'June', 'July', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                    datasets: [{
                        label: window.parts_name,
                        backgroundColor: 'rgb(255, 99, 132)',
                        borderColor: 'rgb(255, 20, 132)',
                        data: window.data_line_chart
                    }]
                },
                // Configuration options go here
                options: {}
            });
        }


    </script>
@endsection
