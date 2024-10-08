@props([
    'id' => '',
    'data' => null
])

<div class="modal" id="{{ $id }}" aria-labelledby="{{ $id }}" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="block block-rounded shadow-none mb-0">
                <div class="block-header bg-body">
                    <h3 class="block-title ">Detail Pembayaran</h3>
                    <div class="block-options">
                        <button type="button" class=" btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <div class="row">
                        <div class="col-md-6">
                            <x-field-read label="Tanggal" value="{{ \Carbon\Carbon::parse($data->created_at)->translatedFormat('d F Y') }}"/>
                            <x-field-read label="Tujuan Bayar" value="{{ $data->bank }}"/>
                            <x-field-read label="Nama Pengirim" value="{{ $data->pengirim }}"/>
                            <x-field-read label="Jumlah Bayar" value="Rp {{  number_format($data->jumlah,0,',','.') }}"/>
                                
                            <x-field-read label="Status">
                                <x-slot name="value">
                                    @if($data->status == 'Belum Bayar')
                                        <span class="badge bg-danger px-3">Belum Bayar</span>
                                    @elseif($data->status == 'Pending')
                                    <span class="badge bg-warning px-3">Pending</span>
                                    @elseif($data->status == 'Disetujui')
                                    <span class="badge bg-success px-3">Diterima</span>
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
                @if($data->status == 'Disetujui')
                
                    @if(request()->is('admin/*'))
                    <div class="block-content block-content-full block-content-sm text-end border-top">
                        <a  class="btn btn-primary px-4" href="{{ route('admin.request.kwitansi', $data->id) }}">
                            Kwitansi
                        </a>
                    </div>
                    @else
                    <div class="block-content block-content-full block-content-sm text-end border-top">
                        <a  class="btn btn-primary px-4" href="{{ route('user.request.kwitansi', $data->id) }}">
                            Kwitansi
                        </a>
                    </div>
                    @endif
                @endif

                @if ($data->status != 'Disetujui' && request()->is('admin/*'))
                <form method="POST" action="{{ route('admin.request.bayar', $data->id)}}">
                    @csrf
                    <div class="block-content block-content-full block-content-sm text-end border-top">
                        <button type="submit" name="status" value="Ditolak" class="btn btn-alt-danger px-4 rounded-pill" data-bs-dismiss="modal">
                            <i class="fa fa-times me-1"></i>
                            Tolak
                        </button>
                        <button type="submit" name="status" value="Disetujui" class="btn btn-alt-primary px-4 rounded-pill" id="btn-simpan">
                            <i class="fa fa-check me-1"></i>
                            Terima
                        </button>
                    </div>
                </form>
                @endif
            </div>
        </div>
    </div>
</div>