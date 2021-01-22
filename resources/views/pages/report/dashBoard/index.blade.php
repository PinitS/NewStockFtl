@extends('layouts.master')

@section('content')


    <div class="row ">
        <div class="col-md-3">
            <div class="card">
                <div class="card-header border-0 pb-0">
                    <h4 class="card-title">@lang('Timeline History')</h4>
                </div>
                <div class="card-body">
                    <div id="DZ_W_TimeLine1" class="widget-timeline dz-scroll style-1" style="height:250px;">
                        <ul class="timeline text-card-timeline">
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-5">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">@lang('History Parts')</h4>
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

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">@lang('Products Chart')</h4>
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
                    <canvas id="myChart_doughnut" width="250" height="200" class="chartjs-render-monitor"
                            style="display: block; width: 250px; height: 250px;"></canvas>
                </div>
            </div>
        </div>


    </div>


    <div class="row">

        <div class="col-md-6">
            <div class="card">
                <div class="card-header border-0 pb-0">
                    <h4 class="card-title">@lang('All Customer')</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="userData">
                            <thead>
                            <tr>
                                <th class="text-dark">#</th>
                                <th class="text-dark">@lang('Name')</th>
                                <th class="text-dark">@lang('Contact Name')</th>
                                <th class="text-dark">@lang('Products(Count)')</th>
                                <th class="text-dark">@lang('Phone Number')</th>

                            </tr>
                            </thead>
                            <tbody class="data-section-users">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-md-6">
            <div class="card">
                <div class="card-header border-0 pb-0">
                    <h4 class="card-title">@lang('All Dealer')</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="dealerData">
                            <thead>
                            <tr>
                                <th class="text-dark">#</th>
                                <th class="text-dark">@lang('Name')</th>
                                <th class="text-dark">@lang('Contact Name')</th>
                                <th class="text-dark">@lang('Products(Count)')</th>
                                <th class="text-dark">@lang('Phone Number')</th>

                            </tr>
                            </thead>
                            <tbody class="data-section-dealer">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>


    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header border-0 pb-0">
                    <h4 class="card-title">@lang('All Parts')</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="partsData">
                            <thead>
                            <tr>
                                <th><strong>#</strong></th>
                                <th><strong>@lang('Name')</strong></th>
                                <th><strong>@lang('Category')</strong></th>
                                <th><strong>@lang('Quantity')</strong></th>
                                <th><strong>@lang('Unit')</strong></th>
                                <th><strong>@lang('Branch')</strong></th>
                                <th><strong>@lang('Sku')</strong></th>
                            </tr>
                            </thead>
                            <tbody class="data-section-parts">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header border-0 pb-0">
                    <h4 class="card-title">@lang('Parts All Branch')</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="all-branch-partsData">
                            <thead>
                            <tr>
                                <th><strong>#</strong></th>
                                <th><strong>@lang('Parts')</strong></th>
                                <th><strong>@lang('Quantity')</strong></th>
                                <th><strong>@lang('Unit')</strong></th>
                            </tr>
                            </thead>
                            <tbody class="data-section-all-branch-parts">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
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
        var ctx = document.getElementById('myChart').getContext('2d');
        var chart = new Chart(ctx, '');


        var tableUsers = $('#userData').DataTable({
            "pageLength": 5,
            "searching": false,
            "lengthChange": false
        });

        var tableDealer = $('#dealerData').DataTable({
            "pageLength": 5,
            "searching": false,
            "lengthChange": false
        });


        var tableParts = $('#partsData').DataTable();
        var tableAllBranchParts = $('#all-branch-partsData').DataTable();


        $(document).ready(function () {
            getBranch();
            getDashBoard();
        });

        function getBranch() {
            $.ajax({
                type: "get",
                url: '{!! url('manage/branches/getBranches') !!}',
                success: function (data) {
                    window.filter_dropdown_branch.empty();
                    if (data.status) {
                        var branch = "<option value=" + 0 + "> <strong>" + "Select Branch" + "</strong></option>";
                        var select_value = 0;
                        $.each(data.branch, function (index, value) {
                            if (index === 0) {
                                select_value = value.id;
                            }
                            branch += "<option value='" + value.id + "'> <strong>" + value.name + "</strong></option>"
                        });
                        window.filter_dropdown_branch.append(branch);
                        window.filter_dropdown_branch.selectpicker('refresh');
                        $('.pnt-sel-filter-branch').val(select_value).change();

                        window.branch_id = select_value;
                        if (window.branch_id > 0) {
                            callBranchParts();
                        }
                    }
                }
            });
        }

        function getDashBoard() {
            $.ajax({
                type: "get",
                url: '{!! url('report/dashBoard/getDashBoard') !!}',
                beforeSend: function () {
                    $('#pnt-loading').show();
                },
                success: function (data) {


                    console.log(data);

                    var dataTimeline = '';
                    var cnt = 0;
                    var date = '';
                    const color = ["primary", "info", "danger", "success", "warning"];
                    $.each(data.dataSet.dataTimeline, function (index, value) {
                        if (cnt > color.length - 1) {
                            cnt = 0;
                        }
                        date = moment(value.created_at).fromNow();
                        dataTimeline += "<li><div class='timeline-badge " + color[cnt] + "'></div><a class='timeline-panel text-muted'><span>" + date + "<strong>" + " By " + (value.user == null ? "-" : value.user.name) + "</strong>" + "</span><h6 class='mb-0'>" + value.detail + "</h6></a></li>"
                        cnt++;
                    });
                    window.text_card_timeline.append(dataTimeline);

                    //userDash
                    tableUsers.destroy();
                    $('.data-section-users').html(null);
                    $.each(data.dataSet.customer, function (index, value) {
                        $('.data-section-users').append(
                            "<tr><td>" +
                            (index + 1) +
                            "</td><td>" +
                            value.name +
                            "</td><td>" +
                            (value.contact_name == null ? "-" : value.contact_name) +
                            "</td><td>" +
                            value.cnt +
                            "</td><td>" +
                            value.phone_number +
                            "</td></tr>"
                        )
                    });
                    tableUsers = $('#userData').DataTable({
                        "pageLength": 5,
                        "searching": false,
                        "lengthChange": false
                    });


                    //dealerDash
                    tableDealer.destroy();
                    $('.data-section-dealer').html(null);
                    $.each(data.dataSet.dealer, function (index, value) {
                        $('.data-section-dealer').append(
                            "<tr><td>" +
                            (index + 1) +
                            "</td><td>" +
                            value.name +
                            "</td><td>" +
                            (value.contact_name == null ? "-" : value.contact_name) +
                            "</td><td>" +
                            value.cnt +
                            "</td><td>" +
                            value.phone_number +
                            "</td></tr>"
                        )
                    });
                    tableUsers = $('#dealerData').DataTable({
                        "pageLength": 5,
                        "searching": false,
                        "lengthChange": false
                    });
                    //ENDdealerDash

                    //partDash
                    tableAllBranchParts.destroy();
                    $('.data-section-all-branch-parts').html(null);
                    $.each(data.dataSet.dataGroup, function (index, value) {
                        $('.data-section-all-branch-parts').append(
                            "<tr><td>" +
                            (index + 1) +
                            "</td><td>" +
                            value.name +
                            "</td><td>" +
                            value.quantity +
                            "</td><td>" +
                            value.unit +
                            "</td></tr>"
                        )
                    });
                    tableAllBranchParts = $('#all-branch-partsData').DataTable();


                    //AllpartDash
                    tableParts.destroy();
                    $('.data-section-parts').html(null);
                    $.each(data.dataSet.dataParts, function (index, value) {
                        $('.data-section-parts').append(
                            "<tr><td>" +
                            (index + 1) +
                            "</td><td>" +
                            value.name +
                            "</td><td>" +
                            (value.category == null ? "-" : value.category) +
                            "</td><td>" +
                            value.quantity +
                            "</td><td>" +
                            value.unit +
                            "</td><td>" +
                            (value.branch == null ? "-" : value.branch) +
                            "</td><td>" +
                            (value.sku == null ? "-" : value.sku) +
                            "</td></tr>"
                        )
                    });
                    tableParts = $('#partsData').DataTable();
                    window.color_set = data.dataSet.color;
                    window.product_name = data.dataSet.productNameSet;
                    window.data_donut_chart = data.dataSet.cntProduct;
                    callDoughnutChart(window.product_name, window.color_set, window.data_donut_chart);
                    $('#pnt-loading').hide();
                }
            });
        }

        function callBranchParts() {
            $.ajax({
                type: "get",
                url: '{!! url('report/dashBoard/getPartsByBranch') !!}/' + window.branch_id,
                beforeSend: function () {
                    $('#pnt-loading').show();
                },
                success: function (data) {
                    console.log("===================");
                    console.log(data);
                    window.filter_dropdown_parts.empty();
                    if (data.status) {
                        var parts = "";
                        var select_value = 0;
                        var select_name_value = '';
                        $.each(data.parts, function (index, value) {
                            if (index === 0) {
                                select_value = value.id;
                                select_name_value = value.group_part.name ;
                            }
                            parts += "<option value=" + value.id + "> <strong>" + value.group_part.name + "</strong></option>"
                        });
                        window.filter_dropdown_parts.append(parts);
                        window.filter_dropdown_parts.selectpicker('refresh');
                        $('.pnt-sel-filter-parts').val(select_value).change();
                        window.parts_id = select_value;
                        window.parts_name = select_name_value;
                        $('#pnt-loading').hide();
                        callDataLineChart();
                    }
                }
            });
        }

        $(document).off('click', '.pnt-sel-filter-branch').on('click', '.pnt-sel-filter-branch', (e) => {
            window.branch_id = $(".pnt-sel-filter-branch option:selected").val();
            if (window.branch_id > 0) {
                callBranchParts();
            }
        });

        function callDataLineChart() {
            window.data_line_chart = [];
            console.log(window.data_line_chart)
            $.ajax({
                type: "get",
                url: '{!! url('report/dashBoard/getDataHistory') !!}/' + window.parts_id,
                success: function (data) {
                    window.data_line_chart = data.data;
                    callLineChart();
                }
            });
        }

        $(document).off('click', '.pnt-sel-filter-parts').on('click', '.pnt-sel-filter-parts', (e) => {
            window.parts_id = $('.pnt-sel-filter-parts option:selected').val();
            window.parts_name = $('.pnt-sel-filter-parts option:selected').text();
            callDataLineChart();
        });


        function callLineChart() {
            chart.destroy();
            chart = new Chart(ctx, {
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

        function callDoughnutChart(name, color, data) {
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
                options: {}
            });
        }
    </script>
@endsection
