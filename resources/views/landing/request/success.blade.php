<x-landing-layout>
    <div class="bg-primary">
        <div class="content text-center">
            <div class="pt-5 pb-5">
                <h1 class="h2 fw-bold text-white mb-2">Pengajuan Kelas</h1>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="block block-rounded">
            <div class="block-content p-3 text-center">
                <h2>Terima kasih!</h2>
                <p>Pengajuan program kelas Anda telah berhasil kami terima. Tim kami akan segera memproses pengajuan Anda dan menghubungi Anda dalam waktu 2-3 hari kerja</p>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            
            $("#field-tgl").flatpickr({
                altInput: true,
                altFormat: "j F Y H:i",
                dateFormat: "Y-m-d H:i",
                locale : "id",
                defaultDate : new Date(),
                enableTime: true,
                time_24hr: true
            });
        </script>
    @endpush
</x-landing-layout>