@section('breadcrumb')
    Halaman
@endsection

@section('breadcrumb-active')
    Manajemen Katalog
@endsection

@section('page-title')
    Kelola Pustaka
@endsection

<div>
    <div class="card">
        <div class="card-header pb-0 d-flex justify-content-between align-items-center">
            <h6>Kelola Pustaka</h6>
            <!-- Search bar -->
            <div class="ms-auto pe-md-3 d-flex align-items-center">
                <div class="input-group">
                    <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                    <input type="search" class="form-control search-input" wire:model.live="cari"
                        placeholder="Cari Pustaka...">
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
                                <th style="white-space: nowrap;" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" scope="col">Judul Pustaka</th>
                                <th style="white-space: nowrap;" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" scope="col">Kode Pustaka</th>
                                <th style="white-space: nowrap;" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" scope="col">ISBN</th>
                                <th style="white-space: nowrap;" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" scope="col">Jenis DDC</th>
                                <th style="white-space: nowrap;" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" scope="col">Jenis Format</th>
                                <th style="white-space: nowrap;" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" scope="col">Penerbit</th>
                                <th style="white-space: nowrap;" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" scope="col">Pengarang</th>
                                <th style="white-space: nowrap;" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" scope="col">Tahun Terbit</th>
                                <th style="white-space: nowrap;" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" scope="col">Keyword</th>
                                <th style="white-space: nowrap;" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" scope="col">Keterangan Fisik</th>
                                <th style="white-space: nowrap;" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" scope="col">Keterangan Tambahan</th>
                                <th style="white-space: nowrap;" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" scope="col">Abstraksi</th>
                                <th style="white-space: nowrap;" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" scope="col">Gambar</th>
                                <th style="white-space: nowrap;" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" scope="col">Harga Buku</th>
                                <th style="white-space: nowrap;" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" scope="col">Kondisi Buku</th>
                                <th style="white-space: nowrap;" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" scope="col">Fp</th>
                                <th style="white-space: nowrap;" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" scope="col">Jumlah Pinjam</th>
                                <th style="white-space: nowrap;" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" scope="col">Denda Terlambat</th>
                                <th style="white-space: nowrap;" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" scope="col">Denda Hilang</th>
                                <th style="white-space: nowrap;" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" scope="col">Proses</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($pustaka->isEmpty())
                                <tr>
                                    <td colspan="21" class="text-center">Data belum dimasukkan</td>
                                </tr>
                            @else
                                @foreach ($pustaka as $data)
                                    <tr>
                                        <th scope="row" class="align-middle text-sm text-center">
                                            <span class="text-xs font-weight-bold">{{ $loop->iteration }}</span>
                                        </th>
                                        <td class="align-middle text-sm text-center">
                                            <span class="text-xs font-weight-bold">{{ $data->judul_pustaka }}</span>
                                        </td>
                                        <td class="align-middle text-sm text-center">
                                            <span class="text-xs font-weight-bold">{{ $data->kode_pustaka }}</span>
                                        </td>
                                        <td class="align-middle text-sm text-center">
                                            <span class="text-xs font-weight-bold">{{ $data->isbn }}</span>
                                        </td>
                                        <td class="align-middle text-sm text-center">
                                            <span class="text-xs font-weight-bold">{{ $data->ddc->ddc }}</span>
                                        </td>
                                        <td class="align-middle text-sm text-center">
                                            <span class="text-xs font-weight-bold">{{ $data->format->format }}</span>
                                        </td>
                                        <td class="align-middle text-sm text-center">
                                            <span class="text-xs font-weight-bold">{{ $data->penerbit->nama_penerbit }}</span>
                                        </td>
                                        <td class="align-middle text-sm text-center">
                                            <span class="text-xs font-weight-bold">{{ $data->pengarang->nama_pengarang }}</span>
                                        </td>
                                        <td class="align-middle text-sm text-center">
                                            <span class="text-xs font-weight-bold">{{ $data->tahun_terbit }}</span>
                                        </td>
                                        <td class="align-middle text-sm text-center">
                                            <span class="text-xs font-weight-bold">{{ $data->keyword }}</span>
                                        </td>
                                        <td class="align-middle text-sm text-center">
                                            <span class="text-xs font-weight-bold">{{ $data->keterangan_fisik }}</span>
                                        </td>
                                        <td class="align-middle text-sm text-center">
                                            <span class="text-xs font-weight-bold">{{ $data->keterangan_tambahan }}</span>
                                        </td>
                                        <td class="align-middle text-sm text-center">
                                            <span class="text-xs font-weight-bold">{{ $data->abstraksi }}</span>
                                        </td>
                                        <td class="align-middle text-sm text-center">
                                            <span class="text-xs font-weight-bold">
                                                @if ($data->gambar)
                                                    <img src="{{ asset('storage/' . $data->gambar) }}" alt="Foto {{ $data->judul_pustaka }}" class="img-thumbnail" style="max-width: 100px;">
                                                @else
                                                    Tidak ada foto
                                                @endif
                                            </span>
                                        </td>
                                        <td class="align-middle text-sm text-center">
                                            <span class="text-xs font-weight-bold">Rp {{ number_format($data->harga_buku, 0, ',', '.') }}</span>
                                        </td>
                                        <td class="align-middle text-sm text-center">
                                            <span class="text-xs font-weight-bold">{{ $data->kondisi_buku }}</span>
                                        </td>
                                        <td class="align-middle text-sm text-center">
                                            <span class="text-xs font-weight-bold">
                                                @if ($data->fp == '0')
                                                    Tidak
                                                @elseif($data->fp == '1')
                                                    Ya
                                                @else
                                                    {{ $data->fp }}
                                                @endif
                                            </span>
                                        </td>
                                        <td class="align-middle text-sm text-center">
                                            <span class="text-xs font-weight-bold">{{ $data->jml_pinjam }}</span>
                                        </td>
                                        <td class="align-middle text-sm text-center">
                                            <span class="text-xs font-weight-bold">Rp {{ number_format($data->denda_terlambat, 0, ',', '.') }}</span>
                                        </td>
                                        <td class="align-middle text-sm text-center">
                                            <span class="text-xs font-weight-bold">Rp {{ number_format($data->denda_hilang, 0, ',', '.') }}</span>
                                        </td>
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
                    {{ $pustaka->links() }}
                </div>
                <a href="#" class="btn btn-info mt-3" data-bs-toggle="modal" data-bs-target="#addpage">Tambah</a>
            </div>
        </div>
    </div>

    {{-- Tambah --}}
    <div wire:ignore.self class="modal fade" id="addpage" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Pustaka</h5>
                    <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form>
                        <div class="form-group">
                            <label>Judul Pustaka</label>
                            <input type="text" class="form-control" wire:model="judul_pustaka">
                            @error('judul_pustaka')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Kode Pustaka</label>
                            <input type="text" class="form-control" wire:model="kode_pustaka" maxlength="10">
                            @error('kode_pustaka')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>ISBN</label>
                            <input type="text" class="form-control" wire:model="isbn" maxlength="13">
                            @error('isbn')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Jenis DDC</label>
                            <select class="form-control" wire:model="ddc_id">
                                <option value="">-- Pilih Jenis DDC --</option>
                                @foreach ($ddc as $jenis)
                                    <option value="{{ $jenis->id }}">{{ $jenis->ddc }}</option>
                                @endforeach
                            </select>
                            @error('ddc_id')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Jenis Format</label>
                            <select class="form-control" wire:model="format_id">
                                <option value="">-- Pilih Jenis Format --</option>
                                @foreach ($format as $jenis)
                                    <option value="{{ $jenis->id }}">{{ $jenis->format }}</option>
                                @endforeach
                            </select>
                            @error('format_id')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Penerbit</label>
                            <select class="form-control" wire:model="penerbit_id">
                                <option value="">-- Pilih Penerbit --</option>
                                @foreach ($penerbit as $data)
                                    <option value="{{ $data->id }}">{{ $data->nama_penerbit }}</option>
                                @endforeach
                            </select>
                            @error('penerbit_id')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Pengarang</label>
                            <select class="form-control" wire:model="pengarang_id">
                                <option value="">-- Pilih Pengarang --</option>
                                @foreach ($pengarang as $data)
                                    <option value="{{ $data->id }}">{{ $data->nama_pengarang }}</option>
                                @endforeach
                            </select>
                            @error('pengarang_id')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Tahun Terbit</label>
                            <input type="number" class="form-control" wire:model="tahun_terbit" min="1900"
                                max="{{ date('Y') }}">
                            @error('tahun_terbit')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Keyword</label>
                            <input type="text" class="form-control" wire:model="keyword">
                            @error('keyword')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Keterangan Fisik</label>
                            <textarea class="form-control" wire:model="keterangan_fisik"></textarea>
                            @error('keterangan_fisik')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Keterangan Tambahan</label>
                            <textarea class="form-control" wire:model="keterangan_tambahan"></textarea>
                            @error('keterangan_tambahan')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Abstraksi</label>
                            <textarea class="form-control" wire:model="abstraksi"></textarea>
                            @error('abstraksi')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Gambar</label>
                            <input type="file" class="form-control" wire:model="gambar" accept="image/*">
                            @error('gambar')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Harga Buku</label>
                            <input type="number" class="form-control" wire:model="harga_buku" min="0">
                            @error('harga_buku')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Kondisi Buku</label>
                            <input type="text" class="form-control" wire:model="kondisi_buku">
                            @error('kondisi_buku')
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
                            <label>Jumlah Pinjam</label>
                            <input type="number" class="form-control" wire:model="jml_pinjam" min="0">
                            @error('jml_pinjam')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Denda Terlambat</label>
                            <input type="number" class="form-control" wire:model="denda_terlambat" min="0">
                            @error('denda_terlambat')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Denda Hilang</label>
                            <input type="number" class="form-control" wire:model="denda_hilang" min="0">
                            @error('denda_hilang')
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
                    <h5 class="modal-title" id="exampleModalLabel">Ubah Pustaka</h5>
                    <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">

                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form>
                        <div class="form-group">
                            <label>Judul Pustaka</label>
                            <input type="text" class="form-control" wire:model="judul_pustaka"
                                value="{{ @old('judul_pustaka', $judul_pustaka ?? '') }}">
                            @error('judul_pustaka')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Kode Pustaka</label>
                            <input type="text" class="form-control" wire:model="kode_pustaka" maxlength="10"
                                value="{{ @old('kode_pustaka', $kode_pustaka ?? '') }}">
                            @error('kode_pustaka')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>ISBN</label>
                            <input type="text" class="form-control" wire:model="isbn" maxlength="13"
                                value="{{ @old('isbn', $isbn ?? '') }}">
                            @error('isbn')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Jenis DDC</label>
                            <select class="form-control" wire:model="ddc_id">
                                <option value="">-- Pilih Jenis DDC --</option>
                                @foreach ($ddc as $jenis)
                                    <option value="{{ $jenis->id }}"
                                        {{ @old('ddc_id', $ddc_id ?? '') == $jenis->id ? 'selected' : '' }}>
                                        {{ $jenis->ddc }}
                                    </option>
                                @endforeach
                            </select>
                            @error('ddc_id')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Jenis Format</label>
                            <select class="form-control" wire:model="format_id">
                                <option value="">-- Pilih Jenis Format --</option>
                                @foreach ($format as $jenis)
                                    <option value="{{ $jenis->id }}"
                                        {{ @old('format_id', $format_id ?? '') == $jenis->id ? 'selected' : '' }}>
                                        {{ $jenis->format }}
                                    </option>
                                @endforeach
                            </select>
                            @error('format_id')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Penerbit</label>
                            <select class="form-control" wire:model="penerbit_id">
                                <option value="">-- Pilih Penerbit --</option>
                                @foreach ($penerbit as $data)
                                    <option value="{{ $data->id }}"
                                        {{ @old('penerbit_id', $penerbit_id ?? '') == $data->id ? 'selected' : '' }}>
                                        {{ $data->nama_penerbit }}
                                    </option>
                                @endforeach
                            </select>
                            @error('penerbit_id')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Pengarang</label>
                            <select class="form-control" wire:model="pengarang_id">
                                <option value="">-- Pilih Pengarang --</option>
                                @foreach ($pengarang as $data)
                                    <option value="{{ $data->id }}"
                                        {{ @old('pengarang_id', $pengarang_id ?? '') == $data->id ? 'selected' : '' }}>
                                        {{ $data->nama_pengarang }}
                                    </option>
                                @endforeach
                            </select>
                            @error('pengarang_id')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Tahun Terbit</label>
                            <input type="number" class="form-control" wire:model="tahun_terbit" min="1900"
                                max="{{ date('Y') }}" value="{{ @old('tahun_terbit', $tahun_terbit ?? '') }}">
                            @error('tahun_terbit')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Keyword</label>
                            <input type="text" class="form-control" wire:model="keyword"
                                value="{{ @old('keyword', $keyword ?? '') }}">
                            @error('keyword')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Keterangan Fisik</label>
                            <textarea class="form-control" wire:model="keterangan_fisik">{{ @old('keterangan_fisik', $keterangan_fisik ?? '') }}</textarea>
                            @error('keterangan_fisik')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Keterangan Tambahan</label>
                            <textarea class="form-control" wire:model="keterangan_tambahan">{{ @old('keterangan_tambahan', $keterangan_tambahan ?? '') }}</textarea>
                            @error('keterangan_tambahan')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Abstraksi</label>
                            <textarea class="form-control" wire:model="abstraksi">{{ @old('abstraksi', $abstraksi ?? '') }}</textarea>
                            @error('abstraksi')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Gambar</label>
                            <input type="file" class="form-control" wire:model="gambar" accept="image/*">
                            @error('gambar')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Harga Buku</label>
                            <input type="number" class="form-control" wire:model="harga_buku" min="0"
                                value="{{ @old('harga_buku', $harga_buku ?? '') }}">
                            @error('harga_buku')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Kondisi Buku</label>
                            <input type="text" class="form-control" wire:model="kondisi_buku"
                                value="{{ @old('kondisi_buku', $kondisi_buku ?? '') }}">
                            @error('kondisi_buku')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Fp</label>
                            <div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="fp" id="fa0"
                                        value="0" wire:model="fp"
                                        {{ @old('fp', $fp ?? '') == '0' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="fa0">0</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="fp" id="fa1"
                                        value="1" wire:model="fp"
                                        {{ @old('fp', $fp ?? '') == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="fa1">1</label>
                                </div>
                            </div>
                            @error('fp')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Jumlah Pinjam</label>
                            <input type="number" class="form-control" wire:model="jml_pinjam" min="0"
                                value="{{ @old('jml_pinjam', $jml_pinjam ?? '') }}">
                            @error('jml_pinjam')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Denda Terlambat</label>
                            <input type="number" class="form-control" wire:model="denda_terlambat" min="0"
                                value="{{ @old('denda_terlambat', $denda_terlambat ?? '') }}">
                            @error('denda_terlambat')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Denda Hilang</label>
                            <input type="number" class="form-control" wire:model="denda_hilang" min="0"
                                value="{{ @old('denda_hilang', $denda_hilang ?? '') }}">
                            @error('denda_hilang')
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
                    <h5 class="modal-title" id="exampleModalLabel">Hapus Pustaka</h5>
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
