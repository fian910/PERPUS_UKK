<div>
    <div class="card">
        <div class="card-header">
            Kelola Transaksi
        </div>
        <div class="card-body">
            @if (@session()->has('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            <div class="d-flex justify-content-end mb-3">
                <input type="text" wire:model.live="cari" class="form-control w-30" placeholder="Cari Perpustakaan...">
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover align-items-center mb-0">
                    <thead>
                        <tr>
                            <th style="white-space: nowrap;" scope="col">No.</th>
                            <th style="white-space: nowrap;" scope="col">Pustaka</th>
                            <th style="white-space: nowrap;" scope="col">Anggota</th>
                            <th style="white-space: nowrap;" scope="col">Tanggal Pinjam</th>
                            <th style="white-space: nowrap;" scope="col">Tanggal Kembali</th>
                            <th style="white-space: nowrap;" scope="col">Tanggal Pengembalian</th>
                            <th style="white-space: nowrap;" scope="col">Fp</th>
                            <th style="white-space: nowrap;" scope="col">Keterangan</th>
                            <th style="white-space: nowrap;" scope="col">Proses</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($transaksi->isEmpty())
                            <tr>
                                <td colspan="21" class="text-center">Data belum dimasukkan</td>
                            </tr>
                        @else
                            @foreach ($transaksi as $data)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $data->pustaka->judul_pustaka }}</td>
                                    <td>{{ $data->anggota->nama_anggota }}</td>
                                    <td>{{ $data->tgl_pinjam }}</td>
                                    <td>{{ $data->tgl_kembali }}</td>
                                    <td>{{ $data->tgl_pengembalian }}</td>
                                    <td>{{ $data->fp }}</td>
                                    <td>{{ $data->keterangan }}</td>
                                    <td class="proses">
                                        <div class="btn-group" role="group" aria-label="Proses Buttons">
                                            <button type="button" wire:click="edit({{ $data->id }})"
                                                class="btn btn-sm btn-warning me-2" data-bs-toggle="modal"
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
                                    <option value="{{ $data->id }}">{{ $data->judul_pustaka }}</option>
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
                            <label>Tanggal Pinjam</label>
                            <input type="number" class="form-control" wire:model="tgl_pinjam" min="1900"
                                max="{{ date('Y') }}">
                            @error('tgl_pinjam')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Tanggal Kembali</label>
                            <input type="text" class="form-control" wire:model="tgl_kembali">
                            @error('tgl_kembali')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Tanggal Pengembalian</label>
                            <textarea class="form-control" wire:model="tgl_pengembalian"></textarea>
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
                            <label>Keterangan</label>
                            <textarea class="form-control" wire:model="keterangan"></textarea>
                            @error('keterangan')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="button" wire:click="store" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </div>