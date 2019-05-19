@extends('product-mgmt.base')

@section('action-content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Update</div>
                <div class="panel-body">

                        <form class="form-horizontal" role="form" method="POST" action="{{ route('employee-management.update', ['id' => $employees -> id]) }}" enctype="multipart/form-data">
                        <input type="hidden" name="_method" value="PATCH">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group{{ $errors->has('productName') ? ' has-error' : '' }}">
                            <label for="productName" class="col-md-4 control-label">Product Name</label>
                            <div class="col-md-6">
                                <input id="productName" type="text" class="form-control" name="productName" value="{{ $employees -> productName }}" required autofocus>

                                @if ($errors->has('productName'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('productName') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('aboutProduct') ? ' has-error' : '' }}">
                            <label for="aboutProduct" class="col-md-4 control-label">About</label>

                            <div class="col-md-6">
                                <input id="aboutProduct" type="text" class="form-control" name="aboutProduct" value="{{ $employees->aboutProduct }}" required>

                                @if ($errors->has('aboutProduct'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('aboutProduct') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>



                        <div class="form-group">
                            <label class="col-md-4 control-label">Status</label>
                            <div class="col-md-6">
                                <select class="form-control js-country" name="Status">
                                    <option value="Active" id="Status">Active</option>
                                    <option value="UnActive" id="Status">UnActive</option>
                                </select>
                            </div>
                        </div>



                        <div class="form-group{{ $errors->has('Price') ? ' has-error' : '' }}">
                            <label for="zip" class="col-md-4 control-label">Price</label>
                            <div class="col-md-6">
                                <input id="Price" type="text" class="form-control" name="Price" value="{{ $employees->Price }}" required>
                                @if ($errors->has('Price'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('Price') }}</strong>
                                    </span>
                                @endif
                            </div>

                        </div>


                        <div class="form-group">
                            <label class="col-md-4 control-label">Category</label>
                            <div class="col-md-6">

                                <select class="form-control" name="category_id">
                                    @foreach ($categoris as $category)
                                        <option {{$employees->category_id == $category->id ? 'selected' : ''}} value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="avatar" class="col-md-4 control-label" >Picture</label>
                            <div class="col-md-6">

                                <img src="../../{{$employees->picture }}" width="50px" height="50px"/>
                                <input type="file" id="picture" name="picture" />

                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Update
                                </button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
