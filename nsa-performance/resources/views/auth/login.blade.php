@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-4">

            <h3 class="text-center mb-4">Admin Login</h3>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" required autofocus>
                </div>

                <div class="mb-3">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <button class="btn btn-dark w-100">Login</button>

            </form>

        </div>
    </div>
</div>
@endsection