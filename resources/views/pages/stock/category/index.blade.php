@extends('layouts.master')

@section('content')

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <input type="hidden" id="pnt-input-branch_id" name="pnt-input-branch_id" runat="server"
           value="{{ session()->get('branch')[0]['id'] }}"/>

    <div class="row">
        <div class="col-12">
            <div class="card bg-white">
                <div class="card-header">
                    <h4 class="card-title text-dark">Category Information</h4>
                    <button type="button" class="btn btn-danger pnt-bnt-add-category">Add <span
                            class="btn-icon-right"><i
                                class="fa fa-plus color-danger"></i></span>
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="categoryInformation" style="min-width: 845px">
                            <thead>
                            <tr>
                                <th class="text-dark">#</th>
                                <th class="text-dark">Category</th>
                                <th class="text-dark">Manage</th>
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


    {{--    modal add Category--}}
    <form id="add-modal-category">
        <div class="modal fade pnt-modal-add-category" id="pnt-modal-add-category">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Category</h5>
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="mb-1"><strong>Category</strong></label>
                            <input type="text" class="form-control pnt-input-add-name" id="name" name="name"
                                   required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger light" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary pnt-btn-modal-add-category-save">Add Category
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    {{--    end modal add Category--}}



    {{--modal update--}}
    <form id="edit-modal-category">
        <div class="modal fade pnt-modal-edit " id="exampleModalCenter">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Category</h5>
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="mb-1"><strong>Category</strong></label>
                            <input type="text" class="form-control pnt-input-name" id="name" name="name"
                                   required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger light" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary pnt-btn-modal-save">Save changes</button>
                    </div>

                </div>
            </div>
        </div>
    </form>
    {{--modal update--}}



@endsection



@section('script')

    <script>

        var token = $('meta[name="csrf-token"]').attr('content');
        var id = 0;
        var table = $('#categoryInformation').DataTable();

        function resetTable() {
            $.ajax({
                type: "get",
                url: '{!! url('stock/categories/getCategories') !!}',
                beforeSend: function () {
                    $('#pnt-loading').show();
                },
                success: function (data) {
                    if (data.status) {
                        table.destroy();
                        $('.data-section').html(null);
                        $.each(data.categories, function (index, value) {
                            let localHtmal = "<tr><td>" +
                                (index + 1) +
                                "</td><td>" +
                                value.name +
                                "</td><td>" +
                                "<div class = 'd-flex'>" +
                                "<button  class='btn btn-warning text-white pnt-btn-edit shadow btn-xs sharp mr-1' value = '" + value.id + "' ><i class='fa fa-pencil-square-o'></i></button>";

                            if (value.delete_active) {
                                localHtmal += "<button  class='btn btn-danger pnt-btn-delete shadow btn-xs sharp mr-1' value = '" + value.id + "' ><i class= 'fa fa-trash'></i></button>"
                            }
                            $('.data-section').append(localHtmal);
                        });
                        table = $('#categoryInformation').DataTable();
                        $('#pnt-loading').hide();
                    }
                }
            });
        }

        $(document).ready(function () {
            resetTable();
            $('#add-modal-category').validate({
                rules: {
                    name: {
                        required: true,
                    },
                },
                // <span class='text-danger'></span>
                messages: {
                    name: {
                        required: "<span class='text-danger'>Please enter a Category name</span>",
                    },
                }
            });
            $('#edit-modal-category').validate({
                rules: {
                    name: {
                        required: true,
                    },
                },
                // <span class='text-danger'></span>
                messages: {
                    name: {
                        required: "<span class='text-danger'>Please enter a Category name</span>",
                    },
                }
            });

        });

        // btn-add-category
        $(document).off('click', '.pnt-bnt-add-category').on('click', '.pnt-bnt-add-category', (e) => {
            $('.pnt-modal-add-category').modal();
        });
        // end-save-add-category

        // btn-save-add-category
        $(document).off('click', '.pnt-btn-modal-add-category-save').on('click', '.pnt-btn-modal-add-category-save', e => {
            if ($("#add-modal-category").valid()) {
                $(e.currentTarget).prop('disabled', true);
                $.ajax({
                    type: "post",
                    url: '{!! url('stock/categories/create') !!}',
                    data: {
                        name: $('.pnt-input-add-name').val(),
                        stock_branch_id: $('#pnt-input-branch_id').val(),
                        '_token': window.token,
                    },
                    beforeSend: function () {
                        $('#pnt-loading').show();
                    },
                    success: function (data) {
                        $('.pnt-btn-modal-add-category-save').prop('disabled', false);
                        if (data.status) {
                            $('.pnt-modal-add-category').modal('hide');
                            $('.pnt-input-add-name').val(''),
                                resetTable();
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Add Category Success fully',
                                showConfirmButton: false,
                                timer: 1500
                            })
                            $('#pnt-loading').hide();
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
                            $('.pnt-btn-modal-add-category-save').prop('disabled', false);
                            $('#pnt-loading').hide();
                        }
                    },
                });
            }
        });
        // end-btn-save-add-category


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
                        url: "{!! url('stock/categories/destroy') !!}/" + window.id,
                        beforeSend: function () {
                            $('#pnt-loading').show();
                        },
                        success: function (data) {
                            if (data.status) {
                                resetTable();
                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    title: 'Delete Category Success fully',
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                            } else {
                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'error',
                                    title: "Can't Delete this Category",
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                            }
                            $('#pnt-loading').hide();
                        }
                    });
                }
            })
        });
        // end btn-delete

        // btn-edit
        $(document).off('click', '.pnt-btn-edit').on('click', '.pnt-btn-edit', (e) => {
            window.id = $(e.currentTarget).val();
            $.ajax({
                type: "get",
                url: "{!! url('stock/categories/getCategory') !!}/" + window.id,
                beforeSend: function () {
                    $('#pnt-loading').show();
                },
                success: function (data) {
                    if (data.status) {
                        $('.pnt-input-name').val(data.category.name);
                        $('.pnt-modal-edit').modal();
                    }
                    $('#pnt-loading').hide();
                }
            });
        });
        // end btn-edit

        // btn save update modal
        $(document).off('click', '.pnt-btn-modal-save').on('click', '.pnt-btn-modal-save', e => {
            if ($("#edit-modal-category").valid()) {
                $(e.currentTarget).prop('disabled', true);
                $.ajax({
                    type: "post",
                    url: "{!! url('stock/categories/update') !!}/" + window.id,
                    data: {
                        name: $(".pnt-input-name").val(),
                        '_token': window.token,
                    },
                    beforeSend: function () {
                        $('#pnt-loading').show();
                    },
                    success: function (data) {
                        if (data.status) {
                            $(".pnt-modal-edit").modal('hide');
                            $('.pnt-btn-modal-save').prop('disabled', false);
                            resetTable();
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Update Category Success fully',
                                showConfirmButton: false,
                                timer: 1500
                            })
                            $('#pnt-loading').hide();
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
                            $('.pnt-btn-modal-save').prop('disabled', false);
                            $('#pnt-loading').hide();
                        }
                    },
                });
            }
        });
        // end btn save update modal

    </script>
@endsection
