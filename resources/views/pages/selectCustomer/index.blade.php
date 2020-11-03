@extends('layouts.master')

@section('content')

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="col-md-6  mx-auto">
        <div class="card text-center bg-white">
            <div class="card-header">
                <h5 class="card-title text-dark">Please Selected Customer</h5>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label> <strong>Customer</strong> </label>
                    <select class="form-control pnt-sel-customer">
                    </select>
                </div>
                <button class="btn btn-warning text-white btn-card pnt-goto-branch">Go to Customer</button>
            </div>
        </div>
    </div>

@endsection



@section('script')

    <script>
        var token = $('meta[name="csrf-token"]').attr('content');
        var dropdown_customer = $('.pnt-sel-customer');

        $(document).ready(function () {
            getCustomer();
        });

        function getCustomer() {
            $.ajax({
                type: "get",
                url: '{{route('getLocations')}}',
                beforeSend: function () {
                    $('#pnt-loading').show();
                },
                success: function (data) {
                    if (data.status) {
                        var str = "<option value=" + 0 + "> <strong>" + "Select Customer" + "</strong></option>";
                        $.each(data.location, function (index, value) {
                            str += "<option value=" + value.id + "> <strong>" + value.name + "</strong></option>"
                        });
                        window.dropdown_customer.append(str);
                        window.dropdown_customer.selectpicker('refresh');
                        $('#pnt-loading').hide();
                    }
                }
            });
        }

        // pnt-goto-branch
        $(document).off('click', '.pnt-goto-branch').on('click', '.pnt-goto-branch', (e) => {
            var customer_id = $(".pnt-sel-customer option:selected").val();
            var customer_name = $(".pnt-sel-customer option:selected").text();

            if (customer_id == 0) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: 'Please Select Customer',
                    showConfirmButton: false,
                    timer: 1500
                });
            } else {
                $.ajax({
                    type: "post",
                    url: '{{route('getSessionCustomer')}}',
                    data: {
                        id: customer_id,
                        name: customer_name,
                        '_token': window.token,
                    },
                    success: function (data) {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Select Customer success fully',
                            showConfirmButton: false,
                            timer: 2000
                        });
                        window.location.href = "{!! url('customer/') !!}";
                    }
                });
            }
        });


        // end-pnt-goto-branch

    </script>
@endsection
