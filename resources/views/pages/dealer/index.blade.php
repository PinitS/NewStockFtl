@extends('layouts.master')

@section('content')

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <input type="hidden" id="pnt-input-dealer_id" name="pnt-input-dealer_id" runat="server"
           value="{{ session()->get('dealer')[0]['id'] }}"/>


    <div class="row">
        <div class="col-12">
            <div class="card bg-white">
                <div class="card-header">
                    <h4 class="card-title text-dark">Dealer Product</h4>
                    <button type="button" class="btn btn-success pnt-bnt-add-product">Add <span
                            class="btn-icon-right"><i
                                class="fa fa-plus color-danger"></i></span>
                    </button>
                </div>
                <div class="card-body">
                    <div class="div">
                        <div class="table-responsive">
                            <table id="data_product_dealer" style="min-width: 845px">
                                <thead>
                                <tr>
                                    <th class="text-dark">#</th>
                                    <th class="text-dark">Product</th>
                                    <th class="text-dark">Quantity</th>
                                    <th class="text-dark">Manage</th>
                                </tr>
                                </thead>
                                <tbody class="data-section_product_dealer">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{--    modal add parts--}}
    <form id="add-product-dealer">
        <div class="modal fade pnt-modal-add-product">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Product Dealer</h5>
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label class="mb-1"><strong>Products</strong></label>
                            <select class="form-control pnt-modal-sel-add-product">
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="mb-1"><strong>Quantity</strong></label>
                            <input type="number" class="form-control pnt-modal-add-product-quantity" id="quantity"
                                   name="quantity" required>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger light" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-success pnt-btn-modal-add-product-save">Add Product
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    {{--    end modal add parts--}}

    {{--    modal plus--}}
    <div class="modal fade pnt-modal-plus " id="exampleModalCenter">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Increment Quantity</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <span>Quantity : </span><span id="modal-plus-quantity"></span>

                    <div class="input-group mt-3 input-success-o">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-plus"></i></span>
                        </div>
                        <input type="number" class="form-control pnt-plus-quantity" value="" autofocus>
                        <input type="text" class="form-control pnt-plus-detail" placeholder="Description...">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger light" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success pnt-btn-modal-plus-save">Save changes</button>
                </div>

            </div>
        </div>
    </div>
    {{--    end modal plus--}}


    {{--    modal history--}}
    <div class="modal fade bd-example-modal-lg pnt-modal-history" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Dealer Product</h5>
                    <button type="button" class="close pnt-data-history-close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table id="productHistory" style="min-width: 845px">
                                    <thead>
                                    <tr>
                                        <th class="text-dark">#</th>
                                        <th class="text-dark">Type</th>
                                        <th class="text-dark">Quatity</th>
                                        <th class="text-dark">Detail</th>
                                        <th class="text-dark">User</th>
                                        <th class="text-dark">date</th>
                                    </tr>
                                    </thead>
                                    <tbody class="data-section-history">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--    end modal history--}}




@endsection



