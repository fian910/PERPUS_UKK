<div class="container py-5 d-flex flex-column">
    @if($showAlert)
    <div class="row">
        <div class="col-md-10 mx-auto">
            <div class="alert alert-{{ $alertType }} alert-dismissible fade show" role="alert">
                {{ $alertMessage }}
                <button 
                    type="button" 
                    class="btn-close" 
                    wire:click="closeAlert"
                    aria-label="Close"
                ></button>
            </div>
        </div>
    </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header bg-warning text-white">
                    <h4 class="card-title mb-0 h5">Riwayat Transaksi</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="thead-light">
                                <tr>
                                    <th style="white-space: nowrap;">No</th>
                                    <th style="white-space: nowrap;">Pustaka (Buku)</th>
                                    <th style="white-space: nowrap;">Anggota</th>
                                    <th style="white-space: nowrap;">Tanggal Pinjam</th>
                                    <th style="white-space: nowrap;">Tanggal Kembali</th>
                                    <th style="white-space: nowrap;">Tanggal Pengembalian</th>
                                    <th style="white-space: nowrap;">Status</th>
                                    <th style="white-space: nowrap;">Denda</th>
                                    <th style="white-space: nowrap;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($transaksi as $index => $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->pustaka->judul_pustaka}}</td>
                                        <td>{{ $item->anggota->nama_anggota}}</td>
                                        <td>{{ $item->tgl_pinjam }}</td>
                                        <td>{{ $item->tgl_kembali }}</td>
                                        <td>{{ $item->tgl_pengembalian }}</td>
                                        <td>
                                            @if($item->fp === '0')
                                                <span class="badge bg-warning">Dipinjam</span>
                                            @elseif($item->fp === '1')
                                                <span class="badge bg-success">Dikembalikan</span>
                                            @endif
                                        </td>
                                        <td>
                                            Rp. {{ number_format($item->denda, 0, ',', '.') }}
                                        </td>
                                        <td>
                                            @if($item->fp === '0')
                                                <button 
                                                    wire:click="requestStatusChange({{ $item->id }})" 
                                                    class="btn btn-sm btn-info">
                                                    Ajukan Kembali
                                                </button>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center">Tidak ada riwayat transaksi</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        @if ($transaksi instanceof \Illuminate\Pagination\LengthAwarePaginator)
                            <div class="d-flex justify-content-center">
                                {{ $transaksi->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>