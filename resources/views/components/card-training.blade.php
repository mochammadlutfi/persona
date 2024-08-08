<a class="block block-rounded block-bordered shadow-sm" href="{{ route('training.show', $data->slug) }}">
    <div class="block-content p-3">
        <h2 class="fs-5 mb-2">{{ $data->nama }}</h2>
    </div>
    <div class="block-content p-3 border-top border-2">
        <div class="fs-sm fw-semibold mb-2">
            <i class="fa fa-map-pin me-1"></i>
            {{ $data->lokasi }}
        </div>
        <div class="d-flex justify-content-between">
            <div class="fs-sm fw-semibold">
                <i class="fa fa-calendar-alt me-1"></i>
                <x-format-date mulai="{{ $data->tgl_mulai}}" selesai="{{ $data->tgl_selesai}}"/>
            </div>
            <div class="fs-sm fw-semibold">
                <i class="fa fa-clock me-1"></i>
                {{ Carbon\Carbon::parse($data->waktu_mulai)->format('H:i') }} - {{ Carbon\Carbon::parse($data->waktu_selesai)->format('H:i') }} WIB
            </div>
        </div>
    </div>
</a>