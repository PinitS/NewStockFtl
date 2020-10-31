@extends('layouts.master')

@section('content')

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="row">
        <div class="col-12">
            <div class="card bg-white">
                <div class="card-header">
                    <h4 class="card-title text-dark">Calculator Information</h4>

                    <div class="row pull-right text-center ">
                        <div class="form-group  pull-right justify-content-sm-end mt-2 mt-sm-0 d-flex">
                            <select class="form-control mr-2 pnt-sel-filter-product">
                            </select>
                            <input class="form-control col-md-4 pnt-input-cal-value" type="number" value="1">
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
                                    <th class="text-dark">Parts</th>
                                    <th class="text-dark">UseQuantity/Unit</th>
                                    <th class="text-dark">UseQuantity</th>
                                    <th class="text-dark">StockQuantity</th>
                                    <th class="text-dark">Requirement</th>
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
                success: function (data) {
                    window.selProduct.empty();
                    console.log(data);
                    if (data.status) {
                        var product = "<option value=" + 0 + "> <strong>" + "All Product" + "</strong></option>";
                        $.each(data.locationProduct, function (index, value) {
                            product += "<option value=" + value.id + "> <strong>" + value.name + "</strong></option>"
                        });
                        window.selProduct.append(product);
                        window.selProduct.selectpicker('refresh');
                    }
                }
            });
        }

        function productPartsTable(product_id , value) {
            $.ajax({
                type: "get",
                url: '{!! url('report/calculator/getCalProductParts') !!}/' + product_id +'&'+ value,
                success: function (data) {
                    window.table.destroy();
                    if (data.status) {
                        console.log(data);
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
                                value.stock_quantity +
                                "</td><td>" +
                                value.sum
                            );
                        });
                        window.table = $('#calculatorInformation').DataTable();
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
            productPartsTable(window.product_id , window.value);
        });
        // end-btn-change-product

        //input-change-value
        $(document).off('change paste keyup', '.pnt-input-cal-value').on('change paste keyup', '.pnt-input-cal-value', (e) => {
            window.product_id = $('.pnt-sel-filter-product option:selected').val();
            window.value = $('.pnt-input-cal-value').val();
            if(window.product_id == 0)
            {
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: 'Please Select Product',
                    showConfirmButton: false,
                    timer: 1500
                })
            }
            productPartsTable(window.product_id , window.value);
        });
        // end-input-change-value


    </script>
@endsection