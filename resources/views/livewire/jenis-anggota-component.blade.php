<div>
    <div class="card">
        <div class="card-header">
            Kelola Jenis Anggota
        </div>
        <div class="card-body">
            @if (@session()->has('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-stripped table-hover table-bordered">
                    <thead>
                        <tr>
                            <th style="white-space: nowrap;" scope="col">No.</th>
                            <th style="white-space: nowrap;" scope="col">Kode Jenis Anggota</th>
                            <th style="white-space: nowrap;" scope="col">Jenis Anggota</th>
                            <th style="white-space: nowrap;" scope="col">Batas Pinjam</th>
                            <th style="white-space: nowrap;" scope="col">Keterangan</th>
                            <th style="white-space: nowrap;" scope="col">Proses</th>

                        </tr>
                    </thead>
                    <tbody>
                        @if ($jenis_anggota->isEmpty())
                            <tr>
                                <td colspan="6" class="text-center">Data belum dimasukkan</td>
                            </tr>
                        @else
                            @foreach ($jenis_anggota as $data)
                                <tr>
                                    <td scope="row">{{ $loop->iteration }}</td>
                                    <td>{{ $data->kode_jenis_anggota }}</td>
                                    <td>{{ $data->jns_anggota }}</td>
                                    <td>{{ $data->max_pinjam }}</td>
                                    <td>{{ $data->keterangan }}</td>
                                    <td class="proses">
                                        <div class="btn-group" role="group" aria-label="Proses Buttons">
                                            <button type="button" wire:click="edit({{ $data->id }})"
                                                class="btn btn-sm btn-info mr-2" data-toggle="modal"
                                                data-target="#editjenisanggota">Ubah</button>
                                            <button type="button" wire:click="confirm({{ $data->id }})"
                                                class="btn btn-sm btn-danger" data-toggle="modal"
                                                data-target="#deletejenisanggota">Hapus</button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
            <a href="#" class="btn btn-md btn-primary mt-3" data-toggle="modal"
                data-target="#addjenisanggota">Tambah</a>
        </div>
    </div>

    {{-- Tambah --}}
    <div wire:ignore.self class="modal fade" id="addjenisanggota" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Jenis Anggota</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form>
                        <div class="form-group">
                            <label>Kode Jenis Aggota</label>
                            <input type="text" class="form-control" wire:model="kode_jenis_anggota" maxlength="10"
                                value="{{ @old('kode_jenis_anggota') }}">
                            @error('kode_jenis_anggota')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Jenis Anggota</label>
                            <input type="text" class="form-control" wire:model="jns_anggota"
                                value="{{ @old('jns_anggota') }}">
                            @error('jns_anggota')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Batas Pinjam</label>
                            <input type="text" class="form-control" wire:model="max_pinjam"
                                value="{{ @old('max_pinjam') }}">
                            @error('max_pinjam')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Keterangan</label>
                            <input type="text" class="form-control" wire:model="keterangan"
                                value="{{ @old('keterangan') }}">
                            @error('keterangan')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="button" wire:click="store" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Edit --}}
    <div wire:ignore.self class="modal fade" id="editjenisanggota" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ubah Jenis Anggota</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form>
                        <div class="form-group">
                            <label>Kode Jenis Anggota</label>
                            <input type="text" class="form-control" wire:model="kode_jenis_anggota" disabled
                                value="{{ @old('kode_jenis_anggota') }}">
                            @error('kode_jenis_anggota')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Jenis Anggota</label>
                            <input type="text" class="form-control" wire:model="jns_anggota"
                                value="{{ @old('jns_anggota') }}">
                            @error('jns_anggota')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Batas Pinjam</label>
                            <input type="text" class="form-control" wire:model="max_pinjam"
                                value="{{ @old('max_pinjam') }}">
                            @error('max_pinjam')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Keterangan</label>
                            <input type="text" class="form-control" wire:model="keterangan"
                                value="{{ @old('keterangan') }}">
                            @error('keterangan')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="button" wire:click="update" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Delete --}}
    <div wire:ignore.self class="modal fade" id="deletejenisanggota" tabindex="-1"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus Jenis Anggota</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Yakin Mau Hapus Data?</p>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="button" wire:click="destroy" class="btn btn-primary"
                        data-dismiss="modal">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</div>