@section('script')

    <script>
        var token = $('meta[name="csrf-token"]').attr('content');
        var id = 0;
        var table = $('#data_product_dealer').DataTable();
        var table_history = $('#productHistory').DataTable();
        var product_sel = $('.pnt-modal-sel-add-product').select2();
        var dealer_id = $('#pnt-input-dealer_id').val();


        function getOptionDropdown() {
            $.ajax({
                type: "get",
                url: '{!! url('product_location/product/getProducts') !!}',
                success: function (data) {
                    // console.log(data)
                    window.product_sel.empty();
                    if (data.status) {
                        var select_value = 0;
                        var str = "";
                        $.each(data.dataSet.product, function (index, value) {
                            if (index === 0) {
                                select_value = value.id;
                            }
                            str += "<option value=" + value.id + "> <strong>" + value.name + "</strong></option>"
                        });
                        window.product_sel.append(str);
                        window.product_sel.selectpicker('refresh');
                        $('.pnt-modal-sel-add-product').val(select_value).change();
                    }
                }
            });
        }

        function resetTable() {
            $.ajax({
                type: "get",
                url: '{!! url('dealer/getDealerProductById') !!}/' + window.dealer_id,
                beforeSend: function () {
                    $('#pnt-loading').show();
                },
                success: function (data) {
                    if (data.status) {
                        console.log(data)
                        window.table.destroy();
                        $('.data-section_product_dealer').html(null);
                        $.each(data.dealerProduct, function (index, value) {

                            let dataLocal = "<tr><td>" +
                                (index + 1) +
                                "</td><td>" +
                                value.location_product.name +
                                "</td><td>" +
                                value.quantity +
                                "</td><td>" +
                                "<div class = 'd-flex'>" +
                                "<button  class='btn btn-success text-white pnt-btn-plus shadow btn-xs sharp mr-1' value = '" + value.id + "' data-id = '" + 0 + "'><i class='fa fa-plus'></i></button>" +
                                "<button  class='btn btn-secondary text-white pnt-btn-history shadow btn-xs sharp mr-1' value = '" + value.id + "' ><i class='fa fa-history'></i></button>";
                            if (value.delete_active) {
                                dataLocal += "<button  class='btn btn-danger pnt-btn-delete shadow btn-xs sharp mr-1' value = '" + value.id + "' ><i class= 'fa fa-trash'></i></button>";
                            }
                            $('.data-section_product_dealer').append(dataLocal)
                        });
                        window.table = $('#data_product_dealer').DataTable();
                        $('#pnt-loading').hide();
                    }
                }
            });
        }


        $(document).ready(function () {
            getOptionDropdown();
            resetTable();

            $('#add-product-dealer').validate({
                rules: {
                    quantity: {
                        required: true,
                    },
                },
                messages: {
                    quantity: {
                        required: "<span class='text-danger'>Please insert quantity</span>",
                    },
                }
            });

        });


        // btn-add-products-open-modal
        $(document).off('click', '.pnt-bnt-add-product').on('click', '.pnt-bnt-add-product', (e) => {
            $('pnt-bnt-add-parts').prop('disabled', false);
            $('.pnt-modal-add-product-quantity').val(''),
            $('.pnt-modal-add-product').modal();
        });
        // end-btn-add-products-open-modal

        // btn-add-products
        $(document).off('click', '.pnt-btn-modal-add-product-save').on('click', '.pnt-btn-modal-add-product-save', (e) => {
            if ($("#add-product-dealer").valid()) {
                $('pnt-bnt-add-parts').prop('disabled', true);
                if ($('.pnt-modal-add-product-quantity').val() > 0) {
                    $.ajax({
                        type: "post",
                        url: '{!! url('dealer/create') !!}',
                        data: {
                            dealer_id: window.dealer_id,
                            quantity: $('.pnt-modal-add-product-quantity').val(),
                            location_product_id: $('.pnt-modal-sel-add-product option:selected').val(),
                            product_name: $('.pnt-modal-sel-add-product option:selected').text(),

                            '_token': window.token,
                        },
                        beforeSend: function () {
                            $('#pnt-loading').show();
                        },
                        success: function (data) {
                            console.log(data)
                            if (data.status) {
                                // resetTable();
                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    title: 'Add Dealer Product Success fully.',
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                            } else {
                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'error',
                                    title: 'Duplicate Product',
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                            }
                            $('pnt-bnt-add-parts').prop('disabled', false);
                            resetTable();
                            $('.pnt-modal-add-product').modal('hide');
                            $('#pnt-loading').hide();
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
                                $('pnt-bnt-add-parts').prop('disabled', false);
                                $('#pnt-loading').hide();
                            }
                        },
                    });
                } else {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: 'Quantity went wrong',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    $('.pnt-btn-modal-add-product-save').prop('disabled', false);
                }
            }
        });
        // end-btn-add-products

        // btn-delete-products-open-modal
        $(document).off('click', '.pnt-btn-delete').on('click', '.pnt-btn-delete', (e) => {
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
                        url: "{!! url('dealer/destroy') !!}/" + window.id,
                        beforeSend: function () {
                            $('#pnt-loading').show();
                        },
                        success: function (data) {
                            resetTable();
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Delete Dealer Product Success fully',
                                showConfirmButton: false,
                                timer: 1500
                            })
                            $('#pnt-loading').hide();
                        }
                    });
                }
            })
        });
        // end-btn-delete-products-open-modal

        // btn-history
        $(document).off('click', '.pnt-btn-history').on('click', '.pnt-btn-history', (e) => {
            window.id = $(e.currentTarget).val();
            console.log(id);
            $.ajax({
                type: "get",
                url: '{!! url('dealer/getDealerProductHistory') !!}/' + window.id,
                beforeSend: function () {
                    $('#pnt-loading').show();
                },
                success: function (data) {
                    console.log(data)
                    if (data.status) {
                        window.table_history.destroy();
                        $('.data-section-history').html(null);
                        $.each(data.history, function (index, value) {
                            var text = '';
                            var date = moment(value.created_at).format('DD/MM/YYYY, h:mm:ss a');

                            (value.type == 0 ? text = 'Imported' : text = 'Withdraw')
                            $('.data-section-history').append(
                                "<tr><td>" +
                                (index + 1) +
                                "</td><td>" +
                                text +
                                "</td><td>" +
                                value.quantity +
                                "</td><td>" +
                                value.detail +
                                "</td><td>" +
                                (value.user == null? "-" : value.user.name) +
                                "</td><td>" +
                                date +
                                "</td></tr>"
                            )
                        });
                        window.table_history = $('#productHistory').DataTable();
                        $('.pnt-modal-history').modal();
                        $('#pnt-loading').hide();
                    }
                }
            });
        });
        // end-btn-history

        $(document).off('click', '.pnt-btn-plus').on('click', '.pnt-btn-plus', (e) => {
            window.id = $(e.currentTarget).val();
            $.ajax({
                type: "get",
                url: '{!! url('dealerSell/getProductInDealer') !!}/' + window.product_id + "&" + window.dealer_id,
                beforeSend: function () {
                    $('#pnt-loading').show();
                },
                success: function (data) {
                    $('.pnt-btn-modal-plus-save').prop('disabled', false);
                    $('.pnt-modal-plus').modal();
                    $('#pnt-loading').hide();

                }
            });
        });

        $(document).off('click', '.pnt-btn-modal-plus-save').on('click', '.pnt-btn-modal-plus-save', (e) => {
            console.log('save')
            if ($('.pnt-plus-quantity').val() > 0) {
                $('.pnt-btn-modal-plus-save').prop('disabled', false);
                $.ajax({
                    type: "post",
                    url: "{!! url('dealer/addQuantity') !!}/" + window.id,
                    data: {
                        quantity: $('.pnt-plus-quantity').val(),
                        description: $('.pnt-plus-detail').val(),
                        '_token': window.token,
                    },
                    beforeSend: function () {
                        $('#pnt-loading').show();
                    },
                    success: function (data) {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Import Quantity Success fully',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        console.log(data)
                        resetTable()
                        $('.pnt-modal-plus').modal('hide');
                        $('.pnt-plus-detail ').val('');
                        $('.pnt-plus-quantity ').val('');
                        $('#pnt-loading').hide();
                    }
                });
            } else {
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: 'Quantity went wrong',
                    showConfirmButton: false,
                    timer: 1500
                })
            }

        });
    </script>




@endsection
