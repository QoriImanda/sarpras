@extends('layouts.app-auth')
@section('title', 'Login')
@section('auth')
    <div class="pt-4 pb-2">
        <h5 class="card-title text-center pb-0 fs-4">Session Access</h5>
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
            <p class="text-center small">Select to Your Access</p>
        @endif
    </div>

    <form action="{{ route('auth.login.post') }}" method="post" class="row g-3 needs-validation" novalidate>
        @csrf
        
        @foreach ($fakultases as $fakultas)
        <div class="col-12">
            <a href="{{route('auth.selectedSessionAkses', $fakultas->id)}}" class="btn btn-primary w-100" type="submit">{{$fakultas->nama_fakultas}}</a>
        </div>
        @endforeach

        @foreach ($prodis as $prodi)
        <div class="col-12">
            <a href="{{route('auth.selectedSessionAkses', $prodi->id)}}" class="btn btn-primary w-100" type="submit">{{$prodi->nama_prodi}}</a>
        </div>
        @endforeach
        

        <div class="col-12">
            <p class="small mb-0">Don't have account? <a href="{{ route('auth.register') }}">Create an account</a></p>
        </div>
    </form>
@endsection
