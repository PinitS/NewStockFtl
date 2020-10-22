@extends('layouts.master')

@section('content')

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="row">
        <div class="col-12">
            <div class="card bg-white">
                <div class="card-header">
                    <h4 class="card-title text-dark">Product Information</h4>
                    <button type="button" class="btn btn-info pnt-bnt-add-product">Add <span class="btn-icon-right"><i
                                class="fa fa-plus color-info"></i></span>
                    </button>
                </div>
                <div class="card-body">
                    <div class="div">
                        <div class="table-responsive">
                            <table id="productInformation" style="min-width: 845px">
                                <thead>
                                <tr>
                                    <th class="text-dark">#</th>
                                    <th class="text-dark">Name</th>
                                    <th class="text-dark">Model</th>
                                    <th class="text-dark">Description</th>
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

    {{--    modal add Product--}}
    <div class="modal fade pnt-modal-add-product" id="pnt-modal-add-product">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Product</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="input-group mb-3 ">
                        <div class="input-group-prepend w-10">
                            <span class="input-group-text">&nbsp &nbsp Model</span>
                        </div>
                        <select class="form-control pnt-modal-sel-add-product-model">
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="mb-1"><strong>Name</strong></label>
                        <input type="text" class="form-control pnt-modal-add-product-name"
                               placeholder="Name" required>
                    </div>

                    <div class="form-group">
                        <label class="mb-1"><strong>Description</strong></label>
                        <input type="text" class="form-control pnt-modal-add-product-description">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger light" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary pnt-btn-modal-add-product-save">Add Product</button>
                </div>
            </div>
        </div>
    </div>
    {{--    end modal add product--}}

    {{--modal update--}}
    <div class="modal fade pnt-modal-edit " id="exampleModalCenter">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Product</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="input-group mb-3 ">
                        <div class="input-group-prepend w-10">
                            <span class="input-group-text">&nbsp &nbsp Model</span>
                        </div>
                        <select class="form-control pnt-modal-sel-edit-product-model">
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="mb-1"><strong>Name</strong></label>
                        <input type="text" class="form-control pnt-modal-edit-product-name"
                               placeholder="Name" required>
                    </div>

                    <div class="form-group">
                        <label class="mb-1"><strong>Description</strong></label>
                        <input type="text" class="form-control pnt-modal-edit-product-description">
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger light" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-warning pnt-btn-modal-edit-product-save">Edit Product</button>
                </div>

            </div>
        </div>
    </div>
    {{--modal update--}}

    {{--    pnt-modal-product-parts--}}
    <div class="modal fade pnt-modal-product-parts" id="pnt-modal-product-parts">
        <div class="modal-dialog modal-xl " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Parts</h5>
                    <button type="button" class="btn btn-secondary pnt-bnt-add-path">Add to Product <span
                            class="btn-icon-right"><i
                                class="fa fa-plus color-info"></i></span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="pnt-add-path-data-toggle text-center " style="display:none;">
                        <div class="col-md-6 mx-auto">
                            <ul class="list-group">
                                <li class="list-group-item disabled"><strong>Add Parts to Product</strong></li>
                                <li class="list-group-item">
                                    <select class="form-control pnt-modal-sel-add-group-part">
                                    </select>
                                </li>
                                <li class="list-group-item">
                                    {{--                                    <label>Quatity :</label>--}}
                                    <input type="text" class="form-control pnt-modal-sel-add-group-quantity"
                                           placeholder="Quatity">
                                </li>
                                <li class="list-group-item">
                                    <button type="button"
                                            class="btn btn-secondary btn-block mb-3 pnt-bnt-add-group-save">Add <i
                                            class="ml-2 fa fa-plus color-info"></i>
                                    </button>
                                </li>
                            </ul>
                        </div>
                        <hr>
                    </div>


                    <div class="pnt-add-path-edit-data-toggle text-center " style="display:none;">
                        <div class="col-md-6 mx-auto">
                            <ul class="list-group">
                                <li class="list-group-item active"><strong>Edit Quantity Parts</strong></li>
                                <li class="list-group-item">
                                    <input type="text" class="form-control pnt-modal-sel-edit-group-quantity"
                                           placeholder="Quatity">

                                </li>
                                <li class="list-group-item">
                                    <button type="button"
                                            class="btn btn-primary btn-block mb-3 pnt-bnt-edit-group-save">Edit
                                        <i class="ml-2 fa fa-save color-info"></i>
                                    </button>
                                </li>
                            </ul>
                        </div>
                        <hr>
                    </div>


                    <div class="div">
                        <div class="table-responsive">
                            <table id="productPartInformation" style="min-width: 845px">
                                <thead>
                                <tr>
                                    <th class="text-dark">#</th>
                                    <th class="text-dark">Parts</th>
                                    <th class="text-dark">Quantity</th>
                                    <th class="text-dark">Manage</th>
                                </tr>
                                </thead>
                                <tbody class="data-section-productPart">
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger light" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    {{--    end pnt-modal-product-parts--}}

