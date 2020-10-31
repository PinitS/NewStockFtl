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

    {{--    chart.js--}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

    {{--    SweetAlert--}}
    <script src="{!! url('sweetalert2.all.min.js') !!}"></script>
    <link href="{!! url('sweetalert2.min.css') !!}" rel="stylesheet">

    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBrWrXezL74wcInfHbd0Nfm8BjbdUdHZMw&callback=initMap&libraries=&v=weekly"
        defer
    ></script>
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


            {{--    modal-edit-this-user--}}
            <div class="modal fade bd-example-modal-lg pnt-modal-edit-this-user" tabindex="-1" role="dialog"
                 aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">User Infomation</h5>
                            <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                            </button>
                        </div>
                        <div class="modal-body text-center">

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Username</label>
                                <div class="col-sm-9">
                                    <span style="display: inline-block; margin-top: 7px;"><strong>{{ Auth::user()->name }}</strong></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Email</label>
                                <div class="col-sm-9">
                                    <span style="display: inline-block; margin-top: 7px;"><strong>{{ Auth::user()->email }}</strong></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Status</label>
                                <div class="col-sm-9">
                                    <span style="display: inline-block; margin-top: 7px;"><strong>{{ Auth::user()->status == 1 ? "Admin" : "Member" }}</strong></span>
                                </div>
                            </div>

                            <div class="pnt-edit-this-save-user-toggle" style="display: none" >
                                <hr>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label pnt-label-username-check">New Username</label>
                                    <div class="col-sm-8">
                                        <input type="hidden" class="pnt-modal-edit-this-usid" value="{{ Auth::user()->id }}">
                                        <input type="hidden" class="pnt-modal-edit-this-status" value="{{ Auth::user()->status }}">
                                        <input type="email" class="form-control pnt-modal-edit-this-username" value="{{ Auth::user()->name }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label"> New Email</label>
                                    <div class="col-sm-8">
                                        <input type="email" class="form-control pnt-modal-edit-this-email" value="{{ Auth::user()->email }}">
                                    </div>
                                </div>
                                <button type="button" class="btn btn-block btn-success pnt-modal-edit-this-user-save">Save changes</button>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-warning light pnt-open-toggle-edit-this-username">Edit</button>
                            <button type="button" class="btn btn-danger light" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            {{--    modal-edit-this-user--}}

                {{--modal reset password--}}
            <div class="modal fade pnt-modal-reset-password-this " id="exampleModalCenter">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Reset Password User</h5>
                            <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="password">Password
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="col-lg-6">
                                    <input type="password" class="form-control pnt-input-password-this">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="password_confirmation">Confirm Password <span
                                        class="text-danger">*</span>
                                </label>
                                <div class="col-lg-6">
                                    <input type="password" class="form-control pnt-input-password_confirmation-this"
                                        id="password_confirmation" name="password_confirmation">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger light" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary pnt-btn-modal-reset-password-save-this">Save changes
                            </button>
                        </div>
                    </div>
                </div>
            </div>
    {{--modal reset password--}}

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

<div class="map-section-show-only"
     style="display: none;position: fixed; bottom: 0; right: 0; z-index: 3000; width: 50%; height: 50%">
    <div id="map-show-only" style="height: 100%; width: 100%"></div>
    <a class="btn btn-danger text-white close-map-section-show-only"
       style="z-index: 1010; position: absolute; left: 5px; bottom: 5px; cursor: pointer">Close</a>
</div>

<div class="map-section-get-only"
     style="display: none;position: fixed; bottom: 0; right: 0; z-index: 3000; width: 50%; height: 50%">
    <div id="map-get-only" style="height: 100%; width: 100%"></div>
    <a class="btn btn-danger text-white close-map-section-get-only"
       style="z-index: 1010; position: absolute; left: 5px; bottom: 5px; cursor: pointer">Close</a>
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
    let mapShowOnly;
    let mapGetOnly;
    let mapPointerLocation;
    let centerLat = 18.788880;
    let centerLng = 98.993285;
    let markersShowOnly = [];
    let markersPointerLocation = [];
    let markersGetOnly = [];

    // let markersGetOnly = null;

    function initMap() {
        //Show Only
        mapShowOnly = new google.maps.Map(document.getElementById("map-show-only"), {
            zoom: 14,
            center: {lat: centerLat, lng: centerLng},
        });

        //Get Only
        mapGetOnly = new google.maps.Map(document.getElementById("map-get-only"), {
            zoom: 14,
            center: {lat: centerLat, lng: centerLng},
        });

        mapGetOnly.addListener("click", (e) => {
            $('input[name="latitude"]').val(e.latLng.lat());
            $('input[name="longitude"]').val(e.latLng.lng());

            let lat = $('.pnt-modal-edit-latitude').val();
            let lng = $('.pnt-modal-edit-longitude').val();
            getLatLng(lat, lng);
        });
    }

    function showOnMap(lat, lng) {
        deleteMarkers(markersShowOnly);
        if (lat === null || lng === null) {
            Swal.fire({
                position: 'top-end',
                icon: 'error',
                title: 'latitude or longitude went wrong',
                showConfirmButton: false,
                timer: 1500
            })
        }

        const markerShow = new google.maps.Marker({
            position: {lat: parseFloat(lat), lng: parseFloat(lng)},
        });
        markerShow.setMap(mapShowOnly);
        markersShowOnly.push(markerShow);
        mapShowOnly.panTo(markerShow.getPosition());
        $('.map-section-show-only').show();
        $('.map-section-get-only').hide();
    }

    function deleteMarkers(marker) {
        for (let i = 0; i < marker.length; i++) {
            marker[i].setMap(null);
        }
        // marker = [];
    }

    function getLatLng(lat, lng) {
        deleteMarkers(markersGetOnly);
        const marker = new google.maps.Marker({
            position: {lat: parseFloat(lat), lng: parseFloat(lng)},
            map: mapGetOnly,
        });
        mapGetOnly.setCenter({lat: parseFloat(lat), lng: parseFloat(lng)});
        markersGetOnly.push(marker);
    }

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
            navheaderBg: "color_2",
            sidebarBg: "color_1",
            sidebarStyle: "full",
            sidebarPosition: "fixed",
            headerPosition: "fixed",
            containerLayout: "wide",
            direction: direction
        });

    });

    $(document).off('click', '.close-map-section-show-only').on('click', '.close-map-section-show-only', (e) => {
        $('.map-section-show-only').hide();
    });

    $(document).off('click', '.close-map-section-get-only').on('click', '.close-map-section-get-only', (e) => {
        $('.map-section-get-only').hide();
    });

    $(document).off('click', '.pnt-btn-forget-session').on('click', '.pnt-btn-forget-session', (e) => {
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

    $(document).off('click', '.pnt-btn-forget-session-customer').on('click', '.pnt-btn-forget-session-customer', (e) => {
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
                    data: {
                        _token: $('#pnt-logout-token').val(),
                    },
                    success: function (data) {
                        window.location.href = "{!! url('/') !!}";
                    }
                });
            }
        })
    });

    $(document).off('click', '.pnt-btn-profile').on('click', '.pnt-btn-profile', (e) => {
        $('.pnt-modal-edit-this-user').modal();
    });

    $(document).off('click', '.pnt-open-toggle-edit-this-username').on('click', '.pnt-open-toggle-edit-this-username', (e) => {
        $('.pnt-edit-this-save-user-toggle').toggle(150);
    });

        // pnt-modal-edit-this-user-save
    $(document).off('click', '.pnt-modal-edit-this-user-save').on('click', '.pnt-modal-edit-this-user-save', (e) => {
            console.log($('.pnt-modal-edit-this-usid').val());
            console.log($('.pnt-modal-edit-this-status').val());
            console.log($('.pnt-modal-edit-this-email').val());

            $.ajax({
                type: "post",
                url: "{!! url('manage/users/update') !!}/" + $('.pnt-modal-edit-this-usid').val(),
                data: {
                    name: $('.pnt-modal-edit-this-username').val(),
                    email: $('.pnt-modal-edit-this-email').val(),
                    status: $('.pnt-modal-edit-this-status').val(),
                    '_token': window.token,
                },
                success: function (data) {
                    if (data.status) {
                        resetTable();
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Update User Success fully',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        window.location.reload();
                    }
                },
                error: function (jqXHR, exception) {
                    if (jqXHR.status !== 200) {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'error',
                            title: 'Something went wrong',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    }
                },
            });
    });
        // end-pnt-modal-edit-this-user-save

            // btn-password
        $(document).off('click', '.pnt-btn-reset-password-in-header').on('click', '.pnt-btn-reset-password-in-header', (e) => {
            $(".pnt-modal-reset-password-this").modal();
        });
        // end btn-password

        // btn save reset-password modal
        $(document).off('click', '.pnt-btn-modal-reset-password-save-this').on('click', '.pnt-btn-modal-reset-password-save-this', e => {
            console.log('this')
            $.ajax({
                type: "post",
                url: "{!! url('manage/users/resetPassword') !!}/" + $('.pnt-modal-edit-this-usid').val(),
                data: {
                    password: $(".pnt-input-password-this").val(),
                    password_confirmation: $(".pnt-input-password_confirmation-this").val(),
                    '_token': window.token,
                },
                success: function (data) {
                    if (data.status) {
                        $(".pnt-modal-reset-password-this").modal('hide');
                        resetTable();
                        Swal.fire({

                            position: 'top-end',
                            icon: 'success',
                            title: 'Please Login',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        window.location.reload();
                    }
                },
                error: function (jqXHR, exception) {
                    if (jqXHR.status !== 200) {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'error',
                            title: 'Something went wrong',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    }
                },
            });
        });
        // end btn save reset-password modal




</script>

@yield('script')

</body>
</html>
