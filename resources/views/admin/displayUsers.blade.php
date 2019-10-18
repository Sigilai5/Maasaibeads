@extends('layouts.admin')

@section('body')

    @if (\Session::has('success'))
        <div class="alert alert-success">
            <p>{{ \Session::get('success')  }}</p>

        </div><br \>
    @endif
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Admin</th>
                <th>Email</th>
                <th>Admin_level</th>
                <th>Edit</th>
                <th>Remove</th>
            </tr>
            </thead>
            <tbody>

            @foreach($users as $user)
                <tr>
                    <td>{{$user['id']}}</td>
                    <td>{{$user['name']}}</td>
                    <td>{{$user['admin']}}</td>
                    <td>{{$user['email']}}</td>
                    <td>{{$user['admin_levels']}}</td>
                    <td><a href="{{ route('adminEditUserForm',['id'=> $user['id'] ])}}" class="btn btn-primary">Edit Info</a></td>
                    <td><a href=""  class="btn btn-warning">Remove</a></td>


                </tr>

            @endforeach





            </tbody>
        </table>



        {{$users->links()}}

    </div>
@endsection
