@extends('layouts.app-auth')
@section('title', 'Login')
@section('auth')
    <div class="pt-4 pb-2">
        {{-- <h5 class="card-title text-center pb-0 fs-4">Login to Your Sains UP Account </h5> --}}
        @if (session('sukses'))
            <div class="alert alert-success bg-success text-light border-0 alert-dismissible fade show" role="alert">
                {{ session('sukses') }}
                <i class="bi bi-check-circle me-1"></i>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @elseif (session('gagal'))
            <div class="alert alert-danger bg-danger text-light border-0 alert-dismissible fade show" role="alert">
                {{ session('gagal') }}
                <i class="bi bi-exclamation-octagon me-1"></i>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @elseif ($errors->any())
            <div class="alert alert-danger bg-danger text-light border-0 alert-dismissible fade show">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @elseif (session('warning'))
            <div class="alert alert-warning bg-warning text-light border-0 alert-dismissible fade show" role="alert">
                {{ session('warning') }}
                <i class="bi bi-exclamation-octagon me-1"></i>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @else
            <p class="text-center small">Enter your username & password to login</p>

        @endif
    </div>

    <form action="{{ route('auth.login.post') }}" method="post" class="row g-3 needs-validation" novalidate>
        {{ csrf_field() }}
        <div class="col-12">
            <label for="yourUsername" class="form-label">Username</label>
            <div class="input-group has-validation">
                <span class="input-group-text" id="inputGroupPrepend">@</span>
                <input type="text" name="username" class="form-control" id="yourUsername" required>
                <div class="invalid-feedback">Please enter your username.</div>
            </div>
        </div>

        {{-- <div class="col-12">
            <label for="yourUsername" class="form-label">Username</label>
            <input type="text" name="username" class="form-control" id="yourUsername" required>
            <div class="invalid-feedback">Please enter your password!</div>
        </div> --}}

        <div class="col-12">
            <label for="yourPassword" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" id="yourPassword" required>
            <div class="invalid-feedback">Please enter your password!</div>
        </div>

        {{-- <div class="col-12">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="remember" value="true" id="rememberMe">
                <label class="form-check-label" for="rememberMe">Remember me</label>
            </div>
        </div> --}}
        <div class="col-12">
            <button class="btn btn-primary w-100" type="submit">Login</button>
        </div>
        <div class="col-12">
            <p class="small mb-0">Don't have account? <a href="{{ route('auth.register') }}">Create an account</a></p>
        </div>
    </form>
@endsection
