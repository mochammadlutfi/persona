<x-app-layout>
    <div class="content">
        <div class="content-heading d-flex justify-content-between align-items-center">
            <span>Laporan</span>
            <div class="space-x-1">
            </div>
        </div>
        <div class="block block-rounded">
            <div class="block-content p-3">
                <form method="GET" action="{{ route('admin.laporan.pdf')}}">
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <x-input-field type="text" name="tgl" id="tgl" label="Periode Tanggal"/> 
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        Download
                    </button>
                </form>
            </div>
        </div>
    </div>
    
    @push('scripts')
        <script>
            $("#field-tgl").flatpickr({
                altInput: true,
                altFormat: "j F Y",
                dateFormat: "Y-m-d",
                locale : "id",
                defaultDate: [new Date(Date.now() - 7 * 24 * 60 * 60 * 1000), new Date()],
                mode: "range"
            });
            
        </script>
    @endpush

</x-app-layout>

