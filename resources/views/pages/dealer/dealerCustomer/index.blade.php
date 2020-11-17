@extends('layouts.master')

@section('content')

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="dealer_id" content="{{ session()->get('dealer')[0]['id'] }}">
    <div class="col-md-12  mx-auto">
        <div class="card text-center bg-white">

            <div class="card-header">
                <h5 class="card-title text-dark">Please Selected</h5>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label> <strong>Product</strong> </label>
                            <select class="form-control pnt-sel-product">
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label> <strong>Customer</strong> </label>
                            <select class="form-control pnt-sel-customer">
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label><strong>Quantity</strong></label>
                            <input type="text" class="form-control pnt-add-quantity" required>
                            <span class="text-danger" id="quantityMax"></span>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <label><strong></strong></label>
                        <button class="mt-2 btn btn-success btn-block pnt-submit">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="card bg-white">
            <div class="card-header">
                <h4 class="card-title text-dark">Dealer Product Information</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="dealerInformation" style="min-width: 845px">
                        <thead>
                        <tr>
                            <th class="text-dark">#</th>
                            <th class="text-dark">Product</th>
                            <th class="text-dark">Max quantity</th>
                        </tr>
                        </thead>
                        <tbody class="data-section-dealer">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>





@endsection

@section('script')

    <script>
        var token = $('meta[name="csrf-token"]').attr('content');
        var dealer_id = $('meta[name="dealer_id"]').attr('content');
        var dropdown_product = $('.pnt-sel-product');
        var dropdown_customer = $('.pnt-sel-customer');
        var checkQuantity = 0;
        var product_id = $('.pnt-sel-product option:selected').val();
        var dealer_table = $('#dealerInformation').DataTable();
        var maxQuantity = 0;

        $(document).ready(function () {
            getCustomer();
            tableDealer();
            console.log(window.dealer_id);

        });

        function getCustomer() {
            $.ajax({
                type: "get",
                url: '{!! url('dealerSell/getDropdownSell') !!}',
                beforeSend: function () {
                    $('#pnt-loading').show();
                },
                success: function (data) {
                    // console.log(data)
                    if (data.status) {
                        var selected = 0;
                        var str = '';

                        $.each(data.dataSet.customer, function (index, value) {
                            if (index === 0) {
                                selected = value.id;
                            }
                            str += "<option value=" + value.id + "> <strong>" + value.name + "</strong></option>"
                        });

                        window.dropdown_customer.append(str);
                        window.dropdown_customer.selectpicker('refresh');
                        window.dropdown_customer.val(selected).change();
                        getDorpdownProduct();
                        $('#pnt-loading').hide();
                    }
                }
            });
        }

        function getDorpdownProduct() {
            $.ajax({
                type: "get",
                url: '{!! url('dealerSell/getDropdownSellProduct') !!}/' + window.dealer_id,
                success: function (data) {
                    window.dropdown_product.empty();
                    console.log(data.productDealer)
                    if (data.status) {
                        var selected = 0;
                        var str = '';
                        $.each(data.productDealer, function (index, value) {
                            console.log(value.id)
                            if (index === 0) {
                                selected = value.id;
                                window.checkQuantity = value.quantity;
                            }
                            str += "<option value=" + value.id + "> <strong>" + value.name + "</strong></option>"
                        });

                        window.dropdown_product.append(str);
                        window.dropdown_product.selectpicker('refresh');
                        window.dropdown_product.val(selected).change();
                    }
                }
            });
        }

        $(document).off('click', '.pnt-submit').on('click', '.pnt-submit', (e) => {
            var customer_id = $('.pnt-sel-customer option:selected').val();
            var product_id = $('.pnt-sel-product option:selected').val();
            var quantity = $('.pnt-add-quantity').val();

            if (quantity > 0 && quantity != '' && product_id != null) {
                $.ajax({
                    type: "post",
                    url: '{!! url('dealerSell/dealerSold') !!}',
                    data: {
                        location_product_id: product_id,
                        quantity: quantity,
                        dealer_id: window.dealer_id,
                        customer_id: customer_id,
                        '_token': window.token,
                    },
                    beforeSend: function () {
                        $('#pnt-loading').show();
                    },
                    success: function (data) {
                        console.log(data)
                        tableDealer();
                        updateMaxQuantity();
                        $('.pnt-add-quantity').val('');
                        $('#pnt-loading').hide();
                        if (data.status) {
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Sold Product Success fully',
                                showConfirmButton: false,
                                timer: 1500
                            })
                        } else {
                            Swal.fire({
                                position: 'top-end',
                                icon: 'error',
                                title: data.msg,
                                showConfirmButton: false,
                                timer: 1500
                            })
                        }
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
                $('#pnt-loading').hide();
            }
        });

        function tableDealer() {
            console.log(window.product_id)
            $.ajax({
                type: "get",
                url: '{!! url('dealerSell/getDropdownSellProduct') !!}/' + window.dealer_id,
                success: function (data) {
                    if (data.status) {
                        dealer_table.destroy();
                        $('.data-section-dealer').html(null);
                        $.each(data.productDealer, function (index, value) {
                            let localHtml = "<tr><td>" +
                                (index + 1) +
                                "</td><td>" +
                                value.name +
                                "</td><td>" +
                                value.quantity +
                                "</td></tr>";

                            $('.data-section-dealer').append(localHtml)
                        });
                        dealer_table = $('#dealerInformation').DataTable();
                    }
                }
            });
        }

        function updateMaxQuantity() {
            var product_id = $('.pnt-sel-product option:selected').val();
            $.ajax({
                type: "get",
                url: '{!! url('dealerSell/getProductInDealer') !!}/' + product_id + "&" + window.dealer_id,
                success: function (data) {
                    console.log(data)
                    if (data.product != null) {
                        $("#quantityMax").text("Max Quantity : " + data.product.quantity);
                        window.maxQuantity = data.product.quantity;
                    }
                }
            });
        }

        $(document).off('change', '.pnt-sel-product').on('change', '.pnt-sel-product', (e) => {
            window.product_id = $('.pnt-sel-product option:selected').val();
            updateMaxQuantity();
        });



    </script>
@endsection
