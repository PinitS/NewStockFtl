@extends('layouts.master')

@section('content')

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="row">
        <div class="col-12">
            <div class="card bg-white">
                <div class="card-header">
                    <h4 class="card-title text-dark">@lang('Calculator Information')</h4>

                    <div class="row pull-right text-center ">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group  pull-right justify-content-sm-end mt-2 mt-sm-0 d-flex">
                                    <select class="form-control mr-2 pnt-sel-filter-product">
                                    </select>
                                    <input class="form-control col-md-4 pnt-input-cal-value" type="number" value="1">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group  pull-right justify-content-sm-end mt-2 mt-sm-0 d-flex">
                                    <p class="text-success pnt-sum-cost"></p>

                                </div>
                            </div>
                        </div>


                    </div>

                </div>
                <div class="card-body">
                    <div class="div">
                        <div class="table-responsive">
                            <table id="calculatorInformation" style="min-width: 845px">
                                <thead>
                                <tr>
                                    <th class="text-dark">#</th>
                                    <th class="text-dark">@lang('Parts')</th>
                                    <th class="text-dark">@lang('UseQuantity/Unit')</th>
                                    <th class="text-dark">@lang('UseQuantity')</th>
                                    <th class="text-dark">@lang('Unit')</th>
                                    <th class="text-dark">@lang('StockQuantity')</th>
                                    <th class="text-dark">@lang('Requirement')</th>
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

@endsection



@section('script')

    <script>

        var token = $('meta[name="csrf-token"]').attr('content');
        var table = $('#calculatorInformation').DataTable();
        var selProduct = $('.pnt-sel-filter-product');

        let product_id = $('.pnt-sel-filter-product option:selected').val();
        let value = $('.pnt-input-cal-value').val();


        function getOptionDropdown() {
            $.ajax({
                type: "get",
                url: '{!! url('report/calculator/getCalProducts') !!}',
                beforeSend: function () {
                    $('#pnt-loading').show();
                },
                success: function (data) {
                    window.selProduct.empty();
                    console.log(data)
                    if (data.status) {
                        var product = "";
                        var selected = 0;
                        $.each(data.locationProduct, function (index, value) {
                            if (index === 0) {
                                selected = value.id;
                            }
                            product += "<option value=" + value.id + "> <strong>" + value.name + "</strong></option>"
                        });
                        window.selProduct.append(product);
                        window.selProduct.selectpicker('refresh');
                        window.product_id = selected;
                        $('.pnt-sel-filter-product').val(selected).change();
                        window.value = $('.pnt-input-cal-value').val();
                        productPartsTable(window.product_id, window.value);
                    }
                    $('#pnt-loading').hide();
                }
            });
        }

        function productPartsTable(product_id, value) {
            $.ajax({
                type: "get",
                url: '{!! url('report/calculator/getCalProductParts') !!}/' + product_id + '&' + value,
                beforeSend: function () {
                    $('#pnt-loading').show();
                },
                success: function (data) {
                    window.table.destroy();
                    if (data.status) {
                        $('.data-section').html(null);
                        $.each(data.stockParts, function (index, value) {
                            $('.data-section').append(
                                "<tr><td>" +
                                (index + 1) +
                                "</td><td>" +
                                value.part_name +
                                "</td><td>" +
                                value.use_quantity_unit +
                                "</td><td>" +
                                value.use_quantity +
                                "</td><td>" +
                                value.unit +
                                "</td><td>" +
                                value.stock_quantity +
                                "</td><td>" +
                                value.sum
                            );
                        });
                        window.table = $('#calculatorInformation').DataTable();
                        $(".pnt-sum-cost").text("{!! __('Cost') !!} : " + data.sum_cost);
                        $('#pnt-loading').hide();
                    }
                }
            });
        }


        $(document).ready(function () {
            getOptionDropdown();
        });

        // btn-change-product
        $(document).off('click', '.pnt-sel-filter-product').on('click', '.pnt-sel-filter-product', (e) => {
            window.product_id = $('.pnt-sel-filter-product option:selected').val();
            window.value = $('.pnt-input-cal-value').val();
            productPartsTable(window.product_id, window.value);
        });
        // end-btn-change-product

        //input-change-value
        $(document).off('change paste keyup', '.pnt-input-cal-value').on('change paste keyup', '.pnt-input-cal-value', (e) => {
            window.product_id = $('.pnt-sel-filter-product option:selected').val();
            window.value = $('.pnt-input-cal-value').val();
            if (window.product_id == 0) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: 'Please Select Product',
                    showConfirmButton: false,
                    timer: 1500
                })
            }
            productPartsTable(window.product_id, window.value);
        });
        // end-input-change-value


    </script>
@endsection
