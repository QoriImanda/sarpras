@extends('layouts.app')
@section('hidden-collapsed-master-data')
        class="nav-link"
@endsection
@section('show-master-data', 'show')
@section('mahasiswa-active')
    class="active"
@endsection

@section('title', 'Data Mahasiswa')

@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Mahasiswa</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
                    <li class="breadcrumb-item">Master Data</li>
                    <li class="breadcrumb-item active">Mahasiswa</li>
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
                            <h5 class="card-title">Data Mahasiswa</h5>

                            <!-- Table with stripped rows -->
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th scope="col">NIM</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Prodi</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($mahasiswas as $mahasiswa)
                                        <tr>
                                            <th scope="row">{{ $mahasiswa->nim_string }}</th>
                                            <td>{{ $mahasiswa->nama_lengkap }}</td>
                                            <td>{{ $mahasiswa->nama_prodi }}</td>
                                            <td>
                                                <a href="#" class="btn btn-info" title="Profile User">
                                                    <i class="bi bi-info-circle"></i></a>
                                            </td>
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
