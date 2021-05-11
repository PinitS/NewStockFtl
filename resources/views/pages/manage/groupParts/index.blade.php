@extends('layouts.master')

@section('content')

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="row">
        <div class="col-12">
            <div class="card bg-white">
                <div class="card-header">
                    <h4 class="card-title text-dark">@lang('Group Parts Information')</h4>
                    <button type="button" class="btn btn-info pnt-bnt-add-group">@lang('Add') <span
                            class="btn-icon-right"><i
                                class="fa fa-plus color-info"></i></span>
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="groupInformation" style="min-width: 845px">
                            <thead>
                            <tr>
                                <th class="text-dark">#</th>
                                <th class="text-dark">@lang('Name')</th>
                                <th class="text-dark">@lang('Cost')</th>
                                <th class="text-dark">@lang('Unit')</th>
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
    <form id="edit-modal-gp">
        <div class="modal fade pnt-modal-edit " id="exampleModalCenter">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">@lang('Edit Group Parts')</h5>
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label class="mb-1"><strong>@lang('Groups Name')</strong></label>
                            <input type="text" class="form-control pnt-modal-edit-group-name" id="name" name="name"
                                   required>
                        </div>
                        <div class="form-group">
                            <label class="mb-1"><strong>@lang('Cost')</strong></label>
                            <input type="number" class="form-control pnt-modal-edit-group-cost" id="cost" name="cost"
                                   required>
                        </div>
                        <div class="form-group">
                            <label class="mb-1"><strong>@lang('Unit')</strong></label>
                            <select class="form-control pnt-modal-sel-edit-unit">
                            </select>
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
    <form id="add-modal-gp">
        <div class="modal fade pnt-modal-add-group">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">@lang('Add Group Parts')</h5>
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="mb-1"><strong>@lang('Groups Name')</strong></label>
                            <input type="text" class="form-control pnt-input-add-name-gp" id="name" name="name"
                                   required>
                        </div>
                        <div class="form-group">
                            <label class="mb-1"><strong>@lang('Cost')</strong></label>
                            <input type="number" class="form-control pnt-input-add-cost-gp" id="cost" name="cost"
                                   required>
                        </div>
                        <div class="form-group">
                            <label class="mb-1"><strong>@lang('Unit')</strong></label>
                            <select class="form-control pnt-modal-sel-add-unit">
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger light" data-dismiss="modal">@lang('Close')</button>
                        <button type="button"
                                class="btn btn-primary pnt-btn-modal-add-group-save">@lang('Add Group Parts')
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
        var table = $('#groupInformation').DataTable();
        var addUnit = $('.pnt-modal-sel-add-unit').select2();
        var editUnit = $('.pnt-modal-sel-edit-unit').select2();

        function resetTable() {
            $.ajax({
                type: "get",
                url: '{!! url('manage/groupParts/getGroups') !!}',
                beforeSend: function () {
                    $('#pnt-loading').show();
                },
                success: function (data) {
                    console.log(data)
                    if (data.status) {
                        table.destroy();
                        $('.data-section').html(null);
                        $.each(data.groups, function (index, value) {
                            let localHtml = "<tr><td>" +
                                (index + 1) +
                                "</td><td>" +
                                value.name +
                                "</td><td>" +
                                value.cost +
                                "</td><td>" +
                                value.unit +
                                "</td><td>" +
                                "<div class = 'd-flex'>" +
                                "<button  class='btn btn-warning text-white pnt-btn-edit shadow btn-xs sharp mr-1' value = '" + value.id + "' ><i class='fa fa-pencil-square-o'></i></button>";

                            if (value.delete_active) {
                                localHtml += "<button  class='btn btn-danger pnt-btn-delete shadow btn-xs sharp mr-1' value = '" + value.id + "' ><i class= 'fa fa-trash'></i></button>";
                            }
                            $('.data-section').append(localHtml);
                        });
                        table = $('#groupInformation').DataTable();
                        $('#pnt-loading').hide();
                    }
                }
            });
            getOptionDropdown();
        }

        function getOptionDropdown() {
            $.ajax({
                type: "get",
                url: '{!! url('manage/unitParts/getUnits') !!}',
                success: function (data) {
                    window.addUnit.empty();
                    window.editUnit.empty();
                    if (data.status) {
                        var str = "";
                        $.each(data.units, function (index, value) {
                            str += "<option value=" + value.id + "> <strong>" + value.name + "</strong></option>"
                        });
                        window.addUnit.append(str);
                        window.editUnit.append(str);
                        window.addUnit.selectpicker('refresh');
                        window.editUnit.selectpicker('refresh');
                    }
                }
            });
        }

        $(document).ready(function () {
            resetTable();

            $('#add-modal-gp').validate({
                rules: {
                    name: {
                        required: true,
                    },
                    cost: {
                        required: true,
                    },
                },
                // <span class='text-danger'></span>
                messages: {
                    name: {
                        required: "<span class='text-danger'>{!! __('Please enter a Group Parts name') !!}</span>",
                    },
                    cost: {
                        required: "<span class='text-danger'>{!! __('Please enter a Cost') !!}</span>",
                    },
                }
            });

            $('#edit-modal-gp').validate({
                rules: {
                    name: {
                        required: true,
                    },
                    cost: {
                        required: true,
                    },
                },
                // <span class='text-danger'></span>
                messages: {
                    name: {
                        required: "<span class='text-danger'>{!! __('Please enter a Group Parts name') !!}</span>",
                    },
                    cost: {
                        required: "<span class='text-danger'>{!! __('Please enter a Cost') !!}</span>",
                    },
                }
            });
        });

        // btn-edit
        $(document).off('click', '.pnt-btn-edit').on('click', '.pnt-btn-edit', (e) => {
            window.id = $(e.currentTarget).val();
            $.ajax({
                type: 'get',
                url: '{!! url('manage/groupParts/getOneGroup') !!}/' + window.id,
                success: function (data) {
                    console.log(data)
                    if (data.status) {
                        $('.pnt-modal-edit-group-name').val(data.group.name);
                        $('.pnt-modal-edit-group-cost').val(data.group.cost);
                        $('.pnt-modal-sel-edit-unit').val(data.group.unit_id).change();
                        $('.pnt-modal-edit').modal();
                    }
                }
            });
        });
        // end btn-edit

        // btn save update modal
        $(document).off('click', '.pnt-btn-modal-save').on('click', '.pnt-btn-modal-save', e => {
            if ($("#edit-modal-gp").valid()) {
                $('.pnt-btn-modal-save').prop('disabled', true);
                $.ajax({
                    type: "post",
                    url: '{!! url('manage/groupParts/update') !!}/' + window.id,
                    data: {
                        name: $('.pnt-modal-edit-group-name').val(),
                        cost: $('.pnt-modal-edit-group-cost').val(),
                        unit: $('.pnt-modal-sel-edit-unit option:selected').val(),
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
                                title: '{!! __('Update Group Success fully') !!}',
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
                if (result.isConfirmed) {
                    $.ajax({
                        type: "get",
                        url: '{!! url('manage/groupParts/destroy') !!}/' + window.id,
                        beforeSend: function () {
                            $('#pnt-loading').show();
                        },
                        success: function (data) {
                            if (data.status) {
                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    title: '{!! __('Delete Group Success fully') !!}',
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                            } else {
                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'error',
                                    title: "{!! __('Can not Delete this Group') !!}",
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


        $(document).off('click', '.pnt-bnt-add-group').on('click', '.pnt-bnt-add-group', (e) => {
            $('.pnt-input-add-name-gp').val('');
            $('.pnt-input-add-cost-gp').val('');
            $('.pnt-btn-modal-add-group-save').prop('disabled', false);
            $('.pnt-modal-add-group').modal('show');
        });
        // end btn-delete


        $(document).off('click', '.pnt-btn-modal-add-group-save').on('click', '.pnt-btn-modal-add-group-save', (e) => {
            if ($("#add-modal-gp").valid()) {
                $('.pnt-btn-modal-add-group-save').prop('disabled', true);
                $.ajax({
                    type: "post",
                    url: '{!! url('manage/groupParts/create') !!}',
                    data: {
                        name: $('.pnt-input-add-name-gp').val(),
                        cost: $('.pnt-input-add-cost-gp').val(),
                        unit: $('.pnt-modal-sel-add-unit option:selected').val(),
                        '_token': window.token,
                    },
                    beforeSend: function () {
                        $('#pnt-loading').show();
                    },
                    success: function (data) {
                        $('.pnt-btn-modal-add-group-save').prop('disabled', false);
                        $('.pnt-input-add-name-gp').val('');
                        resetTable();
                        if (data.status) {
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: '{!! __('Add Group parts Success fully') !!}',
                                showConfirmButton: false,
                                timer: 1500
                            })
                            $('.pnt-modal-add-group').modal('hide');
                            $('#pnt-loading').hide();
                        } else {
                            Swal.fire({
                                position: 'top-end',
                                icon: 'error',
                                title: '{!! __('Duplicate GroupParts Name.') !!}',
                                showConfirmButton: false,
                                timer: 1500
                            })
                        }
                    },
                    error: function (jqXHR, exception) {
                        $('.pnt-btn-modal-add-group-save').prop('disabled', false);
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
