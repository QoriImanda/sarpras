@extends('layouts.app-auth')
@section('title', 'Register')
@section('auth')

    <div class="pt-4 pb-2">
        @if ($errors->any())
            <div class="alert alert-warning bg-warning text-light border-0 alert-dismissible fade show" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }} <i class="bi bi-exclamation-octagon me-1"></i></li>
                    @endforeach
                </ul>
                {{-- <button type="button" class="btn-close" data-bs-dismiss="alert"
        aria-label="Close"></button> --}}
            </div>
        @endif
        <h5 class="card-title text-center pb-0 fs-4">Buat Akun</h5>
        {{-- <p class="text-center small">Masukkan detail pribadi Anda untuk membuat akun</p> --}}
    </div>

    <form action="{{ route('auth.register.post') }}" method="post" class="row g-3 needs-validation" novalidate>
        {{ csrf_field() }}
        {{-- <div class="col-12">
            <label for="yourName" class="form-label">Nama Lengkap</label>
            <input type="text" name="nama_lengkap" class="form-control" id="nama_lengkap" required>
            <div class="invalid-feedback">Silahkan isi nama lengkap!</div>
        </div> --}}

        {{-- <div class="col-12">
            <label for="yourEmail" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" id="yourEmail" >
            <div class="invalid-feedback">Silakan isi alamat email!</div>
        </div> --}}

        <div class="col-12">
            <label for="yourUsername" class="form-label">Username</label>
            <div class="input-group has-validation">
                <span class="input-group-text" id="inputGroupPrepend">@</span>
                <input type="text" name="username" class="form-control" id="yourUsername" required>
                <div class="invalid-feedback">Silakan isi username!</div>
            </div>
        </div>

        <div class="col-12">
            <label for="yourPassword" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" id="yourPassword" required>
            <div class="invalid-feedback">Silahkan isi password!</div>
        </div>

        {{-- <div class="col-12">
            <div class="form-check">
                <input class="form-check-input" name="terms" type="checkbox" value="" id="acceptTerms" required>
                <label class="form-check-label" for="acceptTerms">I agree and accept the <a href="#">terms and
                        conditions</a></label>
                <div class="invalid-feedback">You must agree before submitting.</div>
            </div>
        </div> --}}

        <div class="col-md-12">
            <label for="role_id" class="form-label">Role</label>
            <select class="form-select" name="role_id" id="role_id" required>
                <option selected disabled value="">Pilih Role...</option>
                @foreach ($role as $item)
                    <option value="{{ $item->id }}">{{ $item->role_name }}</option>
                @endforeach
            </select>
            <div class="invalid-feedback">
                Silahkan pilih role!
            </div>
        </div>

        <div class="col-12">
            <button class="btn btn-primary w-100" type="submit">Create Account</button>
        </div>
        <div class="col-12">
            <p class="small mb-0">Already have an account? <a href="{{ route('auth.login') }}">Log in</a></p>
        </div>
    </form>
@endsection
