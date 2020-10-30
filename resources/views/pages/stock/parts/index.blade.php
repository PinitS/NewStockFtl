@extends('layouts.master')

@section('content')

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <input type="hidden" id="pnt-input-branch_id" name="pnt-input-branch_id" runat="server"
           value="{{ session()->get('branch')[0]['id'] }}"/>

    <div class="row">
        <div class="col-12">
            <div class="card bg-white">
                <div class="card-header">
                    <h4 class="card-title text-dark">Parts Information</h4>

                    <button type="button" class="btn btn-info pnt-bnt-add-parts">Add <span class="btn-icon-right"><i
                                class="fa fa-plus color-info"></i></span>
                    </button>

                </div>
                <div class="card-body">

                    <div class="row pull-right mr-0">

                        <div class="form-group">
                            <select class="form-control pnt-sel-filter-category">
                            </select>
                        </div>

                    </div>

                    <div class="div">
                        <div class="table-responsive">
                            <table id="partsInformation" style="min-width: 845px">
                                <thead>
                                <tr>
                                    <th class="text-dark">#</th>
                                    <th class="text-dark">Name</th>
                                    <th class="text-dark">Sku</th>
                                    <th class="text-dark">Category</th>
                                    <th class="text-dark">Branch</th>
                                    <th class="text-dark">Quantity</th>
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
    </div>


    {{--    modal add parts--}}
    <div class="modal fade pnt-modal-add-parts" id="pnt-modal-add-parts">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Parts</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="input-group mb-3 ">
                        <div class="input-group-prepend w-10">
                            <span class="input-group-text">Category</span>
                        </div>
                        <select class="form-control pnt-modal-sel-add-parts-category">
                        </select>
                    </div>

                    <div class="input-group mb-3 ">
                        <div class="input-group-prepend w-10">
                            <span class="input-group-text">&nbsp &nbsp Group &nbsp</span>
                        </div>
                        <select class="form-control pnt-modal-sel-add-group-parts">
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="mb-1"><strong>Name</strong></label>
                        <input type="text" class="form-control pnt-modal-add-parts-name" id="name" name="name"
                               placeholder="Name" required>
                    </div>

                    <div class="form-group">
                        <label class="mb-1"><strong>Quantity</strong></label>
                        <input type="number" class="form-control pnt-modal-add-parts-quantity" id="quantity"
                               name="quantity" required>
                    </div>

                    <div class="form-group">
                        <label class="mb-1"><strong>Sku</strong></label>
                        <input type="text" class="form-control pnt-modal-add-parts-sku" id="sku" name="sku"
                               placeholder="#A382824" value="#">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger light" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary pnt-btn-modal-add-parts-save">Add Parts</button>
                </div>
            </div>
        </div>
    </div>
    {{--    end modal add parts--}}

    {{--    modal plus--}}
    <div class="modal fade pnt-modal-plus " id="exampleModalCenter">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Increment Part</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <span>Quantity : </span><span id="modal-plus-quantity"></span>

                    <div class="input-group mt-3 input-success-o">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-plus"></i></span>
                        </div>
                        <input type="number" class="form-control pnt-plus-quantity" value="">
                        <input type="text" class="form-control pnt-plus-detail" placeholder="Description...">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger light" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success pnt-btn-modal-plus-save">Save changes</button>
                </div>

            </div>
        </div>
    </div>
    {{--    end modal plus--}}

    {{--    modal minus--}}
    <div class="modal fade pnt-modal-minus " id="exampleModalCenter">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Decrement Part</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <span>Quantity : </span><span id="modal-minus-quantity"></span>

                    <div class="input-group mt-3 input-info-o">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-minus"></i></span>
                        </div>

                        <input type="number" class="form-control pnt-minus-quantity">
                        <input type="text" class="form-control pnt-minus-detail" placeholder="Description...">

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger light" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-info pnt-btn-modal-minus-save">Save changes</button>
                </div>

            </div>
        </div>
    </div>
    {{--    end modal minus--}}

    {{--    modal history--}}
    <div class="modal fade bd-example-modal-lg pnt-modal-history" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Parts History</h5>
                    <button type="button" class="close pnt-data-history-close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table id="partsHistory" style="min-width: 845px">
                                    <thead>
                                    <tr>
                                        <th class="text-dark">#</th>
                                        <th class="text-dark">Part</th>
                                        <th class="text-dark">Type</th>
                                        <th class="text-dark">Quatity</th>
                                        <th class="text-dark">Detail</th>
                                        <th class="text-dark">User</th>
                                        <th class="text-dark">date</th>
                                    </tr>
                                    </thead>
                                    <tbody class="data-section-history">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--    end modal history--}}

    {{--modal update--}}
    <div class="modal fade pnt-modal-edit " id="exampleModalCenter">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit parts</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="input-group mb-3 ">
                        <div class="input-group-prepend w-10">
                            <span class="input-group-text">Category</span>
                        </div>
                        <select class="form-control pnt-modal-sel-edit-parts-category">
                        </select>
                    </div>

                    <div class="input-group mb-3 ">
                        <div class="input-group-prepend w-10">
                            <span class="input-group-text">&nbsp &nbsp Group &nbsp</span>
                        </div>
                        <select class="form-control pnt-modal-sel-edit-group-parts">
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="mb-1"><strong>Name</strong></label>
                        <input type="text" class="form-control pnt-modal-edit-parts-name">
                    </div>

                    <div class="form-group">
                        <label class="mb-1"><strong>Sku</strong></label>
                        <input type="text" class="form-control pnt-modal-edit-parts-sku">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger light" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-warning pnt-btn-modal-edit-parts-save">Edit Parts</button>
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
        var change_id = 0;
        var table = $('#partsInformation').DataTable();
        var table_history = $('#partsHistory').DataTable();
        var filter_dropdown = $('.pnt-sel-filter-category');
        var category_filter = 0;
        var checkQuantity = 0;

        var filter = $('.pnt-sel-filter-category');
        var addpart = $('.pnt-modal-sel-add-parts-category');
        var addgroup = $('.pnt-modal-sel-add-group-parts');
        var editPart = $('.pnt-modal-sel-edit-parts-category');
        var editgroup = $('.pnt-modal-sel-edit-group-parts');


        function getOnePart() {
            $.ajax({
                type: "get",
                url: "{!! url('stock/parts/getOnePart') !!}/" + window.id,
                success: function (data) {
                    window.checkQuantity = data.part.quantity;
                    if (data.status) {
                        $('.pnt-plus-quantity').val('');
                        $('.pnt-minus-quantity').val('');
                        $('.pnt-plus-detail').val(null);
                        $('.pnt-minus-detail').val(null);
                        if (window.change_id == 0) {
                            $('#modal-plus-quantity').text(data.part.quantity);
                            $('.pnt-modal-plus').modal();
                        } else if (window.change_id == 1) {
                            $('#modal-minus-quantity').text(data.part.quantity);
                            $('.pnt-modal-minus').modal();
                        } else {
                            $('.pnt-modal-sel-edit-parts-category').val(data.part.stock_category_id).change();
                            $('.pnt-modal-sel-edit-group-parts').val(data.part.group_part_id).change();
                            $('.pnt-modal-edit-parts-name').val(data.part.name);
                            $('.pnt-modal-edit-parts-sku').val(data.part.sku);
                            $(".pnt-modal-edit").modal();
                        }
                    }
                }
            });
        }

        function saveChange(quantity, description) {
            $.ajax({
                type: "post",
                url: "{!! url('stock/parts/changeQuantity') !!}/" + window.id,
                data: {
                    type: window.change_id,
                    quantity: quantity,
                    description: description,
                    _token: window.token,
                },
                success: function (data) {
                    if (data.status) {

                        $("#modal-plus-quantity").text();
                        $(".pnt-modal-plus").modal('hide');

                        $("#modal-minus-quantity").text();
                        $(".pnt-modal-minus").modal('hide');

                        $('.pnt-btn-modal-plus-save').prop('disabled', false);
                        $('.pnt-btn-modal-minus-save').prop('disabled', false);

                        resetTable();
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Update Quantity Success fully',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    } else {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'error',
                            title: 'Something went wrong',
                            showConfirmButton: false,
                            timer: 1500
                        })

                    }
                }
            });
        }

        function getOptionDropdown() {
            $.ajax({
                type: "post",
                url: '{!! url('stock/parts/getParts') !!}',
                data: {
                    filter_category_id: 0,
                    '_token': window.token,
                },

                success: function (data) {
                    // console.log(data.dataSet.group);
                    window.editPart.empty();
                    window.filter.empty();
                    window.addpart.empty();
                    window.addgroup.empty();
                    window.editgroup.empty();

                    if (data.status) {
                        var str = "<option value=" + 0 + "> <strong>" + "All Categories" + "</strong></option>";
                        $.each(data.dataSet.categories, function (index, value) {
                            str += "<option value=" + value.id + "> <strong>" + value.name + "</strong></option>"
                        });
                        window.editPart.append(str);
                        window.filter.append(str);
                        window.addpart.append(str);
                        window.filter.selectpicker('refresh');
                        window.addpart.selectpicker('refresh');
                        window.editPart.selectpicker('refresh');

                        var group_option = "<option value=" + 0 + "> <strong>" + "New Parts" + "</strong></option>";
                        $.each(data.dataSet.group, function (index, value) {
                            group_option += "<option value=" + value.id + "> <strong>" + value.name + "</strong></option>"
                        });
                        // console.log(group_option);
                        window.addgroup.append(group_option);
                        window.addgroup.selectpicker('refresh');
                        window.editgroup.append(group_option);
                        window.editgroup.selectpicker('refresh');
                    }
                }
            });

        }

        function resetTable(filter) {
            $.ajax({
                type: "post",
                url: '{!! url('stock/parts/getParts') !!}',
                data: {
                    filter_category_id: filter,
                    '_token': window.token,
                },

                success: function (data) {
                    if (data.status) {

                        window.table.destroy();
                        $('.data-section').html(null);
                        $.each(data.dataSet.parts, function (index, value) {
                            $('.data-section').append(
                                "<tr><td>" +
                                (index + 1) +
                                "</td><td>" +
                                value.name +
                                "</td><td>" +
                                value.sku +
                                "</td><td>" +
                                (value.category == null ? "-" : value.category.name) +
                                "</td><td>" +
                                (value.branch == null ? "-" : value.branch.name) +
                                "</td><td>" +
                                value.quantity +
                                "</td><td>" +
                                "<div class = 'd-flex'>" +

                                "<button  class='btn btn-success text-white pnt-btn-plus shadow btn-xs sharp mr-1' value = '" + value.id + "' data-id = '" + 0 + "'><i class='fa fa-plus'></i></button>" +
                                "<button  class='btn btn-info text-white pnt-btn-minus shadow btn-xs sharp mr-1' value = '" + value.id + "' data-id = '" + 1 + "'><i class='fa fa-minus'></i></button>" +
                                "<button  class='btn btn-secondary text-white pnt-btn-history shadow btn-xs sharp mr-1' value = '" + value.id + "' ><i class='fa fa-calculator'></i></button>" +
                                "<button  class='btn btn-warning text-white pnt-btn-edit shadow btn-xs sharp mr-1' value = '" + value.id + "' data-id = '" + 3 + "'><i class='fa fa-pencil-square-o'></i></button>" +
                                "<button  class='btn btn-danger pnt-btn-delete shadow btn-xs sharp mr-1' value = '" + value.id + "' ><i class= 'fa fa-trash'></i></button>"
                            )
                        });
                        window.table = $('#partsInformation').DataTable();
                    }
                }
            });
            getOptionDropdown();
        }

        $(document).ready(function () {
            resetTable(window.category_filter);
            //getOptionDropdown();
        });

        // btn-filter-parts
        $(document).off('click', '.pnt-sel-filter-category').on('click', '.pnt-sel-filter-category', (e) => {
            window.category_filter = $(".pnt-sel-filter-category option:selected").val();
            resetTable(window.category_filter);
        });
        // end-filter-parts


        // btn-add-parts
        $(document).off('click', '.pnt-bnt-add-parts').on('click', '.pnt-bnt-add-parts', (e) => {
            $(".pnt-modal-add-parts").modal();
        });
        // end-save-add-parts

        // btn-save-add-parts
        $(document).off('click', '.pnt-btn-modal-add-parts-save').on('click', '.pnt-btn-modal-add-parts-save', e => {
            $('e.currentTarget').prop('disabled', true);

            if ($(".pnt-modal-sel-add-parts-category option:selected").val() != 0) {

                if ($('.pnt-modal-add-parts-quantity').val() == 0) {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: 'Plaese Add Quantity.',
                        showConfirmButton: false,
                        timer: 1500
                    })
                } else {
                    $.ajax({
                        type: "post",
                        url: '{{route('createParts')}}',
                        data: {
                            stock_category_id: $(".pnt-modal-sel-add-parts-category option:selected").val(),
                            group_id: $(".pnt-modal-sel-add-group-parts option:selected").val(),
                            stock_branch_id: $('#pnt-input-branch_id').val(),
                            name: $('.pnt-modal-add-parts-name').val(),
                            quantity: $('.pnt-modal-add-parts-quantity').val(),
                            sku: $('.pnt-modal-add-parts-sku').val(),
                            '_token': window.token,
                        },
                        success: function (data) {
                            if (data.status) {
                                $(".pnt-modal-add-parts").modal('hide');
                                $('pnt-bnt-add-parts').prop('disabled', false);
                                resetTable();
                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    title: 'Add Category Success fully.',
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                            } else {
                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'error',
                                    title: 'Duplicate Parts Name.',
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
                                $('pnt-bnt-add-parts').prop('disabled', false);
                            }
                        },
                    });
                }

            } else {
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: 'Please Select Category',
                    showConfirmButton: false,
                    timer: 1500
                })
                $('pnt-bnt-add-parts').prop('disabled', false);
            }
            // getOptionDropdown();
        });
        // end-btn-save-add-parts

        // btn-plus
        $(document).off('click', '.pnt-btn-plus').on('click', '.pnt-btn-plus', (e) => {
            window.id = $(e.currentTarget).val();
            window.change_id = $(e.currentTarget).attr('data-id');
            getOnePart();
        });
        // end-btn-plus

        // pnt-btn-modal-plus-save
        $(document).off('click', '.pnt-btn-modal-plus-save').on('click', '.pnt-btn-modal-plus-save', (e) => {
            $(e.currentTarget).prop('disabled', true);

            console.log("plus")
            console.log(window.change_id);
            var quantity = $('.pnt-plus-quantity').val();
            var description = $('.pnt-plus-detail').val();
            console.log(quantity);
            if (quantity == "" || quantity <= 0) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: 'Quantity Wrong',
                    showConfirmButton: false,
                    timer: 1500
                })
            } else {
                saveChange(quantity, description);
            }
        });
        // pnt-btn-modal-plus-save

        // btn-minus
        $(document).off('click', '.pnt-btn-minus').on('click', '.pnt-btn-minus', (e) => {
            window.id = $(e.currentTarget).val();
            window.change_id = $(e.currentTarget).attr('data-id');
            console.log(window.change_id);
            getOnePart();
        });
        // end-btn-minus

        // pnt-btn-modal-minus-save
        $(document).off('click', '.pnt-btn-modal-minus-save').on('click', '.pnt-btn-modal-minus-save', (e) => {
            $(e.currentTarget).prop('disabled', true);

            console.log("minus")
            var quantity = $('.pnt-minus-quantity').val();
            var description = $('.pnt-minus-detail').val();
            console.log('update', quantity);
            if (quantity == "" || quantity <= 0 || quantity > window.checkQuantity) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: 'Quantity Wrong',
                    showConfirmButton: false,
                    timer: 1500
                })
            } else {
                saveChange(quantity, description);
            }
        });
        // end-btn-modal-minus-save

        // btn-history
        $(document).off('click', '.pnt-btn-history').on('click', '.pnt-btn-history', (e) => {
            window.id = $(e.currentTarget).val();
            $.ajax({
                type: "get",
                url: '{!! url('stock/parts/getPartHistory') !!}/' + window.id,
                success: function (data) {
                    if (data.status) {
                        window.table_history.destroy();
                        $('.data-section-history').html(null);
                        $.each(data.partHistory, function (index, value) {
                            var text = '';
                            var date = moment(value.created_at).format('L');

                            (value.type == 0 ? text = 'Imported' : text = 'Withdraw')
                            $('.data-section-history').append(
                                "<tr><td>" +
                                (index + 1) +
                                "</td><td>" +
                                value.part.name +
                                "</td><td>" +
                                text +
                                "</td><td>" +
                                value.quantity +
                                "</td><td>" +
                                value.detail +
                                "</td><td>" +
                                value.user.name +
                                "</td><td>" +
                                date +
                                "</td></tr>"
                            )
                        });
                        window.table_history = $('#partsHistory').DataTable();
                        $(".pnt-modal-history").modal();
                    }
                }
            });
        });
        // end-btn-history

        // pnt-btn-edit
        $(document).off('click', '.pnt-btn-edit').on('click', '.pnt-btn-edit', (e) => {
            window.id = $(e.currentTarget).val();
            window.change_id = $(e.currentTarget).attr('data-id');
            getOnePart();
        });
        // end-pnt-btn-edit

        // pnt-btn-edit-save
        $(document).off('click', '.pnt-btn-modal-edit-parts-save').on('click', '.pnt-btn-modal-edit-parts-save', (e) => {
            $(e.currentTarget).prop('disabled', true);
            console.log(window.id);
            if ($(".pnt-modal-sel-edit-parts-category option:selected").val() != 0) {
                $.ajax({
                    type: "post",
                    url: '{!! url('stock/parts/update') !!}/' + window.id,
                    data: {
                        stock_category_id: $('.pnt-modal-sel-edit-parts-category option:selected').val(),
                        name: $('.pnt-modal-edit-parts-name').val(),
                        sku: $('.pnt-modal-edit-parts-sku').val(),
                        group_id: $('.pnt-modal-sel-edit-group-parts option:selected').val(),
                        '_token': window.token,
                    },
                    success: function (data) {
                        console.log(data)
                        if (data.status) {
                            $(".pnt-modal-edit").modal('hide');
                            $('.pnt-btn-modal-edit-parts-save').prop('disabled', false);
                            resetTable();
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Add Category Success fully',
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
                            $('.pnt-btn-modal-edit-parts-save').prop('disabled', false);

                        }
                    },
                });
            } else {
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: 'Please Select Category',
                    showConfirmButton: false,
                    timer: 1500
                })
                $('.pnt-btn-modal-edit-parts-save').prop('disabled', false);

            }
        });
        // end-pnt-btn-edit-save

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
                        url: "{!! url('stock/parts/destroy') !!}/" + window.id,
                        success: function (data) {
                            resetTable();

                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Delete Part Success fully',
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
