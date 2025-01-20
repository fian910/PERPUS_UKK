<div>
    <div class="card">
        <div class="card-header">
            Kelola Pustaka
        </div>
        <div class="card-body">
            @if (@session()->has('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            <div class="d-flex justify-content-end mb-3">
                <input type="text" wire:model.live="cari" class="form-control w-30" placeholder="Cari Pustaka...">
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover align-items-center mb-0">
                    <thead>
                        <tr>
                            <th style="white-space: nowrap;" scope="col">No.</th>
                            <th style="white-space: nowrap;" scope="col">Judul Pustaka</th>
                            <th style="white-space: nowrap;" scope="col">Kode Pustaka</th>
                            <th style="white-space: nowrap;" scope="col">ISBN</th>
                            <th style="white-space: nowrap;" scope="col">Jenis DDC</th>
                            <th style="white-space: nowrap;" scope="col">Jenis Format</th>
                            <th style="white-space: nowrap;" scope="col">Penerbit</th>
                            <th style="white-space: nowrap;" scope="col">Pengarang</th>
                            <th style="white-space: nowrap;" scope="col">Tahun Terbit</th>
                            <th style="white-space: nowrap;" scope="col">Keyword</th>
                            <th style="white-space: nowrap;" scope="col">Keterangan Fisik</th>
                            <th style="white-space: nowrap;" scope="col">Keterangan Tambahan</th>
                            <th style="white-space: nowrap;" scope="col">Abstraksi</th>
                            <th style="white-space: nowrap;" scope="col">Gambar</th>
                            <th style="white-space: nowrap;" scope="col">Harga Buku</th>
                            <th style="white-space: nowrap;" scope="col">Kondisi Buku</th>
                            <th style="white-space: nowrap;" scope="col">Fp</th>
                            <th style="white-space: nowrap;" scope="col">Jumlah Pinjam</th>
                            <th style="white-space: nowrap;" scope="col">Denda Terlambat</th>
                            <th style="white-space: nowrap;" scope="col">Denda Hilang</th>
                            <th style="white-space: nowrap;" scope="col">Proses</th>
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
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $data->judul_pustaka }}</td>
                                    <td>{{ $data->kode_pustaka }}</td>
                                    <td>{{ $data->isbn }}</td>
                                    <td>{{ $data->ddc->ddc }}</td>
                                    <td>{{ $data->format->format }}</td>
                                    <td>{{ $data->penerbit->nama_penerbit }}</td>
                                    <td>{{ $data->pengarang->nama_pengarang }}</td>
                                    <td>{{ $data->tahun_terbit }}</td>
                                    <td>{{ $data->keyword }}</td>
                                    <td>{{ $data->keterangan_fisik }}</td>
                                    <td>{{ $data->keterangan_tambahan }}</td>
                                    <td>{{ $data->abstraksi }}</td>
                                    <td>
                                        @if ($data->gambar)
                                            <img src="{{ asset('storage/' . $data->gambar) }}"
                                                alt="Foto {{ $data->judul_pustaka }}" class="img-thumbnail"
                                                style="max-width: 100px;">
                                        @else
                                            <span class="text-muted">Tidak ada foto</span>
                                        @endif
                                    </td>
                                    <td>Rp {{ number_format($data->harga_buku, 0, ',', '.') }}</td>
                                    <td>{{ $data->kondisi_buku }}</td>
                                    <td>
                                        @if ($data->fp == '0')
                                            Tidak
                                        @elseif($data->fp == '1')
                                            Ya
                                        @else
                                            {{ $data->fp }}
                                        @endif
                                    </td>
                                    <td>{{ $data->jml_pinjam }}</td>
                                    <td>Rp {{ number_format($data->denda_terlambat, 0, ',', '.') }}</td>
                                    <td>Rp {{ number_format($data->denda_hilang, 0, ',', '.') }}</td>
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
                            <input type="text" class="form-control" wire:model="judul_pustaka" value="{{ @old('judul_pustaka', $judul_pustaka ?? '') }}">
                            @error('judul_pustaka')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    
                        <div class="form-group">
                            <label>Kode Pustaka</label>
                            <input type="text" class="form-control" wire:model="kode_pustaka" maxlength="10" value="{{ @old('kode_pustaka', $kode_pustaka ?? '') }}">
                            @error('kode_pustaka')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    
                        <div class="form-group">
                            <label>ISBN</label>
                            <input type="text" class="form-control" wire:model="isbn" maxlength="13" value="{{ @old('isbn', $isbn ?? '') }}">
                            @error('isbn')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    
                        <div class="form-group">
                            <label>Jenis DDC</label>
                            <select class="form-control" wire:model="ddc_id">
                                <option value="">-- Pilih Jenis DDC --</option>
                                @foreach ($ddc as $jenis)
                                    <option value="{{ $jenis->id }}" {{ @old('ddc_id', $ddc_id ?? '') == $jenis->id ? 'selected' : '' }}>
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
                                    <option value="{{ $jenis->id }}" {{ @old('format_id', $format_id ?? '') == $jenis->id ? 'selected' : '' }}>
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
                                    <option value="{{ $data->id }}" {{ @old('penerbit_id', $penerbit_id ?? '') == $data->id ? 'selected' : '' }}>
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
                                    <option value="{{ $data->id }}" {{ @old('pengarang_id', $pengarang_id ?? '') == $data->id ? 'selected' : '' }}>
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
                            <input type="number" class="form-control" wire:model="tahun_terbit" min="1900" max="{{ date('Y') }}" 
                                value="{{ @old('tahun_terbit', $tahun_terbit ?? '') }}">
                            @error('tahun_terbit')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    
                        <div class="form-group">
                            <label>Keyword</label>
                            <input type="text" class="form-control" wire:model="keyword" value="{{ @old('keyword', $keyword ?? '') }}">
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
                                    <input class="form-check-input" type="radio" name="fp" id="fa0" value="0" 
                                        wire:model="fp" {{ @old('fp', $fp ?? '') == '0' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="fa0">0</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="fp" id="fa1" value="1" 
                                        wire:model="fp" {{ @old('fp', $fp ?? '') == '1' ? 'checked' : '' }}>
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
