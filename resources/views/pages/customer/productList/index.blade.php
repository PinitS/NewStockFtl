@extends('layouts.master')

@section('content')

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="row">
        <div class="col-12">
            <div class="card bg-white">
                <div class="card-header">
                    <h4 class="card-title text-dark">Product List ({{ session()->get('customer')[0]['name'] }})</h4>
                    <button type="button" class="btn btn-warning text-white pnt-bnt-add-detail">Add <span class="btn-icon-right"><i
                                class="fa fa-plus color-warning"></i></span>
                    </button>
                </div>
                <div class="card-body">
                    <div class="div">
                        <div class="table-responsive">
                            <table id="detailInformation" style="min-width: 845px">
                                <thead>
                                <tr>
                                    <th class="text-dark">#</th>
                                    <th class="text-dark">Serial Number</th>
                                    <th class="text-dark">Product</th>
                                    <th class="text-dark">Model</th>
                                    <th class="text-dark">Status</th>
                                    <th class="text-dark">Sku</th>
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
    </div>

    {{--    modal add detail--}}
    <div class="modal fade pnt-modal-add-detail" id="pnt-modal-add-product">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Product</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="input-group mb-3 ">
                        <div class="input-group-prepend w-10">
                            <span class="input-group-text">&nbsp Product</span>
                        </div>
                        <select class="form-control pnt-modal-sel-add-detail-product">
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="mb-1"><strong>Quantity</strong></label>
                        <input type="number" class="form-control pnt-modal-add-detail-quantity">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger light" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary pnt-btn-modal-add-detail-save">Add Serial</button>
                </div>
            </div>
        </div>
    </div>
    {{--    end modal add detail--}}

    {{--    modal update--}}
    <div class="modal fade pnt-modal-edit " id="exampleModalCenter">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Serial</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">

{{--                    <div class="input-group mb-3 ">--}}
{{--                        <div class="input-group-prepend w-10">--}}
{{--                            <span class="input-group-text">&nbsp Product</span>--}}
{{--                        </div>--}}
{{--                        <select class="form-control pnt-modal-sel-edit-detail-product">--}}
{{--                        </select>--}}
{{--                    </div>--}}

                    <div class="input-group mb-3 ">
                        <div class="input-group-prepend w-10">
                            <span class="input-group-text">Customer</span>
                        </div>
                        <select class="form-control pnt-modal-sel-edit-product-location">
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="mb-1"><strong>Serial</strong></label>
                        <input type="text" class="form-control pnt-modal-edit-detail-code"
                               placeholder="Name" required>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="mb-1"><strong>Latitude</strong></label>
                                <input type="text" class="form-control pnt-modal-edit-latitude" id="latitude" name="latitude" value="" readonly>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="mb-1"><strong>Longitude</strong></label>
                                <input type="text" class="form-control pnt-modal-edit-longitude" id="longitude" name="longitude" value="" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <a class="btn btn-success btn-block text-white getLatLnt" style="cursor:pointer;">Select Location</a>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="mb-1"><strong>Sku</strong></label>
                        <input type="text" class="form-control pnt-modal-edit-detail-sku">
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger light" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-warning pnt-btn-modal-edit-product-save">Save changes</button>
                </div>

            </div>
        </div>
    </div>
    {{--    modal update--}}

@endsection


