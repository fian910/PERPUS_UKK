@section('breadcrumb')
    Halaman
@endsection

@section('breadcrumb-active')
    Manajemen Keanggotaan
@endsection

@section('page-title')
    Kelola Jenis Anggota
@endsection


<div>
    <div class="card">
        <div class="card-header pb-0 d-flex justify-content-between align-items-center">
            <h6>Kelola Jenis Anggota</h6>
            <!-- Search bar -->
            <div class="ms-auto pe-md-3 d-flex align-items-center">
                <div class="input-group">
                    <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                    <input type="search" class="form-control search-input" wire:model.live="cari"
                        placeholder="Cari Jenis Anggota...">
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
                                <th style="white-space: nowrap;"
                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                    scope="col">No.</th>
                                <th style="white-space: nowrap;"
                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                    scope="col">Kode Jenis Anggota</th>
                                <th style="white-space: nowrap;"
                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                    scope="col">Jenis Anggota</th>
                                <th style="white-space: nowrap;"
                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                    scope="col">Batas Pinjam</th>
                                <th style="white-space: nowrap;"
                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                    scope="col">Keterangan</th>
                                <th style="white-space: nowrap;"
                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                    scope="col">Proses</th>

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
                                        <td scope="row" class="align-middle text-sm text-center">
                                            <span class="text-xs font-weight-bold">{{ $loop->iteration }}</span>
                                        </td>
                                        <td class="align-middle text-sm text-center">
                                            <span
                                                class="text-xs font-weight-bold">{{ $data->kode_jenis_anggota }}</span>
                                        </td>
                                        <td class="align-middle text-sm text-center">
                                            <span class="text-xs font-weight-bold">{{ $data->jns_anggota }}</span>
                                        </td>
                                        <td class="align-middle text-sm text-center">
                                            <span class="text-xs font-weight-bold">{{ $data->max_pinjam }}</span>
                                        </td>
                                        <td class="align-middle text-sm text-center">
                                            <span class="text-xs font-weight-bold">{{ $data->keterangan }}</span>
                                        </td>

                                        <td class="proses">
                                            <div class="btn-group" role="group" aria-label="Proses Buttons">
                                                <button type="button" wire:click="edit({{ $data->id }})"
                                                    class="btn btn-sm btn-warning me-2" data-bs-toggle="modal"
                                                    data-bs-target="#editjenisanggota">Ubah</button>
                                                <button type="button" wire:click="confirm({{ $data->id }})"
                                                    class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                                    data-bs-target="#deletejenisanggota">Hapus</button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
                <a href="#" class="btn btn-md btn-info mt-3" data-bs-toggle="modal"
                    data-bs-target="#addjenisanggota">Tambah</a>
            </div>
        </div>
    </div>

    {{-- Tambah --}}
    <div wire:ignore.self class="modal fade" id="addjenisanggota" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Jenis Anggota</h5>
                    <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">

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
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="button" wire:click="store" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Edit --}}
    <div wire:ignore.self class="modal fade" id="editjenisanggota" tabindex="-1"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ubah Jenis Anggota</h5>
                    <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">

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
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
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
