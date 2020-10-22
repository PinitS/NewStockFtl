<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>FarmThailand</title>
    <!-- Favicon icon -->
    <link rel="icon" type="{!! url('image/png') !!}" sizes="16x16" href="{!! '/images/favicon.png' !!}">
    <link href="{!! url('/vendor/jqvmap/css/jqvmap.min.css') !!}" rel="stylesheet">
    <link rel="stylesheet" href="{!! '/vendor/chartist/css/chartist.min.css' !!}">
    <link href="{!! url('/vendor/bootstrap-select/dist/css/bootstrap-select.min.css') !!}" rel="stylesheet">
    <link href="{!! url('/css/style.css') !!}" rel="stylesheet">
    <link href="{!! url('https://cdn.lineicons.com/2.0/LineIcons.css') !!}" rel="stylesheet">
    <link href="{!! url('/vendor/datatables/css/jquery.dataTables.min.css') !!}" rel="stylesheet">
    <script src="{!! url('moment.min.js') !!}"></script>

{{--    SweetAlert--}}
    <script src="{!! url('sweetalert2.all.min.js') !!}"></script>
    <link href="{!! url('sweetalert2.min.css') !!}" rel="stylesheet">


</head>

<body>

<!--*******************
    Preloader start
********************-->
<div id="preloader">
    <div class="sk-three-bounce">
        <div class="sk-child sk-bounce1"></div>
        <div class="sk-child sk-bounce2"></div>
        <div class="sk-child sk-bounce3"></div>
    </div>
</div>
<!--*******************
    Preloader end
********************-->


<!--**********************************
    Main wrapper start
***********************************-->
<div id="main-wrapper">

    <!--**********************************
        Nav header start
    ***********************************-->
@include('layouts.navheader')
    <!--**********************************
        Nav header end
    ***********************************-->

    <!--**********************************
Chat box start
***********************************-->

    <!--**********************************
        Chat box End
    ***********************************-->

    <!--**********************************
        Header start
    ***********************************-->
@include('layouts.header')
<!--**********************************
        Header end ti-comment-alt
    ***********************************-->

    <!--**********************************
        Sidebar start
    ***********************************-->
@include('layouts.sidebar')
<!--**********************************
        Sidebar end
    ***********************************-->

    <!--**********************************
        Content body start
    ***********************************-->
    <div class="content-body">
        <!-- row -->
        <div class="container-fluid">

            @yield('content')

        </div>
    </div>
    <!--**********************************
        Content body end
    ***********************************-->


    <!--**********************************
        Footer start
    ***********************************-->
@include('layouts.footer')
<!--**********************************
        Footer end
    ***********************************-->

    <!--**********************************
       Support ticket button start
    ***********************************-->

    <!--**********************************
       Support ticket button end
    ***********************************-->


</div>
<!--**********************************
    Main wrapper end
***********************************-->

<!--**********************************
    Scripts
***********************************-->
<!-- Required vendors -->
<script src="{!! url('/vendor/global/global.min.js') !!}"></script>
<script src="{!! url('/vendor/bootstrap-select/dist/js/bootstrap-select.min.js') !!}"></script>
<script src="{!! url('/vendor/chart.js/Chart.bundle.min.js') !!}"></script>
<script src="{!! url('/js/custom.min.js') !!}"></script>
<!-- Apex Chart -->
<script src="{!! url('/vendor/apexchart/apexchart.js') !!}"></script>

<!-- Vectormap -->
<!-- Chart piety plugin files -->
<script src="{!! url('/vendor/peity/jquery.peity.min.js') !!}"></script>

<!-- Chartist -->
<script src="{!! url('/vendor/chartist/js/chartist.min.js') !!}"></script>

<!-- Dashboard 1 -->
<script src="{!! url('/js/dashboard/dashboard-1.js') !!}"></script>
<!-- Svganimation scripts -->
<script src="{!! url('/vendor/svganimation/vivus.min.js') !!}"></script>
<script src="{!! url('/vendor/svganimation/svg.animation.js') !!}"></script>

<!-- Required vendors -->

<script src="{!! url('/js/deznav-init.js') !!}"></script>
<!-- Apex Chart -->


<!-- Datatable -->
<script src="{!! url('/vendor/datatables/js/jquery.dataTables.min.js') !!}"></script>
<script src="{!! url('/js/plugins-init/datatables.init.js') !!}"></script>

<!-- Svganimation scripts -->
<script src="{!! url('/vendor/svganimation/svg.animation.js') !!}"></script>

<script>

    $(document).ready(function () {
        // callAjax("testLogin", "GET", null).then( (data) => console.log(data) )
        "use strict"
        var direction = getUrlParams('dir');
        if (direction != 'rtl') {
            direction = 'ltr';
        }

        new dezSettings({
            typography: "roboto",
            version: "light",
            layout: "vertical",
            headerBg: "color_1",
            navheaderBg: "color_3",
            sidebarBg: "color_1",
            sidebarStyle: "full",
            sidebarPosition: "fixed",
            headerPosition: "fixed",
            containerLayout: "wide",
            direction: direction
        });

    });

    $(document).off('click', '.pnt-btn-forget-session').on('click', '.pnt-btn-forget-session', (e) =>
    {
        $.ajax({
            type: "get",
            url: '{{route('removeSessionBranch')}}',
            success: function (data) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Leave Branch Success fully',
                    showConfirmButton: false,
                    timer: 2000
                });
                window.location.href = "{!! url('/selectBranch') !!}";
            }
        });
    });

    $(document).off('click', '.pnt-btn-forget-session-customer').on('click', '.pnt-btn-forget-session-customer', (e) =>
    {
        $.ajax({
            type: "get",
            url: '{{route('removeSessionCustomer')}}',
            success: function (data) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Leave Customer Success fully',
                    showConfirmButton: false,
                    timer: 2000
                });
                window.location.href = "{!! url('/selectCustomer') !!}";
            }
        });
    });



    $(document).off('click', '.pnt-btn-logout').on('click', '.pnt-btn-logout', (e) => {
        Swal.fire({
            title: 'Are you sure?',
            text: "Logout!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'logout!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "{{ route('logout') }}",
                    data :{
                        _token : $('#pnt-logout-token').val(),
                    },
                    success: function (data) {
                        window.location.href = "{!! url('/') !!}";
                    }
                });
            }
        })
    });



</script>

@yield('script')

</body>
</html>
