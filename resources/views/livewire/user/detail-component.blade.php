<div>
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-4">
                <div class="card border-0 shadow">
                    <div class="position-relative">
                        <img src="{{ asset('storage/' . $pustaka->gambar) }}" class="card-img-top"
                            alt="{{ $pustaka->judul_pustaka }}" style="height: 500px; object-fit: cover;">
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
                        <h2 class="card-title mb-4">Informasi Detail</h2>

                        <div class="row mb-4">
                            <div class="col-md-3">
                                <div class="card bg-primary text-white">
                                    <div class="card-body text-center">
                                        <i class="bi bi-boxes fs-3 mb-2"></i>
                                        <h6 class="fw-bold">Stock Tersedia</h6>
                                        <p class="h4 mb-0">{{ $pustaka->stock }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card bg-info text-white">
                                    <div class="card-body text-center">
                                        <i class="bi bi-book-half fs-3 mb-2"></i>
                                        <h6 class="fw-bold">Total Dipinjam</h6>
                                        <p class="h4 mb-0">{{ $pustaka->jml_pinjam }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card bg-success text-white">
                                    <div class="card-body text-center">
                                        <i class="bi bi-currency-dollar fs-3 mb-2"></i>
                                        <h6 class="fw-bold">Harga Buku</h6>
                                        <p class="h4 mb-0">Rp. {{ number_format($pustaka->harga_buku, 0, ',', '.') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

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
                                <h6 class="fw-bold">Keterangan Tambahan</h6>
                                <p class="text-muted">{{ $pustaka->keterangan_tambahan ?: 'Tidak ada keterangan' }}</p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="fw-bold">Kondisi Buku</h6>
                                <p class="text-muted">{{ $pustaka->kondisi_buku ?: 'Tidak ada keterangan' }}</p>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-12">
                                <h6 class="fw-bold">Keterangan Fisik</h6>
                                <p class="text-muted">{{ $pustaka->keterangan_fisik ?: 'Tidak ada keterangan' }}</p>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="card bg-light">
                                    <div class="card-body">
                                        <h6 class="fw-bold">Denda Terlambat</h6>
                                        <p class="text-muted mb-0">Rp.
                                            {{ number_format($pustaka->denda_terlambat, 0, ',', '.') }}/hari</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
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
                            <a class="btn btn-secondary me-2" href="{{ route('user') }}">Kembali</a>
                            <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#pinjam">Pinjam
                                Buku</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="pinjam" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Form Peminjaman Buku</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <!-- Hidden input untuk pustaka_id -->
                        <input type="hidden" wire:model="pustaka_id" value="{{ $pustaka->id }}">
    
                        <div class="form-group mb-3">
                            <label class="form-label">Judul Buku</label>
                            <input type="text" class="form-control" value="{{ $pustaka->judul_pustaka }}" disabled>
                        </div>
    
                        <div class="form-group mb-3">
                            <label class="form-label">Anggota</label>
                            <select class="form-control" wire:model="anggota_id">
                                <option value="">-- Pilih Anggota --</option>
                                @foreach ($anggota as $data)
                                    <option value="{{ $data->id }}">{{ $data->nama_anggota }}</option>
                                @endforeach
                            </select>
                            @error('anggota_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
    
                        <div class="form-group mb-3">
                            <label class="form-label">Tanggal Pengembalian</label>
                            <input type="date" class="form-control" wire:model="tgl_pengembalian">
                            @error('tgl_pengembalian')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
    
                        <div class="form-group">
                            <label>Fp</label>
                            <div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="fp" id="fa0"
                                        value="0" wire:model="fp">
                                    <label class="form-check-label" for="fa0">0</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="fp" id="fa1"
                                        value="1" wire:model="fp">
                                    <label class="form-check-label" for="fa1">1</label>
                                </div>
                            </div>
                            @error('fp')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
    
                        <div class="form-group mb-3">
                            <label class="form-label">Keterangan</label>
                            <textarea class="form-control" wire:model="keterangan" rows="3"></textarea>
                            @error('keterangan')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary" wire:click="store">Simpan Peminjaman</button>
                </div>
            </div>
        </div>
    </div>
</div>
