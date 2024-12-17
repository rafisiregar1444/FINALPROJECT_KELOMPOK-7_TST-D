<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark"> <!--begin::Sidebar Brand-->
    <div class="sidebar-brand"> <!--begin::Brand Link--> 
        <a href="../index.html" class="brand-link"> <!--begin::Brand Image--> 
            <span class="brand-text fw-bold">My Ticket</span>
        </a>
    </div> 
    <div class="sidebar-wrapper">
        <nav class="mt-2"> <!--begin::Sidebar Menu-->
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="index.php" class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'index.php') ? 'active' : ''; ?>"> 
                        <i class="nav-icon bi bi-clipboard-fill"></i>
                        <p>Birthday Treats</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="index2.php" class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'index2.php' || basename($_SERVER['PHP_SELF']) == 'lakukanpenempatan.php') ? 'active' : ''; ?>"> 
                        <i class="nav-icon bi bi-pencil-square"></i>
                        <p>Tiket Spesial Lomba</p>
                    </a>
                </li>
            </ul> <!--end::Sidebar Menu-->
        </nav>
    </div> <!--end::Sidebar Wrapper-->
</aside> <!--end::Sidebar-->