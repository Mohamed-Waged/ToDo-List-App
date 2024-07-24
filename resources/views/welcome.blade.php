@extends('layouts.app')

@section('title', 'HomePage')

@section('content')
    <div class="p-5 mb-4 rounded-3 mt-5">
        <div class="container-fluid py-5 text-center">
            @auth
                <h1 class="display-5 fw-bold">Hello {{ Auth::user()->name }}</h1>
            @endauth

            @guest
                <h1 class="display-5 fw-bold">Hello User</h1>
                <p class="col-md-8 fs-4 my-5  mx-auto ">
                    Please Login To Enter To Dashboard
                </p>
            @endguest
            
            <button class="btn btn-outline-primary btn-lg px-4" type="button">
                Let's Start!
            </button>
        </div>
    </div>
@endsection