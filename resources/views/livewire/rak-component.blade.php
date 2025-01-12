<div>
    <div class="card">
        <div class="card-header">
            Kelola Rak Buku
        </div>
        <div class="card-body">
            @if (@session()->has('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered">
                    <thead>
                        <tr>
                            <th style="white-space: nowrap;" scope="col">No.</th>
                            <th style="white-space: nowrap;" scope="col">Kode Rak Buku</th>
                            <th style="white-space: nowrap;" scope="col">Rak Buku</th>
                            <th style="white-space: nowrap;" scope="col">Keterangan</th>
                            <th style="white-space: nowrap;" scope="col">Proses</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($raks->isEmpty())
                            <tr>
                                <td colspan="5" class="text-center">Data belum dimasukkan</td>
                            </tr>
                        @else
                            @foreach ($raks as $data)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $data->kode_rak }}</td>
                                    <td>{{ $data->rak }}</td>
                                    <td>{{ $data->keterangan }}</td>
                                    <td class="proses">
                                        <div class="btn-group" role="group" aria-label="Proses Buttons">
                                            <button type="button" wire:click="edit({{ $data->id }})"
                                                class="btn btn-sm btn-info mr-2" data-toggle="modal"
                                                data-target="#editpage">Ubah</button>
                                            <button type="button" wire:click="confirm({{ $data->id }})"
                                                class="btn btn-sm btn-danger" data-toggle="modal"
                                                data-target="#deletepage">Hapus</button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
            <a href="#" class="btn btn-md btn-primary mt-3" data-toggle="modal" data-target="#addpage">Tambah</a>
        </div>
    </div>

    {{-- Tambah --}}
    <div wire:ignore.self class="modal fade" id="addpage" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Rak Buku</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form>
                        <div class="form-group">
                            <label>Kode Rak</label>
                            <input type="text" class="form-control" wire:model="kode_rak" maxlength="10"
                                value="{{ @old('kode_rak') }}">
                            @error('kode_rak')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Rak</label>
                            <input type="text" class="form-control" wire:model="rak" value="{{ @old('rak') }}">
                            @error('rak')
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
    <div wire:ignore.self class="modal fade" id="editpage" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ubah Rak Buku</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form>
                        <div class="form-group">
                            <label>Kode Rak Buku</label>
                            <input type="text" class="form-control" wire:model="kode_rak" disabled
                                value="{{ @old('kode_rak') }}">
                            @error('kode_rak')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Rak Buku</label>
                            <input type="text" class="form-control" wire:model="rak"
                                value="{{ @old('rak') }}">
                            @error('rak')
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
    <div wire:ignore.self class="modal fade" id="deletepage" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus Rak Buku</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Yakin Mau Hapus Data?</p>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="button" wire:click="destroy" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </div>
