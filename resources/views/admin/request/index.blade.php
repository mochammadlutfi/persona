<x-app-layout>
    <div class="content">
        <div class="content-heading d-flex justify-content-between align-items-center">
            <span>Data Pengajuan Kelas</span>
            <div class="space-x-1">
            </div>
        </div>
        <div class="block block-rounded">
            <div class="block-content p-3">
                <table class="table table-bordered datatable w-100">
                    <thead>
                        <tr>
                            <th width="60px">No</th>
                            <th>Nama</th>
                            <th>Instansi</th>
                            <th>Tgl Training</th>
                            <th>Program</th>
                            <th>Harga</th>
                            <th>Status</th>
                            <th width="100px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $d)
                        <tr>
                            <td>
                                {{ $loop->index+1}}
                            </td>
                            <td>
                                {{ $d->user->nama }}
                            </td>
                            <td>
                                {{ $d->instansi }}
                            </td>
                            <td>
                                {{ \Carbon\Carbon::parse($d->tgl)->translatedFormat('d F Y') }}
                            </td>
                            <td>
                                {{ $d->jenis }}<br/>
                                {{ $d->program->nama }}
                            </td>
                            <td>
                                Rp {{ number_format($d->harga,0,',','.') }}
                            </td>
                            <td>
                                @if ($d->status == 'Pending')
                                    <span class="badge bg-warning">Menunggu</span>
                                @elseif ($d->status == 'Disetujui')
                                <span class="badge bg-success">Disetujui</span>
                                @elseif ($d->status == 'Ditolak')
                                <span class="badge bg-danger">Ditolak</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('user.request.show', $d->id)}}" class="btn btn-primary">
                                    Detail
                                </a>
                            </td>
                        </tr>
                            
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    @push('scripts')
        <script>
            $(function () {
                $('.datatable').DataTable({
                    dom: "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>><'row'<'col-sm-12'tr>><'r" +
                            "ow'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                });
            });
        </script>
    @endpush

</x-app-layout>

