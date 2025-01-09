<nav class="col-md-2 bg-dark sidebar">
    <div class="sidebar-sticky">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active text-white" href="{{ route('home') }}">
                    <i class="fa-solid fa-house fa-lg me-2"></i>
                    Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="{{ route('rak') }}">
                    <i class="fa-solid fa-book-open"></i>
                    Kelola Rak Buku
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="{{ route('anggota') }}">
                    <i class="fa-solid fa-user-plus fa-lg me-2"></i>
                    Kelola Anggota
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="{{ route('jenis_anggota') }}">
                    <i class="fa-solid fa-user fa-lg me-2"></i>
                    Kelola Jenis Anggota
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="{{ route('perpus') }}">
                    <i class="fa-solid fa-book-atlas fa-lg me-2"></i>
                    Kelola Perpustakaan
                </a>
            </li>
        </ul>
    </div>
</nav>
