<ul class="navbar-nav ms-auto"><!--begin::Navbar Search-->
                    <li class="nav-item dropdown user-menu"><a href="#" class="nav-link dropdown-toggle"
                            data-bs-toggle="dropdown"><img src="{{ Auth::user()->avatar }}"
                                class="user-image rounded-circle shadow" onerror="this.onerror=null;this.src='{{ URL('/altprofile/tutwuri.png') }}';"><span
                                class="d-none d-md-inline"><?php echo Auth::user()->nama_pt; ?></span></a>
                        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end"><!--begin::User Image-->
                            <li class="user-header text-bg-primary"><img
                                    src="{{ Auth::user()->avatar }}"
                                    onerror="this.onerror=null;this.src='{{ URL('/altprofile/tutwuri.png') }}';"
                                    class="rounded-circle shadow">
                                <p>
                                    <?php echo Auth::user()->nama_pt; ?>
                                    <small>Member since <?php echo date('M. Y', strtotime(Auth::user()->date_added)); ?></small>
                                </p>
                            <li class="user-footer">    
                                <a href="{{ route('profile', ['id_userx' => Auth::user()->id_userx]) }}" class="btn btn-default btn-flat">Profile</a>
                                <a href="/logout" class="btn btn-default btn-flat float-end">Sign out</a></li>
                            <!--end::Menu Footer-->
                        </ul>
                    </li><!--end::User Menu Dropdown-->
                </ul><!--end::End Navbar Links-->