@extends('layouts.app')
@section('hidden-collapsed-master-data')
    class="nav-link"
@endsection
@section('show-master-data', 'show')
@section('prodi-active')
    class="active"
@endsection

@section('title', 'Data Prodi')

@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Program Studi</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
                    <li class="breadcrumb-item">Master Data</li>
                    <li class="breadcrumb-item active">Prodi</li>
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
                            <h5 class="card-title">Data Prodi</h5>

                            <!-- Table with stripped rows -->
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th scope="col">No.</th>
                                        <th scope="col">Kode</th>
                                        <th scope="col">Prodi</th>
                                        <th scope="col">Jenjang</th>
                                        <th scope="col">Fakultas</th>
                                        <th scope="col">Ketua Prodi</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($prodis as $prodi)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>{{ $prodi->kode_prodi }}</td>
                                            <td>{{ $prodi->nama_prodi }}</td>
                                            <td>{{ $prodi->jenjang }}</td>
                                            <td>{{ $prodi->fakultas->nama_fakultas }}</td>
                                            <td>{{ $prodi->user->userDetail->nama_lengkap ?? ' ' }}</td>
                                            <td>
                                                <a href="#" class="btn btn-sm btn-info" title="Edit"
                                                    data-toggle="modal" data-target="#editKaprodis{{ $prodi->id }}"
                                                    onclick="editKaprodi({{ $prodi->id }})">
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

    @foreach ($prodis as $item)
        <!-- Modal -->
        <form action="{{ route('masterDataProdi.updateKaprodi', $item->id) }}" method="post"
            enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="modal fade modalEditKaprodi{{ $item->id }}" id="editKaprodis{{ $item->id }}"
                tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Pilih
                                Kaprodi</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row mb-3">
                                <label for="jk" class="col-md-4 col-lg-3 col-form-label">Kaprodi
                                </label>
                                <div class="col-md-8 col-lg-9">
                                    <select class="form-select " id="selectKaprodi{{ $item->id }}" style="width: 100%"
                                        name="user_id" data-placeholder="" required>
                                        <option selected value="{{ $item->user_id ?? 'Pilih Kaprodi!!' }}">
                                            {{ $item->user->userDetail->nama_lengkap ?? 'Pilih Kaprodi!!' }}
                                        </option>
                                        @foreach ($kaprodi as $ketuaprodi)
                                            <option value="{{ $ketuaprodi->user_id }}">
                                                {{ $ketuaprodi->nama_lengkap }}
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
                function editKaprodi(id) {
                    $("#selectKaprodi" + id).select2({
                        theme: 'bootstrap-5',
                        dropdownParent: '.modalEditKaprodi' + id
                    });
                }
            </script>
        @endsection
    @endforeach
@endsection
