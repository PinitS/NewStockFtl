@extends('layouts.master')

@section('content')

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="col-md-6  mx-auto">
        <div class="card text-center bg-white">
            <div class="card-header">
                <h5 class="card-title text-dark">@lang('Please Selected Branch')</h5>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label> <strong>@lang('Branch')</strong> </label>
                    <select class="form-control pnt-sel-branch">
                    </select>
                </div>
                <button class="btn btn-danger btn-card pnt-goto-branch">@lang('Go to Branch')</button>
            </div>
        </div>
    </div>

@endsection



@section('script')

    <script>
        var token = $('meta[name="csrf-token"]').attr('content');
        var dropdown_branch = $('.pnt-sel-branch');
        $(document).ready(function () {
            getbranch();
        });

        function getbranch() {
            $.ajax({
                type: "get",
                url: '{{route('getBranches')}}',
                beforeSend: function () {
                    $('#pnt-loading').show();
                },
                success: function (data) {
                    console.log(data)
                    if (data.status) {
                        var str = "";
                        $.each(data.branch, function (index, value) {
                            str += "<option value=" + value.id + "> <strong>" + value.name + "</strong></option>"
                        });
                        window.dropdown_branch.append(str);
                        window.dropdown_branch.selectpicker('refresh');
                        $('#pnt-loading').hide();
                    }
                }
            });
        }

        // pnt-goto-branch
        $(document).off('click', '.pnt-goto-branch').on('click', '.pnt-goto-branch', (e) => {
            var branch_id = $(".pnt-sel-branch option:selected").val();
            var branch_name = $(".pnt-sel-branch option:selected").text();

            if (branch_id == 0 || branch_id == undefined) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: '{{__('Please Select Branch')}}',
                    showConfirmButton: false,
                    timer: 1500
                });
            } else {
                $.ajax({
                    type: "post",
                    url: '{{route('getSessionBranch')}}',
                    data: {
                        id: branch_id,
                        name: branch_name,
                        '_token': window.token,
                    },
                    success: function (data) {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: '{{ __('Select Branch success fully')}}',
                            showConfirmButton: false,
                            timer: 2000
                        });
                        window.location.href = "{!! url('stock/parts') !!}";
                    }
                });
            }
        });
        // end-pnt-goto-branch

    </script>
@endsection
