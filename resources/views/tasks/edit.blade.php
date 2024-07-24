@extends('layouts.app')

@section('title', 'Edit Task')

@section('content')
    <div class="row mt-3">
        <div class="col-6 mx-auto mb-3">
            <h2 class="text-center">Edit Task : {{ $task->title }}</li>
        </div>
    </div>
    <div class="row">
        <div class="col-6 mx-auto">
            <form action="{{route('tasks.update',$task->id)}}" method="post" class="border p-3">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" name="title" id="title" value="{{ old('title') ?? $task->title}}">
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="3" style="resize: none">{{ old('description') ?? $task->description}}</textarea>
                </div>

                <div class="form-group">
                    <label for="category_id">Category</label>
                    <select name="category_id" id="category_id" class="form-control">
                        <option selected="true" disabled="disabled">-- Selet Category --</option>
                        @foreach($categories as $category)
                            <option value="{{$category->id}}" @selected($category->id == $task->category_id)>{{$category->name}}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <div class="text-danger">* {{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control">
                        <option selected="true" disabled="disabled">-- Selet Status --</option>
                        <option value="pending" @selected($task->status == "pending")>pending</option>
                        <option value="completed" @selected($task->status == "completed")>completed</option>
                    </select>
                    @error('status')
                        <div class="text-danger">* {{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-warning">Update</button>
            </form>
        </div>
    </div>
@endsection
