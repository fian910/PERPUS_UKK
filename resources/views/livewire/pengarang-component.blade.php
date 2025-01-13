<div>
    <div class="card">
        <div class="card-header">
            Kelola Pengarang Buku
        </div>
        <div class="card-body">
            @if (@session()->has('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover align-items-center mb-0">
                    <thead>
                        <tr>
                            <th style="white-space: nowrap;" scope="col">No.</th>
                            <th style="white-space: nowrap;" scope="col">Kode Pengarang Buku</th>
                            <th style="white-space: nowrap;" scope="col">Gelar Depan</th>
                            <th style="white-space: nowrap;" scope="col">Nama Pengarang</th>
                            <th style="white-space: nowrap;" scope="col">Gelar Belakang</th>
                            <th style="white-space: nowrap;" scope="col">No Telp</th>
                            <th style="white-space: nowrap;" scope="col">Email</th>
                            <th style="white-space: nowrap;" scope="col">Website</th>
                            <th style="white-space: nowrap;" scope="col">Biografi</th>
                            <th style="white-space: nowrap;" scope="col">Keterangan</th>
                            <th style="white-space: nowrap;" scope="col">Proses</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($pengarang->isEmpty())
                            <tr>
                                <td colspan="10" class="text-center">Data belum dimasukkan</td>
                            </tr>
                        @else
                            @foreach ($pengarang as $data)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $data->kode_pengarang }}</td>
                                    <td>{{ $data->gelar_depan }}</td>
                                    <td>{{ $data->nama_pengarang }}</td>
                                    <td>{{ $data->gelar_belakang }}</td>
                                    <td>{{ $data->no_telp }}</td>
                                    <td>{{ $data->email }}</td>
                                    <td>{{ $data->website }}</td>
                                    <td>{{ $data->biografi }}</td>
                                    <td>{{ $data->keterangan }}</td>
                                    <td class="proses">
                                        <div class="btn-group" role="group" aria-label="Proses Buttons">
                                            <button type="button" wire:click="edit({{ $data->id }})"
                                                class="btn btn-sm btn-warning me-2" data-bs-toggle="modal"
                                                data-bs-target="#editpage">Ubah</button>
                                            <button type="button" wire:click="confirm({{ $data->id }})"
                                                class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#deletepage">Hapus</button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
            <a href="#" class="btn btn-md btn-info mt-3" data-bs-toggle="modal"
                data-bs-target="#addpage">Tambah</a>
        </div>
    </div>

    {{-- Tambah --}}
    <div wire:ignore.self class="modal fade" id="addpage" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Pengarang Buku</h5>
                    <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">

                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form>
                        <div class="form-group">
                            <label>Kode Pengarang</label>
                            <input type="text" class="form-control" wire:model="kode_pengarang" maxlength="10"
                                value="{{ @old('kode_pengarang') }}">
                            @error('kode_pengarang')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Gelar Depan</label>
                            <input type="text" class="form-control" wire:model="gelar_depan"
                                value="{{ @old('gelar_depan') }}">
                            @error('gelar_depan')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Nama Pengarang</label>
                            <input type="text" class="form-control" wire:model="nama_pengarang"
                                value="{{ @old('nama_pengarang') }}">
                            @error('nama_pengarang')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Gelar Belakang</label>
                            <input type="text" class="form-control" wire:model="gelar_belakang"
                                value="{{ @old('gelar_belakang') }}">
                            @error('gelar_belakang')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>No Telp</label>
                            <input type="tel" class="form-control" wire:model="no_telp" pattern="[0-9\s\-\+\(\)]*"
                                maxlength="15" value="{{ @old('no_telp') }}">
                            @error('no_telp')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" wire:model="email"
                                value="{{ @old('email') }}">
                            @error('email')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Website</label>
                            <input type="url" class="form-control" wire:model="website" placeholder="https://"
                                value="{{ @old('website') }}">
                            @error('website')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Biografi</label>
                            <textarea class="form-control" wire:model="biografi" rows="4">{{ @old('biografi') }}</textarea>
                            @error('biografi')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Keterangan</label>
                            <textarea class="form-control" wire:model="keterangan" rows="3">{{ @old('keterangan') }}</textarea>
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
                    <h5 class="modal-title" id="exampleModalLabel">Ubah Penerbit Buku</h5>
                    <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">

                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form>
                        <div class="form-group">
                            <label>Kode Pengarang</label>
                            <input type="text" class="form-control" wire:model="kode_pengarang" maxlength="10"
                                value="{{ @old('kode_pengarang') }}">
                            @error('kode_pengarang')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Gelar Depan</label>
                            <input type="text" class="form-control" wire:model="gelar_depan"
                                value="{{ @old('gelar_depan') }}">
                            @error('gelar_depan')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Nama Pengarang</label>
                            <input type="text" class="form-control" wire:model="nama_pengarang"
                                value="{{ @old('nama_pengarang') }}">
                            @error('nama_pengarang')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Gelar Belakang</label>
                            <input type="text" class="form-control" wire:model="gelar_belakang"
                                value="{{ @old('gelar_belakang') }}">
                            @error('gelar_belakang')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>No Telp</label>
                            <input type="tel" class="form-control" wire:model="no_telp"
                                pattern="[0-9\s\-\+\(\)]*" maxlength="15" value="{{ @old('no_telp') }}">
                            @error('no_telp')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" wire:model="email"
                                value="{{ @old('email') }}">
                            @error('email')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Website</label>
                            <input type="url" class="form-control" wire:model="website" placeholder="https://"
                                value="{{ @old('website') }}">
                            @error('website')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Biografi</label>
                            <textarea class="form-control" wire:model="biografi" rows="4">{{ @old('biografi') }}</textarea>
                            @error('biografi')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Keterangan</label>
                            <textarea class="form-control" wire:model="keterangan" rows="3">{{ @old('keterangan') }}</textarea>
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

    {{-- Delete --}}
    <div wire:ignore.self class="modal fade" id="deletepage" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus Penerbit Buku</h5>
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
