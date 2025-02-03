<div>
    <header class="masthead">
        <div class="container position-relative">
            <div class="row justify-content-center">
                <div class="col-xl-6">
                    <div class="text-center text-white">
                        <!-- Page heading-->
                        <h1 class="mb-5">Mari Belajar Membaca Bersama-sama!</h1>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <section class="my-3 text-center">
        <div class="container py-5">
            <h2 class="mb-5 fs-2">List Buku Terbaru</h2>
            <div class="row">
                @if ($pustakas->count() > 0)
                    @foreach ($pustakas as $pustaka)
                        <div class="col-lg-4 mb-4">
                            <div class="card h-100 shadow border-0">
                                <div class="position-relative">
                                    <img src="{{ asset('storage/' . $pustaka->gambar) }}" class="card-img-top"
                                        alt="{{ $pustaka->judul_pustaka }}" style="height: 400px; object-fit: cover;">
                                    <span class="badge bg-primary position-absolute top-0 end-0 m-3">
                                        {{ $pustaka->tahun_terbit }}
                                    </span>
                                </div>
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title mb-3 fw-bold">{{ Str::limit($pustaka->judul_pustaka, 30) }}
                                    </h5>
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="bi bi-person me-2 text-muted"></i>
                                        <span class="text-muted">{{ $pustaka->pengarang->nama_pengarang }}</span>
                                    </div>
                                    <div class="d-flex align-items-center mb-3">
                                        <i class="bi bi-book me-2 text-muted"></i>
                                        <span class="text-muted">ISBN: {{ $pustaka->isbn }}</span>
                                    </div>
                                    <div class="mt-auto">
                                        <a href="{{ route('book.detail', ['id' => $pustaka->id]) }}"
                                            class="btn btn-primary w-100">
                                            <i class="bi bi-eye me-2"></i>
                                            Lihat Detail
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-12">
                        <div class="text-center py-5">
                            <i class="bi bi-book-half display-4 text-muted mb-4"></i>
                            <h2 class="mb-3 text-muted">Buku Sedang Tidak Tersedia</h2>
                            <p class="lead text-muted">Saat ini, tidak ada buku yang tersedia di perpustakaan.</p>
                            <p class="text-muted">Silakan periksa kembali nanti atau hubungi admin perpustakaan.</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>
</div>
