<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <!--begin::Sidebar Brand-->
    <div class="sidebar-brand">
        <!--begin::Brand Link-->
        <a href="/home" class="brand-link">
            <!--begin::Brand Image-->
            <img src="{{ URL('/uploadLogo/Logo') }}?t=<?php echo time(); ?>" alt=""
                class="rounded-circle elevation-3 border-1"
                style="opacity: 0.8; width: 2.5rem; height: 2.5rem; max-height: unset;"
          php a      onerror="this.onerror=null;this.src='{{ URL('/altlogo/avatardikti.png') }}';">
            <span class="brand-text fw-light">LLDIKTI Wilayah VII</span><!--end::Brand Text-->
        </a><!--end::Brand Link-->
    </div>
    <!--end::Sidebar Brand-->
    <!--begin::Sidebar Wrapper-->
    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <!--begin::Sidebar Menu-->
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="/home" class="nav-link {{ Request::is('home') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-speedometer"></i>
                        <p>
                            Home
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/listbp" class="nav-link {{ Request::is('listbp') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-box-seam-fill"></i>
                        <p>
                            Badan Penyelenggara
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link {{ Request::is('listpts*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-clipboard-fill"></i>
                        <p>
                            Perguruan Tinggi
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/listpts" class="nav-link {{ Request::is('listpts') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-file-ruled text-success"></i>
                                <p>Rekap Data</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/listptsaktif" class="nav-link {{ Request::is('listptsaktif') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-card-list"></i>
                                <p>Perguruan Tinggi Aktif</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/listptsbermasalah" class="nav-link {{ Request::is('listptsbermasalah') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-card-list"></i>
                                <p>Perguruan Tinggi Bermasalah</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/listptstutup" class="nav-link {{ Request::is('listptstutup') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-card-list"></i>
                                <p>Perguruan Tinggi Tutup</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="/daftarpemimpin" class="nav-link {{ Request::is('daftarpemimpin') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-people-fill"></i>
                        <p>
                            Pemimpin PT
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link {{ Request::is('listdokung*') || Request::is('programbeasiswa*') || Request::is('listuser*') || Request::is('tentang-sistem*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-wrench"></i>
                        <p>
                            Pendukung
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/listdokung" class="nav-link {{ Request::is('listdokung') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-clipboard2-data"></i>
                                <p>List Dokumen</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/programbeasiswa" class="nav-link {{ Request::is('programbeasiswa') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-award"></i>
                                <p>Program Beasiswa</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/listlomba" class="nav-link {{ Request::is('listlomba') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-trophy"></i>
                                <p>Lomba</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/listuser" class="nav-link {{ Request::is('listuser') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-person"></i>
                                <p>Daftar User</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/tentang-sistem" class="nav-link {{ Request::is('tentang-sistem') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-info-circle"></i>
                                <p>Tentang Sistem</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!--end::Sidebar Menu-->
        </nav>
    </div>
    <!--end::Sidebar Wrapper-->
</aside>
<!--end::Sidebar-->
<!--begin::App Main-->
