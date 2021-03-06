@extends('layouts.admin')

@section('body')

{{--@if(Auth::user()->admin_level == 1)--}}
    <div class="table-responsive">

        <form action="/admin/updateProduct/{{$product->id}}" method="post">

            {{csrf_field()}}

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="Product Name" value="{{$product->name}}" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <input type="text" class="form-control" name="description" id="description" placeholder="description" value="{{$product->description}}" required>
            </div>


            <div class="form-group">
                <label for="type">Type</label>
                <input type="text" class="form-control" name="type" id="type" placeholder="type" value="{{$product->type}}" required>
            </div>

            <div class="form-group">
                <label for="type">Price</label>
                <input type="text" class="form-control" name="price" id="price" placeholder="price" value="{{$product_price}}" required>
            </div>

            <div class="form-group">
                <label for="type">Category</label>
                <input type="text" class="form-control" name="category" id="category" placeholder="Category" value="{{$product->category}}" required>
            </div>

            <button type="submit" name="submit" class="btn btn-default">Submit</button>
        </form>

    </div>
{{--@else--}}
    <div class="alert alert-danger" role="alert">
        <strong>Please!</strong> Only level one admin can edit this page
    </div>
{{--@endif--}}

@endsection
