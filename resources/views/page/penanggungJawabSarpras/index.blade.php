@extends('layouts.app')

@section('penanggung-jawab-sarpras-active')
    class="nav-link "
@endsection

@section('title', 'PJS')

@section('content')
    @php
        $roleUser = [];
        $roles = auth()->user()->roles;
        foreach ($roles as $role) {
            array_push($roleUser, $role->role_code);
        }

        $users = App\Models\User::Join('role_user', 'users.id', '=', 'role_user.user_id')
        ->join('roles', 'role_user.role_id', '=', 'roles.id')
        ->join('user_details', 'users.id', '=', 'user_details.user_id')
        ->where('roles.role_code', 'PJS')->select('users.id', 'user_details.nama_lengkap')->get();

        // dd($users);
    @endphp
    <main id="main" class="main">
        <div class="pagetitle">
            <h1 style="text-transform: capitalize;">Penanggung Jawab Sarpras</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
                    <li class="breadcrumb-item active" style="text-transform: capitalize;">Penaggung Jawab Sarpras</li>
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

                    {{-- <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Filter</h5>
                            <form class="row gx-3 gy-2 align-items-center">
                                <div class="col-sm-3">
                                    <label class="visually-hidden" for="specificSizeSelect">Gedung</label>
                                    <select class="form-select" id="specificSizeSelect">
                                        <option selected>Pilih Gedung...</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>
                                <div class="col-sm-3">
                                    <label class="visually-hidden" for="specificSizeSelect">Ruangan</label>
                                    <select class="form-select" id="specificSizeSelect">
                                        <option selected>Pilih Ruangan...</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>

                                <div class="col-auto">
                                    <button type="submit" class="btn btn-primary">Search</button>
                                </div>
                            </form>
                        </div>
                    </div> --}}

                </div>
            </div>
        </section>
        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">

                            <!-- Table with stripped rows -->

                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th scope="col">Kode Inventaris</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Sarpras</th>
                                        <th scope="col">Kategori</th>
                                        <th scope="col">Penanggung Jawab</th>
                                        {{-- <th scope="col">Lokasi Prasarana</th> --}}
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($prasaranas as $item)
                                        @php
                                            $sarpras = 'Prasarana';
                                        @endphp
                                        @include('page.penanggungJawabSarpras.popup.pj-sarpras')
                                        <tr>
                                            <th scope="row">{{ $item->kode_inventaris }}</th>
                                            <td>{{ $item->nama_prasarana }}</td>
                                            <td>Prasarana</td>
                                            <td>{{ $item->kategori->kategori }}</td>
                                            <td>{{ $item->pjSarpras($item->id)->user->userDetail->nama_lengkap ?? 'N/A' }}</td>
                                            {{-- <td>{{ $item->lokasi_prasarana }}</td> --}}
                                            <td>
                                                <a href="#" class="btn btn-warning" title="Edit"
                                                    data-bs-toggle="modal" data-bs-target="#pj-sarpras{{ $item->id }}" 
                                                    onclick="pjsarpras('{{ $item->id }}')">
                                                    <i class="bi bi-pencil"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    @foreach ($saranas as $item)
                                        @php
                                            $sarpras = 'Sarana';
                                        @endphp
                                        @include('page.penanggungJawabSarpras.popup.pj-sarpras')
                                        <tr>
                                            <th scope="row">{{ $item->kode_inventaris }}</th>
                                            <td>{{ $item->nama_sarana }}</td>
                                            <td>Sarana</td>
                                            <td>{{ $item->kategori->kategori }}</td>
                                            <td>{{ $item->pjSarpras($item->id)->user->userDetail->nama_lengkap ?? 'N/A' }}</td>
                                            {{-- <td>{{ $item->lokasi_sarana }}</td> --}}
                                            <td>
                                                <a href="#" class="btn btn-warning" title="Edit"
                                                    data-bs-toggle="modal" data-bs-target="#pj-sarpras{{ $item->id }}"
                                                    onclick="pjsarpras('{{ $item->id }}')">
                                                    <i class="bi bi-pencil"></i></a>
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

@section('script')
    <script>
        document.getElementById('showPopup').addEventListener('click', function() {
            document.getElementById('popup').classList.remove('hidden');
        });
    </script>
@endsection
