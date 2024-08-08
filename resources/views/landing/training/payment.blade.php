<x-landing-layout>
    <div class="bg-primary text-center">
        <div class="content text-center">
            <div class="py-5">
                <h1 class="fw-bold text-white mb-4">Detail Pendaftaran</h1>
            </div>
        </div>
    </div>
    <div class="content content-full">
        <div class="row justify-content-center">
            @if(in_array($data->status, ['Belum Bayar', 'Pending', 'Ditolak']))
            <div class="col-4">
                <div class="block block-bordered rounded">
                    <div class="block-content p-3">
                        <h3 class="fs-4 fw-semibold">Rekening Pembayaran</h3>
                        @foreach ($bank as $d)
                        <div class="block border border-3 rounded-3 mb-2">
                            <div class="block-content p-3 text-center">
                                <div class="g-2 row">
                                    <div class="col-5 d-flex">
                                        <img src="{{ $d['img'] }}" class="w-100">
                                    </div>
                                    <div class="col-7">
                                        <div class="fs-base fw-bold">{{ $d['rek'] }}</div>
                                        <div class="fs-sm">A.n {{ $d['an'] }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif
            <div class="col-lg-8">
                <div class="block block-bordered rounded">
                    <div class="block-header">
                        <div class="block-title">{{ $data->nomor }}
                        </div>
                        <div class="block-options">
                            <a href="{{ route('user.training.invoice', $data->id) }}"  class="btn btn-primary btn-sm">
                                Download Invoice
                            </a>
                        </div>
                    </div>
                    <div class="block-content p-3">
                        @if ($data->status == 'Belum Bayar')
                        <h3 class="fs-4 fw-semibold">Konfirmasi Pembayaran</h3>
                        <form method="POST" action="{{ route('user.training.update', $data->id)}}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <x-input-field type="text" id="nama" name="nama" label="Nama Pengirim" required/>
                                    <x-select-field id="bank" name="bank" label="Rekening Tujuan" :options="[
                                        ['value' => 'BCA', 'label' => 'Bank BCA'],
                                        ['value' => 'BNI', 'label' => 'Bank BNI'],
                                        ['value' => 'Mandiri', 'label' => 'Bank Mandiri'],
                                    ]" />
                                    <div class="mb-4">
                                        <label class="form-label" for="field-bukti">Bukti Bayar</label>
                                        <input class="form-control" type="file" name="bukti" id="field-bukti">
                                        <div class="invalid-feedback" id="error-bukti">Invalid feedback</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <x-input-field type="text" id="tgl" name="tgl" label="Tanggal Kirim" required/>
                                    <x-input-field type="number" id="jumlah" name="jumlah" max="{{ $data->training->harga }}" label="Jumlah Bayar" required/>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">
                                Kirim
                            </button>
                        </form>
                        @elseif($data->status == 'Pending')
                            <div class="text-center">
                                <h3>Pembayaran Sedang Diverifikasi</h3>
                                <div class="spinner-border text-primary" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                                <p>Terimakasih sudah melakukan konfirmasi pembayaran, kami akan segera menghubungi kamu</p>
                            </div>
                        @elseif($data->status == 'Lunas')
                            <div class="row">
                                <div class="col-md-8">
                                    <x-field-read label="Nama Peserta" value="{{ $data->user->nama }}"/>
                                    <x-field-read label="Training" value="{{ $data->training->nama }}"/>
                                    <x-field-read label="Tanggal Daftar" value="{{ \Carbon\Carbon::parse($data->created_at)->translatedFormat('d F Y') }}"/>
                                    <x-field-read label="Tanggal Pembayaran" value="{{ \Carbon\Carbon::parse($data->tgl)->translatedFormat('d F Y') }}"/>
                                    <x-field-read label="Tujuan Pembayaran" value="{{ $data->bank }}"/>
                                    <x-field-read label="Jumlah pembayaran" value="{{ $data->pengirim }}"/>
                                    <x-field-read label="A.n Pengirim" value="Rp {{  number_format($data->jumlah,0,',','.') }}"/>
                                        
                                    <x-field-read label="Status">
                                        <x-slot name="value">
                                            @if($data->status == 'Belum Bayar')
                                                <span class="badge bg-danger px-3">Belum Bayar</span>
                                            @elseif($data->status == 'Pending')
                                            <span class="badge bg-warning px-3">Pending</span>
                                            @elseif($data->status == 'Lunas')
                                            <span class="badge bg-success px-3">Lunas</span>
                                            @elseif($data->status == 'Ditolak')
                                            <span class="badge bg-danger px-3">Ditolak</span>
                                            @else
                                            <span class="badge bg-secondary px-3">Batal</span>
                                            @endif
                                        </x-slot>
                                    </x-field-read>
            
                                </div>
                                <div class="col-md-4">
                                    <a href="{{ $data->bukti }}" data-lightbox="image-1" data-title="My caption">
                                        <img src="{{ $data->bukti }}" class="w-50"/>
                                    </a>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/css/lightbox.min.css" integrity="sha512-ZKX+BvQihRJPA8CROKBhDNvoc2aDMOdAlcm7TUQY+35XYtrd3yh95QOOhsPDQY9QnKE0Wqag9y38OIgEvb88cA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    @endpush
    @push('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/js/lightbox.min.js" integrity="sha512-Ixzuzfxv1EqafeQlTCufWfaC6ful6WFqIz4G+dWvK0beHw0NVJwvCKSgafpy5gwNqKmgUfIBraVwkKI+Cz0SEQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.countdown/2.2.0/jquery.countdown.min.js" integrity="sha512-lteuRD+aUENrZPTXWFRPTBcDDxIGWe5uu0apPEn+3ZKYDwDaEErIK9rvR0QzUGmUQ55KFE2RqGTVoZsKctGMVw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        <script>
            
            $("#field-tgl").flatpickr({
                altInput: true,
                altFormat: "j F Y",
                dateFormat: "Y-m-d",
                locale : "id",
                defaultDate : new Date(),
                enableTime: false,
                time_24hr: true
            });

            $(document).ready(function() {
                $('#field-jumlah').on('input', function() {
                    var max = $(this).attr('max');
                    if (parseInt($(this).val()) > parseInt(max)) {
                        $(this).val(max);
                    }
                });
            });
        </script>
    @endpush
</x-landing-layout>