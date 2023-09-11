@extends('layout.master')
@section('title')
    Products
@endsection
@section('current-header')
    Products Management
@endsection
@section('active-page')
    Product List
@endsection

@section('content')
    <style type="text/css">
        input[type="file"] {
            display: block;
        }

        .imageThumb {
            max-height: 75px;
            border: 2px solid;
            padding: 1px;
            cursor: pointer;
        }

        .pip {
            display: inline-block;
            margin: 10px 10px 0 0;
        }

        .remove {
            display: block;
            background: white;
            color: red;
            text-align: center;
            cursor: pointer;
        }

        .remove:hover {
            background: white;
            color: black;
        }
    </style>
    @if ($message = Session::get('success'))
        <div class="panel panel-success">
            <div class="panel-heading" style="color:white;"> {{ $message }} </div>
        </div>
    @endif
    @if ($error = Session::get('message'))
        <div class="panel panel-danger">
            <div class="panel-heading" style="color:white;"> {{ $error }} </div>
        </div>
    @endif
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2 class="panel-title"><i class="fa fa-list"></i> Product Listing</h3>
        </div>
        <div class="panel-body">

            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover" id="dataTables-products">
                    <thead>
                        <tr class="table-header-bc">
                            <th>ID</th>
                            <th>Product Name</th>
                            <th class="col-sm-1">Category</th>
                            <th>Stock Quantity</th>
                            <th class="col-sm-1">Price</th>
                            <th>Stock Status</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="modal fade" id="updateproducts" tabindex="-1" role="dialog" aria-labelledby="registerModal"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="registerModal">Update Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="updateproduct_form" enctype="multipart/form-data">

                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="id" value="" id="product_id">
                        <div class="form-group row">
                            <label for="product_name" class="col-sm-2 control-label">Product Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="product_name" name="product_name"
                                    placeholder="Product name" value="">
                                <label for="product_name_error" class="error" style="display:none;"
                                    id="product_name_error"></label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="unit_type" class="col-sm-2 control-label">Product Unit</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="unit_type" id="unit_type">
                                    <option value="">Select Unit</option>
                                    <option value="Qty">Qty</option>
                                    <option value="Ltr">Ltr</option>
                                    <option value="Kg">Kg</option>
                                    <option value="Meter">Meter</option>
                                </select>
                                <label for="unit_type_error" class="error" style="display:none;"
                                    id="unit_type_error"></label>

                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="category" class="col-sm-2 control-label">Category</label>
                            <div class="col-sm-10">
                                <select class="select2" multiple data-placeholder="Choose a Category..." name="category[]"
                                    id="category">
                                    <option value=""></option>
                                    <option value="mobile">Mobile</option>
                                    <option value="cable">Cable</option>
                                    <option value="cover">Cover</option>
                                    <option value="battary">Battary</option>

                                </select>
                                <label for="category_error" class="error" style="display:none;"
                                    id="category_error"></label>
                            </div>
                        </div>
                        <div class="form-group row" align="left">
                            <label for="product_images" class="col-sm-2 control-label">Product Images</label>
                            <div class="col-sm-10">
                                <input type="file" name="product_images[]" class="form-control input-sm" multiple
                                    min="3" id="files">
                                <div id="img-upload">
                                </div>
                                <input type="hidden" name="old_images" value="" id="old_images">
                                <label for="product_images_error" class="error" style="display:none;"
                                    id="product_images_error"></label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="price" class="col-sm-2 control-label">Price</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="price" name="price"
                                    placeholder="Product Price" value="">
                                <label for="price_error" class="error" style="display:none;" id="price_error"></label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="discount_percentage" class="col-sm-2 control-label">Discount Percentage</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="discount_percentage"
                                    name="discount_percentage" placeholder="Discount Percentage" value="">
                                <label for="discount_percentage_error" class="error" style="display:none;"
                                    id="discount_percentage_error"></label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="discount_price" class="col-sm-2 control-label">Discount Amount</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="discount_price" name="discount_price"
                                    placeholder="Discount Amount" value="">
                                <label for="discount_price_error" class="error" style="display:none;"
                                    id="discount_price_error"></label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="discount_from" class="col-sm-2 control-label">Discount Start Date</label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="" id="startdate"
                                        name="discount_from" value="">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="discount_to" class="col-sm-2 control-label">Discount End Date</label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="" id="enddate"
                                        name="discount_to" value="">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="taxable_percentage" class="col-sm-2 control-label">Tax Percentage</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="taxable_percentage"
                                    name="taxable_percentage" placeholder="Tax Percentage" value="">
                                <label for="taxable_percentage_error" class="error" style="display:none;"
                                    id="taxable_percentage_error"></label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="taxable_amount" class="col-sm-2 control-label">Tax Amount</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="taxable_amount" name="taxable_amount"
                                    placeholder="Tax Amount" value="">
                                <label for="taxable_amount_error" class="error" style="display:none;"
                                    id="taxable_amount_error"></label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="in_stock" class="col-sm-2 control-label">Stock</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="in_stock" id="in_stock">
                                    <option value="">Select Stock Status</option>
                                    <option value="1">In Stock</option>
                                    <option value="0">Out of Stock</option>
                                </select>
                                <label for="in_stock_error" class="error" style="display:none;"
                                    id="in_stock_error"></label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="stock_quantity" class="col-sm-2 control-label">Stock In Qty</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="stock_quantity" name="stock_quantity"
                                    placeholder="Stock In Qty" value="">
                                <label for="stock_quantity_error" class="error" style="display:none;"
                                    id="stock_quantity_error"></label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="status" class="col-sm-2 control-label">Status</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="status" id="product_status">
                                    <option value="">Select Status</option>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                                <label for="product_status_error" class="error" style="display:none;"
                                    id="status_error"></label>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="pull-right">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/3.1.4/css/bootstrap-datetimepicker.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.13.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/3.1.4/js/bootstrap-datetimepicker.min.js">
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#dataTables-products').dataTable({
                "processing": true,
                "serverSide": true,
                "ajax": "{{ URL::to('product/listing') }}",
                "order": [
                    [0, 'desc']
                ],
                "columnDefs": [{
                    "targets": "_all",
                    "defaultContent": ""
                }],
                "sPaginationType": "full_numbers",
                "columns": [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'product_name',
                        name: 'product_name'
                    },
                    {
                        data: 'category',
                        name: 'category',
                        searchable: false
                    },
                    {
                        data: 'stock_quantity',
                        name: 'stock_quantity'
                    },
                    {
                        data: 'price',
                        name: 'price'
                    },
                    {
                        data: 'in_stock',
                        name: 'in_stock'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    },
                ]
            });

            jQuery(".select2").select2({
                width: '100%'
            });
            $("#startdate").datetimepicker({
                format: 'YYYY-MM-DD HH:mm:ss',
                defaultDate: new Date(),
            });

            $("#enddate").datetimepicker({
                format: 'YYYY-MM-DD HH:mm:ss',
                defaultDate: new Date(),
            });


            $(document).on('click', '#deleteProduct', function(e) {

                let id = $(this).attr("data-id");
                e.preventDefault();
                bootbox.confirm({
                    title: "Deactivate Product",
                    message: "Are you sure to Delete this Product  ID- " + $(this).attr("data-id") +
                        " ?",
                    callback: function(result) {
                        if (result === true) {
                            $.ajax({
                                url: "delete/" + id,
                                type: 'GET',
                                success: function(data) {

                                    if (data.success === 1) {
                                        alert('Product Deleted Successfully')
                                        $('#dataTables-products').DataTable().ajax
                                            .reload();
                                    } else {
                                        alert('something went wrong! try again');
                                        return false;
                                    }
                                }
                            });
                        } else {
                            console.log("IGNORE");
                        }
                    }
                });

            });

            $(document).on('click', '#updateproduct', function(e) {
                let id = $(this).attr("data-id");
                var details = getProduct(id);
                e.preventDefault();
                $('#updateproducts').modal({
                    show: true
                });
            });

            function getProduct(id) {
                $.ajax({
                    url: "details/" + id,
                    type: 'GET',
                    success: function(data) {
                       
                        $('#product_name').val(data.product.product_name);
                        $('#unit_type').val(data.product.unit_type);
                        $('#product_id').val(data.product.id);
                        var category = [];
                        for (var i = 0; i < data.category.length; i++) {
                            category.push(data.category[i].category_name);
                        }
                        var images = [];
                        for (var i = 0; i < data.product_images.length; i++) {
                            images.push(data.product_images[i].id);
                            $("<span class=\"pip\">" +
                                "<img class=\"imageThumb\" src=\"../public/custom_images/products/" +
                                data.product_images[i].image_url +
                                "\" title=\"" + data.product_images[i].image_url + "\"/>" +
                                "<br/><span class=\"remove\">Remove image</span>" +
                                "</span>").appendTo("#img-upload");
                        }
                        $('#old_images').val(JSON.stringify(images));
                        $(document).on("click", ".remove", function() {
                            $el = $(this).parent(".pip");
                            images.splice($el.index(), 1);
                            $el.remove();
                            $('#old_images').val(JSON.stringify(images)); //store array

                        });
                        $("#category").val(category).trigger('change');
                        $('#price').val(data.product.price);
                        $('#discount_percentage').val(data.product.discount_percentage);
                        $('#discount_price').val(data.product.discount_price);
                        $('#startdate').val(data.product.discount_from);
                        $('#enddate').val(data.product.discount_to);
                        $('#taxable_percentage').val(data.product.taxable_percentage);
                        $('#taxable_amount').val(data.product.taxable_amount);
                        $('#in_stock').val(data.product.in_stock);
                        $('#stock_quantity').val(data.product.stock_quantity);
                        $('#product_status').val(data.product.status);
                        //console.log(data);
                    }
                });
            }

            $('#updateproduct_form').on('submit', function(e) {
                e.preventDefault();
                var formData = new FormData($('#updateproduct_form')[0]);

                $.ajax({
                    url: "update",
                    type: 'POST',
                    contentType: false,
                    processData: false,
                    data: formData,
                    success: function(data) {
                        if (data.message == 'success') {
                            $('#updateproducts').modal('toggle');
                            $('#dataTables-products').DataTable().ajax.reload();
                            $("#updateproduct_form")[0].reset();
                             $("#img-upload").html("");
                        }

                    },
                    error: function(data, textStatus, errorThrown) {
                        var err = JSON.parse(data.responseText);
                        if (err.errors) {
                            Object.keys(err.errors).forEach(function(key) {
                                var errorname = '#' + key + '_error';
                                $(errorname).text(err.errors[key]).css("display",
                                    "block");
                            });
                            return false;
                        }
                    }
                });
            });

        });
    </script>
@endsection