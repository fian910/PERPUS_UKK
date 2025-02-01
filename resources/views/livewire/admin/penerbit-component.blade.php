@section('breadcrumb')
    Halaman
@endsection

@section('breadcrumb-active')
    Manajemen Author
@endsection

@section('page-title')
    Kelola Penerbit
@endsection


<div>
    <div class="card">
        <div class="card-header pb-0 d-flex justify-content-between align-items-center">
            <h6>Kelola Penerbit</h6>
            <!-- Search bar -->
            <div class="ms-auto pe-md-3 d-flex align-items-center">
                <div class="input-group">
                    <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                    <input type="search" class="form-control search-input" wire:model.live="cari"
                        placeholder="Cari Penerbit...">
                </div>
            </div>
            <!-- End Search bar -->
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
                                <th style="white-space: nowrap;" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" scope="col">No.</th>
                                <th style="white-space: nowrap;" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" scope="col">Kode Penerbit Buku</th>
                                <th style="white-space: nowrap;" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" scope="col">Nama Penerbit</th>
                                <th style="white-space: nowrap;" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" scope="col">Alamat Penerbit</th>
                                <th style="white-space: nowrap;" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" scope="col">No Telp</th>
                                <th style="white-space: nowrap;" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" scope="col">Email</th>
                                <th style="white-space: nowrap;" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" scope="col">Fax</th>
                                <th style="white-space: nowrap;" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" scope="col">Website</th>
                                <th style="white-space: nowrap;" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" scope="col">kontak</th>
                                <th style="white-space: nowrap;" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" scope="col">Proses</th>
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
                                        <td scope="row" class="align-middle text-sm text-center">
                                            <span class="text-xs font-weight-bold">{{ $loop->iteration }}</span>
                                        </td>
                                        <td class="align-middle text-sm text-center">
                                            <span class="text-xs font-weight-bold">{{ $data->kode_penerbit }}</span>
                                        </td>
                                        <td class="align-middle text-sm text-center">
                                            <span class="text-xs font-weight-bold">{{ $data->nama_penerbit }}</span>
                                        </td>
                                        <td class="align-middle text-sm text-center">
                                            <span class="text-xs font-weight-bold">{{ $data->alamat_penerbit }}</span>
                                        </td>
                                        <td class="align-middle text-sm text-center">
                                            <span class="text-xs font-weight-bold">{{ $data->no_telp }}</span>
                                        </td>
                                        <td class="align-middle text-sm text-center">
                                            <span class="text-xs font-weight-bold">{{ $data->email }}</span>
                                        </td>
                                        <td class="align-middle text-sm text-center">
                                            <span class="text-xs font-weight-bold">{{ $data->fax }}</span>
                                        </td>
                                        <td class="align-middle text-sm text-center">
                                            <span class="text-xs font-weight-bold">{{ $data->website }}</span>
                                        </td>
                                        <td class="align-middle text-sm text-center">
                                            <span class="text-xs font-weight-bold">{{ $data->kontak }}</span>
                                        </td>
                                        
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
