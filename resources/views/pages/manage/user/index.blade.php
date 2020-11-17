@extends('layouts.master')

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="row">
        <div class="col-12">
            <div class="card bg-white">
                <div class="card-header">
                    <h4 class="card-title text-dark">User Information</h4>
                    <button type="button" class="btn btn-info pnt-bnt-add-user">Add <span class="btn-icon-right"><i
                                class="fa fa-plus color-info"></i></span>
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="userData" style="min-width: 845px">
                            <thead>
                            <tr>
                                <th class="text-dark">#</th>
                                <th class="text-dark">Username</th>
                                <th class="text-dark">Email</th>
                                <th class="text-dark">Role</th>
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

    {{--    modal add user--}}

    <form id="add-modal-user-valid">
        <div class="modal fade pnt--modal-add-user" id="exampleModalCenter">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add user</h5>
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="mb-1"><strong>Role</strong></label>
                            <select class="form-control pnt-input-status-add" id="pnt-input-status-add">
                                <option value="1">Admin</option>
                                <option value="0">Member</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="mb-1"><strong>Username</strong></label>
                            <input type="text" class="form-control pnt-modal-add-user-username" id="username"
                                   name="username" placeholder="username" required>
                        </div>
                        <div class="form-group">
                            <label class="mb-1"><strong>Email</strong></label>
                            <input type="email" class="form-control pnt-modal-add-user-email" id="email" name="email"
                                   placeholder="hello@example.com" required>
                        </div>
                        <div class="form-group">
                            <label class="mb-1"><strong>Password</strong></label>
                            <input type="password" class="form-control pnt-modal-add-user-password" id="password"
                                   name="password" value="" required>
                        </div>
                        <div class="form-group">
                            <label class="mb-1"><strong>Confirm Password</strong></label>
                            <input type="password" class="form-control pnt-modal-add-user-password_confirmation "
                                   id="confirm_password" name="confirm_password" value="" required>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger light" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary pnt-btn-modal-add-user-save">Register</button>
                    </div>
                </div>
            </div>
        </div>

    </form>
    {{--    end modal add user--}}

    {{--modal update--}}
    <form id="edit-modal-user-valid">
        <div class="modal fade pnt-modal-edit " id="exampleModalCenter">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit User</h5>
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="mb-1"><strong>Role</strong></label>
                            <select class="form-control pnt-input-status" id="pnt-input-status">
                                <option value="1">Admin</option>
                                <option value="0">Member</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="mb-1"><strong>Username</strong></label>
                            <input type="text" class="form-control pnt-input-username" value="" name="username">
                        </div>

                        <div class="form-group">
                            <label class="mb-1"><strong>Email</strong></label>
                            <input type="email" class="form-control pnt-input-email" value="" name="email">
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

    {{--modal reset password--}}
    <form id="reset-pass-modal-user-valid">
        <div class="modal fade pnt-modal-reset-password " id="exampleModalCenter">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Reset Password User</h5>
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label class="mb-1"><strong>Password</strong></label>
                            <input type="password" class="form-control pnt-input-password" id="reset_password"
                                   name="reset_password" value="" required>
                        </div>
                        <div class="form-group">
                            <label class="mb-1"><strong>Confirm Password</strong></label>
                            <input type="password" class="form-control pnt-input-password_confirmation"
                                   id="reset_confirm_password" name="reset_confirm_password" value="" required>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger light" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary pnt-btn-modal-reset-password-save">Save changes
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    {{--modal reset password--}}

@endsection




