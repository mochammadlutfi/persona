<x-landing-layout>
    <div class="bg-primary text-center">
        <div class="content content-top text-start">
            <div class="py-4 text-center">
                <h1 class="fw-bold text-white mb-4">{{ $data->nama }}</h1>
                <div class="d-flex justify-content-center">
                    <div class="me-4 text-white text-start">
                        <div class="font-size-md fw-medium">Tgl Promo</div>
                        <div class="font-size-md">
                            <i class="fa fa-calendar-alt me-1"></i>
                            <x-format-date mulai="{{ $data->tgl_mulai}}" selesai="{{ $data->tgl_selesai}}"/>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
        <div class="content content-full">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="block block-bordered rounded">
                        <div class="block-content p-3">
                            {!! $data->deskripsi !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @push('scripts')

        @endpush
    </x-landing-layout>