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
            <div class="block-content p-4">
                <form method="post" action="{{ route('request.store') }}">
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <x-input-field type="text" id="instansi" name="instansi" label="Instansi" required/>
                            <x-select-field id="program" name="program" label="Program" :options="$program" />
                            <x-input-field type="text" id="tgl" name="tgl" label="Tanggal Training" required/>
                        </div>
                        <div class="col-6">
                            <div class="mb-4">
                                <label class="form-label">Media Training</label>
                                <div class="space-x-2 py-2">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" id="jenis-offline"
                                            name="jenis" value="Offline" checked="">
                                        <label class="form-check-label" for="jenis-offline">Offline</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" id="jenis-online"
                                            name="jenis" value="Online">
                                        <label class="form-check-label" for="jenis-online">Online</label>
                                    </div>
                                </div>
                            </div>
                            <x-input-field type="number" id="peserta" name="peserta" label="Jumlah Peserta" value="20" min="20" required/>
                            <div class="mb-4">
                                <label>Harga</label>
                                <div class="fw-bold py-2" id="showHarga">Rp. {{ number_format(20*1250000,0,',','.') }}</div>
                                <input type="hidden" name="harga" value="{{ 20*1250000 }}"/>
                            </div>
                        </div>
                    </div>
                    <x-input-field type="text" id="lokasi" name="lokasi" label="Lokasi Training" required/>
                    <button type="submit" class="btn btn-primary">
                        Simpan
                    </button>
                </form>
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