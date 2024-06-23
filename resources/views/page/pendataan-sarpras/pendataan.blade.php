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
            <h1 style="text-transform: capitalize;">Pendataan
                @if (in_array('PJS', $roleUser))
                    Sarpras
                @else
                    {{ $menu }}
                @endif

            </h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
                    @if (in_array(!'PJS', $roleUser))
                        <li class="breadcrumb-item"><a href="{{ route('pendataanSarpras.menu') }}">Pendataan</a></li>
                    @endif
                    <li class="breadcrumb-item active" style="text-transform: capitalize;">
                        @if (in_array('PJS', $roleUser))
                            Pendataan Sarpras
                        @else
                            {{ $menu }}
                        @endif

                    </li>
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
                            @if (in_array('PJS', $roleUser))
                                <h5 class="mt-4"><strong>{{ $prasarana->nama_prasarana ?? '' }}</strong></h5>
                            @endif
                            @if (!in_array('PJS', $roleUser) || $kondisiPJL ?? '' == true)
                                @include('page.pendataan-sarpras.popup.add-' . $menu)
                                <h5 class="card-title">
                                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#add-{{ $menu }}" style="text-transform: capitalize;">
                                        Add {{ $menu }}
                                    </button>
                                </h5>
                            @endif

                            <!-- Table with stripped rows -->
                            @if ($menu == 'sarana')
                                <table id="table-responsive-mobile" class="display" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th scope="col">Kode Inventaris</th>
                                            <th scope="col">Nama Sarana</th>
                                            <th scope="col">Deskripsi</th>
                                            <th scope="col">Jenis Sarana</th>
                                            <th scope="col">Kategori</th>
                                            <th scope="col">Tahun Pengadaan</th>
                                            <th scope="col">Jumlah</th>
                                            <th scope="col">Harga</th>
                                            <th scope="col">Lokasi Sarana</th>
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($sarpras as $item)
                                            @include('page.pendataan-sarpras.popup.edit-' . $menu)
                                            <tr>
                                                <th scope="row">
                                                    <div class="text-nowrap">
                                                        {{ $item->kodeInventaris->gol }}.{{ $item->kodeInventaris->bid }}.{{ $item->kodeInventaris->kel }}.{{ $item->kodeInventaris->sub_kel }}.{{ $item->kodeInventaris->sub_sub }}.{{ $item->kodeInventaris->no_urut }}
                                                    </div>
                                                </th>
                                                <td>{{ $item->nama_sarana }}</td>
                                                <td>{{ $item->desc }}</td>
                                                <td>{{ $item->jenis_sarana }}</td>
                                                <td>{{ $item->kategori->kategori }}</td>
                                                <td>{{ $item->tahun_pengadaan }}</td>
                                                <td>{{ $item->jumlah }}</td>
                                                <td>{{ $item->harga }}</td>
                                                <td>{{ $item->lokasi_sarana }}</td>
                                                <td>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <a href="#" class="btn btn-warning" title="Edit"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#edit-sarana{{ $item->id }}">
                                                                <i class="bi bi-pencil"></i></a>
                                                        </div>
                                                        @if (in_array('PJS', $roleUser))
                                                            <form
                                                                action="{{ route('pendataanSarpras.destroy', [$menu, $item->id]) }}"
                                                                method="post">
                                                                @csrf
                                                                @method('delete')
                                                                <input type="hidden" name="kondisi" value="move out">
                                                                <button class="btn btn-secondary mt-2" title="Delete"
                                                                    onclick="return confirm('Anda ingin mengeluarkan data ini?')"><i
                                                                        class="bi bi-box-arrow-up"></i></button>
                                                            </form>
                                                        @endif
                                                        <form
                                                            action="{{ route('pendataanSarpras.destroy', [$menu, $item->id]) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('delete')

                                                            <button class="btn btn-danger mt-2" title="Trash"
                                                                onclick="return confirm('Anda ingin menghapus data ini?')"><i
                                                                    class="bi bi-trash"></i></button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @elseif ($menu == 'prasarana')
                                <table class="table datatable">
                                    <thead>
                                        <tr>
                                            @if (!in_array('PJS', $roleUser))
                                                <th scope="col">Kode Inventaris</th>
                                            @endif
                                            <th scope="col">Nama Prasarana</th>
                                            @if (!in_array('PJS', $roleUser))
                                                <th scope="col">Deskripsi</th>
                                            @endif
                                            <th scope="col">Kategori</th>
                                            {{-- <th scope="col">Tahun Pengadaan</th> --}}
                                            {{-- <th scope="col">Lokasi Prasarana</th> --}}
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($sarpras as $item)
                                            @include('page.pendataan-sarpras.popup.edit-' . $menu)
                                            <tr>
                                                @if (!in_array('PJS', $roleUser))
                                                    <th scope="row">
                                                        {{ $item->kode_inventaris ?? $item->prasarana($item->sarpras_id)->kode_inventaris }}
                                                    </th>
                                                @endif
                                                <td>{{ $item->nama_prasarana ?? $item->prasarana($item->sarpras_id)->nama_prasarana }}
                                                </td>
                                                @if (!in_array('PJS', $roleUser))
                                                    <td>{{ $item->desc ?? ('' ?? $item->prasarana($item->sarpras_id)->desc) }}
                                                    </td>
                                                @endif
                                                <td>{{ $item->kategori->kategori ?? $item->prasarana($item->sarpras_id)->kategori->kategori }}
                                                </td>
                                                {{-- <td>{{ $item->tahunlokasi_pengadaan }}</td> --}}
                                                {{-- <td>{{ $item->lokasi_prasarana }}</td> --}}
                                                <td>
                                                    @if (in_array('PJS', $roleUser))
                                                        <a href="{{ route('pendataanSarpras.pendataan.pjs', ['sarana', $item->prasarana($item->sarpras_id)->id]) }}"
                                                            class="btn btn-info" title="View Sarana">
                                                            <i class="bi bi-info"></i></a>
                                                    @else
                                                        <a href="#" class="btn btn-warning" title="Edit"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#edit-prasarana{{ $item->id }}">
                                                            <i class="bi bi-pencil"></i></a>
                                                        <form
                                                            action="{{ route('pendataanSarpras.destroy', [$menu, $item->id]) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('delete')

                                                            <button class="btn btn-danger mt-2" title="Delete"
                                                                onclick="return confirm('Anda ingin menghapus data ini?')"><i
                                                                    class="bi bi-trash"></i></button>
                                                        </form>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endif

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
        new DataTable('#table-responsive-mobile', {
            responsive: true,
            lengthChange: false,
            searching: false,
            paging: false,
            info: false,
            rowReorder: {
                selector: 'td:nth-child(2)'
            }
        });
    </script>
@endsection