@section('script')

    <script>

        var token = $('meta[name="csrf-token"]').attr('content');
        var id = 0;
        var table = $('#detailInformation').DataTable();

        function getOptionDropdown() {
            var addProduct = $('.pnt-modal-sel-add-detail-product');
            var editProduct = $('.pnt-modal-sel-edit-detail-product');

            var addLocation = $('.pnt-modal-sel-add-product-location');
            var editLocation = $('.pnt-modal-sel-edit-product-location');

            $.ajax({
                type: "get",
                url: '{!! url('product_location/product_detail/getDetails') !!}',
                success: function (data) {
                    // console.log(data);
                    if (data.status) {
                        var product = "<option value=" + 0 + "> <strong>" + "All product" + "</strong></option>";
                        $.each(data.dataSet.product, function (index, value) {
                            product += "<option value=" + value.id + "> <strong>" + value.name + "</strong></option>"
                        });
                        addProduct.append(product);
                        addProduct.selectpicker('refresh');
                        editProduct.append(product);
                        editProduct.selectpicker('refresh');

                        var location = "<option value=" + 0 + "> <strong>" + "All location" + "</strong></option>";
                        $.each(data.dataSet.location, function (index, value) {
                            location += "<option value=" + value.id + "> <strong>" + value.name + "</strong></option>"
                        });

                        addLocation.append(location);
                        editLocation.append(location);
                        addLocation.selectpicker('refresh');
                        editLocation.selectpicker('refresh');
                    }
                }
            });
        }

        function resetTable() {
            $.ajax({
                type: "get",
                url: '{!! url('product_location/product_detail/getDetails') !!}',
                success: function (data) {
                    console.log(data)
                    // console.log(data.dataSet.detail.name)
                    // console.log(data.dataSet.detail.latitude)
                    // console.log(data.dataSet.detail.longitude)

                    if (data.status) {
                        window.table.destroy();
                        $('.data-section').html(null);

                        $.each(data.dataSet.detail.product_lists, function (index, value) {
                            $('.data-section').append(
                                "<tr><td>" +
                                (index + 1) +
                                "</td><td>" +
                                value.location_product_details[0]['code'] +
                                "</td><td>" +
                                value.location_product.name +
                                "</td><td>" +
                                value.location_product.location_model.name +
                                "</td><td>" +
                                "<select class='form-control pnt-modal-sel-change-status-detail-product" + index + "' id='pnt-modal-sel-change-status-detail-product' data-id='" + value.location_product_details[0]['id'] + "'></select>" +
                                "</td><td>" +
                                value.location_product_details[0]['sku']+
                                "</td><td>" +
                                "<div class = 'd-flex'>" +
                                "<button  class='btn btn-info text-white shadow btn-xs sharp mr-1' onclick='showOnMap(" + value.location_product_details[0]['latitude'] + ", " + value.location_product_details[0]['longitude'] + ")'><i class='fa fa-map-marker'></i></button>"+
                                "<button  class='btn btn-warning text-white pnt-btn-edit shadow btn-xs sharp mr-1' value = '" + value.location_product_details[0]['id'] + "' data-id = '" + value.location_product_details[0]['id'] + "'><i class='fa fa-pencil-square-o'></i></button>" +
                                "<button  class='btn btn-danger pnt-btn-delete shadow btn-xs sharp mr-1' value = '" + value.location_product_details[0]['id'] + "' ><i class= 'fa fa-trash'></i></button>"
                            )

                            var status_dropdown = $('.pnt-modal-sel-change-status-detail-product' + index);
                            var status_option = 0;

                            $.each(data.dataSet.option, function (index, option_value) {
                                var checked = false
                                parseInt(value.location_product_details[0]['status']) === index ? checked = true : false;
                                status_option += "<option " + (checked ? 'selected' : '') + " value='" + index + "'> <strong>" + option_value + "</strong></option>"
                            });
                            status_dropdown.append(status_option);
                            status_dropdown.selectpicker('refresh');

                        });
                        window.table = $('#detailInformation').DataTable();
                    }
                }
            });
        }

        $(document).ready(function () {
            resetTable();
            getOptionDropdown();
        });

        // btn-add-detail
        $(document).off('click', '.pnt-bnt-add-detail').on('click', '.pnt-bnt-add-detail', (e) => {
            $(".pnt-modal-add-detail").modal();
        });
        // end-save-add-detail

        // btn-save-add-detail
        $(document).off('click', '.pnt-btn-modal-add-detail-save').one('click', '.pnt-btn-modal-add-detail-save', e => {
            var product_id = $(".pnt-modal-sel-add-detail-product option:selected").val();

            console.log(product_id);
            if (product_id == 0) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: 'Please Select Product',
                    showConfirmButton: false,
                    timer: 1500
                })
            } else {
                if($('.pnt-modal-add-detail-quantity').val() <= 0)
                {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: 'Quantity went wrong',
                        showConfirmButton: false,
                        timer: 1500
                    })
                }
                else{
                    $.ajax({
                        type: "post",
                        url: '{{route('createDetail')}}',
                        data: {
                            location_product_id: product_id,
                            quantity: $('.pnt-modal-add-detail-quantity').val(),
                            '_token': window.token,
                        },
                        success: function (data) {
                            console.log(data)
                            if (data.status) {
                                $(".pnt-modal-add-detail").modal('hide');
                                resetTable();
                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    title: 'Add Serial Success fully',
                                    showConfirmButton: false,
                                    timer: 1500
                                })
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

                }

            }
        });
        // end-btn-save-add-detail

        // pnt-btn-edit
        $(document).off('click', '.pnt-btn-edit').on('click', '.pnt-btn-edit', (e) => {
            window.id = $(e.currentTarget).val();
            console.log(window.id);
            $.ajax({
                type: "get",
                url: '{!! url('product_location/product_detail/getOneDetail') !!}/'+ window.id,
                success: function (data) {
                    if (data.status) {
                        console.log(data)
                        // $(".pnt-modal-sel-edit-detail-product").val(data.product.location_product_id).change();
                        $(".pnt-modal-sel-edit-product-location").val(data.product.location_product_list.location_id).change();
                        $('.pnt-modal-edit-detail-code').val(data.product.code);
                        $('.pnt-modal-edit-latitude').val(data.product.latitude);
                        $('.pnt-modal-edit-longitude').val(data.product.longitude);
                        $('.pnt-modal-edit-detail-sku').val(data.product.sku);
                    }
                }
            });
            $(".pnt-modal-edit").modal();
        });
        // end-pnt-btn-edit

        // pnt-btn-edit-save
        $(document).off('click', '.pnt-btn-modal-edit-product-save').on('click', '.pnt-btn-modal-edit-product-save', (e) => {
            // var product_id = $(".pnt-modal-sel-edit-detail-product option:selected").val();
            var location_id = $(".pnt-modal-sel-edit-product-location option:selected").val();
            if (location_id == 0) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: 'Please Select Customer',
                    showConfirmButton: false,
                    timer: 1500
                })
            } else {
                $.ajax({
                    type: "post",
                    url: '{!! url('product_location/product_detail/update') !!}/'+ window.id,
                    data: {
                        // location_product_id: product_id,
                        location_id: location_id,
                        code: $('.pnt-modal-edit-detail-code').val(),
                        latitude: $('.pnt-modal-edit-latitude').val(),
                        longitude: $('.pnt-modal-edit-longitude').val(),
                        sku: $('.pnt-modal-edit-detail-sku').val(),
                        '_token': window.token,
                    },
                    success: function (data) {
                        if (data.status) {
                            $(".pnt-modal-edit").modal('hide');
                            resetTable();
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Update Serial Success fully',
                                showConfirmButton: false,
                                timer: 1500
                            })
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
            }
        });
        // end-pnt-btn-edit-save

        // btn-delete
        $(document).off('click', '.pnt-btn-delete').on('click', '.pnt-btn-delete', (e) => {
            window.id = $(e.currentTarget).val();
            console.log($(e.currentTarget).val());
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
                        url: '{!! url('product_location/product_detail/destroy') !!}/'+ window.id,
                        success: function (data) {
                            resetTable();

                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Delete Serial Success fully',
                                showConfirmButton: false,
                                timer: 1500
                            })
                        }
                    });
                }
            })
        });
        // end btn-delete

        // pnt-modal-sel-change-status-detail-product
        $(document).off('change', '#pnt-modal-sel-change-status-detail-product').on('change', '#pnt-modal-sel-change-status-detail-product', (e) => {

            window.id = $(e.currentTarget).attr('data-id');
            console.log(window.id)
            var status_id = $(e.currentTarget).find(':selected').val();
            console.log(status_id)

            $.ajax({
                type: "post",
                url: '{!! url('product_location/product_detail/changeStatus') !!}/'+ window.id,
                data: {
                    status: status_id,
                    '_token': window.token,
                },
                success: function (data) {
                    if (data.status) {
                        resetTable();
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Update Status fully',
                            showConfirmButton: false,
                            timer: 1500
                        })
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
        // end-pnt-modal-sel-change-status-detail-product

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
            console.log()
            let lat = centerLat;
            let lng = centerLng;
            console.log(lat , lng)

            $('.map-section-show-only').hide();
            $('.map-section-get-only').show();
            getLatLng(lat, lng);
        });
        //end-map-add

    </script>
@endsection
