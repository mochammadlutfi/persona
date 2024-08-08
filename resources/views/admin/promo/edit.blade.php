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
        <form method="POST" action="{{ route('admin.promo.update', $data->id) }}" enctype="multipart/form-data">
            @csrf
            <div class="content-heading d-flex justify-content-between align-items-center">
                <span>Tambah Promo</span>
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
                            <x-input-field type="text" id="nama" name="nama" label="Nama" value="{{ $data->nama }}" :required="true"/>
                            <div class="mb-4">
                                <label for="field-deskripsi">Deskripsi</label>
                                <textarea class="form-control {{ $errors->has('deskripsi') ? 'is-invalid' : '' }}"
                                    id="field-deskripsi" name="deskripsi"
                                    placeholder="Masukan deskripsi">{{ old('deskripsi', $data->nama) }}</textarea>
                                <x-input-error :messages="$errors->get('deskripsi')" class="mt-2" />
                            </div>
                        </div>
                        <div class="col-4">
                            <x-input-field type="text" id="tgl" name="tgl" label="Periode Tgl" value="{{ $data->tgl }}" :required="true"/>
                        
                            <div class="mb-3">
                                <label>Foto</label>
                                <img id="preview" src="{{ $data->foto }}" alt="Foto" class="img-fluid mb-2" style="display:block;"/>
                                <input type="file" class="form-control" name="foto" @error('image') is-invalid @enderror id="selectImage">
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
        
        $("#field-tgl").flatpickr({
            altInput: true,
            altFormat: "d M Y",
            dateFormat: "Y-m-d",
            locale : "id",
            mode: "range"
        });


    </script>
    @endpush
</x-app-layout>

