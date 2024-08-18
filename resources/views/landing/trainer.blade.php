<x-landing-layout>
    <div class="bg-primary">
        <div class="content text-center">
            <div class="py-5">
                <h1 class="h2 fw-bold mb-2 text-white">Trainer</h1>
            </div>
        </div>
    </div>
    <div class="content content-full">

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="block rounded">
                    <div class="block-content p-4">
                        
                        @foreach ($data as $d)
                        <div class="row">
                            <div class="col-4">
                                <img src="{{ $d->foto }}" class="img-fluid"/>
                            </div>
                            <div class="col-md-8">
                                <h4 class="fw-bold fs-3 text-primary">{{ $d->nama }}</h4>
                                <p class="fs-sm fw-semibold">
                                    {{ $d->biografi }}
                                </p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-md-6">
            </div>
        </div>
    </div>
</x-landing-layout>