@extends('layouts.app')
@section('hidden-collapsed-master-data')
    class="nav-link"
@endsection
@section('show-master-data', 'show')
@section('fakultas-active')
    class="active"
@endsection

@section('title', 'Data Fakultas')

@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Fakultas</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
                    <li class="breadcrumb-item">Master Data</li>
                    <li class="breadcrumb-item active">Fakultas</li>
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
                            <h5 class="card-title">Data Fakultas</h5>

                            <!-- Table with stripped rows -->
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th scope="col">No.</th>
                                        <th scope="col">Fakultas</th>
                                        <th scope="col">Dekan Fakultas</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($fakultases as $fakultas)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>{{ $fakultas->nama_fakultas }}</td>
                                            <td>{{ $fakultas->user->userDetail->nama_lengkap ?? '' }}</td>
                                            <td>

                                                <a href="#" class="btn btn-sm btn-info" title="Edit"
                                                    data-toggle="modal" data-target="#editFakultas{{ $fakultas->id }}"
                                                    onclick="editDekan({{ $fakultas->id }})">
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

    @foreach ($fakultases as $item)
        <!-- Modal -->
        <form action="{{ route('masterDataFakultas.updateDekan', $item->id) }}" method="post"
            enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="modal fade modalEditFakultas{{ $item->id }}" id="editFakultas{{ $item->id }}"
                tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Pilih
                                Dekan</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row mb-3">
                                <label for="Address" class="col-md-4 col-lg-3 col-form-label">Nama Fakultas</label>
                                <div class="col-md-8 col-lg-9">
                                    <input name="nama_fakultas" type="text" class="form-control" id="Address"
                                        value="{{ $item->nama_fakultas ?? '' }}" required>
                                    <div class="invalid-feedback">
                                        Silahkan masukkan nama fakultas!
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="jk" class="col-md-4 col-lg-3 col-form-label">Dekan
                                </label>
                                <div class="col-md-8 col-lg-9">
                                    <select class="form-select " id="selectDekan{{ $item->id }}" style="width: 100%"
                                        name="user_id" data-placeholder="" required>
                                        <option selected value="{{ $item->user_id ?? 'Pilih Dekan!!' }}">
                                            {{ $item->user->userDetail->nama_lengkap ?? 'Pilih Dekan!!' }}
                                        </option>
                                        @foreach ($dekans as $dekan)
                                            <option value="{{ $dekan->user_id }}">
                                                {{ $dekan->nama_lengkap }}
                                            </option>
                                        @endforeach
                                    </select>
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

        @section('script1')
            <script>
                function editDekan(id) {
                    $("#selectDekan" + id).select2({
                        theme: 'bootstrap-5',
                        dropdownParent: '.modalEditFakultas' + id
                    });
                    // console.log(id);
                }
            </script>
        @endsection
    @endforeach


@endsection