@section('script')

    <script>
        var token = $('meta[name="csrf-token"]').attr('content');
        var id = 0;
        var table = $('#userData').DataTable();

        function resetTable() {
            $.ajax({
                type: "get",
                url: "{!! url('manage/users/getUsers') !!}",
                beforeSend: function () {
                    $('#pnt-loading').show();
                },
                success: function (data) {
                    if (data.status) {
                        table.destroy();
                        $('.data-section').html(null);
                        $.each(data.userData, function (index, value) {
                            var text_status = "";
                            (value.status > 0 ? text_status = "<span class='badge badge-pill badge-danger'>Admin</span>" : text_status = "<span class='badge badge-pill badge-primary'>Member</span>")
                            $('.data-section').append(
                                "<tr><td>" +
                                (index + 1) +
                                "</td><td>" +
                                value.name +
                                "</td><td>" +
                                value.email +
                                "</td><td>" +
                                text_status +
                                "</td><td>" +
                                "<div class = 'd-flex'>" +
                                "<button  class='btn btn-primary pnt-btn-reset-password shadow btn-xs sharp mr-1' value = '" + value.id + "' >" +
                                "<i class='fa fa-key'></i></button>" +
                                "<button  class='btn btn-warning text-white pnt-btn-edit shadow btn-xs sharp mr-1' value = '" + value.id + "' ><i class='fa fa-pencil-square-o'></i></button>" +
                                "<button  class='btn btn-danger pnt-btn-delete shadow btn-xs sharp mr-1' value = '" + value.id + "' ><i class= 'fa fa-trash'></i></button>"
                            )
                        });
                        table = $('#userData').DataTable();
                        $('#pnt-loading').hide();
                    }
                }
            });
        }

        $(document).ready(function () {
            resetTable();

            $('#add-modal-user-valid').validate({
                rules: {
                    username: {
                        required: true,
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true,
                        minlength: 8
                    },
                    confirm_password: {
                        required: true,
                        minlength: 8,
                        equalTo: "#password"
                    },
                },
                // <span class='text-danger'></span>
                messages: {
                    username: {
                        required: "<span class='text-danger'>Please enter a username</span>",
                    },
                    password: {
                        required: "<span class='text-danger'>Please provide a password</span>",
                        minlength: "<span class='text-danger'>Your password must be at least 8 characters long</span>"
                    },
                    confirm_password: {
                        required: "<span class='text-danger'>Please provide a confirm password</span>",
                        minlength: "<span class='text-danger'>Your password must be at least 8 characters long</span>",
                        equalTo: "<span class='text-danger'>Please enter the same password as above</span>"
                    },
                    email: {
                        required: "<span class='text-danger'>Please enter a email</span>",
                        email: "<span class='text-danger'>Invalid email</span>"
                    },
                }
            });
            $('#edit-modal-user-valid').validate({
                rules: {
                    username: {
                        required: true,
                    },
                    email: {
                        required: true,
                        email: true
                    },
                },
                // <span class='text-danger'></span>
                messages: {
                    username: {
                        required: "<span class='text-danger'>Please enter a username</span>",
                    },
                    email: {
                        required: "<span class='text-danger'>Please enter a email</span>",
                        email: "<span class='text-danger'>Invalid email</span>"
                    },
                }
            });
            $('#reset-pass-modal-user-valid').validate({
                rules: {
                    reset_password: {
                        required: true,
                        minlength: 8
                    },
                    reset_confirm_password: {
                        required: true,
                        minlength: 8,
                        equalTo: "#reset_password"
                    },
                },
                messages: {
                    reset_password: {
                        required: "<span class='text-danger'>Please provide a password</span>",
                        minlength: "<span class='text-danger'>Your password must be at least 8 characters long</span>"
                    },
                    reset_confirm_password: {
                        required: "<span class='text-danger'>Please provide a confirm password</span>",
                        minlength: "<span class='text-danger'>Your password must be at least 8 characters long</span>",
                        equalTo: "<span class='text-danger'>Please enter the same password as above</span>"
                    },
                }
            });
        });

        // btn-save-add-user
        $(document).off('click', '.pnt-btn-modal-add-user-save').on('click', '.pnt-btn-modal-add-user-save', e => {
            if ($("#add-modal-user-valid").valid()) {
                $.ajax({
                    type: "post",
                    url: "{!! url('manage/users/create') !!}",
                    data: {
                        name: $('.pnt-modal-add-user-username').val(),
                        email: $('.pnt-modal-add-user-email').val(),
                        status: $('.pnt-input-status-add option:selected').val(),
                        password: $('.pnt-modal-add-user-password').val(),
                        password_confirmation: $('.pnt-input-password_confirmation').val(),
                        '_token': window.token,
                    },
                    beforeSend: function () {
                        $('#pnt-loading').show();
                    },
                    success: function (data) {
                        if (data.status) {
                            $('.pnt--modal-add-user').modal('hide');
                            $('#pnt-loading').hide();
                            resetTable();
                            Swal.fire({

                                position: 'top-end',
                                icon: 'success',
                                title: 'Add User Success fully',
                                showConfirmButton: false,
                                timer: 1500
                            })
                        }
                    },
                    error: function (jqXHR, exception) {
                        if (jqXHR.status !== 200) {
                            $('#pnt-loading').hide();
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
            }
        });
        // end-btn-save-add-user


        // btn-add-user
        $(document).off('click', '.pnt-bnt-add-user').on('click', '.pnt-bnt-add-user', (e) => {
            $('.pnt-modal-add-user-username').val('');
            $('.pnt-modal-add-user-email').val('');
            $('.pnt-modal-add-user-password').val('');
            $('.pnt-modal-add-user-password_confirmation').val('');
            $('.pnt--modal-add-user').modal();
        });
        // end-save-add-user


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
                        url: "{!! url('manage/users/destroy') !!}/" + window.id,
                        beforeSend: function () {
                            $('#pnt-loading').show();
                        },
                        success: function (data) {
                            resetTable();
                            console.log(data)
                            $('#pnt-loading').hide();
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Delete User Success fully',
                                showConfirmButton: false,
                                timer: 1500
                            })
                        }
                    });
                }
            })
        });
        // end btn-delete


        // btn-password
        $(document).off('click', '.pnt-btn-reset-password').on('click', '.pnt-btn-reset-password', (e) => {
            window.id = $(e.currentTarget).val();
            $('.pnt-modal-reset-password').modal();
        });
        // end btn-password

        // btn save reset-password modal
        $(document).off('click', '.pnt-btn-modal-reset-password-save').on('click', '.pnt-btn-modal-reset-password-save', e => {
            if ($("#reset-pass-modal-user-valid").valid()) {
                $.ajax({
                    type: "post",
                    url: "{!! url('manage/users/resetPassword') !!}/" + window.id,
                    data: {
                        password: $(".pnt-input-password").val(),
                        password_confirmation: $(".pnt-input-password_confirmation").val(),
                        '_token': window.token,
                    },
                    beforeSend: function () {
                        $('#pnt-loading').show();
                    },
                    success: function (data) {
                        if (data.status) {
                            $('.pnt-modal-reset-password').modal('hide');
                            $('.pnt-input-password').val('');
                            $('.pnt-input-password_confirmation').val('');
                            resetTable();
                            $('#pnt-loading').hide();
                            Swal.fire({

                                position: 'top-end',
                                icon: 'success',
                                title: 'Update User Success fully',
                                showConfirmButton: false,
                                timer: 1500
                            })
                        }
                    },
                    error: function (jqXHR, exception) {
                        if (jqXHR.status !== 200) {
                            $('#pnt-loading').hide();
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
            }
        });
        // end btn save reset-password modal

        // btn-edit
        $(document).off('click', '.pnt-btn-edit').on('click', '.pnt-btn-edit', (e) => {
            window.id = $(e.currentTarget).val();
            $.ajax({
                type: "get",
                url: "{!! url('manage/users/oneUser') !!}/" + window.id,
                beforeSend: function () {
                    $('#pnt-loading').show();
                },
                success: function (data) {
                    if (data.status) {
                        var status = data.userData.status;
                        $('.pnt-input-status').val(data.userData.status).change();
                        $('.pnt-input-username').val(data.userData.name);
                        $('.pnt-input-email').val(data.userData.email);
                        $('#pnt-loading').hide();
                        $('.pnt-modal-edit').modal();
                    }
                }
            });
        });
        // end btn-edit

        // btn save update modal
        $(document).off('click', '.pnt-btn-modal-save').on('click', '.pnt-btn-modal-save', e => {
            if ($("#edit-modal-user-valid").valid()) {
                $.ajax({
                    type: "post",
                    url: "{!! url('manage/users/update') !!}/" + window.id,
                    data: {
                        name: $('.pnt-input-username').val(),
                        email: $('.pnt-input-email').val(),
                        status: $('#pnt-input-status option:selected').val(),
                        '_token': window.token,
                    },
                    beforeSend: function () {
                        $('#pnt-loading').show();
                    },
                    success: function (data) {
                        if (data.status) {
                            $('.pnt-modal-edit').modal('hide');
                            $('#pnt-loading').hide();
                            resetTable();
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Update User Success fully',
                                showConfirmButton: false,
                                timer: 1500
                            })
                        }
                    },
                    error: function (jqXHR, exception) {
                        if (jqXHR.status !== 200) {
                            $('#pnt-loading').hide();
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
            }
        });
        // end btn save update modal

    </script>
@endsection
