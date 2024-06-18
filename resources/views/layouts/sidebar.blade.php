<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        @php
            $roleUser = [];
            $roles = auth()->user()->roles;
            foreach ($roles as $role) {
                array_push($roleUser, $role->role_code);
            }
        @endphp

        <li class="nav-item">
            <a @yield('dashboard-active') class="nav-link collapsed" href="{{ route('dashboard.index') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

        @if (in_array('PJS', $roleUser) || in_array('ADM', $roleUser) || in_array('IVN', $roleUser))
            <li class="nav-item">
                @if (in_array('PJS', $roleUser))
                    <a @yield('pendataan-sarpras-active') class="nav-link collapsed"
                        href="{{ route('pendataanSarpras.pendataan', 'prasarana') }}">
                    @else
                        <a @yield('pendataan-sarpras-active') class="nav-link collapsed" href="{{ route('pendataanSarpras.menu') }}">
                @endif
                <i class="bi bi-card-list"></i>
                <span>Pendataan Sarpras</span>
                </a>
            </li><!-- End Inventaris Nav -->
        @endif


        {{-- <li class="nav-item">
            <a @yield('pengadaan-barang-sarpras-active') class="nav-link collapsed" href="">
                <i class="bi bi-cart-plus"></i>
                <span>Pengadaan Barang Sarpras</span>
            </a>
        </li><!-- End Pengadaan Barang Sarpras Nav --> --}}

        @if (in_array('PJS', $roleUser) || in_array('ADM', $roleUser) || in_array('IVN', $roleUser))
            <li class="nav-item">
                <a @yield('pemeliharaan-sarpras-active') class="nav-link collapsed" href="{{ route('pemeliharaanSarpras.index') }}">
                    <i class="bi bi-tools"></i>
                    <span>Pemeliharaan Sarpras</span>
                </a>
            </li><!-- End Pemeliharaan Sarpras Nav -->
        @endif

        {{-- <li class="nav-item">
            <a @yield('mutasi-barang-active') class="nav-link collapsed" href="">
                <i class="bi bi-arrow-left-right"></i>
                <span>Mutasi Barang</span>
            </a>
        </li><!-- End Mutasi Barang Nav --> --}}

        {{-- <li class="nav-item">
            <a @yield('penghapusan-sarpras-active') class="nav-link collapsed" href="">
                <i class="bi bi-trash"></i>
                <span>Penghapusan Sarpras</span>
            </a>
        </li><!-- End Penghapusan Sarpras Nav --> --}}

        @if (in_array('ADM', $roleUser) || in_array('LPM', $roleUser))
            <li class="nav-item">
                <a @yield('monev-sarpras-active') class="nav-link collapsed" href="{{ route('monev.index') }}">
                    <i class="bi bi-display"></i>
                    <span>Monev Sarpras</span>
                </a>
            </li><!-- End Pemeliharaan Sarpras Nav -->
        @endauth

        @if (in_array('ADM', $roleUser) || in_array('IVN', $roleUser))
            {{-- <li class="nav-item">
                <a @yield('hidden-collapsed-master-data') class="nav-link collapsed" data-bs-target="#components-nav"
                    data-bs-toggle="collapse" href="#">
                    <i class="bi bi-menu-button-wide"></i><span>Master Data</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="components-nav" class="nav-content collapse @yield('show-master-data')"
                    data-bs-parent="#sidebar-nav">
                    @if (in_array('IVN', $roleUser) || in_array('ADM', $roleUser))
                        <li>
                            <a href="{{ route('masterDataRuangan.index') }}" @yield('ruangan-active')>
                                <i class="bi bi-circle"></i><span>Lokasi Inventaris</span>
                            </a>
                        </li>
                    @endif
                    @if (in_array('ADM', $roleUser))
                        <li>
                            <a href="{{ route('masterDataProdi.index') }}" @yield('prodi-active')>
                                <i class="bi bi-circle"></i><span>Labor</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('masterDataFakultas.index') }}" @yield('fakultas-active')>
                                <i class="bi bi-circle"></i><span>Fakultas</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('masterDataProdi.index') }}" @yield('prodi-active')>
                                <i class="bi bi-circle"></i><span>Prodi</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('masterDataDosen.index') }}" @yield('dosen-active')>
                                <i class="bi bi-circle"></i><span>Dosen</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('masterDataMahasiswa.index') }}" @yield('mahasiswa-active')>
                                <i class="bi bi-circle"></i><span>Mahasiswa</span>
                            </a>
                        </li>
                    @endif
                </ul>
            </li><!-- End Components Nav --> --}}

            {{-- <li class="nav-item">
                <a @yield('penghapusan-sarpras-active') class="nav-link collapsed" href="">
                    <i class="bi bi-person-workspace"></i>
                    <span>Penanggung Jawab</span>
                </a>
            </li><!-- End Penghapusan Sarpras Nav --> --}}

            @if (in_array('ADM', $roleUser))
                <li class="nav-item">
                    <a @yield('penanggung-jawab-sarpras-active') class="nav-link collapsed" href="{{ route('pjsarpras.index') }}">
                        <i class="bi bi-person-workspace"></i>
                        <span>Penanggung Jawab Sarpras</span>
                    </a>
                </li><!-- End Pemeliharaan Sarpras Nav -->
                <li class="nav-item">
                    <a @yield('user-active') class="nav-link collapsed" href="{{ route('user.index') }}">
                        <i class="bi bi-person"></i>
                        <span>Akun User</span>
                    </a>
                </li><!-- End Profile Page Nav -->
            @endif
        @endif


</ul>

</aside>
