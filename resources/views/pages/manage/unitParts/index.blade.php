@extends('layouts.master')

@section('content')

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="row">
        <div class="col-12">
            <div class="card bg-white">
                <div class="card-header">
                    <h4 class="card-title text-dark">@lang('Unit Parts Information')</h4>
                    <button type="button" class="btn btn-info pnt-bnt-add-unit">@lang('Add') <span class="btn-icon-right"><i
                                class="fa fa-plus color-info"></i></span>
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="unitInformation" style="min-width: 845px">
                            <thead>
                            <tr>
                                <th class="text-dark">#</th>
                                <th class="text-dark">@lang('Name')</th>
                                <th class="text-dark">@lang('Manage')</th>
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

    {{--modal update--}}
    <form id="edit-modal-unit">
        <div class="modal fade pnt-modal-edit " id="exampleModalCenter">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">@lang('Edit Unit Parts')</h5>
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label class="mb-1"><strong>@lang('Unit Name')</strong></label>
                            <input type="text" class="form-control pnt-modal-edit-unit-name" id="name" name="name"
                                   required>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger light" data-dismiss="modal">@lang('Close')</button>
                        <button type="button" class="btn btn-primary pnt-btn-modal-save">@lang('Save changes')</button>
                    </div>

                </div>
            </div>
        </div>
    </form>
    {{--modal update--}}

    {{--    modal add groups--}}
    <form id="add-modal-unit">
        <div class="modal fade pnt-modal-add-unit">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">@lang('Add Unit Parts')</h5>
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="mb-1"><strong>@lang('Unit Name')</strong></label>
                            <input type="text" class="form-control pnt-input-add-name-unit" id="name" name="name"
                                   required>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger light" data-dismiss="modal">@lang('Close')</button>
                        <button type="button" class="btn btn-primary pnt-btn-modal-add-unit-save">@lang('Add Unit Parts')
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    {{--    end modal add groups--}}


@endsection



