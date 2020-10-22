@extends('layouts.master')

@section('content')

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="row">
        <div class="col-12">
            <div class="card bg-white">
                <div class="card-header">
                    <h4 class="card-title text-dark">Group Parts Information</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id = "groupInformation" style="min-width: 845px">
                            <thead>
                            <tr>
                                <th class="text-dark">#</th>
                                <th class="text-dark">Name</th>
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

    {{--modal update--}}
    <div class="modal fade pnt-modal-edit " id="exampleModalCenter">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Group Parts</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label class="mb-1"><strong>Groups Name</strong></label>
                        <input type="text" class="form-control pnt-modal-edit-group-name" id="name" name="name" required>
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
        var table = $('#groupInformation').DataTable();

        function resetTable()
        {
            $.ajax({
                type: "get",
                url: '{!! url('manage/groupParts/getGroups') !!}',
                success: function (data) {
                    console.log(data)
                    if(data.status)
                    {
                        table.destroy();
                        $('.data-section').html(null);
                        $.each(data.groups , function( index, value ) {

                            $('.data-section').append(
                                "<tr><td>" +
                                (index + 1) +
                                "</td><td>" +
                                value.name +
                                "</td><td>" +
                                "<div class = 'd-flex'>"+
                                "<button  class='btn btn-warning text-white pnt-btn-edit shadow btn-xs sharp mr-1' value = '" + value.id + "' ><i class='fa fa-pencil-square-o'></i></button>"+
                                "<button  class='btn btn-danger pnt-btn-delete shadow btn-xs sharp mr-1' value = '" + value.id + "' ><i class= 'fa fa-trash'></i></button>"
                            )
                        });
                        table = $('#groupInformation').DataTable();
                    }
                }
            });
        }

        $(document).ready(function () {
            resetTable();
        });





        // btn-edit
        $(document).off('click', '.pnt-btn-edit').on('click', '.pnt-btn-edit', (e) => {
            window.id = $(e.currentTarget).val();
            $.ajax({
                type: "get",
                url: '{!! url('manage/groupParts/getOneGroup') !!}/' + window.id,
                success: function (data) {
                    console.log(data);
                    if(data.status)
                    {
                        $(".pnt-modal-edit-group-name").val(data.group.name);
                        $(".pnt-modal-edit").modal();
                    }
                }
            });
        });
        // end btn-edit

        // btn save update modal
        $(document).off('click', '.pnt-btn-modal-save').on('click', '.pnt-btn-modal-save', e => {
            $.ajax({
                type: "post",
                url: '{!! url('manage/groupParts/update') !!}/' + window.id,
                data: {
                    name : $('.pnt-modal-edit-group-name').val(),
                    '_token': window.token,
                },
                success: function (data) {
                    console.log(data)
                    if (data.status) {
                        $(".pnt-modal-edit").modal('hide');
                        resetTable();
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Update Group Success fully',
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
                        url: '{!! url('manage/groupParts/destroy') !!}/' + window.id,
                        success: function (data) {
                            if(data.status)
                            {
                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    title: 'Delete Group Success fully',
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                            }
                            else
                            {
                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'error',
                                    title: "Can't Delete this Groups",
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                            }
                            resetTable();
                        }
                    });
                }
            })
        });
        // end btn-delete

    </script>
@endsection
