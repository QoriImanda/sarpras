@extends('layouts.app')

@section('monev-sarpras-active')
    class="nav-link "
@endsection

@section('title', 'Monev')

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.0.2/css/buttons.dataTables.css">
@endsection

@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1 style="text-transform: capitalize;">Monev Sarpras</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
                    <li class="breadcrumb-item active" style="text-transform: capitalize;">Monev Sarpras</li>
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
                            <form class="row gx-3 gy-2 align-items-center" action="{{ route('monev.index') }}">
                                <div class="col-sm-3">
                                    <label class="visually-hidden" for="specificSizeSelect">Tahun</label>
                                    <select class="form-select" id="specificSizeSelect" name="thn">
                                        @foreach ($thnPeriode as $item)
                                            <option value="{{ $item->thn }}"
                                                @if ($item->thn == $thn) selected @endif>{{ $item->thn }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <input type="hidden" name="semester" value="{{ $semester }}">
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
                                <form class="row gx-3 gy-2 align-items-center" action="{{ route('monev.index') }}">
                                    <li class="nav-item" role="presentation">
                                        <input type="hidden" name="thn" value="{{ $thn }}">
                                        <input type="hidden" name="semester" value="Ganjil">

                                        <button type="submit"
                                            @if ($semester == 'Ganjil') class="nav-link active"@else class="nav-link" @endif
                                            id="ganjil-tab" data-bs-toggle="tab" data-bs-target="#home" type="button"
                                            role="tab" aria-controls="home" aria-selected="true">Ganjil</button>
                                    </li>
                                </form>
                                <form class="row gx-3 gy-2 align-items-center" action="{{ route('monev.index') }}">
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
                            <div class="tab-content pt-2" id="myTabContent">
                                <div @if ($semester == 'Ganjil') class="tab-pane fade show active" @else class="tab-pane fade" @endif
                                    id="home" role="tabpanel" aria-labelledby="ganjil-tab">
                                    <div class="card-body mt-4">
                                        <!-- Table with stripped rows -->
                                        {{-- <a href="" class="btn btn-sm btn-primary">Laporan PDF</a> --}}
                                        <table id="datatable-file-export-ganjil" class="table">
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
                                                    {{-- <th scope="col">Aksi</th> --}}
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($prasaranas as $item)
                                                    @php
                                                        $sarpras = 'Prasarana';
                                                    @endphp
                                                    {{-- @include('page.pemeliharaanSarpras.popup.form-input-pemeliharaan-sarpras-Ganjil') --}}
                                                    <tr>
                                                        <th scope="row">{{ $item->kode_inventaris }}</th>
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
                                                        {{-- <td>
                                                            <a href="#" class="btn btn-warning" title="Edit"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#pemeliharaan-sarpras{{ $item->id }}{{ $semester }}">
                                                                <i class="bi bi-pencil"></i></a>
                                                        </td> --}}
                                                    </tr>
                                                @endforeach
                                                @foreach ($saranas as $item)
                                                    @php
                                                        $sarpras = 'Sarana';
                                                    @endphp
                                                    {{-- @include('page.pemeliharaanSarpras.popup.form-input-pemeliharaan-sarpras-Ganjil') --}}
                                                    <tr>
                                                        <th scope="row">{{ $item->kode_inventaris }}</th>
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
                                                        {{-- <td>
                                                            <a href="#" class="btn btn-warning" title="Edit"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#pemeliharaan-sarpras{{ $item->id }}{{ $semester }}">
                                                                <i class="bi bi-pencil"></i></a>
                                                        </td> --}}
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

                                        <table id="datatable-file-export-genap" class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Kode Inventaris</th>
                                                    <th scope="col">Nama</th>
                                                    <th scope="col">Sarpras</th>
                                                    <th scope="col">Kondisi</th>
                                                    <th scope="col">Keterangan</th>
                                                    <th scope="col">Akar Masalah</th>
                                                    <th scope="col">Tindak Lanjut</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($prasaranas as $item)
                                                    @php
                                                        $sarpras = 'Prasarana';
                                                    @endphp
                                                    <tr>
                                                        <th scope="row">{{ $item->kode_inventaris }}</th>
                                                        <td>{{ $item->nama_prasarana }}
                                                            @if ($item->pjSarpras($item->id)->user->userDetail->nama_lengkap ?? '')
                                                                ({{ $item->pjSarpras($item->id)->user->userDetail->nama_lengkap ?? '' }})
                                                            @endif
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

                                                    </tr>
                                                @endforeach
                                                @foreach ($saranas as $item)
                                                    @php
                                                        $sarpras = 'Sarana';
                                                    @endphp
                                                    <tr>
                                                        <th scope="row">{{ $item->kode_inventaris }}</th>
                                                        <td>{{ $item->nama_sarana }}
                                                            @if ($item->pjSarpras($item->id)->user->userDetail->nama_lengkap ?? '')
                                                                ({{ $item->pjSarpras($item->id)->user->userDetail->nama_lengkap ?? '' }})
                                                            @endif
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
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>

                                        <!-- End Table with stripped rows -->

                                    </div>
                                </div>
                            </div><!-- End Default Tabs -->
                        </div>
                    </div>

                </div>
            </div>
        </section>

    </main>

@endsection

@section('script')

    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.2/js/dataTables.buttons.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.dataTables.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.print.min.js"></script>
    <script>
        new DataTable('#datatable-file-export-ganjil', {
            layout: {
                topStart: {
                    buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
                }
            }
        });

        new DataTable('#datatable-file-export-genap', {
            layout: {
                topStart: {
                    buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
                }
            }
        });

        document.getElementById('showPopup').addEventListener('click', function() {
            document.getElementById('popup').classList.remove('hidden');
        });
    </script>
@endsection
