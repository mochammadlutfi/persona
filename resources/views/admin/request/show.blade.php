<x-app-layout>
    <div class="content">
        <div class="content-heading d-flex justify-content-between align-items-center">
            <span>Detail Pengajuan</span>
            <div class="space-x-1">
                @if ($data->status == 'Pending')
                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <i class="fa fa-check me-1"></i>
                    Terima
                  </button>
                <button type="button" class="btn btn-sm btn-danger" onclick="addPayment()">
                    <i class="fa fa-times me-1"></i>
                    Tolak
                </button>
                @endif
            </div>
        </div>
        <div class="block block-rounded">
            <div class="block-content p-4">
                <div class="row">
                    <div class="col-md-6">
                        <x-field-read label="Nama" value="{{ $data->nama }}"/>
                        <x-field-read label="No HP/WA" value="{{ $data->hp }}"/>
                        <x-field-read label="Email" value="{{ $data->email }}"/>
                        <x-field-read label="Instansi" value="{{ $data->instansi }}"/>
                        <x-field-read label="Tanggal Pengajuan" value="{{ \Carbon\Carbon::parse($data->created_at)->translatedFormat('d F Y') }}"/>
                        <x-field-read label="Program Kelas" value="{{ $data->program->nama }}"/>         
                    </div>
                    <div class="col-md-6">               
                        <x-field-read label="Tanggal Training" value="{{ \Carbon\Carbon::parse($data->tgl)->translatedFormat('d F Y H:i') }} WIB"/>
                        <x-field-read label="Jenis" value="{{ $data->jenis }}"/>
                        <x-field-read label="Peserta" value="{{ $data->peserta }}"/>
                        <x-field-read label="Lokasi" value="{{ $data->lokasi }}"/>
                        <x-field-read label="Harga" value="{{ $data->harga }}"/>
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