@section('script')

    <script>

        var token = $('meta[name="csrf-token"]').attr('content');
        var id = 0;
        var table = $('#unitInformation').DataTable();

        function resetTable() {
            $.ajax({
                type: "get",
                url: '{!! url('manage/unitParts/getUnits') !!}',
                beforeSend: function () {
                    $('#pnt-loading').show();
                },
                success: function (data) {
                    if (data.status) {
                        table.destroy();
                        $('.data-section').html(null);
                        $.each(data.units, function (index, value) {
                            console.log(value)
                            let localHtml = "<tr><td>" +
                                (index + 1) +
                                "</td><td>" +
                                value.name +
                                "</td><td>" +
                                "<div class = 'd-flex'>" +
                                "<button  class='btn btn-warning text-white pnt-btn-edit shadow btn-xs sharp mr-1' value = '" + value.id + "' ><i class='fa fa-pencil-square-o'></i></button>";

                            if (value.delete_active) {
                                localHtml += "<button  class='btn btn-danger pnt-btn-delete shadow btn-xs sharp mr-1' value = '" + value.id + "' ><i class= 'fa fa-trash'></i></button>";
                            }
                            $('.data-section').append(localHtml);
                        });
                        table = $('#unitInformation').DataTable();
                        $('#pnt-loading').hide();
                    }
                }
            });
        }

        $(document).ready(function () {
            resetTable();

            $('#add-modal-unit').validate({
                rules: {
                    name: {
                        required: true,
                    },
                },
                // <span class='text-danger'></span>
                messages: {
                    name: {
                        required: "<span class='text-danger'>{!! __('Please enter a Unit Parts name') !!}</span>",
                    },
                }
            });
            $('#edit-modal-unit').validate({
                rules: {
                    name: {
                        required: true,
                    },
                },
                // <span class='text-danger'></span>
                messages: {
                    name: {
                        required: "<span class='text-danger'>{!! __('Please enter a Unit Parts name') !!}</span>",
                    },
                }
            });

        });

        // btn-edit
        $(document).off('click', '.pnt-btn-edit').on('click', '.pnt-btn-edit', (e) => {
            window.id = $(e.currentTarget).val();
            $.ajax({
                type: 'get',
                url: '{!! url('manage/unitParts/getOneUnit') !!}/' + window.id,
                success: function (data) {
                    if (data.status) {
                        $('.pnt-modal-edit-unit-name').val(data.unit.name);
                        $('.pnt-modal-edit').modal();
                    }
                }
            });
        });
        // end btn-edit

        // btn save update modal
        $(document).off('click', '.pnt-btn-modal-save').on('click', '.pnt-btn-modal-save', e => {
            if ($("#edit-modal-unit").valid()) {
                $('.pnt-btn-modal-save').prop('disabled', true);
                $.ajax({
                    type: "post",
                    url: '{!! url('manage/unitParts/update') !!}/' + window.id,
                    data: {
                        name: $('.pnt-modal-edit-unit-name').val(),
                        '_token': window.token,
                    },
                    beforeSend: function () {
                        $('#pnt-loading').show();
                    },
                    success: function (data) {
                        $('.pnt-btn-modal-save').prop('disabled', false);
                        if (data.status) {
                            $('.pnt-modal-edit').modal('hide');
                            $('#pnt-loading').hide();
                            resetTable();
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: '{!! __('Update Unit Success fully') !!}',
                                showConfirmButton: false,
                                timer: 1500
                            })
                        }
                    },
                    error: function (jqXHR, exception) {
                        $('.pnt-btn-modal-save').prop('disabled', false);
                        if (jqXHR.status !== 200) {
                            $('#pnt-loading').hide();
                            Swal.fire({
                                position: 'top-end',
                                icon: 'error',
                                title: '{!! __('Something went wrong') !!}',
                                showConfirmButton: false,
                                timer: 1500
                            })
                        }
                    },
                });
            }
        });
        // end btn save update modal

        // btn-delete
        $(document).off('click', '.pnt-btn-delete').on('click', '.pnt-btn-delete', (e) => {
            window.id = $(e.currentTarget).val();
            Swal.fire({
                title: '{!! __('Are you sure?') !!}',
                text: "{!! __('You will not be able to revert this!') !!}",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '{!! __('Yes, delete it!') !!}',
                cancelButtonText: '{!! __('Close') !!}'
            }).then((result) => {
                console.log(window.id)
                if (result.isConfirmed) {
                    $.ajax({
                        type: "get",
                        url: '{!! url('manage/unitParts/destroy') !!}/' + window.id,
                        beforeSend: function () {
                            $('#pnt-loading').show();
                        },
                        success: function (data) {
                            if (data.status) {
                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    title: '{!! __('Delete Unit Success fully') !!}',
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                            } else {
                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'error',
                                    title: "{!! __('Can not Delete this Unit') !!}",
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                            }
                            resetTable();
                            $('#pnt-loading').hide();
                        }
                    });
                }
            })
        });
        // end btn-delete


        $(document).off('click', '.pnt-bnt-add-unit').on('click', '.pnt-bnt-add-unit', (e) => {
            $('.pnt-input-add-name-unit').val('');
            $('.pnt-btn-modal-add-unit-save').prop('disabled', false);
            $('.pnt-modal-add-unit').modal('show');
        });
        // end btn-delete


        $(document).off('click', '.pnt-btn-modal-add-unit-save').on('click', '.pnt-btn-modal-add-unit-save', (e) => {
            if ($("#add-modal-un" +
                "" +
                "it").valid()) {
                $('.pnt-btn-modal-add-unit-save').prop('disabled', true);
                $.ajax({
                    type: "post",
                    url: '{!! url('manage/unitParts/create') !!}',
                    data: {
                        name: $('.pnt-input-add-name-unit').val(),
                        '_token': window.token,
                    },
                    beforeSend: function () {
                        $('#pnt-loading').show();
                    },
                    success: function (data) {
                        $('.pnt-btn-modal-add-unit-save').prop('disabled', false);
                        $('.pnt-input-add-name-unit').val('');
                        resetTable();
                        if (data.status) {
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: '{!! __('Add Unit parts Success fully') !!}',
                                showConfirmButton: false,
                                timer: 1500
                            })
                            $('.pnt-modal-add-unit').modal('hide');
                            $('#pnt-loading').hide();
                        } else {
                            Swal.fire({
                                position: 'top-end',
                                icon: 'error',
                                title: '{!! __('Duplicate Unit Name.') !!}',
                                showConfirmButton: false,
                                timer: 1500
                            })
                        }
                    },
                    error: function (jqXHR, exception) {
                        $('.pnt-btn-modal-add-unit-save').prop('disabled', false);
                        if (jqXHR.status !== 200) {
                            Swal.fire({
                                position: 'top-end',
                                icon: 'error',
                                title: '{!! __('Something went wrong') !!}',
                                showConfirmButton: false,
                                timer: 1500
                            })
                            $('#pnt-loading').hide();
                        }
                    },
                });
            }
        });


    </script>
@endsection
