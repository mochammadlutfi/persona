<x-landing-layout>
    <div class="bg-primary">
        <div class="content text-center">
            <div class="pt-5 pb-5">
                <h1 class="h2 fw-bold text-white mb-2">Riwayat Pengajuan</h1>
            </div>
        </div>
    </div>
    <div class="content content-full">
        <div class="row">
            <div class="col-12">
                <div class="block block-rounded">
                    <div class="block-content p-3">
                        <table class="table table-bordered datatable w-100">
                            <thead>
                                <tr>
                                    <th width="60px">No</th>
                                    <th>Instansi</th>
                                    <th>Tgl Training</th>
                                    <th>Program</th>
                                    <th>Harga</th>
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
        </div>
    </div>
    
    @push('scripts')
        <script>
            $('.datatable').DataTable();
        </script>
    @endpush
</x-landing-layout>