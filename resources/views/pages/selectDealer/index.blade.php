@extends('layouts.master')

@section('content')

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="col-md-6  mx-auto">
        <div class="card text-center bg-white">
            <div class="card-header">
                <h5 class="card-title text-dark">Please Selected Dealer</h5>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label> <strong>Dealer</strong> </label>
                    <select class="form-control pnt-sel-dealer">
                    </select>
                </div>
                <button class="btn btn-success text-white btn-card pnt-goto-dealer">Go to Dealer</button>
            </div>
        </div>
    </div>

@endsection



@section('script')

    <script>
        var token = $('meta[name="csrf-token"]').attr('content');
        var dropdown_dealer = $('.pnt-sel-dealer');

        $(document).ready(function () {
            getCustomer();
        });

        function getCustomer() {
            $.ajax({
                type: "get",
                url: '{!! url('manage/dealer/getDealers') !!}',
                beforeSend: function () {
                    $('#pnt-loading').show();
                },
                success: function (data) {
                    console.log(data)
                    if (data.status) {
                        var str = "";
                        $.each(data.dealers, function (index, value) {
                            str += "<option value=" + value.id + "> <strong>" + value.name + "</strong></option>"
                        });
                        window.dropdown_dealer.append(str);
                        window.dropdown_dealer.selectpicker('refresh');
                        $('#pnt-loading').hide();
                    }
                }
            });
        }

        // pnt-goto-dealer
        $(document).off('click', '.pnt-goto-dealer').on('click', '.pnt-goto-dealer', (e) => {
            $('.pnt-goto-dealer').prop('disabled' , true);
            var dealer_id = $(".pnt-sel-dealer option:selected").val();
            var dealer_name = $(".pnt-sel-dealer option:selected").text();



            if (dealer_id == 0 || dealer_id == undefined) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: 'Please Select Dealer',
                    showConfirmButton: false,
                    timer: 1500
                });
                $('.pnt-goto-dealer').prop('disabled' , false);
            } else {
                $.ajax({
                    type: "post",
                    url: '{{route('getSessionDealer')}}',
                    data: {
                        id: dealer_id,
                        name: dealer_name,
                        '_token': window.token,
                    },
                    success: function (data) {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Select Dealer success fully',
                            showConfirmButton: false,
                            timer: 2000
                        });
                        $('.pnt-goto-dealer').prop('disabled' , false);
                        window.location.href = "{!! url('dealer') !!}";
                    }
                });
            }
        });


        // end-pnt-goto-branch

    </script>
@endsection
