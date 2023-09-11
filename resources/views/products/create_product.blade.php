@extends('layout.master')
@section('title') Add Product  @endsection
@section('current-header') Add Product @endsection
@section('active-page') Add Product @endsection

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2 class="panel-title"><i class="fa fa-lock"></i> Product Information </h2>
        </div>
        <div class="panel-body">
        
            <form class="form-horizontal col-md-12 col-xs-12" method="post" action="{{route('product.store')}}" enctype="multipart/form-data" >
            	@csrf
                <div class="form-group">
                  <label for="product_name" class="col-sm-2 control-label">Product Name</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="" name="product_name" placeholder="Product name" value="{{ old('product_name') }}">
                    @if($errors->has('product_name'))
<label for="username" class="error">{{ $errors->first('product_name') }}</label>
@endif
                  </div>
                </div>
                <div class="form-group">
                  <label for="unit_type" class="col-sm-2 control-label">Product Unit</label>
                  <div class="col-sm-10">
                    <select class="form-control" name="unit_type" value="{{ old('unit_type') }}">
                        <option value="">Select Unit</option>
                        <option value="Qty">Qty</option>
                        <option value="Ltr">Ltr</option>
                        <option value="Kg">Kg</option>
                        <option value="Meter">Meter</option>
                    </select>
                    @if($errors->has('units'))
<label for="username" class="error">{{ $errors->first('units') }}</label>
@endif
                  </div>
                </div>
                <div class="form-group">
                    <label for="category" class="col-sm-2 control-label">Category</label>
                    <div class="col-sm-10">
                      <select class="select2" multiple data-placeholder="Choose a Category..." name="category[]" >
                  <option value=""></option>
                  <option value="mobile">Mobile</option>
                  <option value="cable">Cable</option>
                  <option value="cover">Cover</option>
                  <option value="battary">Battary</option>
                
                </select>
                @if($errors->has('category'))
<label for="username" class="error">{{ $errors->first('category') }}</label>
@endif
                    </div>
                </div>
                 <div class="form-group">
                    <label for="product_images" class="col-sm-2 control-label">Product Images</label>
                    <div class="col-sm-10"> 
                        <input type="file" name="product_images[]" class="form-control input-sm" multiple min="3" id="product_images"> 
                        @if($errors->has('product_images'))
<label for="username" class="error">{{ $errors->first('product_images') }}</label>
@endif  
                    </div>
                </div>
                <div class="form-group">
                  <label for="price" class="col-sm-2 control-label">Price</label>
                  <div class="col-sm-10">
                      <input type="text" class="form-control" id="price" name="price" placeholder="Product Price" value="{{ old('price') }}">
                       @if($errors->has('price'))
<label for="username" class="error">{{ $errors->first('price') }}</label>
@endif  
                  </div>
                </div>
                 <div class="form-group">
                  <label for="discount_percentage" class="col-sm-2 control-label">Discount Percentage</label>
                  <div class="col-sm-10">
                      <input type="text" class="form-control" id="discount_percentage" name="discount_percentage" placeholder="Discount Percentage" value="{{ old('discount_percentage') }}">
                       @if($errors->has('discount_percentage'))
<label for="username" class="error">{{ $errors->first('discount_percentage') }}</label>
@endif  
                  </div>
                </div>
                <div class="form-group">
                  <label for="discount_price" class="col-sm-2 control-label">Discount Amount</label>
                  <div class="col-sm-10">
                      <input type="text" class="form-control" id="discount_price" name="discount_price" placeholder="Discount Amount" value="{{ old('discount_price') }}">
                      @if($errors->has('discount_price'))
<label for="username" class="error">{{ $errors->first('discount_price') }}</label>
@endif  
                  </div>
                </div>
                       <div class="form-group">
                  <label for="discount_from" class="col-sm-2 control-label">Discount Start Date</label>
                  <div class="col-sm-10">
                                      <div class="input-group">
              <input type="text" class="form-control" placeholder="" id="startdate" name="discount_from" value="{{ old('discount_from') }}"> 
                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
              </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="discount_to" class="col-sm-2 control-label">Discount End Date</label>
                  <div class="col-sm-10">
                                      <div class="input-group">
              <input type="text" class="form-control" placeholder="" id="enddate" name="discount_to" value="{{ old('discount_to') }}">
                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
              </div>
                  </div>
                </div>
                   <div class="form-group">
                  <label for="taxable_percentage" class="col-sm-2 control-label">Tax Percentage</label>
                  <div class="col-sm-10">
                      <input type="text" class="form-control" id="taxable_percentage" name="taxable_percentage" placeholder="Tax Percentage" value="{{ old('taxable_percentage') }}">
                       @if($errors->has('taxable_percentage'))
<label for="username" class="error">{{ $errors->first('taxable_percentage') }}</label>
@endif  
                  </div>
                </div>
                <div class="form-group">
                  <label for="taxable_amount" class="col-sm-2 control-label">Tax Amount</label>
                  <div class="col-sm-10">
                      <input type="text" class="form-control" id="taxable_amount" name="taxable_amount" placeholder="Tax Amount" value="{{ old('taxable_amount') }}">
                      @if($errors->has('taxable_amount'))
<label for="username" class="error">{{ $errors->first('taxable_amount') }}</label>
@endif  
                  </div>
                </div>
                 <div class="form-group">
                  <label for="in_stock" class="col-sm-2 control-label">Stock</label>
                  <div class="col-sm-10">
                      <select class="form-control" name="in_stock" >
                          <option value="">Select Stock Status</option>
                          <option value="1">In Stock</option>
                          <option value="0">Out of Stock</option>
                      </select>
                      @if($errors->has('in_stock'))
<label for="username" class="error">{{ $errors->first('in_stock') }}</label>
@endif  
                  </div>
                </div>
                 <div class="form-group">
                  <label for="stock_quantity" class="col-sm-2 control-label">Stock In Qty</label>
                  <div class="col-sm-10">
                      <input type="text" class="form-control" id="stock_quantity" name="stock_quantity" placeholder="Stock In Qty" value="{{ old('stock_quantity') }}">
                       @if($errors->has('stock_quantity'))
<label for="username" class="error">{{ $errors->first('stock_quantity') }}</label>
@endif  
                  </div>
                </div>
           <div class="form-group">
                  <label for="status" class="col-sm-2 control-label">Status</label>
                  <div class="col-sm-10">
                      <select class="form-control" name="status" >
                          <option value="">Select Status</option>
                          <option value="1">Active</option>
                          <option value="0">Inactive</option>
                      </select>
                      @if($errors->has('status'))
<label for="username" class="error">{{ $errors->first('status') }}</label>
@endif  
                  </div>
                </div>

                <div class="form-group">
                  <div class="pull-right">
                    <button type="submit" class="btn btn-primary">Save</button>
                  </div>
                </div>
            </form>
        </div>

    </div>

@endsection
@section('script')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/3.1.4/css/bootstrap-datetimepicker.min.css"/>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.13.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/3.1.4/js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
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
   
});
</script>
@endsection