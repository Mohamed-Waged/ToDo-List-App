@extends('layouts.app')

@section('title', 'All Tasks')

@section('content')
    <div class="row mt-5">
        <div class="col-6 mx-auto border border-info bg-light  rounded py-2 mb-5">
            <h3 class="text-center">All Archive Tasks</li>
        </div>
        <div class="col-9 mx-auto">

            @if(session()->has('message'))
                <div class="alert alert-success alert-dismissible fade show text-center w-50 mx-auto" role="alert">
                    <strong>{{ session()->get('message') }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
    
            <table class="table table-striped text-center">
                <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Category</th>
                        <th>User</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tasks as $task)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $task->title }}</td>
                            <td>{{ $task->description }}</td>
                            <td>{{ $task->status }}</td>
                            <td>{{ $task->category->name }}</td>
                            <td>{{ $task->user->name }}</td>
                            <td> 
                                <a href="{{route('restoreTask',$task->id)}}" class="btn btn-success">Restore</a>
                                <form action="{{route('deleteTask',$task->id)}}" method="post" class="d-inline">
                                    @csrf
                                    @method("DELETE")
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                <tbody>
            </table>
        </div>
    </div>
@endsection
