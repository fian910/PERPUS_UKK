<nav class="col-md-2 bg-dark sidebar">
    <div class="sidebar-sticky">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active text-white" href="{{ route('home') }}">
                    <i class="fa-solid fa-house me-2"></i>
                    Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="{{ route('pengarang') }}">
                    <i class="fa-solid fa-pen-nib me-2"></i>
                    Kelola Pengarang
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="{{ route('penerbit') }}">
                    <i class="fa-solid fa-tag me-2"></i>
                    Kelola Penerbit Buku
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="{{ route('rak') }}">
                    <i class="fa-solid fa-book-open me-2"></i>
                    Kelola Rak Buku
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="{{ route('format') }}">
                    <i class="fa-solid fa-paragraph me-2"></i>
                    Kelola Format Buku
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="{{ route('anggota') }}">
                    <i class="fa-solid fa-user-plus me-2"></i>
                    Kelola Anggota
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="{{ route('jenis_anggota') }}">
                    <i class="fa-solid fa-user me-2"></i>
                    Kelola Jenis Anggota
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="{{ route('perpus') }}">
                    <i class="fa-solid fa-book-atlas me-2"></i>
                    Kelola Perpustakaan
                </a>
            </li>
        </ul>
    </div>
</nav>
