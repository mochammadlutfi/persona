<x-landing-layout>
    <div class="bg-primary">
        <div class="content text-center">
            <div class="pt-5 pb-5">
                <h1 class="h2 fw-bold text-white mb-2">Detail Pengajuan</h1>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="block block-rounded">
            <div class="block-content p-4">
                <div class="row">
                    <div class="col-md-6">
                        <x-field-read label="Konsumen" value="{{ $data->user->nama }}"/>
                        <x-field-read label="Instansi" value="{{ $data->instansi }}"/>
                        <x-field-read label="Tanggal Pengajuan" value="{{ \Carbon\Carbon::parse($data->created_at)->translatedFormat('d F Y') }}"/>
                            <x-field-read label="Jenis" value="{{ $data->jenis }}"/>
                        <x-field-read label="Program Kelas" value="{{ $data->program->nama }}"/>         
                    </div>
                    <div class="col-md-6">               
                        <x-field-read label="Tanggal Training" value="{{ \Carbon\Carbon::parse($data->tgl)->translatedFormat('d F Y H:i') }} WIB"/>
                        <x-field-read label="Peserta" value="{{ $data->peserta }}"/>
                        <x-field-read label="Lokasi" value="{{ $data->lokasi }}"/>
                        <x-field-read label="Harga" value="Rp {{ number_format($data->harga,0,',','.') }}"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('styles')
    @endpush
    @push('scripts')

    @endpush

</x-landing-layout>

