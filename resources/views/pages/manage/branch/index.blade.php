@extends('layouts.master')

@section('content')

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="row">
        <div class="col-12">
            <div class="card bg-white">
                <div class="card-header">
                    <h4 class="card-title text-dark">@lang('Branch Information')</h4>
                    <button type="button" class="btn btn-info pnt-bnt-add-branch">@lang('Add') <span class="btn-icon-right"><i
                                class="fa fa-plus color-info"></i></span>
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="branchInformation" style="min-width: 845px">
                            <thead>
                            <tr>
                                <th class="text-dark">#</th>
                                <th class="text-dark">@lang('Branch')</th>
                                <th class="text-dark">@lang('Phone Number')</th>
                                <th class="text-dark">@lang('Address')</th>
                                <th class="text-dark">@lang('Manage')</th>
                            </tr>
                            </thead>
                            <tbody class="data-section">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{--    modal add Branch--}}
    <form id="add-modal-branch-valid">
        <div class="modal fade pnt-modal-add-branch" id="exampleModalCenter">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">@lang('Add Branch')</h5>
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label class="mb-1"><strong>@lang('Branch Name')</strong></label>
                            <input type="text" class="form-control pnt-modal-add-branch-name" id="name" name="name"
                                   required>
                        </div>
                        <div class="form-group">
                            <label class="mb-1"><strong>@lang('Phone Number')</strong></label>
                            <input type="text" class="form-control pnt-modal-add-branch-phone" id="phoneNumber"
                                   name="phoneNumber">
                        </div>
                        <div class="row">
                            <div class="col-md-12 mb-3 mt-1">
                                <a class="btn btn-success btn-block text-white getLatLnt-add" style="cursor:pointer;">@lang('Select Location')</a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="mb-1"><strong>@lang('Latitude')</strong></label>
                                    <input type="text" class="form-control pnt-modal-add-latitude" id="latitude"
                                           name="latitude" value="" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="mb-1"><strong>@lang('Longitude')</strong></label>
                                    <input type="text" class="form-control pnt-modal-add-longitude" id="longitude"
                                           name="longitude" value="" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="mb-1"><strong>@lang('Address')</strong></label>
                            <input type="text" class="form-control pnt-modal-add-address" id="address" name="address"
                                   value="" required>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger light" data-dismiss="modal">@lang('Close')</button>
                        <button type="button" class="btn btn-primary pnt-btn-modal-add-branch-save">@lang('Add Branch')</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    {{--    end modal add Branch--}}


    {{--modal update--}}
    <form id="edit-modal-branch-valid">
        <div class="modal fade pnt-modal-edit " id="exampleModalCenter">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">@lang('Edit Branch')</h5>
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label class="mb-1"><strong>@lang('Branch Name')</strong></label>
                            <input type="text" class="form-control pnt-modal-edit-branch-name" id="name" name="name"
                                   required>
                        </div>
                        <div class="form-group">
                            <label class="mb-1"><strong>@lang('Phone Number')</strong></label>
                            <input type="text" class="form-control pnt-modal-edit-branch-phone" id="phoneNumber"
                                   name="phoneNumber">
                        </div>

                        <div class="row">
                            <div class="col-md-12 mb-3 mt-1">
                                <a class="btn btn-success btn-block text-white getLatLnt" style="cursor:pointer;">@lang('Select
                                    Location')</a>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="mb-1"><strong>@lang('Latitude')</strong></label>
                                    <input type="text" class="form-control pnt-modal-edit-latitude" id="latitude"
                                           name="latitude" value="" readonly>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="mb-1"><strong>@lang('Longitude')</strong></label>
                                    <input type="text" class="form-control pnt-modal-edit-longitude" id="longitude"
                                           name="longitude" value="" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="mb-1"><strong>@lang('Address')</strong></label>
                            <input type="text" class="form-control pnt-modal-edit-branch-address" id="address"
                                   name="address" value="" required>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger light" data-dismiss="modal">@lang('Close')</button>
                        <button type="button" class="btn btn-primary pnt-btn-modal-save">@lang('Save changes')</button>
                    </div>

                </div>
            </div>
        </div>
    </form>
    {{--modal update--}}

@endsection



@section('script')

    <script>

        var token = $('meta[name="csrf-token"]').attr('content');
        var id = 0;
        var table = $('#branchInformation').DataTable();

        function resetTable() {
            $.ajax({
                type: 'get',
                url: '{{route('getBranches')}}',
                beforeSend: function () {
                    $('#pnt-loading').show();
                },
                success: function (data) {
                    if (data.status) {
                        table.destroy();
                        $('.data-section').html(null);
                        $.each(data.branch, function (index, value) {
                            let localHtml = "<tr><td>" +
                                (index + 1) +
                                "</td><td>" +
                                value.name +
                                "</td><td>" +
                                (value.phone_number == null ? "-" : value.phone_number) +
                                "</td><td>" +
                                value.address +
                                "</td><td>" +
                                "<div class = 'd-flex'>" +
                                "<button  class='btn btn-info text-white shadow btn-xs sharp mr-1' onclick='showOnMap(" + value.latitude + ", " + value.longitude + ")'><i class='fa fa-map-marker'></i></button>" +
                                "<button  class='btn btn-warning text-white pnt-btn-edit shadow btn-xs sharp mr-1' value = '" + value.id + "' ><i class='fa fa-pencil-square-o'></i></button>";

                            if (value.delete_active) {
                                localHtml += "<button  class='btn btn-danger pnt-btn-delete shadow btn-xs sharp mr-1' value = '" + value.id + "' ><i class= 'fa fa-trash'></i></button>"
                            }
                            $('.data-section').append(localHtml)
                        });
                        table = $('#branchInformation').DataTable();
                    }
                    $('#pnt-loading').hide();
                }
            });
        }

        $(document).ready(function () {
            resetTable();
            $('#add-modal-branch-valid').validate({
                rules: {
                    name: {
                        required: true,
                    },
                    phoneNumber: {
                        required: true,
                        number: true,
                        minlength: 10,
                        maxlength: 10,
                    },
                    address: {
                        required: true,
                    },
                },
                // <span class='text-danger'></span>
                messages: {
                    name: {
                        required: "<span class='text-danger'>{!! __('Please enter a branch name') !!}</span>",
                    },
                    phoneNumber :{
                        required: "<span class='text-danger'>{!! __('Please enter a Phone number') !!}</span>",
                        number: "<span class='text-danger'>{!! __('Number Only') !!}</span>",
                        minlength: "<span class='text-danger'>{!! __('Your Phone Number must be at least 10 characters long') !!}</span>",
                        maxlength: "<span class='text-danger'>{!! __('Your Phone Number must be at least 10 characters long') !!}</span>",
                    },
                    address: {
                        required: "<span class='text-danger'>{!! __('Please enter an address') !!}</span>",
                    },
                }
            });
            $('#edit-modal-branch-valid').validate({
                rules: {
                    name: {
                        required: true,
                    },
                    phoneNumber: {
                        required: true,
                        number: true,
                        minlength: 10,
                        maxlength: 10,
                    },
                    address: {
                        required: true,
                    },
                },
                // <span class='text-danger'></span>
                messages: {
                    name: {
                        required: "<span class='text-danger'>{!! __('Please enter a branch name') !!}</span>",
                    },
                    phoneNumber :{
                        required: "<span class='text-danger'>{!! __('Please enter a Phone number') !!}</span>",
                        number: "<span class='text-danger'>{!! __('Number Only') !!}</span>",
                        minlength: "<span class='text-danger'>{!! __('Your Phone Number must be at least 10 characters long') !!}</span>",
                        maxlength: "<span class='text-danger'>{!! __('Your Phone Number must be at least 10 characters long') !!}</span>",
                    },
                    address: {
                        required: "<span class='text-danger'>{!! __('Please enter an address') !!}</span>",
                    },
                }
            });
        });

        // btn-add-branch
        $(document).off('click', '.pnt-bnt-add-branch').on('click', '.pnt-bnt-add-branch', (e) => {
            $('.map-section-show-only').hide();
            $('.pnt-modal-add-branch-name').val('');
            $('.pnt-modal-add-branch-phone').val('');
            $('.pnt-modal-add-latitude').val('');
            $('.pnt-modal-add-longitude').val('');
            $('.pnt-modal-add-address').val('');
            $(".pnt-modal-add-branch").modal();
        });
        // end-save-add-branch

        // btn-save-add-branch
        $(document).off('click', '.pnt-btn-modal-add-branch-save').on('click', '.pnt-btn-modal-add-branch-save', e => {
            if ($("#add-modal-branch-valid").valid()) {
                $.ajax({
                    type: "post",
                    url: "{!! url('manage/branches/create') !!}",
                    data: {
                        name: $('.pnt-modal-add-branch-name').val(),
                        phone_number: $('.pnt-modal-add-branch-phone').val(),
                        latitude: $('.pnt-modal-add-latitude').val(),
                        longitude: $('.pnt-modal-add-longitude').val(),
                        address: $('.pnt-modal-add-address').val(),
                        '_token': window.token,
                    },
                    beforeSend: function () {
                        $('#pnt-loading').show();
                    },
                    success: function (data) {
                        if (data.status) {
                            $('.pnt-modal-add-branch').modal('hide');
                            $('#pnt-loading').hide();
                            resetTable();
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: '{!! __('Add Branch Success fully') !!}',
                                showConfirmButton: false,
                                timer: 1500
                            })
                        }
                    },
                    error: function (jqXHR, exception) {
                        $('#pnt-loading').hide();
                        if (jqXHR.status !== 200) {
                            Swal.fire({
                                position: 'top-end',
                                icon: 'error',
                                title: '{!! __('Something went wrong') !!}',
                                showConfirmButton: false,
                                timer: 1500
                            })
                        }
                    },
                });
            }
        });
        // end-btn-save-add-branch

        // btn-edit
        $(document).off('click', '.pnt-btn-edit').on('click', '.pnt-btn-edit', (e) => {
            window.id = $(e.currentTarget).val();
            $('.map-section-show-only').hide();
            $.ajax({
                type: "get",
                url: "{!! url('manage/branches/getBranch') !!}/" + window.id,
                beforeSend: function () {
                    $('#pnt-loading').show();
                },
                success: function (data) {
                    if (data.status) {
                        $('.pnt-modal-edit-branch-name').val(data.branch.name);
                        $('.pnt-modal-edit-branch-phone').val(data.branch.phone_number);
                        $('.pnt-modal-edit-latitude').val(data.branch.latitude);
                        $('.pnt-modal-edit-longitude').val(data.branch.longitude);
                        $('.pnt-modal-edit-branch-address').val(data.branch.address);
                        $('#pnt-loading').hide();
                        $('.pnt-modal-edit').modal();
                    }
                }
            });
        });
        // end btn-edit

        // btn save update modal
        $(document).off('click', '.pnt-btn-modal-save').on('click', '.pnt-btn-modal-save', e => {
            if ($("#edit-modal-branch-valid").valid()) {
                $.ajax({
                    type: "post",
                    url: "{!! url('manage/branches/update') !!}/" + window.id,
                    data: {
                        name: $('.pnt-modal-edit-branch-name').val(),
                        phone_number: $('.pnt-modal-edit-branch-phone').val(),
                        latitude: $('.pnt-modal-edit-latitude').val(),
                        longitude: $('.pnt-modal-edit-longitude').val(),
                        address: $('.pnt-modal-edit-branch-address').val(),
                        '_token': window.token,
                    },
                    beforeSend: function () {
                        $('#pnt-loading').show();
                    },
                    success: function (data) {
                        if (data.status) {
                            $('.pnt-modal-edit').modal('hide');
                            $('#pnt-loading').hide();
                            resetTable();
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: '{!! __('Update Branch Success fully') !!}',
                                showConfirmButton: false,
                                timer: 1500
                            })
                        }
                    },
                    error: function (jqXHR, exception) {
                        if (jqXHR.status !== 200) {
                            $('#pnt-loading').hide();
                            Swal.fire({
                                position: 'top-end',
                                icon: 'error',
                                title: '{!! __('Something went wrong') !!}',
                                showConfirmButton: false,
                                timer: 1500
                            })
                        }
                    },
                });
            }
        });
        // end btn save update modal

        // btn-delete
        $(document).off('click', '.pnt-btn-delete').on('click', '.pnt-btn-delete', (e) => {
            $('.map-section-show-only').hide();
            window.id = $(e.currentTarget).val();
            Swal.fire({
                title: '{!! __('Are you sure?') !!}',
                text: "{!! __('You will not be able to revert this!') !!}",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '{!! __('Yes, delete it!') !!}',
                cancelButtonText: '{!! __('Close') !!}'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "get",
                        url: "{!! url('manage/branches/destroy') !!}/" + window.id,
                        beforeSend: function () {
                            $('#pnt-loading').show();
                        },
                        success: function (data) {
                            resetTable();
                            $('#pnt-loading').hide();
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: '{!! __('Delete Branch Success fully') !!}',
                                showConfirmButton: false,
                                timer: 1500
                            })
                        }
                    });
                }
            })
        });
        // end btn-delete

        //map-update
        $(document).off('click', '.getLatLnt').on('click', '.getLatLnt', (e) => {
            let lat = $('.pnt-modal-edit-latitude').val();
            let lng = $('.pnt-modal-edit-longitude').val();

            $('.map-section-show-only').hide();
            $('.map-section-get-only').show();
            getLatLng(lat, lng);
        });
        //end-map-update

        //map-add
        $(document).off('click', '.getLatLnt-add').on('click', '.getLatLnt-add', (e) => {
            let lat = centerLat;
            let lng = centerLng;
            $('.map-section-show-only').hide();
            $('.map-section-get-only').show();

            getLatLng(lat, lng);
        });
        //end-map-add

    </script>
@endsection
