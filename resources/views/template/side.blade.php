<!-- Sidebar Menu -->
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    
        <li class="nav-item active">
            <a href="{!! route("show_page", ["role" => $_SESSION['role'], "pages" =>"dashboard" ]) !!}" class="nav-link {!! $r->pages =='dashboard'? 'active' :'' !!}">
                <i class="nav-icon fas fa-chart-pie"></i>
                <p>Dashboard</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{!! route("show_page", ["role" => $_SESSION['role'], "pages" =>"kriteria" ]) !!}" class="nav-link {!! $r->pages =='kriteria'? 'active' :'' !!}">
                <i class="nav-icon fas fa-th"></i>
                <p>Kriteria</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{!! route("show_page", ["role" => $_SESSION['role'], "pages" =>"nilai-crips" ]) !!}" class="nav-link {!! $r->pages =='nilai-crips'? 'active' :'' !!}">
                <i class="nav-icon fas fa-book"></i>
                <p>Nilai Crips</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{!! route("show_page", ["role" => $_SESSION['role'], "pages" =>"alternatif" ]) !!}" class="nav-link {!! $r->pages =='alternatif'? 'active' :'' !!}">
                <i class="nav-icon fas fa-users"></i>
                <p>Alternatif</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{!! route("show_page", ["role" => $_SESSION['role'], "pages" =>"nilai-alternatif" ]) !!}" class="nav-link {!! $r->pages =='nilai-alternatif'? 'active' :'' !!}">
                <i class="nav-icon fas fa-columns"></i>
                <p>Nilai Alternatif</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{!! route("show_page", ["role" => $_SESSION['role'], "pages" =>"perhitungan" ]) !!}" class="nav-link {!! $r->pages =='perhitungan'? 'active' :'' !!}">
                <i class="nav-icon fas fa-file"></i>
                <p>Perhitungan</p>
            </a>
        </li>
        <li class="nav-header">Action</li>
        <li class="nav-item">
            <a href="{{ route('logout') }}" class="nav-link">
                <i class="nav-icon fas fa-sign-out-alt"></i>
                <p>Logout</p>
            </a>
        </li>
    </ul>
</nav>
<!-- /.sidebar-menu -->
