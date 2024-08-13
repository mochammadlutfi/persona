<x-app-layout>
    <div class="content">
        <div class="content-heading d-flex justify-content-between align-items-center">
            <span>Detail Pengajuan</span>
            <div class="space-x-1">
                @if ($data->status == 'Pending')
                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <i class="fa fa-check me-1"></i>
                    Konfirmasi Pengajuan
                  </button>
                @endif
            </div>
        </div>
        <div class="block block-rounded">
            <div class="block-content p-4">
                <div class="row">
                    <div class="col-md-6">
                        <x-field-read label="Konsumen" value="{{ $data->user->nama }}"/>
                        <x-field-read label="Instansi" value="{{ $data->instansi }}"/>
                        <x-field-read label="Tanggal Pengajuan" value="{{ \Carbon\Carbon::parse($data->created_at)->translatedFormat('d F Y') }}"/>
                        <x-field-read label="Jenis" value="{{ $data->jenis }}"/>
                        <x-field-read label="Program Kelas" value="{{ $data->program->nama }}"/>     
                        <x-field-read label="Status">
                            <x-slot name="value">
                                @if($data->status == 'Belum Bayar')
                                    <span class="badge bg-danger px-3">Belum Bayar</span>
                                @elseif($data->status == 'Pending')
                                <span class="badge bg-warning px-3">Pending</span>
                                @elseif($data->status == 'Disetujui')
                                <span class="badge bg-success px-3">Disetujui</span>
                                @elseif($data->status == 'Ditolak')
                                <span class="badge bg-danger px-3">Ditolak</span>
                                @else
                                <span class="badge bg-secondary px-3">Batal</span>
                                @endif
                            </x-slot>
                        </x-field-read>
                    </div>
                    <div class="col-md-6">               
                        <x-field-read label="Tanggal Training" value="{{ \Carbon\Carbon::parse($data->tgl)->translatedFormat('d F Y H:i') }} WIB"/>
                        <x-field-read label="Peserta" value="{{ $data->peserta }}"/>
                        <x-field-read label="Lokasi" value="{{ $data->lokasi }}"/>
                        <x-field-read label="Kota" value="Kota Bandung"/>
                        <x-field-read label="Harga" value="Rp {{ number_format($data->harga,0,',','.') }}"/>
                            <x-field-read label="Status Pembayaran">
                                <x-slot name="value">
                                    @if($data->pembayaran->whereIn('status',['Pending', 'Disetujui'])->sum('jumlah') == $data->harga)
                                        <span class="badge bg-success px-3">Lunas</span>
                                    @elseif($data->pembayaran->whereIn('status',['Pending', 'Disetujui'])->sum('jumlah') < $data->harga &&
                                    $data->pembayaran->whereIn('status',['Pending', 'Disetujui'])->sum('jumlah') >0)
                                    <span class="badge bg-warning px-3">Sebagian</span>
                                    @else
                                    <span class="badge bg-danger px-3">Belum Bayar</span>
                                    @endif
                                </x-slot>
                            </x-field-read>   
                    </div>
                </div>
            </div>
        </div>
        @if ($data->status == 'Disetujui')
        <div class="content-heading d-flex justify-content-between align-items-center pt-0">
            <span>Pembayaran</span>
            <div class="space-x-1">
            </div>
        </div>
        <div class="block block-rounded">
            <div class="block-content p-0">
                <table class="table table-bordered datatable w-100">
                    <thead>
                        <tr>
                            <th width="60px">No</th>
                            <th>Tanggal</th>
                            <th>Jumlah</th>
                            <th>Bank Tujuan</th>
                            <th>Pengirim</th>
                            <th>Status</th>
                            <th width="100px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data->pembayaran as $d)
                        <tr>
                            <td>{{ $loop->index+1 }}</td>
                            <td>{{ \Carbon\Carbon::parse($d->tgl)->translatedFormat('d F Y') }}</td>
                            <td>
                                Rp {{ number_format($d->jumlah,0,',','.') }}
                            </td>
                            <td>
                                {{ $d->bank }}
                            </td>
                            <td>
                                {{ $d->pengirim }}
                            </td>
                            <td>
                                @if ($d->status == 'Pending')
                                    <span class="badge bg-warning">Pending</span>
                                @elseif ($d->status == 'Disetujui')
                                    <span class="badge bg-success">Diterima</span>
                                @elseif ($d->status == 'Ditolak')
                                    <span class="badge bg-danger">Ditolak</span>
                                @endif
                            </td>
                            <td>
                                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modalBayar{{ $loop->index}}">
                                    Detail
                                </button>
                                <x-bayar-detail :data="$d" id="modalBayar{{ $loop->index}}"/>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                    <div class="block block-rounded shadow-none mb-0">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">Konfirmasi Pengajuan</h3>
                            <div class="block-options">
                                <button
                                    type="button"
                                    class="btn-block-option"
                                    data-bs-dismiss="modal"
                                    aria-label="Close">
                                    <i class="fa fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="block-content">
                            <h3 class="text-center">Konfirmasi pengajuan program inhouse training</h3>
                        </div>
                        <div class="block-content block-content-full block-content-sm text-end border-top">
                            <form action="{{ route('admin.request.status', $data->id )}}" method="POST">
                                @csrf
                                <button type="submit" name="status" value="Ditolak" class="btn btn-alt-secondary" data-bs-dismiss="modal">
                                    Tolak
                                 </button>
                                <button type="submit"name="status" value="Disetujui"  class="btn btn-primary">
                                    Terima
                                </button>
                            </form>
                        </div>
                    </div>
            </div>
            </div>
        </div>
    </div>
    @push('styles')
    @endpush
    @push('scripts')
    @endpush

</x-app-layout>

