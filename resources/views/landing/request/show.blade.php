<x-landing-layout>
    <div class="bg-primary">
        <div class="content text-center">
            <div class="pt-5 pb-5">
                <h1 class="h2 fw-bold text-white mb-2">Detail Pengajuan</h1>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="block block-rounded">
            <div class="block-content p-3 text-center">
                @if($data->status == 'Pending')
                <h2>Terima kasih!</h2>
                <p>Pengajuan program kelas Anda telah berhasil kami terima. Tim kami akan segera memproses pengajuan Anda dan menghubungi Anda dalam waktu 2-3 hari kerja</p>
                @elseif($data->status == 'Disetujui' && $data->pembayaran->count() == 0)
                <h2>Selamat!</h2>
                <p>Selamat pengajuan program in house kamu telah disetujui. Segera lakukan pembayaran ke nomor rekening berikut</p>
                <div class="row justify-content-center">
                    @foreach ($bank as $d)
                    <div class="col-3">
                        <div class="block border border-3 rounded-3 mb-2">
                            <div class="block-content p-3 text-center">
                                <div class="g-2 row">
                                    <div class="col-5 d-flex">
                                        <div class="my-auto">
                                            
                                        <img src="{{ $d['img'] }}" class="w-75">
                                        </div>
                                    </div>
                                    <div class="col-7">
                                        <div class="fs-base fw-bold">{{ $d['rek'] }}</div>
                                        <div class="fs-sm">A.n {{ $d['an'] }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modalBayar">
                    <i class="fa fa-check me-1"></i>
                    Konfirmasi Pembayaran
                  </button>
                @endif
            </div>
            <div class="block-content p-4">
                <div class="row">
                    <div class="col-md-6">
                        <x-field-read label="Konsumen" value="{{ $data->user->nama }}"/>
                        <x-field-read label="Instansi" value="{{ $data->instansi }}"/>
                        <x-field-read label="Tanggal Pengajuan" value="{{ \Carbon\Carbon::parse($data->created_at)->translatedFormat('d F Y') }}"/>
                            <x-field-read label="Jenis" value="{{ $data->jenis }}"/>
                        <x-field-read label="Program Kelas" value="{{ $data->program->nama }}"/>         
                    </div>
                    <div class="col-md-6">               
                        <x-field-read label="Tanggal Training" value="{{ \Carbon\Carbon::parse($data->tgl)->translatedFormat('d F Y H:i') }} WIB"/>
                        <x-field-read label="Peserta" value="{{ $data->peserta }}"/>
                        <x-field-read label="Lokasi" value="{{ $data->lokasi }}"/>
                        <x-field-read label="Kota" value="Kota Bandung"/>
                        <x-field-read label="Harga" value="Rp {{ number_format($data->harga,0,',','.') }}"/>
                    </div>
                </div>
            </div>
        </div>
        @if ($data->status == 'Disetujui' && $data->pembayaran->count())
        <div class="content-heading d-flex justify-content-between align-items-center pt-0">
            <span>Pembayaran</span>
            <div class="space-x-1">
            </div>
        </div>
        <div class="block block-rounded">
            <div class="block-content p-3">
                <table class="table table-bordered datatable w-100">
                    <thead>
                        <tr>
                            <th width="60px">No</th>
                            <th>Tanggal</th>
                            <th>Jumlah</th>
                            <th>Bank Tujuan</th>
                            <th>Pengirim</th>
                            <th>Status</th>
                            <th width="100px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data->pembayaran as $d)
                        <tr>
                            <td>{{ $loop->index+1 }}</td>
                            <td>{{ \Carbon\Carbon::parse($d->tgl)->translatedFormat('d F Y') }}</td>
                            <td>
                                Rp {{ number_format($d->jumlah,0,',','.') }}
                            </td>
                            <td>
                                {{ $d->bank }}
                            </td>
                            <td>
                                {{ $d->pengirim }}
                            </td>
                            <td>
                                @if ($d->status == 'Pending')
                                    <span class="badge bg-warning">Diterima</span>
                                @elseif ($d->status == 'Disetujui')
                                    <span class="badge bg-success">Disetujui</span>
                                @elseif ($d->status == 'Ditolak')
                                    <span class="badge bg-danger">Ditolak</span>
                                @endif
                            </td>
                            <td>
                                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modalDetail">
                                    Detail
                                  </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif
    </div>
    <div class="modal fade" id="modalBayar" tabindex="-1" aria-labelledby="modalBayarLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form id="formData" onsubmit="return false;" enctype="multipart/form-data">
                    <div class="block block-rounded shadow-none mb-0">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">Konfirmasi Pembayaran</h3>
                            <div class="block-options">
                                <button type="button" class="btn-block-option" data-bs-dismiss="modal"
                                    aria-label="Close">
                                    <i class="fa fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="block-content">
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <x-input-field type="text" id="nama" name="nama" label="Nama Pengirim" isAjax required/>
                                    <x-select-field id="bank" name="bank" label="Rekening Tujuan" isAjax :options="[
                                        ['value' => 'BCA', 'label' => 'Bank BCA'],
                                        ['value' => 'BNI', 'label' => 'Bank BNI'],
                                        ['value' => 'Mandiri', 'label' => 'Bank Mandiri'],
                                    ]" />
                                    <div class="mb-4">
                                        <label class="form-label" for="field-bukti">Bukti Bayar</label>
                                        <input class="form-control" type="file" name="bukti" id="field-bukti">
                                        <div class="invalid-feedback" id="error-bukti">Invalid feedback</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <x-input-field type="text" id="tgl" name="tgl" isAjax label="Tanggal Kirim" required/>
                                    <x-input-field type="number" id="jumlah" name="jumlah" isAjax max="{{ $data->harga }}" value="{{ $data->harga }}" label="Jumlah Bayar" required/>
                                </div>
                            </div>
                        </div>
                        <div class="block-content block-content-full block-content-sm text-end border-top">
                            <button type="button" class="btn btn-alt-danger" data-bs-dismiss="modal">
                                <i class="fa fa-times me-1"></i>
                                Batal
                            </button>
                            <button type="submit" class="btn btn-alt-primary" id="btn-simpan">
                                <i class="fa fa-check me-1"></i>
                                Kirim
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @push('styles')
    @endpush
    @push('scripts')
<script>
    
    $("#field-tgl").flatpickr({
                altInput: true,
                altFormat: "j F Y",
                dateFormat: "Y-m-d",
                locale : "id",
                defaultDate : new Date(),
                enableTime: false,
                time_24hr: true
            });

            $(document).ready(function() {
                $('#field-jumlah').on('input', function() {
                    var max = $(this).attr('max');
                    if (parseInt($(this).val()) > parseInt(max)) {
                        $(this).val(max);
                    }
                });
            });
    $("#formData").on("submit",function (e) {
            e.preventDefault();
            var fomr = $('form#formData')[0];
            var formData = new FormData(fomr);
            let token   = $("meta[name='csrf-token']").attr("content");
            formData.append('_token', token);

            $.ajax({
                url: "{{ route('user.request.bayar', $data->id )}}",
                type: "POST",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response.fail == false) {
                        window.location.reload();
                    } else {
                        for (control in response.errors) {
                            $('#field-' + control).addClass('is-invalid');
                            $('#error-' + control).html(response.errors[control]);
                        }
                    }
                },
                error: function (error) {
                }

            });

        });
    </script>
    @endpush

</x-landing-layout>

