<div>
    <div class="card">
        <div class="card-header">
            Kelola Penerbit Buku
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
                            <th style="white-space: nowrap;" scope="col">Kode Penerbit Buku</th>
                            <th style="white-space: nowrap;" scope="col">Nama Penerbit</th>
                            <th style="white-space: nowrap;" scope="col">Alamat Penerbit</th>
                            <th style="white-space: nowrap;" scope="col">No Telp</th>
                            <th style="white-space: nowrap;" scope="col">Email</th>
                            <th style="white-space: nowrap;" scope="col">Fax</th>
                            <th style="white-space: nowrap;" scope="col">Website</th>
                            <th style="white-space: nowrap;" scope="col">kontak</th>
                            <th style="white-space: nowrap;" scope="col">Proses</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($penerbit->isEmpty())
                            <tr>
                                <td colspan="10" class="text-center">Data belum dimasukkan</td>
                            </tr>
                        @else
                            @foreach ($penerbit as $data)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $data->kode_penerbit }}</td>
                                    <td>{{ $data->nama_penerbit }}</td>
                                    <td>{{ $data->alamat_penerbit }}</td>
                                    <td>{{ $data->no_telp }}</td>
                                    <td>{{ $data->email }}</td>
                                    <td>{{ $data->fax }}</td>
                                    <td>{{ $data->website }}</td>
                                    <td>{{ $data->kontak }}</td>
                                    <td class="proses">
                                        <div class="btn-group" role="group" aria-label="Proses Buttons">
                                            <button type="button" wire:click="edit({{ $data->id }})"
                                                class="btn btn-sm btn-info mr-2" data-bs-toggle="modal"
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
            <a href="#" class="btn btn-md btn-primary mt-3" data-bs-toggle="modal"
                data-bs-target="#addpage">Tambah</a>
        </div>
    </div>

    {{-- Tambah --}}
    <div wire:ignore.self class="modal fade" id="addpage" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Penerbit Buku</h5>
                    <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">

                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form>
                        <div class="form-group">
                            <label>Kode Penerbit</label>
                            <input type="text" class="form-control" wire:model="kode_penerbit" maxlength="10"
                                value="{{ @old('kode_penerbit') }}">
                            @error('kode_penerbit')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Nama Penerbit</label>
                            <input type="text" class="form-control" wire:model="nama_penerbit"
                                value="{{ @old('nama_penerbit') }}">
                            @error('nama_penerbit')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Alamat Penerbit</label>
                            <textarea class="form-control" wire:model="alamat_penerbit" rows="3">{{ @old('alamat_penerbit') }}</textarea>
                            @error('alamat_penerbit')
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
                            <input type="email" class="form-control" wire:model="email" value="{{ @old('email') }}">
                            @error('email')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Fax</label>
                            <input type="tel" class="form-control" wire:model="fax" pattern="[0-9\s\-\+\(\)]*"
                                maxlength="15" value="{{ @old('fax') }}">
                            @error('fax')
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
                            <label>Kontak</label>
                            <input type="text" class="form-control" wire:model="kontak"
                                value="{{ @old('kontak') }}">
                            @error('kontak')
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
                            <label>Kode Penerbit</label>
                            <input type="text" class="form-control" wire:model="kode_penerbit" maxlength="10"
                                value="{{ @old('kode_penerbit') }}">
                            @error('kode_penerbit')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Nama Penerbit</label>
                            <input type="text" class="form-control" wire:model="nama_penerbit"
                                value="{{ @old('nama_penerbit') }}">
                            @error('nama_penerbit')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Alamat Penerbit</label>
                            <textarea class="form-control" wire:model="alamat_penerbit" rows="3">{{ @old('alamat_penerbit') }}</textarea>
                            @error('alamat_penerbit')
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
                            <label>Fax</label>
                            <input type="tel" class="form-control" wire:model="fax" pattern="[0-9\s\-\+\(\)]*"
                                maxlength="15" value="{{ @old('fax') }}">
                            @error('fax')
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
                            <label>Kontak</label>
                            <input type="text" class="form-control" wire:model="kontak"
                                value="{{ @old('kontak') }}">
                            @error('kontak')
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
