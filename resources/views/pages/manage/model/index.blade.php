@extends('layouts.master')

@section('content')

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="row">
        <div class="col-12">
            <div class="card bg-white">
                <div class="card-header">
                    <h4 class="card-title text-dark">Models Information</h4>
                    <button type="button" class="btn btn-info pnt-bnt-add-model">Add <span class="btn-icon-right"><i class="fa fa-plus color-info"></i></span>
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id = "modelInformation" style="min-width: 845px">
                            <thead>
                            <tr>
                                <th class="text-dark">#</th>
                                <th class="text-dark">Model</th>
                                <th class="text-dark">Manage</th>
                            </tr>
                            </thead>
                            <tbody class= "data-section">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--    modal add model--}}
    <div class="modal fade pnt-modal-add-model" id="pnt-modal-add-model">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Model</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Model</span>
                        </div>
                        <input type="text" class="form-control pnt-input-add-name">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger light" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary pnt-btn-modal-add-model-save">Add Model</button>
                </div>
            </div>
        </div>
    </div>
    {{--    end modal add model--}}

    {{--modal update--}}
    <div class="modal fade pnt-modal-edit " id="exampleModalCenter">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Model</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Model</span>
                        </div>
                        <input type="text" class="form-control pnt-input-name">
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger light" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary pnt-btn-modal-save">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    {{--modal update--}}

@endsection



@section('script')

    <script>

        var token = $('meta[name="csrf-token"]').attr('content');
        var id = 0;
        var table = $('#modelInformation').DataTable();

        function resetTable()
        {
            $.ajax({
                type: "get",
                url: "{!! url('manage/model/getLocationModels') !!}",
                success: function (data) {
                    console.log(data);
                    if(data.status)
                    {
                        table.destroy();
                        $('.data-section').html(null);
                        $.each(data.locationModel , function( index, value ) {

                            $('.data-section').append(
                                "<tr><td>" +
                                (index + 1) +
                                "</td><td>" +
                                value.name +
                                "</td><td>"+
                                "<div class = 'd-flex'>"+
                                "<button  class='btn btn-warning text-white pnt-btn-edit shadow btn-xs sharp mr-1' value = '" + value.id + "' ><i class='fa fa-pencil-square-o'></i></button>"+
                                "<button  class='btn btn-danger pnt-btn-delete shadow btn-xs sharp mr-1' value = '" + value.id + "' ><i class= 'fa fa-trash'></i></button>"
                            )
                        });
                        table = $('#modelInformation').DataTable();
                    }
                }
            });
        }

        $(document).ready(function () {
            resetTable();
        });

        // btn-add-model
        $(document).off('click', '.pnt-bnt-add-model').on('click', '.pnt-bnt-add-model', (e) => {
            $('.pnt-input-add-name').val('');
            $(".pnt-modal-add-model").modal();
        });
        // end-save-add-category

        // btn-save-add-model
        $(document).off('click', '.pnt-btn-modal-add-model-save').on('click', '.pnt-btn-modal-add-model-save', e => {
            $.ajax({
                type: "post",
                url: "{!! url('manage/model/create') !!}",
                data: {
                    name : $('.pnt-input-add-name').val(),
                    '_token': window.token,
                },
                success: function (data) {
                    console.log(data)
                    if (data.status) {
                        $(".pnt-modal-add-model").modal('hide');
                        resetTable();
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Add Model Success fully',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    }
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
                    }
                },
            });
        });
        // end-btn-save-add-model


        // btn-edit
        $(document).off('click', '.pnt-btn-edit').on('click', '.pnt-btn-edit', (e) => {
            window.id = $(e.currentTarget).val();
            $.ajax({
                type: "get",
                url: "{!! url('manage/model/getOneLocationModel') !!}/"+window.id,
                success: function (data) {
                    if(data.status)
                    {
                        $(".pnt-input-name").val(data.locationModel.name);
                        $(".pnt-modal-edit").modal();
                    }
                }
            });
        });
        // end btn-edit

        // btn save update modal
        $(document).off('click', '.pnt-btn-modal-save').on('click', '.pnt-btn-modal-save', e => {

            console.log(window.id)

            $.ajax({
                type: "post",
                url: "{!! url('manage/model/update') !!}/"+window.id,
                data: {
                    name : $(".pnt-input-name").val(),
                    '_token': window.token,
                },
                success: function (data) {
                    if (data.status) {
                        $(".pnt-modal-edit").modal('hide');
                        resetTable();
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Update Model Success fully',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    }
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
                    }
                },
            });
        });
        // end btn save update modal

        // btn-delete
        $(document).off('click', '.pnt-btn-delete').on('click', '.pnt-btn-delete', (e) => {
            window.id = $(e.currentTarget).val();
            console.log($(e.currentTarget).val());

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
                        url: "{!! url('manage/model/destroy') !!}/"+window.id,
                        success: function (data) {
                            resetTable();

                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Delete Model Success fully',
                                showConfirmButton: false,
                                timer: 1500
                            })
                        }
                    });
                }
            })
        });
        // end btn-delete

    </script>
@endsection
