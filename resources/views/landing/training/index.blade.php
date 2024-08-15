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
            <div class="col-md-4">
                <div class="block block-rounded">
                    <div class="block-header border-bottom border-3">
                        <h3 class="block-title">
                            Panduan Pemesanan Kelas
                        </h3>
                    </div>
                    <div class="block-content p-2">
                        <ol>
                            <li>Pilih program kelas sesuai minat</li>
                            <li>Buat akun apabila belum punya akun persona</li>
                            <li>Lakukan Pemesanan kelas</li>
                            <li>Lakukan pembayaran</li>
                            <li>Lakukan konfirmasi pembayaran</li>
                            <li>Menunggu verifikasi konfirmasi pembayaran</li>
                            <li>Selesai</li>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                
                <div class="row">
                    @foreach ($data as $d)
                        <div class="col-md-6">
                            <x-card-training :data="$d" />
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-landing-layout>