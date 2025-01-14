<div>
    <div class="card">
        <div class="card-header">
            Kelola Anggota
        </div>
        <div class="card-body">
            @if (@session()->has('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            <div class="d-flex justify-content-end mb-3">
                <input type="text" wire:model.live="cari" class="form-control w-30" placeholder="Cari Perpustakaan...">
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover align-items-center mb-0">
                    <thead>
                        <tr>
                            <th style="white-space: nowrap;" scope="col">No.</th>
                            <th style="white-space: nowrap;" scope="col">Nama Anggota</th>
                            <th style="white-space: nowrap;" scope="col">Kode Anggota</th>
                            <th style="white-space: nowrap;" scope="col">Jenis Anggota</th>
                            <th style="white-space: nowrap;" scope="col">Tempat</th>
                            <th style="white-space: nowrap;" scope="col">Tanggal Lahir</th>
                            <th style="white-space: nowrap;" scope="col">Alamat</th>
                            <th style="white-space: nowrap;" scope="col">NoTelp</th>
                            <th style="white-space: nowrap;" scope="col">Email</th>
                            <th style="white-space: nowrap;" scope="col">Tanggal Daftar</th>
                            <th style="white-space: nowrap;" scope="col">Masa Aktif</th>
                            <th style="white-space: nowrap;" scope="col">Fa</th>
                            <th style="white-space: nowrap;" scope="col">Keterangan</th>
                            <th style="white-space: nowrap;" scope="col">Foto</th>
                            <th style="white-space: nowrap;" scope="col">Username</th>
                            <th style="white-space: nowrap;" scope="col">Proses</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($anggota->isEmpty())
                            <tr>
                                <td colspan="15" class="text-center">Data belum dimasukkan</td>
                            </tr>
                        @else
                            @foreach ($anggota as $data)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $data->nama_anggota }}</td>
                                    <td>{{ $data->kode_anggota }}</td>
                                    <td>{{ $data->jenis_anggota->jns_anggota }}</td>
                                    <td>{{ $data->tempat }}</td>
                                    <td>{{ $data->tgl_lahir }}</td>
                                    <td>{{ $data->alamat }}</td>
                                    <td>{{ $data->no_telp }}</td>
                                    <td>{{ $data->email }}</td>
                                    <td>{{ $data->tgl_daftar }}</td>
                                    <td>{{ $data->masa_aktif }}</td>
                                    <td>{{ $data->fa }}</td>
                                    <td>{{ $data->keterangan }}</td>
                                    <td>
                                        @if ($data->foto)
                                            <img src="{{ asset('storage/' . $data->foto) }}"
                                                alt="Foto {{ $data->nama_anggota }}" class="img-thumbnail"
                                                style="max-width: 100px;">
                                        @else
                                            <span class="text-muted">Tidak ada foto</span>
                                        @endif
                                    </td>
                                    <td>{{ $data->username }}</td>
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
                {{ $anggota->links() }}
            </div>
            <a href="#" class="btn btn-info mt-3" data-bs-toggle="modal" data-bs-target="#addpage"> Tambah</a>
        </div>
    </div>

    {{-- Tambah --}}
    <div wire:ignore.self class="modal fade" id="addpage" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Anggota</h5>
                    <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form>
                        <div class="form-group">
                            <label>Jenis Anggota</label>
                            <select class="form-control" wire:model="jenis_anggota_id">
                                <option value="">-- Pilih Jenis Anggota --</option>
                                @foreach ($jenis_anggota as $jenis)
                                    <option value="{{ $jenis->id }}">{{ $jenis->jns_anggota }}</option>
                                @endforeach
                            </select>
                            @error('jenis_anggota_id')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Kode Anggota</label>
                            <input type="text" class="form-control" wire:model="kode_anggota" maxlength="10"
                                value="{{ @old('kode_anggota') }}">
                            @error('kode_anggota')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Nama Anggota</label>
                            <input type="text" class="form-control" wire:model="nama_anggota"
                                value="{{ @old('nama_anggota') }}">
                            @error('nama_anggota')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Tempat Lahir</label>
                            <input type="text" class="form-control" wire:model="tempat"
                                value="{{ @old('tempat') }}">
                            @error('tempat')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Tanggal Lahir</label>
                            <input type="date" class="form-control" wire:model="tgl_lahir"
                                value="{{ @old('tgl_lahir') }}">
                            @error('tgl_lahir')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Alamat</label>
                            <textarea type="text" class="form-control" wire:model="alamat">{{ @old('alamat') }}</textarea>
                            @error('alamat')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>No Telp</label>
                            <input type="tel" class="form-control" wire:model="no_telp"
                                value="{{ @old('no_telp') }}">
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
                            <label>Tanggal Daftar</label>
                            <input type="date" class="form-control" wire:model="tgl_daftar"
                                value="{{ @old('tgl_daftar') }}">
                            @error('tgl_daftar')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Masa Aktif</label>
                            <input type="date" class="form-control" wire:model="masa_aktif"
                                value="{{ @old('masa_aktif') }}">
                            @error('masa_aktif')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Fa</label>
                            <div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="fa" id="faY"
                                        value="Y" wire:model="fa">
                                    <label class="form-check-label" for="faY">Ya</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="fa" id="faT"
                                        value="T" wire:model="fa">
                                    <label class="form-check-label" for="faT">Tidak</label>
                                </div>
                            </div>
                            @error('fa')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Keterangan</label>
                            <textarea type="text" class="form-control" wire:model="keterangan">{{ @old('keterangan') }}</textarea>
                            @error('keterangan')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Foto</label>
                            <input type="file" class="form-control" wire:model="foto"
                                value="{{ @old('foto') }}">
                            @error('foto')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" class="form-control" wire:model="username"
                                value="{{ @old('username') }}">
                            @error('username')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" wire:model="password"
                                value="{{ @old('password') }}">
                            @error('password')
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
                    <h5 class="modal-title" id="exampleModalLabel">Ubah Anggota</h5>
                    <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">

                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form>
                        <div class="form-group">
                            <label>Jenis Anggota</label>
                            <select class="form-control" wire:model="jenis_anggota_id">
                                <option value="">-- Pilih Jenis Anggota --</option>
                                @foreach ($jenis_anggota as $jenis)
                                    <option value="{{ $jenis->id }}">{{ $jenis->jns_anggota }}</option>
                                @endforeach
                            </select>
                            @error('jenis_anggota_id')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Kode Anggota</label>
                            <input type="text" class="form-control" wire:model="kode_anggota" maxlength="10"
                                value="{{ @old('kode_anggota') }}"disabled>
                            @error('kode_anggota')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Nama Anggota</label>
                            <input type="text" class="form-control" wire:model="nama_anggota"
                                value="{{ @old('nama_anggota') }}">
                            @error('nama_anggota')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Tempat Lahir</label>
                            <input type="text" class="form-control" wire:model="tempat"
                                value="{{ @old('tempat') }}">
                            @error('tempat')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Tanggal Lahir</label>
                            <input type="date" class="form-control" wire:model="tgl_lahir"
                                value="{{ @old('tgl_lahir') }}">
                            @error('tgl_lahir')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Alamat</label>
                            <textarea type="text" class="form-control" wire:model="alamat">{{ @old('alamat') }}</textarea>
                            @error('alamat')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>No Telp</label>
                            <input type="tel" class="form-control" wire:model="no_telp"
                                value="{{ @old('no_telp') }}">
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
                            <label>Tanggal Daftar</label>
                            <input type="date" class="form-control" wire:model="tgl_daftar"
                                value="{{ @old('tgl_daftar') }}">
                            @error('tgl_daftar')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Masa Aktif</label>
                            <input type="date" class="form-control" wire:model="masa_aktif"
                                value="{{ @old('masa_aktif') }}">
                            @error('masa_aktif')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Fa</label>
                            <div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="fa" id="faY"
                                        value="Y" wire:model="fa">
                                    <label class="form-check-label" for="faY">Ya</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="fa" id="faT"
                                        value="T" wire:model="fa">
                                    <label class="form-check-label" for="faT">Tidak</label>
                                </div>
                            </div>
                            @error('fa')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Keterangan</label>
                            <textarea type="text" class="form-control" wire:model="keterangan">{{ @old('keterangan') }}</textarea>
                            @error('keterangan')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Foto</label>
                            <input type="file" class="form-control" wire:model="foto"
                                value="{{ @old('foto') }}">
                            @error('foto')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" class="form-control" wire:model="username"
                                value="{{ @old('username') }}">
                            @error('username')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" wire:model="password"
                                value="{{ @old('password') }}">
                            @error('password')
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
                    <h5 class="modal-title" id="exampleModalLabel">Hapus Anggota</h5>
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
