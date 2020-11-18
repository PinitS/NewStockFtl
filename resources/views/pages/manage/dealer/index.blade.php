@extends('layouts.master')

@section('content')

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="row">
        <div class="col-12">
            <div class="card bg-white">
                <div class="card-header">
                    <h4 class="card-title text-dark">Dealer Information</h4>
                    <button type="button" class="btn btn-info pnt-bnt-add-dealer">Add <span class="btn-icon-right"><i
                                class="fa fa-plus color-info"></i></span>
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="dealerInformation" style="min-width: 845px">
                            <thead>
                            <tr>
                                <th class="text-dark">#</th>
                                <th class="text-dark">Name</th>
                                <th class="text-dark">Contact Name</th>
                                <th class="text-dark">Phone Number</th>
                                <th class="text-dark">Address</th>
                                <th class="text-dark">Manage</th>
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

    {{--    modal add Dealer--}}
    <form id="add-modal-dealer-valid">
        <div class="modal fade pnt-modal-add-dealer" id="exampleModalCenter">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Dealer</h5>
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label class="mb-1"><strong>Name</strong></label>
                            <input type="text" class="form-control pnt-modal-add-dealer-name" id="name" name="name"
                                   required>
                        </div>
                        <div class="form-group">
                            <label class="mb-1"><strong>Contact Name</strong></label>
                            <input type="text" class="form-control pnt-modal-add-dealer-contact " id="contact"
                                   name="contact">
                        </div>
                        <div class="form-group">
                            <label class="mb-1"><strong>Phone Number</strong></label>
                            <input type="text" class="form-control pnt-modal-add-dealer-phone" id="phoneNumber"
                                   name="phoneNumber"
                                   required>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mb-3 mt-1">
                                <a class="btn btn-success btn-block text-white getLatLnt-add" style="cursor:pointer;">Select
                                    Location</a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="mb-1"><strong>Latitude</strong></label>
                                    <input type="text" class="form-control pnt-modal-add-latitude" id="latitude"
                                           name="latitude" value="" readonly>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="mb-1"><strong>Longitude</strong></label>
                                    <input type="text" class="form-control pnt-modal-add-longitude" id="longitude"
                                           name="longitude" value="" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="mb-1"><strong>Address</strong></label>
                            <input type="text" class="form-control pnt-modal-add-dealer-address" id="address"
                                   name="address" value="" required>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger light" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary pnt-btn-modal-add-dealer-save">Add Dealer</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    {{--    end modal add Dealer--}}

    {{--modal update--}}
    <form id="edit-modal-dealer-valid">
        <div class="modal fade pnt-modal-dealer-edit " id="exampleModalCenter">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Dealer</h5>
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label class="mb-1"><strong>Dealer</strong></label>
                            <input type="text" class="form-control pnt-modal-edit-dealer-name" id="name" name="name"
                                   required>
                        </div>
                        <div class="form-group">
                            <label class="mb-1"><strong>Contact Name</strong></label>
                            <input type="text" class="form-control pnt-modal-edit-dealer-contact " id="contact"
                                   name="contact">
                        </div>
                        <div class="form-group">
                            <label class="mb-1"><strong>Phone Number</strong></label>
                            <input type="text" class="form-control pnt-modal-edit-dealer-phone" id="phoneNumber"
                                   name="phoneNumber"
                                   required>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mt-1 mb-3">
                                <a class="btn btn-success btn-block text-white getLatLnt" style="cursor:pointer;">Select
                                    Location</a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="mb-1"><strong>Latitude</strong></label>
                                    <input type="text" class="form-control pnt-modal-edit-latitude" id="latitude"
                                           name="latitude" value="" readonly>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="mb-1"><strong>Longitude</strong></label>
                                    <input type="text" class="form-control pnt-modal-edit-longitude" id="longitude"
                                           name="longitude" value="" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="mb-1"><strong>Address</strong></label>
                            <input type="text" class="form-control pnt-modal-edit-dealer-address" id="address"
                                   name="address" value="" required>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger light" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary pnt-btn-modal-save-dealer">Save changes</button>
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
        var table = $('#dealerInformation').DataTable();

        function resetTable() {
            $.ajax({
                type: "get",
                url: "{!! url('manage/dealer/getDealers') !!}",
                beforeSend: function () {
                    $('#pnt-loading').show();
                },
                success: function (data) {
                    console.log(data)
                    if (data.status) {
                        table.destroy();
                        $('.data-section').html(null);
                        $.each(data.dealers, function (index, value) {
                            let localHtml = "<tr><td>" +
                                (index + 1) +
                                "</td><td>" +
                                value.name +
                                "</td><td>" +
                                (value.contact_name == null ? "-" : value.contact_name) +
                                "</td><td>" +
                                (value.phone_number == null ? "-" : value.phone_number) +
                                "</td><td>" +
                                value.address +
                                "</td><td>" +
                                "<div class = 'd-flex'>" +
                                "<button  class='btn btn-info text-white shadow btn-xs sharp mr-1' onclick='showOnMap(" + value.latitude + ", " + value.longitude + ")'><i class='fa fa-map-marker'></i></button>" +
                                "<button  class='btn btn-warning text-white pnt-btn-edit shadow btn-xs sharp mr-1' value = '" + value.id + "' ><i class='fa fa-pencil-square-o'></i></button>";

                            if (value.delete_active) {
                                localHtml += "<button  class='btn btn-danger pnt-btn-delete shadow btn-xs sharp mr-1' value = '" + value.id + "' ><i class= 'fa fa-trash'></i></button>";
                            }

                            $('.data-section').append(localHtml)
                        });
                        table = $('#dealerInformation').DataTable();
                        $('#pnt-loading').hide();
                    }
                }
            });
        }

        $(document).ready(function () {
            resetTable();

            $('#add-modal-dealer-valid').validate({
                rules: {
                    name: {
                        required: true,
                    },
                    phoneNumber: {
                        required: true,
                        number: true,
                        minlength: 9,
                        maxlength: 10,
                    },
                    address: {
                        required: true,
                    },
                },
                // <span class='text-danger'></span>
                messages: {
                    name: {
                        required: "<span class='text-danger'>Please enter a dealer name</span>",
                    },
                    phoneNumber: "<span class='text-danger' >Enter phone number</span>",
                    address: {
                        required: "<span class='text-danger'>Please enter an address</span>",
                    },
                }
            });
            $('#edit-modal-dealer-valid').validate({
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
                        required: "<span class='text-danger'>Please enter a dealer name</span>",
                    },
                    phoneNumber: "<span class='text-danger' >Enter phone number</span>",
                    address: {
                        required: "<span class='text-danger'>Please enter address</span>",
                    },
                }
            });
        });


        // btn-add-Dealer
        $(document).off('click', '.pnt-bnt-add-dealer').on('click', '.pnt-bnt-add-dealer', (e) => {
            $('.map-section-show-only').hide();
            $('.pnt-modal-add-dealer-name').val('');
            $('.pnt-modal-add-dealer-contact').val('');
            $('.pnt-modal-add-dealer-phone').val('');
            $('.pnt-modal-add-latitude').val('');
            $('.pnt-modal-add-longitude').val('');
            $('.pnt-modal-add-dealer-address').val('');
            $(".pnt-modal-add-dealer").modal();
        });
        // end-save-add-Dealer

        // btn-save-add-Dealer
        $(document).off('click', '.pnt-btn-modal-add-dealer-save').on('click', '.pnt-btn-modal-add-dealer-save', e => {
            if ($("#add-modal-dealer-valid").valid()) {
                $.ajax({
                    type: "post",
                    url: "{!! url('manage/dealer/create') !!}",
                    data: {
                        name: $('.pnt-modal-add-dealer-name').val(),
                        contact_name: $('.pnt-modal-add-dealer-contact').val(),
                        phone_number: $('.pnt-modal-add-dealer-phone').val(),
                        latitude: $('.pnt-modal-add-latitude').val(),
                        longitude: $('.pnt-modal-add-longitude').val(),
                        address: $('.pnt-modal-add-dealer-address').val(),
                        '_token': window.token,
                    },
                    beforeSend: function () {
                        $('#pnt-loading').show();
                    },
                    success: function (data) {
                        if (data.status) {
                            $('.pnt-modal-add-dealer').modal('hide');
                            $('#pnt-loading').hide();
                            resetTable();
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Add Dealer Success fully',
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
                                title: 'Something went wrong',
                                showConfirmButton: false,
                                timer: 1500
                            })
                        }
                    },
                });
            }
        });
        // end-btn-save-add-Dealer

        // btn-delete
        $(document).off('click', '.pnt-btn-delete').on('click', '.pnt-btn-delete', (e) => {
            $('.map-section-show-only').hide();
            window.id = $(e.currentTarget).val();
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "get",
                        url: "{!! url('manage/dealer/destroy') !!}/" + window.id,
                        beforeSend: function () {
                            $('#pnt-loading').show();
                        },
                        success: function (data) {
                            if (data.status) {
                                resetTable();
                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    title: 'Delete Customer Success fully',
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                            } else {
                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'error',
                                    title: "Can't Delete this Dealer",
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                            }
                            $('#pnt-loading').hide();
                        }
                    });
                }
            })
        });
        // end btn-delete


        // btn-edit
        $(document).off('click', '.pnt-btn-edit').on('click', '.pnt-btn-edit', (e) => {
            window.id = $(e.currentTarget).val();
            $('.map-section-show-only').hide();

            $.ajax({
                type: "get",
                url: "{!! url('manage/dealer/getOneDealer') !!}/" + window.id,
                success: function (data) {
                    if (data.status) {
                        $(".pnt-modal-edit-dealer-name").val(data.dealer.name);
                        $('.pnt-modal-edit-dealer-contact').val(data.dealer.contact_name);
                        $(".pnt-modal-edit-dealer-phone").val(data.dealer.phone_number);
                        $(".pnt-modal-edit-latitude").val(data.dealer.latitude);
                        $(".pnt-modal-edit-longitude").val(data.dealer.longitude);
                        $(".pnt-modal-edit-dealer-address").val(data.dealer.address);
                        $(".pnt-modal-dealer-edit").modal();
                    }
                }
            });
        });
        // end btn-edit

        // btn save edit modal
        $(document).off('click', '.pnt-btn-modal-save-dealer').on('click', '.pnt-btn-modal-save-dealer', e => {
            if ($("#edit-modal-dealer-valid").valid()) {
                $.ajax({
                    type: "post",
                    url: "{!! url('manage/dealer/update') !!}/" + window.id,
                    data: {
                        name: $('.pnt-modal-edit-dealer-name').val(),
                        contact_name: $('.pnt-modal-edit-dealer-contact').val(),
                        phone_number: $('.pnt-modal-edit-dealer-phone').val(),
                        latitude: $('.pnt-modal-edit-latitude').val(),
                        longitude: $('.pnt-modal-edit-longitude').val(),
                        address: $('.pnt-modal-edit-dealer-address').val(),
                        '_token': window.token,
                    },
                    beforeSend: function () {
                        $('#pnt-loading').show();
                    },
                    success: function (data) {
                        if (data.status) {
                            $('.pnt-modal-dealer-edit').modal('hide');
                            resetTable();
                            $('#pnt-loading').hide();
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Update Dealer Success fully',
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
                                title: 'Something went wrong',
                                showConfirmButton: false,
                                timer: 1500
                            })
                        }
                    },
                });
            }
        });
        // end btn save edit modal


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
