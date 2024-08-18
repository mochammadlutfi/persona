<x-landing-layout>
    <div class="bg-primary">
        <div class="content text-center">
            <div class="pt-5 pb-5">
                <h1 class="h2 fw-bold text-white mb-2">Program Inhouse</h1>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="block block-rounded">
            <div class="block-content p-4">
                <p>Tata Cara Pemesanan</p>
                <ol>
                    <li>Melakukan pendaftaran</li>
                    <li>mengisi data</li>
                        <li>menunggu email persetujuan</li>
                            <li>melakukan pembayaran</li>
                                <li>menunggu konfirmasi pembayaran</li>
                                    <li>menunggu pencetakan kwitansi</li>
                </ol>
                <p>Pilihan Program Sesuai Kebutuhan Anda</p>
                <ul>
                    <li>
                        <b>Public Speaking Class</b><br/>
                        Program pelatihan yang dirancang agar berani tampil dan percaya diri dengan materi yang disesuaikan dengan kebutuhan anda
                    </li>
                    <li>
                        <b>Master Of Ceremony Class</b><br/>
                        Program pelatihan yang dirancang bagi anda MC pemula yang ingin belajar menjadi MC
                    </li>
                    <li>
                        <b>Master Of Ceremony Class</b><br/>
                        Program pelatihan yang dirancang bagi anda MC pemula yang ingin belajar menjadi MC
                    </li>
                    <li>
                        <b>Effective Negotiation Skills</b><br/>
                        Kelas ini membantu anda agar mampu menguasai prinsip & teknik negosiasi secara efektif agar negosiasi dan lobi yang anda lakukan bisa berjalan sukses dan mencapai hasil terbaik.
                    </li>
                    <li>
                        <b>Etiquette For Public Speaker</b>
                            <br/>Program pelatihan yang dirancang agar peserta mampu memiliki sikap dan etiket yang berkelas dan profesional.
                        
                    </li>
                    <li>
                        <b>Impressive Public Speaking</b><br/>
                        Kelas ini membantu anda agar mampu memberikan penampilan terbaik agar berani tampil dan percaya diri
                    </li>
                    
                </ul>

                <h3>Biaya Paket Inhouse Training</h3>
                <div class="row">
                    <div class="col-md-6">
                        <h4 class="fs-5 mb-2">Biaya Offline Training</h4>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Durasi</th>
                                    <th>Peserta</th>
                                    <th>Harga</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1 Hari</td>
                                    <td>50 Peserta</td>
                                    <td>Rp 25 Juta</td>
                                </tr>
                                <tr>
                                    <td>1 Hari</td>
                                    <td>50-100 Peserta</td>
                                    <td>Rp 50 Juta</td>
                                </tr>
                                <tr>
                                    <td>1 Hari</td>
                                    <td>100-150 Peserta</td>
                                    <td>Rp 75 Juta</td>
                                </tr>
                            </tbody>
                        </table>
                        <h4 class="fs-5 mb-2">Fasilitas Offline Training</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <ul>
                                    <li>Meeting room di hotel</li>
                                    <li>Modul pelatihan</li>
                                    <li>Training Kit (Goodie bag dan alat tulis)</li>
                                    <li>Sertifikat</li>
                                    <li>1x Lunch</li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <ul>
                                    
                                    <li>2x Coffe Break</li>
                                    <li>Dokumentasi</li>
                                    <li>Hadiah untuk peserta</li>
                                    <li>Bonus E-book</li>
                                    <li>Bonus Template PPT Premium</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h4 class="fs-5 mb-2">Biaya Online Training Via Zoom Meeting</h4>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Durasi</th>
                                    <th>Peserta</th>
                                    <th>Harga</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1 Hari</td>
                                    <td>20 Peserta</td>
                                    <td>Rp 25 Juta</td>
                                </tr>
                                <tr>
                                    <td>1 Hari</td>
                                    <td>20-40 Peserta</td>
                                    <td>Rp 50 Juta</td>
                                </tr>
                                <tr>
                                    <td>1 Hari</td>
                                    <td>40-60 Peserta</td>
                                    <td>Rp 75 Juta</td>
                                </tr>
                            </tbody>
                        </table>
                        <h4 class="fs-5 mb-2">Fasilitas Online Training</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <ul>
                                    <li>Sertifikat</li>
                                    <li>File Materi</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <a href="{{ route('request.create')}}" class="btn btn-primary">
                DAFTAR SEKARANG
                </a>
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

            $("input[name='jenis']").on("change", function(e){
                e.preventDefault();
                var media = $(this).val();
                if(media == 'Online'){
                    $("#field-peserta").attr('min', 50);
                    $("#field-peserta").val(50);
                    hitungHarga(500000);
                }else{
                    $("#field-peserta").attr('min', 20);
                    $("#field-peserta").val(20);
                    hitungHarga(1250000);
                }
            })

            $("#field-peserta").on("change", function(){
                hitungHarga();
            });

            function hitungHarga(harga){
                var peserta = $('#field-peserta').val();
                if(peserta){
                    $("#showHarga").html(currency(peserta*harga));
                }
            }

            function currency(angka){
                var number_string = angka.toString(),
                split   		= number_string.split(','),
                sisa     		= split[0].length % 3,
                rupiah     		= split[0].substr(0, sisa),
                ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);

                if(ribuan){
                    separator = sisa ? '.' : '';
                    rupiah += separator + ribuan.join('.');
                }

                rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
                return 'Rp ' + rupiah;
            }
        </script>
    @endpush
</x-landing-layout>