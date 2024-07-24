@extends('layouts.app')

@section('title', 'Show Task')

@section('content')
    <div class="row mt-5">
        <div class="col-9 mx-auto font-weight-bold">
            <div class="card">
                <div class="card-header text-center ">
                    <strong>Show Task</strong>
                </div>
                <div class="card-body">
                    <h5 class="card-title mb-3"><strong>Title : </strong>{{ $task->title }}</h5>
                    <h5 class="card-text mb-4"><strong>Description : </strong>{{ $task->description }}</h5>
                    <h5 class="card-text mb-4"><strong>Status : </strong>{{ $task->status }}</h5>
                    <h5 class="card-text mb-4"><strong>Category : </strong>{{ $task->category->name }}</h5>
                    <h5 class="card-text mb-4"><strong>User : </strong>{{ $task->user->name }}</h5>
                    <div class="text-center">
                        <a href="{{route('tasks.index')}}" class="btn btn-outline-primary px-5">Go Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection 