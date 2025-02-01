@section('breadcrumb')
    Halaman
@endsection

@section('breadcrumb-active')
    Manajemen Katalog
@endsection

@section('page-title')
    Kelola Ddc
@endsection


<div>
    <div class="card">
        <div class="card-header pb-0 d-flex justify-content-between align-items-center">
            <h6>Kelola Ddc</h6>
            <!-- Search bar -->
            <div class="ms-auto pe-md-3 d-flex align-items-center">
                <div class="input-group">
                    <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                    <input type="search" class="form-control search-input" wire:model.live="cari"
                        placeholder="Cari DDC...">
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
                                    scope="col">DDC</th>
                                <th style="white-space: nowrap;"
                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                    scope="col">Kode DDC</th>
                                <th style="white-space: nowrap;"
                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                    scope="col">Jenis Rak</th>
                                <th style="white-space: nowrap;"
                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                    scope="col">Keterangan</th>
                                <th style="white-space: nowrap;"
                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                    scope="col">Proses</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($ddcs->isEmpty())
                                <tr>
                                    <td colspan="6" class="text-center">Data belum dimasukkan</td>
                                </tr>
                            @else
                                @foreach ($ddcs as $data)
                                    <tr>
                                        <td scope="row" class="align-middle text-sm text-center">
                                            <span class="text-xs font-weight-bold">{{ $loop->iteration }}</span>
                                        </td>
                                        <td class="align-middle text-sm text-center">
                                            <span class="text-xs font-weight-bold">{{ $data->ddc }}</span>
                                        </td>
                                        <td class="align-middle text-sm text-center">
                                            <span class="text-xs font-weight-bold">{{ $data->kode_ddc }}</span>
                                        </td>
                                        <td class="align-middle text-sm text-center">
                                            <span class="text-xs font-weight-bold">{{ $data->rak->rak }}</span>
                                        </td>
                                        <td class="align-middle text-sm text-center">
                                            <span class="text-xs font-weight-bold">{{ $data->keterangan }}</span>
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
                    <h5 class="modal-title" id="exampleModalLabel">Tambah DDC Buku</h5>
                    <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">

                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form>
                        <div class="form-group">
                            <label>DDC</label>
                            <input type="text" class="form-control" wire:model="ddc" placeholder="Masukkan DDC"
                                value="{{ @old('ddc') }}">
                            @error('ddc')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Kode DDC</label>
                            <input type="text" class="form-control" wire:model="kode_ddc" maxlength="10"
                                placeholder="Masukkan Kode DDC" value="{{ @old('kode_ddc') }}">
                            @error('kode_ddc')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Jenis Rak</label>
                            <select class="form-control" wire:model="rak_id">
                                <option value="">-- Pilih Jenis Rak --</option>
                                @foreach ($raks as $rak)
                                    <option value="{{ $rak->id }}">{{ $rak->rak }}</option>
                                @endforeach
                            </select>
                            @error('rak_id')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Keterangan</label>
                            <textarea class="form-control" wire:model="keterangan" rows="3" placeholder="Masukkan keterangan">{{ @old('keterangan') }}</textarea>
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
                    <h5 class="modal-title" id="exampleModalLabel">Ubah DDC Buku</h5>
                    <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">

                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form>
                        <div class="form-group">
                            <label>DDC</label>
                            <input type="text" class="form-control" wire:model="ddc" maxlength="5"
                                placeholder="Masukkan DDC" value="{{ @old('ddc') }}">
                            @error('ddc')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Kode DDC</label>
                            <input type="text" class="form-control" wire:model="kode_ddc" maxlength="10"
                                placeholder="Masukkan Kode DDC" value="{{ @old('kode_ddc') }}">
                            @error('kode_ddc')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Jenis Rak</label>
                            <select class="form-control" wire:model="rak_id">
                                <option value="">-- Pilih Jenis Rak --</option>
                                @foreach ($raks as $rak)
                                    <option value="{{ $rak->id }}">{{ $rak->rak }}</option>
                                @endforeach
                            </select>
                            @error('rak_id')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Keterangan</label>
                            <textarea class="form-control" wire:model="keterangan" rows="3" placeholder="Masukkan keterangan">{{ @old('keterangan') }}</textarea>
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
                    <h5 class="modal-title" id="exampleModalLabel">Hapus DDC Buku</h5>
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
