@section('breadcrumb')
    Halaman
@endsection

@section('breadcrumb-active')
    Manajemen Perpustakaan
@endsection

@section('page-title')
    Kelola Perpus
@endsection

<div>
    <div class="card">
        <div class="card-header pb-0 d-flex justify-content-between align-items-center">
            <h6>Kelola Perpustakaan</h6>
            <!-- Search bar -->
            <div class="ms-auto pe-md-3 d-flex align-items-center">
                <div class="input-group">
                    <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                    <input type="search" class="form-control search-input" wire:model.live="cari"
                        placeholder="Cari Perpustakaan...">
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
                                <th style="white-space: nowrap;" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" scope="col">Perpustakaan</th>
                                <th style="white-space: nowrap;" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" scope="col">Pustakawan</th>
                                <th style="white-space: nowrap;" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" scope="col">Alamat</th>
                                <th style="white-space: nowrap;" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" scope="col">Email</th>
                                <th style="white-space: nowrap;" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" scope="col">Website</th>
                                <th style="white-space: nowrap;" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" scope="col">No Telp</th>
                                <th style="white-space: nowrap;" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" scope="col">Keterangan</th>
                                <th style="white-space: nowrap;" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" scope="col">Proses</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($perpustakaan->isEmpty())
                                <tr>
                                    <td colspan="9" class="text-center">Data belum dimasukkan</td>
                                </tr>
                            @else
                                @foreach ($perpustakaan as $data)
                                    <tr>
                                        <th scope="row" class="align-middle text-sm text-center">
                                            <span class="text-xs font-weight-bold">{{ $loop->iteration }}</span>
                                        </th>
                                        <td class="align-middle text-sm text-center">
                                            <span class="text-xs font-weight-bold">{{ $data->nama_perpustakaan }}</span>
                                        </td>
                                        <td class="align-middle text-sm text-center">
                                            <span class="text-xs font-weight-bold">{{ $data->nama_pustakawan }}</span>
                                        </td>
                                        <td class="align-middle text-sm text-center">
                                            <span class="text-xs font-weight-bold">{{ $data->alamat }}</span>
                                        </td>
                                        <td class="align-middle text-sm text-center">
                                            <span class="text-xs font-weight-bold">{{ $data->email }}</span>
                                        </td>
                                        <td class="align-middle text-sm text-center">
                                            <span class="text-xs font-weight-bold">{{ $data->website }}</span>
                                        </td>
                                        <td class="align-middle text-sm text-center">
                                            <span class="text-xs font-weight-bold">{{ $data->no_telp }}</span>
                                        </td>
                                        <td class="align-middle text-sm text-center">
                                            <span class="text-xs font-weight-bold">{{ $data->keterangan }}</span>
                                        </td>
                                        
                                        <td class="proses">
                                            <div class="btn-group" role="group" aria-label="Proses Buttons">
                                                <button type="button" wire:click="edit({{ $data->id }})"
                                                    class="btn btn-sm btn-warning me-2" data-bs-toggle="modal"
                                                    data-bs-target="#editperpus">Ubah</button>
                                                <button type="button" wire:click="confirm({{ $data->id }})"
                                                    class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                                    data-bs-target="#deleteperpus">Hapus</button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
                <a href="#" class="btn btn-md btn-info mt-3" data-bs-toggle="modal"
                    data-bs-target="#addperpus">Tambah</a>
            </div>
        </div>
    </div>

    {{-- Tambah --}}
    <div wire:ignore.self class="modal fade" id="addperpus" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Perpustakaan</h5>
                    <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">

                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form>
                        <div class="form-group">
                            <label>Nama Perpustakaan</label>
                            <input type="text" class="form-control" wire:model="nama_perpustakaan"
                                value="{{ @old('nama_perpustakaan') }}">
                            @error('nama_perpustakaan')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Nama Pustakawan</label>
                            <input type="text" class="form-control" wire:model="nama_pustakawan"
                                value="{{ @old('nama_pustakawan') }}">
                            @error('nama_pustakawan')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Alamat</label>
                            <textarea type="text" class="form-control" wire:model="alamat" cols="30" rows="10">{{ @old('alamat') }}</textarea>
                            @error('alamat')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" class="form-control" wire:model="email" value="{{ @old('email') }}">
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
                            <label>No Telp</label>
                            <input type="number" class="form-control" wire:model="no_telp"
                                value="{{ @old('no_telp') }}">
                            @error('no_telp')
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
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="button" wire:click="store" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Edit --}}
    <div wire:ignore.self class="modal fade" id="editperpus" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ubah Perpustakaan</h5>
                    <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">

                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form>
                        <div class="form-group">
                            <label>Nama Perpustakaan</label>
                            <input type="text" class="form-control" wire:model="nama_perpustakaan"
                                value="{{ @old('nama_perpustakaan') }}">
                            @error('nama_perpustakaan')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Nama Pustakawan</label>
                            <input type="text" class="form-control" wire:model="nama_pustakawan"
                                value="{{ @old('nama_pustakawan') }}">
                            @error('nama_pustakawan')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Alamat</label>
                            <input type="text" class="form-control" wire:model="alamat"
                                value="{{ @old('alamat') }}">
                            @error('alamat')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" class="form-control" wire:model="email"
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
                            <label>No Telp</label>
                            <input type="number" class="form-control" wire:model="no_telp"
                                value="{{ @old('no_telp') }}">
                            @error('no_telp')
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
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="button" wire:click="update" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Delete --}}
    <div wire:ignore.self class="modal fade" id="deleteperpus" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus Perpustakaan</h5>
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
