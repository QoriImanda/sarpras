@extends('layouts.app')

@section('pemeliharaan-sarpras-active')
    class="nav-link "
@endsection

@section('title', 'Pemeliharaan')

@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1 style="text-transform: capitalize;">Pemeliharaan Sarpras</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
                    <li class="breadcrumb-item active" style="text-transform: capitalize;">Pemeliharaan Sarpras</li>
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
                            <h5 class="card-title">Tahun Periode {{ $thn }} | {{ $semester }}</h5>
                            <form class="row gx-3 gy-2 align-items-center"
                                action="{{ route('pemeliharaanSarpras.index') }}">
                                <div class="col-sm-3">
                                    <label class="visually-hidden" for="specificSizeSelect">Gedung</label>
                                    <select class="form-select" id="specificSizeSelect" name="thn">
                                        @foreach ($thnPeriode as $item)
                                            <option value="{{ $item->thn }}"
                                                @if ($item->thn == $thn) selected @endif>{{ $item->thn }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <input type="hidden" name="semester" value="{{$semester}}">
                                </div>
                                <div class="col-auto">
                                    <button type="submit" class="btn btn-primary">Select</button>
                                </div>
                            </form>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Semester</h5>

                            <!-- Default Tabs -->
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <form class="row gx-3 gy-2 align-items-center"
                                    action="{{ route('pemeliharaanSarpras.index') }}">
                                    <li class="nav-item" role="presentation">
                                        <input type="hidden" name="thn" value="{{ $thn }}">
                                        <input type="hidden" name="semester" value="Ganjil">

                                        <button type="submit"
                                            @if ($semester == 'Ganjil') class="nav-link active"@else class="nav-link" @endif
                                            id="ganjil-tab" data-bs-toggle="tab" data-bs-target="#home" type="button"
                                            role="tab" aria-controls="home" aria-selected="true">Ganjil</button>
                                    </li>
                                </form>
                                <form class="row gx-3 gy-2 align-items-center"
                                    action="{{ route('pemeliharaanSarpras.index') }}">
                                    <li class="nav-item" role="presentation">
                                        <input type="hidden" name="thn" value="{{ $thn }}">
                                        <input type="hidden" name="semester" value="Genap">

                                        <button type="submit"
                                            @if ($semester == 'Genap') class="nav-link active"@else class="nav-link" @endif
                                            id="genap-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button"
                                            role="tab" aria-controls="profile" aria-selected="false">Genap</button>
                                    </li>
                                </form>

                            </ul>
                            {{-- ROLE ADMIN|IVN --}}
                            @php
                                $roleUser = [];
                                $roles = auth()->user()->roles;
                                foreach ($roles as $role) {
                                    array_push($roleUser, $role->role_code);
                                }
                            @endphp
                            @if (in_array('PJS', $roleUser))
                                <div class="tab-content pt-2" id="myTabContent">
                                    <div @if ($semester == 'Ganjil') class="tab-pane fade show active" @else class="tab-pane fade" @endif
                                        id="home" role="tabpanel" aria-labelledby="ganjil-tab">
                                        <div class="card-body mt-4">
                                            <!-- Table with stripped rows -->
                                            <table class="table datatable">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Kode Inventaris</th>
                                                        <th scope="col">Nama</th>
                                                        <th scope="col">Sarpras</th>
                                                        {{-- <th scope="col">Kategori</th> --}}
                                                        <th scope="col">Kondisi</th>
                                                        <th scope="col">Keterangan</th>
                                                        <th scope="col">Akar Masalah</th>
                                                        <th scope="col">Tindak Lanjut</th>
                                                        {{-- <th scope="col">Lokasi Prasarana</th> --}}
                                                        <th scope="col">Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($pjSarpras as $item)
                                                        @php
                                                            $sarpras = $item->sarana_or_prasarana;
                                                            $sectionprasaranaSaranas = false;
                                                        @endphp
                                                        @include('page.pemeliharaanSarpras.popup.form-input-pemeliharaan-sarpras-Ganjil')
                                                        <tr>
                                                            <th scope="row">
                                                                {{ $item->sarpras($item->sarpras_id, $item->sarana_or_prasarana)->kodeInventaris->gol ?? '' }}.{{ $item->sarpras($item->sarpras_id, $item->sarana_or_prasarana)->kodeInventaris->bid ?? '' }}{{ $item->sarpras($item->sarpras_id, $item->sarana_or_prasarana)->kodeInventaris->kel ?? '' }}.{{ $item->sarpras($item->sarpras_id, $item->sarana_or_prasarana)->kodeInventaris->sub_kel ?? '' }}.{{ $item->sarpras($item->sarpras_id, $item->sarana_or_prasarana)->kodeInventaris->sub_sub ?? '' }}.{{ $item->sarpras($item->sarpras_id, $item->sarana_or_prasarana)->kodeInventaris->no_urut ?? '' }}
                                                            </th>
                                                            <td>{{ $item->sarpras($item->sarpras_id, $item->sarana_or_prasarana)->nama_prasarana ??
                                                                ($item->sarpras($item->sarpras_id, $item->sarana_or_prasarana)->nama_sarana ?? '') }}
                                                                {{-- @if ($item->pjSarpras($item->id)->user->userDetail->nama_lengkap ?? '')
                                                                    ({{ $item->pjSarpras($item->id)->user->userDetail->nama_lengkap ?? '' }})
                                                                @endif --}}
                                                            </td>
                                                            <td>{{ $item->sarana_or_prasarana }}</td>
                                                            {{-- <td>{{ $item->kategori->kategori }}</td> --}}
                                                            <td>{{ $item->logPemeliharaanSarpras($item->sarpras_id, $thn, $semester)->kondisi ?? 'N/A' }}
                                                            </td>
                                                            <td>{{ $item->logPemeliharaanSarpras($item->sarpras_id, $thn, $semester)->desc ?? 'N/A' }}
                                                            </td>
                                                            <td>{{ $item->logPemeliharaanSarpras($item->sarpras_id, $thn, $semester)->akar_masalah ?? 'N/A' }}
                                                            </td>
                                                            <td>{{ $item->logPemeliharaanSarpras($item->sarpras_id, $thn, $semester)->tindak_lanjut ?? 'N/A' }}
                                                            </td>
                                                            <td>
                                                                <a href="#" class="btn btn-warning" title="Edit"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#pemeliharaan-sarpras{{ $item->id }}{{ $semester }}">
                                                                    <i class="bi bi-pencil"></i></a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    @foreach ($prasaranaSaranas as $item)
                                                        @php
                                                            $sarpras = 'Sarana';
                                                            $sectionprasaranaSaranas = true;
                                                        @endphp
                                                        @include('page.pemeliharaanSarpras.popup.form-input-pemeliharaan-sarpras-Ganjil')
                                                        <tr>
                                                            <th scope="row">
                                                                {{ $item->kodeInventaris->gol }}.{{ $item->kodeInventaris->bid }}.{{ $item->kodeInventaris->kel }}.{{ $item->kodeInventaris->sub_kel }}.{{ $item->kodeInventaris->sub_sub }}.{{ $item->kodeInventaris->no_urut }}
                                                            </th>
                                                            <td>{{ $item->nama_sarana }}
                                                            </td>
                                                            <td>{{ $sarpras }}</td>
                                                            <td>{{ $item->logPemeliharaanSarpras($item->id, $thn, $semester)->kondisi ?? 'N/A' }}
                                                            </td>
                                                            <td>{{ $item->logPemeliharaanSarpras($item->id, $thn, $semester)->desc ?? 'N/A' }}
                                                            </td>
                                                            <td>{{ $item->logPemeliharaanSarpras($item->id, $thn, $semester)->akar_masalah ?? 'N/A' }}
                                                            </td>
                                                            <td>{{ $item->logPemeliharaanSarpras($item->id, $thn, $semester)->tindak_lanjut ?? 'N/A' }}
                                                            </td>
                                                            <td>
                                                                <a href="#" class="btn btn-warning" title="Edit"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#pemeliharaan-sarpras{{ $item->id }}{{ $semester }}">
                                                                    <i class="bi bi-pencil"></i></a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>

                                            <!-- End Table with stripped rows -->

                                        </div>
                                    </div>
                                    <div @if ($semester == 'Genap') class="tab-pane fade show active" @else class="tab-pane fade" @endif
                                        id="profile" role="tabpanel" aria-labelledby="genap-tab">
                                        <div class="card-body mt-4">
                                            <!-- Table with stripped rows -->
                                            <table class="table datatable">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Kode Inventaris</th>
                                                        <th scope="col">Nama</th>
                                                        <th scope="col">Sarpras</th>
                                                        {{-- <th scope="col">Kategori</th> --}}
                                                        <th scope="col">Kondisi</th>
                                                        <th scope="col">Keterangan</th>
                                                        <th scope="col">Akar Masalah</th>
                                                        <th scope="col">Tindak Lanjut</th>
                                                        {{-- <th scope="col">Lokasi Prasarana</th> --}}
                                                        <th scope="col">Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($pjSarpras as $item)
                                                        @php
                                                            $sarpras = $item->sarana_or_prasarana;
                                                            $sectionprasaranaSaranas = false;
                                                        @endphp
                                                        @include('page.pemeliharaanSarpras.popup.form-input-pemeliharaan-sarpras-Genap')
                                                        <tr>
                                                            <th scope="row">
                                                                {{ $item->sarpras($item->sarpras_id, $item->sarana_or_prasarana)->kodeInventaris->gol ?? '' }}.{{ $item->sarpras($item->sarpras_id, $item->sarana_or_prasarana)->kodeInventaris->bid ?? '' }}{{ $item->sarpras($item->sarpras_id, $item->sarana_or_prasarana)->kodeInventaris->kel ?? '' }}.{{ $item->sarpras($item->sarpras_id, $item->sarana_or_prasarana)->kodeInventaris->sub_kel ?? '' }}.{{ $item->sarpras($item->sarpras_id, $item->sarana_or_prasarana)->kodeInventaris->sub_sub ?? '' }}.{{ $item->sarpras($item->sarpras_id, $item->sarana_or_prasarana)->kodeInventaris->no_urut ?? '' }}
                                                            </th>
                                                            <td>{{ $item->sarpras($item->sarpras_id, $item->sarana_or_prasarana)->nama_prasarana ??
                                                                ($item->sarpras($item->sarpras_id, $item->sarana_or_prasarana)->nama_sarana ?? '') }}
                                                                {{-- @if ($item->pjSarpras($item->id)->user->userDetail->nama_lengkap ?? '')
                                                                    ({{ $item->pjSarpras($item->id)->user->userDetail->nama_lengkap ?? '' }})
                                                                @endif --}}
                                                            </td>
                                                            <td>{{ $item->sarana_or_prasarana }}</td>
                                                            {{-- <td>{{ $item->kategori->kategori }}</td> --}}
                                                            <td>{{ $item->logPemeliharaanSarpras($item->sarpras_id, $thn, $semester)->kondisi ?? 'N/A' }}
                                                            </td>
                                                            <td>{{ $item->logPemeliharaanSarpras($item->sarpras_id, $thn, $semester)->desc ?? 'N/A' }}
                                                            </td>
                                                            <td>{{ $item->logPemeliharaanSarpras($item->sarpras_id, $thn, $semester)->akar_masalah ?? 'N/A' }}
                                                            </td>
                                                            <td>{{ $item->logPemeliharaanSarpras($item->sarpras_id, $thn, $semester)->tindak_lanjut ?? 'N/A' }}
                                                            </td>
                                                            <td>
                                                                <a href="#" class="btn btn-warning" title="Edit"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#pemeliharaan-sarpras{{ $item->id }}{{ $semester }}">
                                                                    <i class="bi bi-pencil"></i></a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    @foreach ($prasaranaSaranas as $item)
                                                        @php
                                                            $sarpras = 'Sarana';
                                                            $sectionprasaranaSaranas = true;
                                                        @endphp
                                                        @include('page.pemeliharaanSarpras.popup.form-input-pemeliharaan-sarpras-Genap')
                                                        <tr>
                                                            <th scope="row">
                                                                {{ $item->kodeInventaris->gol }}.{{ $item->kodeInventaris->bid }}.{{ $item->kodeInventaris->kel }}.{{ $item->kodeInventaris->sub_kel }}.{{ $item->kodeInventaris->sub_sub }}.{{ $item->kodeInventaris->no_urut }}
                                                            </th>
                                                            <td>{{ $item->nama_sarana }}
                                                            </td>
                                                            <td>{{ $sarpras }}</td>
                                                            <td>{{ $item->logPemeliharaanSarpras($item->id, $thn, $semester)->kondisi ?? 'N/A' }}
                                                            </td>
                                                            <td>{{ $item->logPemeliharaanSarpras($item->id, $thn, $semester)->desc ?? 'N/A' }}
                                                            </td>
                                                            <td>{{ $item->logPemeliharaanSarpras($item->id, $thn, $semester)->akar_masalah ?? 'N/A' }}
                                                            </td>
                                                            <td>{{ $item->logPemeliharaanSarpras($item->id, $thn, $semester)->tindak_lanjut ?? 'N/A' }}
                                                            </td>
                                                            <td>
                                                                <a href="#" class="btn btn-warning" title="Edit"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#pemeliharaan-sarpras{{ $item->id }}{{ $semester }}">
                                                                    <i class="bi bi-pencil"></i></a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>

                                            <!-- End Table with stripped rows -->

                                        </div>
                                    </div>
                                </div><!-- End Default Tabs -->
                            @elseif (in_array('ADM', $roleUser) || in_array('IVN', $roleUser))
                                <div class="tab-content pt-2" id="myTabContent">
                                    <div @if ($semester == 'Ganjil') class="tab-pane fade show active" @else class="tab-pane fade" @endif
                                        id="home" role="tabpanel" aria-labelledby="ganjil-tab">
                                        <div class="card-body mt-4">
                                            <!-- Table with stripped rows -->
                                            <table class="table datatable">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Kode Inventaris</th>
                                                        <th scope="col">Nama</th>
                                                        <th scope="col">Sarpras</th>
                                                        {{-- <th scope="col">Kategori</th> --}}
                                                        <th scope="col">Kondisi</th>
                                                        <th scope="col">Keterangan</th>
                                                        <th scope="col">Akar Masalah</th>
                                                        <th scope="col">Tindak Lanjut</th>
                                                        {{-- <th scope="col">Lokasi Prasarana</th> --}}
                                                        <th scope="col">Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($prasaranas as $item)
                                                        @php
                                                            $sarpras = 'Prasarana';
                                                        @endphp
                                                        @include('page.pemeliharaanSarpras.popup.form-input-pemeliharaan-sarpras-Ganjil')
                                                        <tr>
                                                            <th scope="row">{{ $item->kodeInventaris->gol }}.{{ $item->kodeInventaris->bid }}.{{ $item->kodeInventaris->kel }}.{{ $item->kodeInventaris->sub_kel }}.{{ $item->kodeInventaris->sub_sub }}.{{ $item->kodeInventaris->no_urut }}</th>
                                                            <td>{{ $item->nama_prasarana }}
                                                                @if ($item->pjSarpras($item->id)->user->userDetail->nama_lengkap ?? '')
                                                                    ({{ $item->pjSarpras($item->id)->user->userDetail->nama_lengkap ?? '' }})
                                                                @endif
                                                            </td>
                                                            <td>{{ $sarpras }}</td>
                                                            {{-- <td>{{ $item->kategori->kategori }}</td> --}}
                                                            <td>{{ $item->logPemeliharaanSarpras($item->id, $thn, $semester)->kondisi ?? 'N/A' }}
                                                            </td>
                                                            <td>{{ $item->logPemeliharaanSarpras($item->id, $thn, $semester)->desc ?? 'N/A' }}
                                                            </td>
                                                            <td>{{ $item->logPemeliharaanSarpras($item->id, $thn, $semester)->akar_masalah ?? 'N/A' }}
                                                            </td>
                                                            <td>{{ $item->logPemeliharaanSarpras($item->id, $thn, $semester)->tindak_lanjut ?? 'N/A' }}
                                                            </td>
                                                            <td>
                                                                <a href="#" class="btn btn-warning" title="Edit"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#pemeliharaan-sarpras{{ $item->id }}{{ $semester }}">
                                                                    <i class="bi bi-pencil"></i></a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    @foreach ($saranas as $item)
                                                        @php
                                                            $sarpras = 'Sarana';
                                                        @endphp
                                                        @include('page.pemeliharaanSarpras.popup.form-input-pemeliharaan-sarpras-Ganjil')
                                                        <tr>
                                                            <th scope="row">{{ $item->kodeInventaris->gol }}.{{ $item->kodeInventaris->bid }}.{{ $item->kodeInventaris->kel }}.{{ $item->kodeInventaris->sub_kel }}.{{ $item->kodeInventaris->sub_sub }}.{{ $item->kodeInventaris->no_urut }}</th>
                                                            <td>{{ $item->nama_sarana }}
                                                                @if ($item->pjSarpras($item->id)->user->userDetail->nama_lengkap ?? ($item->pjSarana($item->id)->nama_lengkap ?? ''))
                                                                    ({{ $item->pjSarpras($item->id)->user->userDetail->nama_lengkap ?? $item->pjSarana($item->id)->nama_lengkap }})
                                                                @endif
                                                            </td>
                                                            <td>{{ $sarpras }}</td>
                                                            {{-- <td>{{ $item->kategori->kategori }}</td> --}}
                                                            <td>{{ $item->logPemeliharaanSarpras($item->id, $thn, $semester)->kondisi ?? 'N/A' }}
                                                            </td>
                                                            <td>{{ $item->logPemeliharaanSarpras($item->id, $thn, $semester)->desc ?? 'N/A' }}
                                                            </td>
                                                            <td>{{ $item->logPemeliharaanSarpras($item->id, $thn, $semester)->akar_masalah ?? 'N/A' }}
                                                            </td>
                                                            <td>{{ $item->logPemeliharaanSarpras($item->id, $thn, $semester)->tindak_lanjut ?? 'N/A' }}
                                                            </td>
                                                            <td>
                                                                <a href="#" class="btn btn-warning" title="Edit"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#pemeliharaan-sarpras{{ $item->id }}{{ $semester }}">
                                                                    <i class="bi bi-pencil"></i></a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>

                                            <!-- End Table with stripped rows -->

                                        </div>
                                    </div>
                                    <div @if ($semester == 'Genap') class="tab-pane fade show active" @else class="tab-pane fade" @endif
                                        id="profile" role="tabpanel" aria-labelledby="genap-tab">
                                        <div class="card-body mt-4">
                                            <!-- Table with stripped rows -->
                                            <table class="table datatable">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Kode Inventaris</th>
                                                        <th scope="col">Nama</th>
                                                        <th scope="col">Sarpras</th>
                                                        {{-- <th scope="col">Kategori</th> --}}
                                                        <th scope="col">Kondisi</th>
                                                        <th scope="col">Keterangan</th>
                                                        <th scope="col">Akar Masalah</th>
                                                        <th scope="col">Tindak Lanjut</th>
                                                        {{-- <th scope="col">Lokasi Prasarana</th> --}}
                                                        <th scope="col">Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($prasaranas as $item)
                                                        @php
                                                            $sarpras = 'Prasarana';
                                                        @endphp
                                                        @include('page.pemeliharaanSarpras.popup.form-input-pemeliharaan-sarpras-Genap')
                                                        <tr>
                                                            <th scope="row">{{ $item->kodeInventaris->gol }}.{{ $item->kodeInventaris->bid }}.{{ $item->kodeInventaris->kel }}.{{ $item->kodeInventaris->sub_kel }}.{{ $item->kodeInventaris->sub_sub }}.{{ $item->kodeInventaris->no_urut }}</th>
                                                            <td>{{ $item->nama_prasarana }}
                                                                @if ($item->pjSarpras($item->id)->user->userDetail->nama_lengkap ?? '')
                                                                    ({{ $item->pjSarpras($item->id)->user->userDetail->nama_lengkap ?? '' }})
                                                                @endif
                                                            </td>
                                                            <td>{{ $sarpras }}</td>
                                                            {{-- <td>{{ $item->kategori->kategori }}</td> --}}
                                                            <td>{{ $item->logPemeliharaanSarpras($item->id, $thn, $semester)->kondisi ?? 'N/A' }}
                                                            </td>
                                                            <td>{{ $item->logPemeliharaanSarpras($item->id, $thn, $semester)->desc ?? 'N/A' }}
                                                            </td>
                                                            <td>{{ $item->logPemeliharaanSarpras($item->id, $thn, $semester)->akar_masalah ?? 'N/A' }}
                                                            </td>
                                                            <td>{{ $item->logPemeliharaanSarpras($item->id, $thn, $semester)->tindak_lanjut ?? 'N/A' }}
                                                            </td>
                                                            <td>
                                                                <a href="#" class="btn btn-warning" title="Edit"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#pemeliharaan-sarpras{{ $item->id }}{{ $semester }}">
                                                                    <i class="bi bi-pencil"></i></a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    @foreach ($saranas as $item)
                                                        @php
                                                            $sarpras = 'Sarana';
                                                        @endphp
                                                        @include('page.pemeliharaanSarpras.popup.form-input-pemeliharaan-sarpras-Genap')
                                                        <tr>
                                                            <th scope="row">{{ $item->kodeInventaris->gol }}.{{ $item->kodeInventaris->bid }}.{{ $item->kodeInventaris->kel }}.{{ $item->kodeInventaris->sub_kel }}.{{ $item->kodeInventaris->sub_sub }}.{{ $item->kodeInventaris->no_urut }}</th>
                                                            <td>{{ $item->nama_sarana }}
                                                                @if ($item->pjSarpras($item->id)->user->userDetail->nama_lengkap ?? '')
                                                                    ({{ $item->pjSarpras($item->id)->user->userDetail->nama_lengkap ?? '' }})
                                                                @endif
                                                            </td>
                                                            <td>{{ $sarpras }}</td>
                                                            {{-- <td>{{ $item->kategori->kategori }}</td> --}}
                                                            <td>{{ $item->logPemeliharaanSarpras($item->id, $thn, $semester)->kondisi ?? 'N/A' }}
                                                            </td>
                                                            <td>{{ $item->logPemeliharaanSarpras($item->id, $thn, $semester)->desc ?? 'N/A' }}
                                                            </td>
                                                            <td>{{ $item->logPemeliharaanSarpras($item->id, $thn, $semester)->akar_masalah ?? 'N/A' }}
                                                            </td>
                                                            <td>{{ $item->logPemeliharaanSarpras($item->id, $thn, $semester)->tindak_lanjut ?? 'N/A' }}
                                                            </td>
                                                            <td>
                                                                <a href="#" class="btn btn-warning" title="Edit"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#pemeliharaan-sarpras{{ $item->id }}{{ $semester }}">
                                                                    <i class="bi bi-pencil"></i></a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>

                                            <!-- End Table with stripped rows -->

                                        </div>
                                    </div>
                                </div><!-- End Default Tabs -->
                            @endif
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
