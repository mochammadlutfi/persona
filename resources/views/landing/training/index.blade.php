<x-landing-layout>
    <div class="bg-primary">
        <div class="content text-center">
            <div class="py-4">
                <h1 class="h2 fw-bold text-white mb-2">Program Pelatihan</h1>
                <h2 class="h5 fw-medium text-white-75">Kembangkan Keahlianmu Bersama Kami!</h2>
            </div>
        </div>
    </div>
    <div class="content content-full">
        <div class="row">
            @foreach ($data as $d)
                <div class="col-md-4">
                    <x-card-training :data="$d" />
                </div>
            @endforeach
        </div>
    </div>
</x-landing-layout>