@extends('layouts.app')

@section('pendataan-sarpras-active')
    class="nav-link "
@endsection

@section('title', 'Inventaris')

@section('content')
    @php
        $roleUser = [];
        $roles = auth()->user()->roles;
        foreach ($roles as $role) {
            array_push($roleUser, $role->role_code);
        }
    @endphp
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Pendataan Sarpras</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
                    {{-- <li class="breadcrumb-item">Master Data</li> --}}
                    <li class="breadcrumb-item active">Pendataan</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        @if (session('info'))
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                <i class="bi bi-info-circle me-1"></i>
                {{ session('info') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                @foreach ($errors->all() as $error)
                    <i class="bi bi-exclamation-triangle me-1"></i>{{ $error }}
                @endforeach
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <section class="section">
            <div class="row align-items-top">

                    <div class="col-lg-6">
                        <!-- Default Card -->
                        <a href="{{route('pendataanSarpras.pendataan', 'sarana')}}" class="card hover">
                            <div class="card-body">
                                <h5 class="card-title">Sarana
                                </h5>

                            </div>
                        </a><!-- End Default Card -->

                    </div>

                    <div class="col-lg-6">
                        <!-- Default Card -->
                        <a href="{{route('pendataanSarpras.pendataan', 'prasarana')}}" class="card hover">
                            <div class="card-body">
                                <h5 class="card-title">Prasarana
                                </h5>

                            </div>
                        </a><!-- End Default Card -->

                    </div>

            </div>
        </section>

    </main>


@endsection
