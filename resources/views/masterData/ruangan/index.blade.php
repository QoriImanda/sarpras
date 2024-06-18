@extends('layouts.app')
@section('hidden-collapsed-master-data')
    class="nav-link"
@endsection
@section('show-master-data', 'show')
@section('ruangan-active')
    class="active"
@endsection

@section('title', 'Data Lokasi/Ruangan')

@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Lokasi / Ruangan</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
                    <li class="breadcrumb-item">Master Data</li>
                    <li class="breadcrumb-item active">Ruangan</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle me-1"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('warning'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-triangle me-1"></i>
                {{ session('warning') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

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
                            <h5 class="card-title">Data Lokasi / Ruangan</h5>
                            @include('masterData.ruangan.popup.add-ruangan')
                            <h5 class="card-title">
                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#add-ruangan">
                                    Add Ruangan
                                </button>
                            </h5>
                            <!-- Table with stripped rows -->
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th scope="col">No.</th>
                                        <th scope="col">Gedung</th>
                                        <th scope="col">Ruangan</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($ruangans as $ruangan)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>{{ $ruangan->gedung->label_gedung }}</td>
                                            <td>{{ $ruangan->ruangan }}</td>
                                            <td>
                                                <a href="#" class="btn btn-sm btn-info" title="Edit"
                                                    data-toggle="modal" data-target="#editRuangan{{ $ruangan->id }}">
                                                    <i class="ri-edit-2-line"></i> Edit</a>
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
    @php
        use App\Models\Gedung;

        $gedungs = Gedung::orderBy('label_gedung', 'asc')->get();
    @endphp
    @foreach ($ruangans as $item)
        <!-- Modal -->
        <form action="{{ route('ruangan.update', $item->id) }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            @method('put')
            <div class="modal fade modalEditRuangan{{ $item->id }}" id="editRuangan{{ $item->id }}" tabindex="-1"
                role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Edit Ruangan</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row mb-3">
                                <label for="jk" class="col-md-4 col-lg-3 col-form-label">Gedung
                                </label>
                                <div class="col-md-8 col-lg-9">
                                    <select class="form-select" style="width: 100%" name="gedung_id" data-placeholder=""
                                        required>
                                        <option selected value="{{ $item->gedung_id ?? '' }}">
                                            {{ $item->gedung->label_gedung ?? 'Pilih Gedung!!' }}
                                        </option>
                                        @foreach ($gedungs as $gedung)
                                            <option value="{{ $gedung->id }}">
                                                {{ $gedung->label_gedung }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">
                                        Silahkan pilih prodi!
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="jk" class="col-md-4 col-lg-3 col-form-label">Ruangan
                                </label>
                                <div class="col-md-8 col-lg-9">
                                    <input type="text" class="form-control" name="ruangan" placeholder="" value="{{$item->ruangan}}">
                                    <div class="invalid-feedback">
                                        Silahkan pilih prodi!
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary btn-sm bi bi-save">
                                Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    @endforeach
@endsection
