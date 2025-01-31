<div>
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-4">
                <div class="card border-0 shadow">
                    <div class="position-relative">
                        <img src="{{ asset('storage/' . $pustaka->gambar) }}" class="card-img-top"
                            alt="{{ $pustaka->judul_pustaka }}" style="height: 400px; object-fit: cover;">
                        <span class="badge bg-primary position-absolute top-0 end-0 m-3">
                            {{ $pustaka->tahun_terbit }}
                        </span>
                        <span class="badge bg-secondary position-absolute top-0 start-0 m-3">
                            {{ $pustaka->format->format }}
                        </span>
                    </div>
                    <div class="card-body">
                        <h4 class="card-title fw-bold mb-3">{{ $pustaka->judul_pustaka }}</h4>
                        <div class="info-list">
                            <div class="d-flex align-items-center mb-2">
                                <i class="bi bi-person-fill me-2 text-primary"></i>
                                <span>{{ $pustaka->pengarang->nama_pengarang }}</span>
                            </div>
                            <div class="d-flex align-items-center mb-2">
                                <i class="bi bi-building me-2 text-primary"></i>
                                <span>{{ $pustaka->penerbit->nama_penerbit }}</span>
                            </div>
                            <div class="d-flex align-items-center mb-2">
                                <i class="bi bi-book me-2 text-primary"></i>
                                <span>ISBN: {{ $pustaka->isbn }}</span>
                            </div>
                            <div class="d-flex align-items-center mb-2">
                                <i class="bi bi-folder me-2 text-primary"></i>
                                <span>DDC: {{ $pustaka->ddc->kode_ddc }} - {{ $pustaka->ddc->ddc }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="card border-0 shadow">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Informasi Detail</h5>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <h6 class="fw-bold">Abstraksi</h6>
                                <p class="text-muted">{{ $pustaka->abstraksi ?: 'Tidak ada abstraksi' }}</p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="fw-bold">Kata Kunci</h6>
                                <p class="text-muted">{{ $pustaka->keyword ?: 'Tidak ada kata kunci' }}</p>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <h6 class="fw-bold">Keterangan Fisik</h6>
                                <p class="text-muted">{{ $pustaka->keterangan_fisik ?: 'Tidak ada keterangan' }}</p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="fw-bold">Kondisi Buku</h6>
                                <p class="text-muted">{{ $pustaka->kondisi_buku ?: 'Tidak ada keterangan' }}</p>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <h6 class="fw-bold">Keterangan Tambahan</h6>
                                <p class="text-muted">{{ $pustaka->keterangan_tambahan ?: 'Tidak ada keterangan' }}</p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="fw-bold">Jumlah Peminjaman</h6>
                                <p class="text-muted">{{ $pustaka->jml_pinjam }} kali</p>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-4">
                                <div class="card bg-light">
                                    <div class="card-body">
                                        <h6 class="fw-bold">Harga Buku</h6>
                                        <p class="text-muted mb-0">Rp.
                                            {{ number_format($pustaka->harga_buku, 0, ',', '.') }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card bg-light">
                                    <div class="card-body">
                                        <h6 class="fw-bold">Denda Terlambat</h6>
                                        <p class="text-muted mb-0">Rp.
                                            {{ number_format($pustaka->denda_terlambat, 0, ',', '.') }}/hari</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card bg-light">
                                    <div class="card-body">
                                        <h6 class="fw-bold">Denda Hilang</h6>
                                        <p class="text-muted mb-0">Rp.
                                            {{ number_format($pustaka->denda_hilang, 0, ',', '.') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <a class="btn btn-secondary me-2" href="{{route('user')}}">Kembali</a>
                            <a class="btn btn-primary">Pinjam Buku</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
