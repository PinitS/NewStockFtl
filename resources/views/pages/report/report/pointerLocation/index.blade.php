@extends('layouts.master')

@section('content')

    <div class="row">
        <div class="col-md-12" style="height: 800px">
            <div class="row page-titles mx-0">
                <div class="col-md-6 col-sm-12 p-md-0">
                    <div class="welcome-text">
                        <div class="row">
                            <div class="col-md-4 col-sm-12"><img src="{!! url('images/marker/icongreen.png') !!}"
                                                                 alt=""> <strong>
                                    Working</strong></div>
                            <div class="col-md-4 col-sm-12"><img src="{!! url('images/marker/iconred.png') !!}" alt="">
                                <strong>
                                    maintenance</strong></div>
                            <div class="col-md-4 col-sm-12"><img src="{!! url('images/marker/iconblue.png') !!}" alt="">
                                <strong>
                                    setup</strong></div>
                        </div>

                    </div>
                </div>
                <div class="col-md-6 col-sm-12 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <div class="form-group mr-3">
                        <select class="form-control pnt-sel-filter-customer"></select>
                    </div>

                    <div class="form-group mr-3">
                        <select class="form-control pnt-sel-filter-product"></select>
                    </div>

                    <div class="form-group">
                        <select class="form-control pnt-sel-filter-status"></select>
                    </div>

                </div>
            </div>

            <div id="local-map" style="height: 100%; width: 100%"></div>

        </div>
    </div>



@endsection



@section('script')

    <script>

        let localMap;
        let localMarkers = [];

        var filter_customer = $('.pnt-sel-filter-customer');
        var filter_product = $('.pnt-sel-filter-product');
        var filter_status = $('.pnt-sel-filter-status');

        var customer_id = 0;
        var product_id = 0;
        var status_id = 10;


        $(document).ready(function () {
            localMap = new google.maps.Map(document.getElementById("local-map"), {
                zoom: 6,
                center: {lat: 14.264612, lng: 100.697404},
            });
            getSelDropdown();
            getProductLocation();
        });

        function getSelDropdown() {
            $.ajax({
                type: "get",
                url: '{!! url('report/pointerLocation/getFilter') !!}',
                beforeSend: function () {
                    $('#pnt-loading').show();
                },
                success: function (data) {
                    var customer = "<option value=" + 0 + "> <strong>" + "All Customers" + "</strong></option>";
                    $.each(data.dataSet.customer, function (index, value) {
                        customer += "<option value=" + value.id + "> <strong>" + value.name + "</strong></option>"
                    });
                    window.filter_customer.append(customer);
                    window.filter_customer.selectpicker('refresh');

                    var product = "<option value=" + 0 + "> <strong>" + "All Products" + "</strong></option>";
                    $.each(data.dataSet.product, function (index, value) {
                        product += "<option value=" + value.id + "> <strong>" + value.name + "</strong></option>"
                    });
                    window.filter_product.append(product);
                    window.filter_product.selectpicker('refresh');

                    var status = "<option value=" + 10 + "> <strong>" + "All Status" + "</strong></option>";
                    $.each(data.dataSet.status, function (index, value) {
                        status += "<option value=" + index + "> <strong>" + value + "</strong></option>"
                    });
                    window.filter_status.append(status);
                    window.filter_status.selectpicker('refresh');

                    $('#pnt-loading').hide();
                }
            });
        }

        function getProductLocation() {
            $.ajax({
                type: "get",
                url: '{!! url('report/pointerLocation/getAllDetail') !!}',
                data: {
                    customer_id: customer_id,
                    product_id: product_id,
                    status_id: status_id,
                },
                beforeSend: function () {
                    $('#pnt-loading').show();
                },
                success: function (data) {
                    console.log(data)

                    for (let i = 0; i < localMarkers.length; i++) {
                        localMarkers[i].setMap(null);
                    }
                    let makerIcon = ['{!! url('images/marker/icongreen.png') !!}', '{!! url('images/marker/iconred.png') !!}', '{!! url('images/marker/iconblue.png') !!}']
                    $.each(data.product, function (index, list) {
                        const localMarker = new google.maps.Marker({
                            // label: detail.code,
                            icon: makerIcon[list.status],
                            position: {lat: parseFloat(list.latitude), lng: parseFloat(list.longitude)},
                        });
                        const contentString =
                            '<div id="content">' +
                            '<div id="siteNotice">' +
                            "</div>" +
                            '<h5 id="firstHeading" class="firstHeading">Serial : ' + list.serial + '</h5>' +
                            '<div id="bodyContent">' +
                            '<h6><b class="text-danger">Customer : </b>' + list.customer + '</h6>' +
                            '<h6><b class="text-success">Phone number : </b>' + (list.phone_number == null ? "-" : list.phone_number) + '</h6>' +
                            '<h6><b class="text-warning">Product : </b>' + list.product + '</h6>' +
                            '</div>' +
                            '</div>';

                        const infowindow = new google.maps.InfoWindow({
                            content: contentString,
                        });

                        localMarker.addListener("click", () => {
                            infowindow.open(localMap, localMarker);
                        });
                        localMarker.setMap(localMap);
                        localMarkers.push(localMarker);
                        // if (index === 0) {
                        //     localMap.panTo(localMarker.getPosition());
                        // }
                    });
                    $('#pnt-loading').hide();
                }
            });
            $('.map-section-all-product').show();
        }

        $(document).off('click', '.pnt-sel-filter-customer').on('click', '.pnt-sel-filter-customer', (e) => {
            window.customer_id = $('.pnt-sel-filter-customer option:selected').val();
            getProductLocation();
        });

        $(document).off('click', '.pnt-sel-filter-product').on('click', '.pnt-sel-filter-product', (e) => {
            window.product_id = $('.pnt-sel-filter-product option:selected').val();
            getProductLocation();
        });

        $(document).off('click', '.pnt-sel-filter-status').on('click', '.pnt-sel-filter-status', (e) => {
            window.status_id = $('.pnt-sel-filter-status option:selected').val();
            getProductLocation();
        });


    </script>
@endsection
