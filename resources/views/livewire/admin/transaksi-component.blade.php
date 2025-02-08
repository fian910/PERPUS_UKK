@section('breadcrumb')
    Halaman
@endsection

@section('breadcrumb-active')
    Manajemen Katalog
@endsection

@section('page-title')
    Kelola Transaksi
@endsection


<div>
    <div class="card">
        <div class="card-header pb-0 d-flex justify-content-between align-items-center">
            <h6>Kelola Transaksi</h6>
        </div>
        <div class="card-body">
            @if (@session()->has('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            <div class="card-body px-0 pb-2">
                <div class="table-responsive">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">No.</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Pustaka</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Anggota</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Tanggal Pinjam</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Tanggal Kembali</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Tanggal Pengembalian</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Status</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Status Buku</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Denda</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Keterangan</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($transaksi->isEmpty())
                                <tr>
                                    <td colspan="11" class="text-center py-4">Data belum dimasukkan</td>
                                </tr>
                            @else
                                @foreach ($transaksi as $data)
                                    <tr>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0 ps-3">{{ $loop->iteration }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $data->pustaka->judul_pustaka }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $data->anggota->nama_anggota }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $data->tgl_pinjam }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $data->tgl_kembali }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $data->tgl_pengembalian }}</p>
                                        </td>
                                        <td>
                                            @if ($data->fp === '0')
                                                <span class="badge bg-warning text-white">Dipinjam</span>
                                            @elseif($data->fp === '1')
                                                <span class="badge bg-success text-white">Dikembalikan</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($data->sb === '0')
                                                <span class="badge bg-warning text-white">Baik</span>
                                            @elseif($data->sb === '1')
                                                <span class="badge bg-success text-white">Rusak</span>
                                            @elseif($data->sb === '2')
                                                <span class="badge bg-danger text-white">Hilang</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex flex-column">
                                                <span class="text-xs font-weight-bold mb-0">Rp. {{ number_format($data->denda, 0, ',', '.') }}</span>
                                                @if ($data->denda > 0)
                                                    @if ($data->denda_dibayar)
                                                        <span class="badge bg-success mt-1">Lunas</span>
                                                    @else
                                                        <span class="badge bg-warning mt-1">Belum Lunas</span>
                                                        <button type="button" wire:click="showPaymentConfirmation({{ $data->id }})"
                                                            class="btn btn-sm btn-info mt-1" data-bs-toggle="modal"
                                                            data-bs-target="#paymentModal">
                                                            Konfirmasi Pembayaran
                                                        </button>
                                                    @endif
                                                @endif
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $data->keterangan }}</p>
                                        </td>
                                        <td>
                                            <div class="d-flex flex-column gap-2">
                                                @if ($data->fp === '0' && $data->pengajuan_kembali)
                                                    <button type="button" wire:click="approve({{ $data->id }})"
                                                        class="btn btn-sm btn-success">
                                                        Konfirmasi
                                                    </button>
                                                @endif
                                                <button type="button" wire:click="edit({{ $data->id }})"
                                                    class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                                    data-bs-target="#editpage">
                                                    Ubah
                                                </button>
                                                <button type="button" wire:click="confirm({{ $data->id }})"
                                                    class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                                    data-bs-target="#deletepage">
                                                    Hapus
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                    {{ $transaksi->links() }}
                </div>
                <a href="#" class="btn btn-info mt-3" data-bs-toggle="modal" data-bs-target="#addpage">Tambah</a>
            </div>
        </div>
    </div>

    {{-- Konfirmasi Pembayaran Denda --}}
    <div wire:ignore.self class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="paymentModalLabel">Konfirmasi Pembayaran Denda</h5>
                    <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin denda telah dibayar oleh anggota?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" wire:click="confirmPayment({{ $selectedTransactionId }})"
                        class="btn btn-primary">
                        Konfirmasi Pembayaran
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- Tambah --}}
    <div wire:ignore.self class="modal fade" id="addpage" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Transaksi</h5>
                    <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form>
                        <div class="form-group">
                            <label>Pustaka</label>
                            <select class="form-control" wire:model="pustaka_id">
                                <option value="">-- Pilih Pustaka --</option>
                                @foreach ($pustaka as $data)
                                    <option value="{{ $data->id }}" {{ $data->stock <= 0 ? 'disabled' : '' }}>
                                        {{ $data->judul_pustaka }} (Stok: {{ $data->stock }})
                                    </option>
                                @endforeach
                            </select>
                            @error('pustaka_id')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Anggota</label>
                            <select class="form-control" wire:model="anggota_id">
                                <option value="">-- Pilih Anggota --</option>
                                @foreach ($anggota as $data)
                                    <option value="{{ $data->id }}">{{ $data->nama_anggota }}</option>
                                @endforeach
                            </select>
                            @error('anggota_id')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Tanggal Pengembalian</label>
                            <input type="date" class="form-control" wire:model="tgl_pengembalian">
                            @error('tgl_pengembalian')
                                <small class="form-text text-danger">{{ $message }}</small>
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

                        <div class="form-group">
                            <label>Status Buku</label>
                            <div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="sb" id="fa0"
                                        value="0" wire:model="sb">
                                    <label class="form-check-label" for="fa0">0</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="sb" id="fa1"
                                        value="1" wire:model="sb">
                                    <label class="form-check-label" for="fa1">1</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="sb" id="fa2"
                                        value="2" wire:model="sb">
                                    <label class="form-check-label" for="fa2">2</label>
                                </div>
                            </div>
                            @error('sb')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Keterangan</label>
                            <textarea class="form-control" wire:model="keterangan"></textarea>
                            @error('keterangan')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="button" wire:click="store" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Edit --}}
    <div wire:ignore.self class="modal fade" id="editpage" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ubah Transaksi</h5>
                    <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">

                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form>
                        <div class="form-group">
                            <label>Pustaka</label>
                            <select class="form-control" wire:model="pustaka_id">
                                <option value="">-- Pilih Pustaka --</option>
                                @foreach ($pustaka as $data)
                                    <option value="{{ $data->id }}" {{ $data->stock <= 0 ? 'disabled' : '' }}>
                                        {{ $data->judul_pustaka }} (Stok: {{ $data->stock }})
                                    </option>
                                @endforeach
                            </select>
                            @error('pustaka_id')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Anggota</label>
                            <select class="form-control" wire:model="anggota_id">
                                <option value="">-- Pilih Anggota --</option>
                                @foreach ($anggota as $data)
                                    <option value="{{ $data->id }}"
                                        {{ old('anggota_id') == $data->id ? 'selected' : '' }}>
                                        {{ $data->nama_anggota }}</option>
                                @endforeach
                            </select>
                            @error('anggota_id')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Tanggal Pengembalian</label>
                            <input type="date" class="form-control" wire:model="tgl_pengembalian">
                            @error('tgl_pengembalian')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Fp</label>
                            <div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="fp" id="fa0"
                                        value="0" wire:model="fp" {{ old('fp') == '0' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="fa0">0</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="fp" id="fa1"
                                        value="1" wire:model="fp" {{ old('fp') == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="fa1">1</label>
                                </div>
                            </div>
                            @error('fp')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Status Buku</label>
                            <div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="sb" id="fa0"
                                        value="0" wire:model="sb" {{ old('sb') == '0' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="fa0">0</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="sb" id="fa1"
                                        value="1" wire:model="sb" {{ old('sb') == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="fa1">1</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="sb" id="fa2"
                                        value="2" wire:model="sb" {{ old('sb') == '2' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="fa2">2</label>
                                </div>
                            </div>
                            @error('sb')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Keterangan</label>
                            <textarea class="form-control" wire:model="keterangan">{{ old('keterangan') }}</textarea>
                            @error('keterangan')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="button" wire:click="update" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </div>

    <div wire:ignore.self class="modal fade" id="deletepage" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus Transaksi</h5>
                    <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">

                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Yakin Mau Hapus Data?</p>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="button" wire:click="destroy" class="btn btn-primary"
                        data-bs-dismiss="modal">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</div>
