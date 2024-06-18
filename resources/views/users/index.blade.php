@extends('layouts.app')
@section('user-active')
    @if (true == $sideBarActive)
        class="nav-link "
    @endif
@endsection

@section('title', 'Users')

@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Users</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
                    <li class="breadcrumb-item active">Users</li>
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
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Data Users</h5>

                            <!-- Table with stripped rows -->
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Username</th>
                                        <th scope="col">Role</th>
                                        <th scope="col">Aksi</th>
                                        <th scope="col">Secret</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>{{ $user->userDetail->nama_lengkap ?? '' }}</td>
                                            <td>{{ $user->username }}</td>
                                            <td>
                                                @foreach ($user->roles as $role)
                                                    <span class="badge rounded-pill bg-primary">
                                                        {{ $role->role_name }}
                                                    </span>
                                                @endforeach
                                            </td>
                                            <td>
                                                <a href="{{ route('user.edit', $user->id) }}" class="btn btn-info" title="Profile User">
                                                    <i class="bi bi-info-circle"></i></a>
                                            </td>
                                            <td>{{$user->secret}}</td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                            <!-- End Table with stripped rows -->

                        </div>
                    </div>

                </div>
            </div>
        </section>

    </main>


@endsection
