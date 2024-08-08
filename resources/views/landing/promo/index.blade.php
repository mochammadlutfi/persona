<x-landing-layout>
    <div class="bg-primary">
        <div class="content text-center">
            <div class="py-5">
                <h1 class="h2 fw-bold text-white mb-2">Promo Program</h1>
            </div>
        </div>
    </div>
    <div class="content content-full">
        <div class="row">
            @foreach ($data as $d)
            <div class="col-md-4">
                <a class="block block-rounded block-bordered shadow-sm" href="{{ route('promo.show', $d->slug) }}">
                    <div class="block-content p-0 overflow-hidden">
                        <img src="{{ $d->foto }}" class="img-fluid"/>
                    </div>
                    <div class="block-content p-3">
                        <h2 class="fs-5 mb-2">{{ $d->nama }}</h2>
                    </div>
                    <div class="block-content p-3 border-top border-2">
                        <div class="d-flex justify-content-between">
                            <div class="fs-sm fw-semibold">
                                <i class="fa fa-calendar-alt me-1"></i>
                                <x-format-date mulai="{{ $d->tgl_mulai}}" selesai="{{ $d->tgl_selesai}}"/>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</x-landing-layout>