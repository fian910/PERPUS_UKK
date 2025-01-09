<nav class="col-md-2 bg-dark sidebar">
    <div class="sidebar-sticky">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active text-white" href="{{ route('home') }}">
                    <span data-feather="home"></span>
                    Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="#members">
                    <span data-feather="users"></span>
                    Manage Members
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="#books">
                    <span data-feather="book"></span>
                    Manage Books
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="#loans">
                    <span data-feather="file"></span>
                    Manage Loans
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="{{ route('anggota')}}">
                    <span data-feather="users"></span>
                    Manage Returns
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="{{ route('jenis_anggota') }}">
                    <span data-feather="user"></span>
                    Kelola Jenis Anggota
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="{{ route('perpus') }}">
                    <span data-feather="bookmark"></span>
                    Kelola Perpustakaan
                </a>
            </li>
        </ul>
    </div>
</nav>