@endsection



@section('script')

    <script>

        var token = $('meta[name="csrf-token"]').attr('content');
        var id = 0;
        var part_id = 0;
        var table = $('#productInformation').DataTable();
        var tablePath = $('#productPartInformation').DataTable();

        var addModel = $('.pnt-modal-sel-add-product-model');
        var editModel = $('.pnt-modal-sel-edit-product-model');
        var addGroup = $('.pnt-modal-sel-add-group-part');

        function getOptionDropdown() {
            $.ajax({
                type: "get",
                url: '{!! url('product_location/product/getProducts') !!}',
                success: function (data) {
                    window.addModel.empty();
                    window.editModel.empty();
                    window.addGroup.empty();
                    console.log(data);
                    if (data.status) {
                        var model = "<option value=" + 0 + "> <strong>" + "All Model" + "</strong></option>";
                        $.each(data.dataSet.model, function (index, value) {
                            model += "<option value=" + value.id + "> <strong>" + value.name + "</strong></option>"
                        });

                        var group_option = "<option value=" + 0 + "> <strong>" + "All Parts" + "</strong></option>";
                        $.each(data.dataSet.group, function (index, value) {
                            group_option += "<option value=" + value.id + "> <strong>" + value.name + "</strong></option>"
                        });

                        window.addGroup.append(group_option);
                        window.addModel.append(model);
                        window.editModel.append(model);
                        window.addGroup.selectpicker('refresh');
                        window.addModel.selectpicker('refresh');
                        window.editModel.selectpicker('refresh');
                    }
                }
            });
        }

        function resetTable() {
            $.ajax({
                type: "get",
                url: '{!! url('product_location/product/getProducts') !!}',
                success: function (data) {
                    window.table.destroy();
                    if (data.status) {
                        console.log(data);
                        $('.data-section').html(null);
                        $.each(data.dataSet.product, function (index, value) {
                            $('.data-section').append(
                                "<tr><td>" +
                                (index + 1) +
                                "</td><td>" +
                                value.name +
                                "</td><td>" +
                                (value.location_model == null ? "-" : value.location_model.name) +
                                // "</td><td>" +
                                // (value.location == null ? "-" : value.location.name) +
                                "</td><td>" +
                                (value.description == null ? "-" : value.description) +
                                "</td><td>" +
                                "<div class = 'd-flex'>" +
                                "<button  class='btn btn-secondary text-white pnt-btn-parts shadow btn-xs sharp mr-1' value = '" + value.id + "' data-id = '" + value.id + "'><i class='fa fa-file'></i></button>" +
                                "<button  class='btn btn-warning text-white pnt-btn-edit shadow btn-xs sharp mr-1' value = '" + value.id + "' data-id = '" + value.id + "'><i class='fa fa-pencil-square-o'></i></button>" +
                                "<button  class='btn btn-danger pnt-btn-delete shadow btn-xs sharp mr-1' value = '" + value.id + "' ><i class= 'fa fa-trash'></i></button>"
                            )
                        });
                        window.table = $('#productInformation').DataTable();
                    }
                }
            });
        }

        function resetProductParts() {
            $.ajax({
                type: "get",
                url: '{!! url('product_location/productPart/getProductParts') !!}/' + window.id,
                success: function (data) {
                    console.log(data);
                    window.tablePath.destroy();
                    $('.data-section-productPart').html(null);
                    $.each(data.productParts, function (index, value) {
                        $('.data-section-productPart').append(
                            "<tr><td>" +
                            (index + 1) +
                            "</td><td>" +
                            (value.group_part === null ? "ไม่มีข้อมูล" : value.group_part.name) +
                            "</td><td>" +
                            value.quantity +
                            "</td><td>" +
                            "<div class = 'd-flex'>" +
                            "<button  class='btn btn-warning text-white pnt-btn-edit-modal-product-part shadow btn-xs sharp mr-1' value = '" + value.id + "' data-id = '" + value.id + "'><i class='fa fa-pencil-square-o'></i></button>" +
                            "<button  class='btn btn-danger pnt-btn-delete-modal-product-part shadow btn-xs sharp mr-1' value = '" + value.id + "' ><i class= 'fa fa-trash'></i></button>"
                        )
                    });
                    window.tablePath = $('#productPartInformation').DataTable();
                    $(".pnt-modal-product-parts").modal();
                }
            });
        }

        $(document).ready(function () {
            resetTable();
            getOptionDropdown();
        });

        // btn-add-product
        $(document).off('click', '.pnt-bnt-add-product').on('click', '.pnt-bnt-add-product', (e) => {
            $(".pnt-modal-add-product").modal();
            $('.pnt-modal-add-product-name').val('');
            $('.pnt-modal-add-product-description').val('');

        });
        // end-save-add-product

        // btn-save-add-product
        $(document).off('click', '.pnt-btn-modal-add-product-save').on('click', '.pnt-btn-modal-add-product-save', e => {
            var model_id = $(".pnt-modal-sel-add-product-model option:selected").val();
            if (model_id === 0) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: 'Please Select Model',
                    showConfirmButton: false,
                    timer: 1500
                })
            } else {
                $.ajax({
                    type: "post",
                    url: '{{route('createProduct')}}',
                    data: {
                        model_id: model_id,
                        name: $('.pnt-modal-add-product-name').val(),
                        description: $('.pnt-modal-add-product-description').val(),
                        '_token': window.token,
                    },

                    success: function (data) {
                        if (data.status) {
                            $(".pnt-modal-add-product").modal('hide');
                            resetTable();
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Add Product Success fully',
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
            }
        });
        // end-btn-save-add-product

        // pnt-btn-edit
        $(document).off('click', '.pnt-btn-edit').on('click', '.pnt-btn-edit', (e) => {
            window.id = $(e.currentTarget).val();
            $.ajax({
                type: "get",
                url: '{!! url('product_location/product/getOneProduct') !!}/' + window.id,
                success: function (data) {
                    if (data.status) {
                        console.log(data)
                        $(".pnt-modal-sel-edit-product-model").val(data.product.model_id).change();
                        $('.pnt-modal-edit-product-name').val(data.product.name);
                        $('.pnt-modal-edit-product-description').val(data.product.description);
                    }
                }
            });
            $(".pnt-modal-edit").modal();
        });
        // end-pnt-btn-edit

        // pnt-btn-edit-save
        $(document).off('click', '.pnt-btn-modal-edit-product-save').on('click', '.pnt-btn-modal-edit-product-save', (e) => {
            var model_id = $(".pnt-modal-sel-edit-product-model option:selected").val();
            if (model_id == 0) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: 'Please Select Model',
                    showConfirmButton: false,
                    timer: 1500
                })
            } else {
                $.ajax({
                    type: "post",
                    url: '{!! url('product_location/product/update') !!}/' + window.id,
                    data: {
                        model_id: model_id,
                        name: $('.pnt-modal-edit-product-name').val(),
                        description: $('.pnt-modal-edit-product-description').val(),
                        '_token': window.token,
                    },

                    success: function (data) {
                        if (data.status) {
                            $(".pnt-modal-edit").modal('hide');
                            resetTable();
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Update Product Success fully',
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
                        url: '{!! url('product_location/product/destroy') !!}/' + window.id,
                        success: function (data) {
                            resetTable();
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Delete Product Success fully',
                                showConfirmButton: false,
                                timer: 1500
                            })
                        }
                    });
                }
            })
        });
        // end btn-delete

        // pnt-btn-parts
        $(document).off('click', '.pnt-btn-parts').on('click', '.pnt-btn-parts', (e) => {
            window.id = $(e.currentTarget).val();
            console.log('product_part', window.id);
            $(".pnt-add-path-edit-data-toggle").hide();
            $(".pnt-add-path-data-toggle").hide();
            resetProductParts();
        });
        // end-pnt-btn-parts

        // pnt-btn-parts-toggle
        $(document).off('click', '.pnt-bnt-add-path').on('click', '.pnt-bnt-add-path', (e) => {
            $(".pnt-add-path-edit-data-toggle").hide(150);
            $(".pnt-add-path-data-toggle").toggle(150);
        });
        // end-pnt-btn-parts-toggle

        // pnt-bnt-add-group-save
        $(document).off('click', '.pnt-bnt-add-group-save').on('click', '.pnt-bnt-add-group-save', (e) => {
            if ($('.pnt-modal-sel-add-group-part option:selected').val() == 0) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: 'Please Selected Parts',
                    showConfirmButton: false,
                    timer: 1500
                })
            } else {
                $.ajax({
                    type: "post",
                    url: '{!! url('product_location/productPart/create') !!}',
                    data: {
                        product_id: window.id,
                        group_part_id: $('.pnt-modal-sel-add-group-part option:selected').val(),
                        quantity: $('.pnt-modal-sel-add-group-quantity').val(),
                        '_token': window.token,
                    },

                    success: function (data) {
                        console.log(data);
                        if (data.status) {
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Add Parts to Product Success fully',
                                showConfirmButton: false,
                                timer: 1500
                            })
                        } else {
                            Swal.fire({
                                position: 'top-end',
                                icon: 'error',
                                title: 'Duplicate Parts',
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
                resetProductParts();
            }

            $('.pnt-modal-sel-add-group-quantity').val('');
            $('.pnt-modal-sel-add-group-part').val(0).change();
        });
        // end-pnt-bnt-add-group-save

        // pnt-btn-edit-toggle
        $(document).off('click', '.pnt-btn-edit-modal-product-part').on('click', '.pnt-btn-edit-modal-product-part', (e) => {
            window.part_id = $(e.currentTarget).val();
            $.ajax({
                type: "get",
                url: '{!! url('product_location/productPart/getOneProductParts') !!}/' + window.part_id,
                success: function (data) {
                    if (data.status) {
                        console.log(data)
                        $('.pnt-modal-sel-edit-group-quantity').val(data.productParts.quantity);
                    }
                }
            });
            $(".pnt-add-path-data-toggle").hide(150);
            $(".pnt-add-path-edit-data-toggle").toggle(150);
        });
        // end-pnt-btn-parts-toggle

        // pnt-btn-edit-save
        $(document).off('click', '.pnt-bnt-edit-group-save').on('click', '.pnt-bnt-edit-group-save', (e) => {
            $.ajax({
                type: "post",
                url: '{!! url('product_location/productPart/update') !!}/' + window.part_id,
                data: {
                    quantity: $('.pnt-modal-sel-edit-group-quantity').val(),
                    '_token': window.token,
                },
                success: function (data) {
                    console.log(data);
                    if (data.status) {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Update Quantity Parts to Product Success fully',
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
            $(".pnt-add-path-edit-data-toggle").hide(150);
            resetProductParts();
        });
        // end-pnt-btn-edit-save

        // pnt-btn-delete-modal-product-part
        $(document).off('click', '.pnt-btn-delete-modal-product-part').on('click', '.pnt-btn-delete-modal-product-part', (e) => {
            window.part_id = $(e.currentTarget).val();
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
                        url: '{!! url('product_location/productPart/delete') !!}/' + window.part_id,
                        success: function (data) {
                            resetTable();
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Delete Success fully',
                                showConfirmButton: false,
                                timer: 1500
                            })
                        }
                    });
                    resetProductParts();
                }
            })
        });
        // end pnt-btn-delete-modal-product-part

    </script>
@endsection
