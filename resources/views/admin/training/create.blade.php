<x-app-layout>

    @push('styles')
    <link rel="stylesheet" href="/js/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="/js/plugins/flatpickr/flatpickr.min.css">
    <style>
        .ck-editor__editable_inline {
            min-height: 400px;
        }
    </style>
    @endpush

    <div class="content">
        <form method="POST" action="{{ route('admin.training.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="content-heading d-flex justify-content-between align-items-center">
                <span>{{ isset($data) ? 'Edit Training' : 'Tambah Training' }}</span>
                <div class="space-x-1">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-check me-1"></i>
                        Simpan
                    </button>
                </div>
            </div>
            <div class="block block-rounded">
                <div class="block-content">
                    <div class="row">
                        <div class="col-8">
                            <x-input-field type="text" id="nama" name="nama" label="Nama Training" :required="true"/>
                            <div class="mb-4">
                                <label class="form-label">Jenis Training</label>
                                <div class="space-x-2">
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
                            <x-input-field type="text" id="lokasi" name="lokasi" label="Lokasi Training" :required="true"/>
                            <div class="mb-4">
                                <label for="field-deskripsi">Deskripsi</label>
                                <textarea class="form-control {{ $errors->has('deskripsi') ? 'is-invalid' : '' }}"
                                    id="field-deskripsi" name="deskripsi"
                                    placeholder="Masukan deskripsi">{{ old('deskripsi') }}</textarea>
                                <x-input-error :messages="$errors->get('deskripsi')" class="mt-2" />
                            </div>
                        </div>
                        <div class="col-4">
                            <x-input-field type="number" id="kuota" name="kuota" label="Jumlah Peserta" :required="true"/>
                            <x-input-field type="text" id="tgl_daftar" name="tgl_daftar" label="Periode Tgl Pendaftaran" :required="true"/>
                            <x-input-field type="text" id="tgl_training" name="tgl_training" label="Periode Tgl Training" :required="true"/>
                            <div class="mb-4">
                                <label for="field-harga">Harga</label>
                                <input type="number" name="harga" class="form-control  {{ $errors->has('harga') ? 'is-invalid' : '' }}" value="{{ old('harga') }}">
                                <x-input-error :messages="$errors->get('harga')" class="mt-2" />
                            </div>
                            <div class="mb-4">
                                <label for="field-status">Status</label>
                                <select class="form-select {{ $errors->has('status') ? 'is-invalid' : '' }}"
                                    id="field-status" style="width: 100%;" name="status" data-placeholder="Pilih Status">
                                    <option value="draft">Draft</option>
                                    <option value="buka">Dibuka</option>
                                    <option value="penuh">Penuh</option>
                                    <option value="tutup">Tutup</option>
                                </select>
                                <x-input-error :messages="$errors->get('status')" class="mt-2" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>


    @push('scripts')
    <script src="/js/plugins/select2/js/select2.full.min.js"></script>
    <script src="/js/plugins/flatpickr/flatpickr.min.js"></script>
    <script src="/js/plugins/flatpickr/l10n/id.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/38.1.1/classic/ckeditor.js"></script>
    <script>
        

        ClassicEditor
        .create( document.querySelector('#field-deskripsi'))
        .catch( error => {
            console.error( error );
        } );
        
        $('#field-kategori').select2();
        $('#field-jadwal').select2({
            multiple : true,
        });
        
        $(".tgl").flatpickr({
            altInput: true,
            altFormat: "j F Y H:i",
            dateFormat: "Y-m-d H:i",
            locale : "id",
            enableTime: true,
            time_24hr: true
        });

        
        $("#field-tgl_daftar").flatpickr({
            altInput: true,
            altFormat: "d M Y",
            dateFormat: "Y-m-d",
            locale : "id",
            mode: "range"
        });

        
        $("#field-tgl_training").flatpickr({
            altInput: true,
            altFormat: "d M Y",
            dateFormat: "Y-m-d",
            locale : "id",
            mode: "range"
        });


        $(".time").flatpickr({
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
            time_24hr: true
        });


    </script>
    @endpush
</x-app-layout>

