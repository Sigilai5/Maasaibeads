@extends('layouts.admin')

@section('body')

{{--    @if(Auth::user()->admin_levels == 1)--}}
    <div class="table-responsive">

        <form action="/admin/updateUser/{{$user->id}}" method="post">

            {{csrf_field()}}

            @foreach($users as $user)

                <div class="form-group">
                    <input type="hidden"  class="form-control" name="user_id" id="user_id" placeholder="Admin Level" value="{{$user->id}}" hidden required>
                </div>

                <div class="form-group">
                    <label for="description">Admin</label>
                    <input type="text" class="form-control" name="admin" id="admin" placeholder="Admin" value="{{$user->admin}}" required>
                </div>

            <div class="form-group">
                <label for="description">Admin Level</label>
                <input type="text" class="form-control" name="admin_levels" id="admin_level" placeholder="Admin Level" value="{{$user->admin_levels}}" required>
            </div>

            @endforeach

            <button type="submit" name="submit" class="btn btn-default">Submit</button>
        </form>

    </div>
{{--    @else--}}
    <div class="alert alert-danger" role="alert">
        <strong>Please!</strong> Only level one admin can edit this page
    </div>
{{--    @endif--}}

@endsection
