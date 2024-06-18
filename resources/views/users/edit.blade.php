@extends('layouts.app')
@section('user-active')
    @if (true == $sideBarActive)
        class="nav-link "
    @else
        class="nav-link collapsed"
    @endif
@endsection

@section('title', 'Profile user')

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Profile</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
                    @if (in_array('ADM', $checkRole))
                        <li class="breadcrumb-item"><a href="{{ route('user.index') }}">Users</a></li>
                    @endif
                    <li class="breadcrumb-item active">Profile</li>
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

        @if ($errors->any())
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                @foreach ($errors->all() as $error)
                    <li><i class="bi bi-exclamation-triangle me-1"></i>{{ $error }}</li>
                @endforeach
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <section class="section profile">
            <div class="row">
                <div class="col-xl-4">

                    <div class="card">
                        <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                            @if ($user->userDetail == null || $user->userDetail->foto_profile == null)
                                <img src="{{ asset('assets/assets/img/profile-img.jpg') }}" alt="Profile"
                                    class="rounded-circle">
                            @else
                                <img src="{{ asset('/storage/' . $user->userDetail->foto_profile) }}" alt="Profile"
                                    class="rounded-circle">
                            @endif

                            <h2>{{ $user->userDetail ? $user->userDetail->nama_lengkap : $user->username }}</h2>

                            {{-- <span class="mt-2">{{session('role_akses')}}</span> --}}

                            {{-- <div class="social-links mt-2">
                                <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                                <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                                <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                                <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
                            </div> --}}
                        </div>
                    </div>

                </div>

                <div class="col-xl-8">

                    <div class="card">
                        <div class="card-body pt-3">
                            <!-- Bordered Tabs -->
                            <ul class="nav nav-tabs nav-tabs-bordered">

                                <li class="nav-item">
                                    <button class="nav-link active" data-bs-toggle="tab"
                                        data-bs-target="#profile-overview">Overview</button>
                                </li>

                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit
                                        Profile</button>
                                </li>
                                @if (in_array('ADM', $roleUser) != true)
                                    <li class="nav-item">
                                        <button class="nav-link" data-bs-toggle="tab"
                                            data-bs-target="#profile-settings">Roles</button>
                                    </li>
                                @endif

                                @if (in_array('ADM', $checkRole))
                                    <li class="nav-item">
                                        <button class="nav-link" data-bs-toggle="tab"
                                            data-bs-target="#profile-change-password">Akun User</button>
                                    </li>
                                @endif

                            </ul>
                            <div class="tab-content pt-2">

                                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                    {{-- <h5 class="card-title">About</h5>
                                    <p class="small fst-italic">Sunt est soluta temporibus accusantium neque nam maiores
                                        cumque temporibus. Tempora libero non est unde veniam est qui dolor. Ut sunt iure
                                        rerum quae quisquam autem eveniet perspiciatis odit. Fuga sequi sed ea saepe at
                                        unde.</p> --}}

                                    <h5 class="card-title">Profile Details</h5>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label ">Nama Lengkap</div>
                                        <div class="col-lg-9 col-md-8">{{ $user->userDetail->nama_lengkap ?? '' }}</div>
                                    </div>

                                    {{-- <div class="row">
                                        <div class="col-lg-3 col-md-4 label ">Jenis Kelamin</div>
                                        <div class="col-lg-9 col-md-8">{{ $user->userDetail->jk ?? '' }}</div>
                                    </div> --}}

                                    @if (in_array('DSN', $checkRole) || in_array('DSN', $roleUser))
                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">NIDN</div>
                                            <div class="col-lg-9 col-md-8">{{ $user->userDetail->nidn_string ?? '' }}</div>
                                        </div>
                                    @endif

                                    @if (in_array('MHS', $checkRole) || in_array('MHS', $roleUser))
                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">NIM</div>
                                            <div class="col-lg-9 col-md-8">{{ $user->userDetail->nim_string ?? '' }}</div>
                                        </div>
                                    @endif

                                    @if (in_array('DSN', $checkRole) ||
                                            in_array('MHS', $checkRole) ||
                                            in_array('DSN', $roleUser) ||
                                            in_array('MHS', $roleUser))
                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">Prodi</div>
                                            <div class="col-lg-9 col-md-8">
                                                {{ $user->userDetail->prodi->jenjang ?? '' }}
                                                {{ $user->userDetail->prodi->nama_prodi ?? '' }}
                                            </div>
                                        </div>
                                    @endif

                                    {{-- <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Email</div>
                                        <div class="col-lg-9 col-md-8">{{ $user->email ?? '' }}</div>
                                    </div> --}}

                                </div>

                                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                                    <!-- Profile Edit Form -->
                                    <form class="row g-3 needs-validation" novalidate
                                        action="{{ route('user.edit.update', $user->id) }}" method="post">
                                        {{ csrf_field() }}
                                        <div class="row mb-3">
                                            <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile
                                                Image</label>
                                            <div class="col-md-8 col-lg-9">
                                                @if ($user->userDetail == null || $user->userDetail->foto_profile == null)
                                                    <img src="{{ asset('assets/assets/img/profile-img.jpg') }}"
                                                        alt="Profile">
                                                @else
                                                    <img src="{{ asset('/storage/' . $user->userDetail->foto_profile) }}"
                                                        alt="Profile">
                                                @endif
                                                <div class="pt-2">
                                                    @if ($user->userDetail != null)
                                                        <a href="#" class="btn btn-primary btn-sm"
                                                            title="Upload new profile image" data-toggle="modal"
                                                            data-target="#exampleModalCenter"><i
                                                                class="bi bi-upload"></i></a>
                                                    @endif

                                                    {{-- <a href="" class="btn btn-danger btn-sm"
                                                            title="Remove profile image"><i class="bi bi-trash"></i></a> --}}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="nama_lengkap" class="col-md-4 col-lg-3 col-form-label">Nama
                                                Lengkap</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="nama_lengkap" type="text" class="form-control"
                                                    id="nama_lengkap"
                                                    value="{{ $user->userDetail->nama_lengkap ?? old('nama_lengkap') }}"
                                                    required>
                                                <div class="invalid-feedback">
                                                    Silahkan isi nama lengkap!
                                                </div>
                                            </div>

                                        </div>

                                        {{-- <div class="row mb-3">
                                            <label for="jk" class="col-md-4 col-lg-3 col-form-label">Jenis
                                                Kelamin</label>
                                            <div class="col-md-8 col-lg-9">
                                                <select class="form-select" name="jk" id="jk" required>
                                                    <option selected value="{{ $user->userDetail->jk ?? '' }}">
                                                        {{ $user->userDetail->jk ?? 'Pilih Jenis Kelamin' }}</option>
                                                    <option value="Laki-laki">Laki-laki</option>
                                                    <option value="Perempuan">Perempuan</option>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Silahkan pilih jenis kelamin!
                                                </div>
                                            </div>
                                        </div> --}}

                                        @if (in_array('DSN', $checkRole) || in_array('DSN', $roleUser))
                                            <div class="row mb-3">
                                                <label for="Job"
                                                    class="col-md-4 col-lg-3 col-form-label">NIDN</label>
                                                <div class="col-md-8 col-lg-9">
                                                    @if (in_array('ADM', $checkRole))
                                                    <input name="nidn" type="number" class="form-control"
                                                        id="Job" value="{{ $user->userDetail->nidn_string ?? '' }}"
                                                        required>
                                                    @else
                                                        <input type="hidden" name="nidn" value="{{ $user->userDetail->nidn_string ?? '' }}">
                                                        <input name="nidn" disabled type="number"
                                                            class="form-control" id="Job"
                                                            value="{{ $user->userDetail->nidn_string ?? '' }}">
                                                    @endif

                                                    <div class="invalid-feedback">
                                                        Silahkan isi nidn!
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                        @if (in_array('MHS', $checkRole) || in_array('MHS', $roleUser))
                                            <div class="row mb-3">
                                                <label for="Address" class="col-md-4 col-lg-3 col-form-label">NIM</label>
                                                <div class="col-md-8 col-lg-9">
                                                    @if (in_array('ADM', $checkRole))
                                                    <input name="nim" type="number" class="form-control"
                                                        id="Address" value="{{ $user->userDetail->nim_string ?? old('nim') }}"
                                                        required>
                                                    @else
                                                    <input type="hidden" name="nim" value="{{ $user->userDetail->nim_string ?? old('nim') }}">
                                                        <input name="nim" disabled type="number"
                                                            class="form-control" id="Address"
                                                            value="{{ $user->userDetail->nim_string ?? old('nim') }}">
                                                    @endif
                                                    <div class="invalid-feedback">
                                                        Silahkan isi nim!
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                        @if (in_array('DSN', $checkRole) ||
                                                in_array('MHS', $checkRole) ||
                                                in_array('DSN', $roleUser) ||
                                                in_array('MHS', $roleUser))
                                            <div class="row mb-3">
                                                <label for="jk" class="col-md-4 col-lg-3 col-form-label">Prodi
                                                </label>
                                                <div class="col-md-8 col-lg-9">
                                                    @if (in_array('ADM', $checkRole) || ($user->userDetail->prodi_id == null))
                                                    <select class="form-select selectProdi" id="prodi_id"
                                                        style="width: 100%" name="prodi_id" data-placeholder="" required>
                                                        @else
                                                            <input type="hidden" name="prodi_id" value="{{ $user->userDetail->prodi_id ?? '' }}">
                                                            <select disabled class="form-select selectProdi"
                                                                id="prodi_id" style="width: 100%" name="prodi_id"
                                                                data-placeholder="" required>
                                                    @endif
                                                        <option selected
                                                            value="{{ $user->userDetail->prodi_id ?? 'Pilih prodi!!' }}">
                                                            {{ $user->userDetail->prodi->jenjang ?? 'Pilih prodi' }}
                                                            {{ $user->userDetail->prodi->nama_prodi ?? 'Pilih prodi' }}
                                                        </option>
                                                        @foreach ($prodis as $prodi)
                                                            <option value="{{ $prodi->id }}">{{ $prodi->jenjang }}
                                                                {{ $prodi->nama_prodi }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <div class="invalid-feedback">
                                                        Silahkan pilih prodi!
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                        {{-- <div class="row mb-3">
                                            <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="email" type="email" class="form-control" id="Email"
                                                    value="{{ $user->email ?? old('email') }}" required>
                                                <div class="invalid-feedback">Silahkan masukkan email yang valid!</div>
                                            </div>
                                        </div> --}}

                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                        </div>
                                    </form><!-- End Profile Edit Form -->

                                </div>

                                <div class="tab-pane fade pt-3" id="profile-settings">

                                    <!-- Settings Form -->
                                    <form action="{{ route('user.changeRole', $user->id) }}" method="post">
                                        {{ csrf_field() }}
                                        <div class="row mb-3">
                                            <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Hak
                                                Akses</label>
                                            <div class="col-md-8 col-lg-9">
                                                @if (in_array('ADM', $checkRole) != true)
                                                    @foreach ($roles as $item)
                                                        @if (in_array($item->role_code, $roleUser))
                                                            <li>{{ $item->role_name }}</li>
                                                        @endif
                                                    @endforeach
                                                @endif

                                                @foreach ($roles as $item)
                                                    @if (in_array('ADM', $checkRole))
                                                        @if (in_array($item->role_code, $roleUser))
                                                            @if ($item->role_code == 'ADM')
                                                                <input class="form-check-input" type="hidden"
                                                                    name="role_id[]" value="{{ $item->id }}"
                                                                    id="changesMade" checked>
                                                            @else
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        name="role_id[]" value="{{ $item->id }}"
                                                                        id="changesMade" checked>
                                                                    <label class="form-check-label" for="changesMade">
                                                                        {{ $item->role_name }}
                                                                    </label>
                                                                </div>
                                                            @endif
                                                        @else
                                                            @if ($item->role_code != 'ADM')
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        name="role_id[]" value="{{ $item->id }}"
                                                                        id="changesMade">
                                                                    <label class="form-check-label" for="changesMade">
                                                                        {{ $item->role_name }}
                                                                    </label>
                                                                </div>
                                                            @endif
                                                        @endif
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>

                                        @if (in_array('ADM', $checkRole))
                                            <div class="text-center">
                                                <button type="submit" class="btn btn-primary">Save Changes</button>
                                            </div>
                                        @endif
                                    </form><!-- End settings Form -->

                                </div>

                                <div class="tab-pane fade pt-3" id="profile-change-password">
                                    <!-- Change Password Form -->
                                    <form action="{{ route('user.changeAccount', $user->id) }}" method="post">
                                        {{ csrf_field() }}
                                        <div class="row mb-3">
                                            <label for="username"
                                                class="col-md-4 col-lg-3 col-form-label">Username</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="username" type="text" class="form-control"
                                                    value="{{ $user->username }}" id="username" required>
                                            </div>
                                        </div>

                                        @if (in_array('ADM', $checkRole) != true)
                                            <div class="row mb-3">
                                                <label for="currentPassword"
                                                    class="col-md-4 col-lg-3 col-form-label">Current
                                                    Password</label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input name="password" type="password" class="form-control"
                                                        id="currentPassword" required>
                                                </div>
                                            </div>
                                        @endif

                                        <div class="row mb-3">
                                            <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New
                                                Password</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="newpassword" type="password" class="form-control"
                                                    id="newPassword" required>
                                            </div>
                                        </div>

                                        @if (in_array('ADM', $checkRole) != true)
                                            <div class="row mb-3">
                                                <label for="renewPassword"
                                                    class="col-md-4 col-lg-3 col-form-label">Re-enter
                                                    New Password</label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input name="renewpassword" type="password" class="form-control"
                                                        id="renewPassword" required>
                                                </div>
                                            </div>
                                        @endif

                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">Change Password</button>
                                        </div>
                                    </form><!-- End Change Password Form -->

                                </div>

                            </div><!-- End Bordered Tabs -->

                        </div>
                    </div>

                </div>
            </div>
        </section>

    </main><!-- End #main -->

    <!-- Modal -->
    <form action="{{ route('user.updateFotoProfile', $user->id) }}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Pilih Foto Profile</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="file" name="foto_profile" class="form-control" accept=".jpg, .png" required>
                        <div>
                            <small id="exampleFormControlFile1" class="text-primary"><br>
                                Pastikan file anda ( jpg, jpeg, png ) !
                            </small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-sm bi bi-upload"> Upload</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
