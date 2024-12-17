<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark"><!--begin::Sidebar Brand-->
            <div class="sidebar-brand"><!--begin::Brand Link--><a href="/home"
                    class="brand-link"><!--begin::Brand Image--><img 
                    src="{{ URL('/uploadLogo/Logo') }}?t=<?php echo time(); ?>" alt="" 
                    class="rounded-circle elevation-3 border-1" 
                    style="opacity: 0.8; width: 2.5rem; height: 2.5rem; max-height: unset;"onerror="this.onerror=null;this.src='{{ URL('/altlogo/avatardikti.png') }}';">
                    <span class="brand-text fw-light">LLDIKTI Wilayah VII</span><!--end::Brand Text--></a><!--end::Brand Link--></div>
            <!--end::Sidebar Brand--><!--begin::Sidebar Wrapper-->
            <div class="sidebar-wrapper">
                <nav class="mt-2"><!--begin::Sidebar Menu-->
                    <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu"
                        data-accordion="false">
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
                            <a href="/listpts" class="nav-link {{ Request::is('listpts*') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-box-seam-fill"></i>
                                <p>
                                    Perguruan Tinggi
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="mahasiswa/listmahasiswa" class="nav-link {{ Request::is('mahasiswa*') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-box-seam-fill"></i>
                                <p>
                                    Mahasiswa
                                </p>
                            </a>
                        </li>
                    </ul><!--end::Sidebar Menu-->
                </nav>
            </div><!--end::Sidebar Wrapper-->
        </aside><!--end::Sidebar--><!--begin::App Main-->