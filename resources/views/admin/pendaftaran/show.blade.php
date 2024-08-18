<x-app-layout>
    <div class="content">
        <div class="content-heading d-flex justify-content-between align-items-center">
            <span>Detail Pembayaran</span>
            <div class="space-x-1">
                @if ($data->status == 'Pending')
                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <i class="fa fa-check me-1"></i>
                    Konfirmasi
                  </button>
                @endif
            </div>
        </div>
        <div class="block block-rounded">
            <div class="block-content p-4">
                <div class="row">
                    <div class="col-md-6">
                        <x-field-read label="Nama Peserta" value="{{ $data->user->nama }}"/>
                        <x-field-read label="Training" value="{{ $data->training->nama }}"/>
                        <x-field-read label="Tanggal Daftar" value="{{ \Carbon\Carbon::parse($data->created_at)->translatedFormat('d F Y') }}"/>
                        <x-field-read label="Tanggal Pembayaran" value="{{ \Carbon\Carbon::parse($data->tgl)->translatedFormat('d F Y') }}"/>
                        <x-field-read label="Tujuan Pembayaran" value="{{ $data->bank }}"/>
                        <x-field-read label="Jumlah pembayaran" value="{{ $data->pengirim }}"/>
                        <x-field-read label="A.n Pengirim" value="Rp {{  number_format($data->jumlah,0,',','.') }}"/>
                            
                        <x-field-read label="Status">
                            <x-slot name="value">
                                @if($data->status == 'Belum Bayar')
                                    <span class="badge bg-danger px-3">Belum Bayar</span>
                                @elseif($data->status == 'Pending')
                                <span class="badge bg-warning px-3">Pending</span>
                                @elseif($data->status == 'Diterima')
                                <span class="badge bg-success px-3">Lunas</span>
                                @elseif($data->status == 'Ditolak')
                                <span class="badge bg-danger px-3">Ditolak</span>
                                @else
                                <span class="badge bg-secondary px-3">Batal</span>
                                @endif
                            </x-slot>
                        </x-field-read>

                    </div>
                    <div class="col-md-6">
                        <a href="{{ $data->bukti }}" data-lightbox="image-1" data-title="My caption">
                            <img src="{{ $data->bukti }}" class="w-25"/>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                
                    <div class="block block-rounded shadow-none mb-0">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">Konfirmasi Pembayaran</h3>
                            <div class="block-options">
                                <button
                                    type="button"
                                    class="btn-block-option"
                                    data-bs-dismiss="modal"
                                    aria-label="Close">
                                    <i class="fa fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="block-content">
                            <h3 class="text-center">Pastikan pembayaran sudah sesuai dan diterima</h3>
                        </div>
                        <div class="block-content block-content-full block-content-sm text-end border-top">
                            <form action="{{ route('admin.payment.status', $data->id )}}" method="POST">
                                @csrf
                                <input type="hidden" name="status" value="Lunas"/>
                                <button type="submit" class="btn btn-danger" name="status" value="Ditolak">
                                    Tolak
                                 </button>
                                <button type="submit" value="Diterima" name="status"  class="btn btn-primary">
                                    Terima
                                </button>
                            </form>
                        </div>
                    </div>
            </div>
            </div>
        </div>
    </div>
    @push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/css/lightbox.min.css" integrity="sha512-ZKX+BvQihRJPA8CROKBhDNvoc2aDMOdAlcm7TUQY+35XYtrd3yh95QOOhsPDQY9QnKE0Wqag9y38OIgEvb88cA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    @endpush
    @push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/js/lightbox.min.js" integrity="sha512-Ixzuzfxv1EqafeQlTCufWfaC6ful6WFqIz4G+dWvK0beHw0NVJwvCKSgafpy5gwNqKmgUfIBraVwkKI+Cz0SEQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script>

            $('#field-booking_id').select2({
                dropdownParent: $("#modal-form")
            });

            function addPayment(){
                var modalForm = bootstrap.Modal.getOrCreateInstance(document.getElementById('modal-form'));
                modalForm.show();
            }

            function modalShow(id){
                $.ajax({
                    url: "/admin/pembayaran/"+id,
                    type: "GET",
                    dataType: "html",
                    success: function (response) {
                        var el = document.getElementById('modal-show');
                        $("#detailPembayaran").html(response);
                        var myModal = bootstrap.Modal.getOrCreateInstance(el);
                        myModal.show();
                    },
                    error: function (error) {
                    }

                });
            }
            
            function updateStatus(id, status, booking_id){
                // console.log(status);
                $.ajax({
                    url: "/admin/pembayaran/"+id +"/status",
                    type: "POST",
                    data : {
                        booking_id : booking_id,
                        status : status,
                        _token : $("meta[name='csrf-token']").attr("content"),
                    },
                    success: function (response) {
                        // console.log(response);
                        location.reload();
                        var el = document.getElementById('modal-show');
                        $('.datatable').DataTable().ajax.reload();
                        // $("#detailPembayaran").html(response);
                        var myModal = bootstrap.Modal.getOrCreateInstance(el);
                        myModal.hide();
                    },
                    error: function (error) {
                    }
                });
            }
            
            function hapus(id){
                Swal.fire({
                    icon : 'warning',
                    text: 'Hapus Data?',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: `Tidak, Jangan!`,
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "/admin/pembayaran/"+ id +"/delete",
                            type: "DELETE",
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            success: function(data) {
                                if(data.fail == false){
                                    Swal.fire({
                                        toast : true,
                                        title: "Berhasil",
                                        text: "Data Berhasil Dihapus!",
                                        timer: 1500,
                                        showConfirmButton: false,
                                        icon: 'success',
                                        position : 'top-end'
                                    }).then((result) => {
                                        window.location.replace("{{ route('admin.payment.index') }}");
                                    });
                                }else{
                                    Swal.fire({
                                        toast : true,
                                        title: "Gagal",
                                        text: "Data Gagal Dihapus!",
                                        timer: 1500,
                                        showConfirmButton: false,
                                        icon: 'error',
                                        position : 'top-end'
                                    });
                                }
                            },
                            error: function(jqXHR, textStatus, errorThrown) {
                                    Swal.fire({
                                        toast : true,
                                        title: "Gagal",
                                        text: "Terjadi Kesalahan Di Server!",
                                        timer: 1500,
                                        showConfirmButton: false,
                                        icon: 'error',
                                        position : 'top-end'
                                    });
                            }
                        });
                    }
                })
            }
        </script>
    @endpush

</x-app-layout>

