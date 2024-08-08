<x-landing-layout>
    <div class="bg-primary text-center">
        <div class="content content-top text-start">
            <div class="py-3">
                <h1 class="fw-bold text-white mb-4">{{ $data->nama }}</h1>
                <div class="d-flex">
                    <div class="me-4 text-white text-start">
                        <div class="font-size-md fw-medium">Tgl Pendaftaran</div>
                        <div class="font-size-md">
                            <i class="fa fa-calendar-alt me-1"></i>
                            {{ \Carbon\Carbon::parse($data->tgl_mulai_daftar)->format('d M Y')}}
                            @if($data->tgl_selesai)
                            - {{ \Carbon\Carbon::parse($data->tgl_selesai_daftar)->format('d M Y')}}
                            @endif
                        </div>
                    </div>
                    <div class="me-4 text-white text-start">
                        <div class="font-size-md fw-medium">Tgl Kelas</div>
                        <div class="font-size-md">
                            <i class="fa fa-calendar-alt me-1"></i>
                            {{ \Carbon\Carbon::parse($data->tgl_mulai)->format('d M Y')}}
                            @if($data->tgl_selesai)
                            - {{ \Carbon\Carbon::parse($data->tgl_selesai)->format('d M Y')}}
                            @endif
                        </div>
                    </div>
                    <div class="me-4 text-white text-start">
                        <div class="font-size-md fw-medium">Waktu Kelas</div>
                        <div class="font-size-md">
                            <i class="fa fa-clock me-1"></i>
                            {{ \Carbon\Carbon::parse($data->waktu_mulai)->format('H:i')}}
                            @if($data->waktu_selesai)
                            - {{ \Carbon\Carbon::parse($data->waktu_selesai)->format('H:i')}}
                            @endif
                            WIB
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
        <div class="content content-full">
            <div class="row">
                <div class="col-lg-8">
                    <div class="block block-bordered rounded">
                        <div class="block-content p-3">
                            {!! $data->deskripsi !!}
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="block block-rounded">
                        <div class="block-content p-3">
                            <h3 class="h5 fw-medium mb-2">Media Kelas</h3>
                            <p class="mb-2">{!! $data->jenis !!}</p>
                            <h3 class="h5 fw-medium mb-2">Kuota Peserta</h3>
                            <p class="mb-2">{{ $data->kuota }}
                                Peserta</p>
                            <h3 class="h5 fw-medium mb-2">Lokasi</h3>
                            <p class="mb-2">{!! $data->lokasi !!}</p>
                            <h3 class="h5 fw-medium mb-2">Harga</h3>
                            <p class="mb-2">
                                @if($data->harga)
                                Rp {{ number_format($data->harga,0,',','.') }}
                                @else Gratis @endif
                            </p>
                            @if (Auth::guard('web')->check())
                                @if($register)
                                    @if($register->status == 'lunas')
                                        @if ($data->status == 'tutup')
                                        <a href="{{ route('user.training.certificate', $data->id) }}" class="btn btn-alt-primary w-100">
                                            Download Sertifikat
                                        </a>
                                        @else
                                        <div class="border border-3 border-danger p-3 rounded-3 text-center w-100">
                                            Kamu Sudah Terdaftar
                                        </div>
                                        @endif
                                    @else
                                        <a type="button" class="btn btn-warning w-100" href="{{ route('user.training.payment', $register->id)}}">
                                            Konfirmasi Pembayaran
                                        </a>
                                    @endif
                                @else
                                    <form method="POST" action="{{ route('user.training.register')}}">
                                        @csrf
                                        <input type="hidden" name="training_id" value="{{ $data->id }}"/>
                                        <button type="submit" class="btn btn-alt-primary  w-100">
                                            Daftar Sekarang
                                        </button>
                                    </form>
                                @endif
                            @else
                            <a href="{{ route('register') }}" class="btn btn-primary w-100">
                                Daftar Sekarang
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @push('scripts')
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.countdown/2.2.0/jquery.countdown.min.js" integrity="sha512-lteuRD+aUENrZPTXWFRPTBcDDxIGWe5uu0apPEn+3ZKYDwDaEErIK9rvR0QzUGmUQ55KFE2RqGTVoZsKctGMVw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
            <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
            <script>
                $('#clock').countdown('2020/10/10 12:34:56')
                    .on('update.countdown', function(event) {
                    var format = '%H:%M:%S';
                    if(event.offset.totalDays > 0) {
                        format = '%-d day%!d ' + format;
                    }
                    if(event.offset.weeks > 0) {
                        format = '%-w week%!w ' + format;
                    }
                    $(this).html(event.strftime(format));
                    })
                    .on('finish.countdown', function(event) {
                    $(this).html('This offer has expired!')
                        .parent().addClass('disabled');

                    });

            </script>
        @endpush
    </x-landing-layout>