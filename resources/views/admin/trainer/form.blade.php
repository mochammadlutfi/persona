<x-app-layout>
    @push('styles')
    @endpush

    <div class="content">
        <form method="POST" action="{{ route('admin.trainer.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="content-heading d-flex justify-content-between align-items-center">
                <span>Tambah Peserta Baru</span>
                <div class="space-x-1">
                </div>
            </div>
            <div class="block block-rounded">
                <div class="block-content p-4">
                    <div class="row">
                        <div class="col-md-6">
                            <x-input-field id="nama" name="nama" label="Nama"/>
                            <x-input-field type="file" id="foto" name="foto" label="Foto"/>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label for="field-biografi">Biografi</label>
                                <textarea name="biografi" id="field-biografi" rows="5" class="form-control  {{ $errors->has('biografi') ? 'is-invalid' : '' }}">{{ old('biografi') }}</textarea>
                                <x-input-error :messages="$errors->get('biografi')" class="mt-2" />
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        Simpan
                    </button>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script src="/js/plugins/flatpickr/flatpickr.min.js"></script>
    <script src="/js/plugins/flatpickr/l10n/id.js"></script>
    <script src="/js/plugins/ckeditor5-classic/build/ckeditor.js"></script>
    <script>
        
        $("#field-tgl_lahir").flatpickr({
            altInput: true,
            altFormat: "d M Y",
            dateFormat: "Y-m-d",
            locale : "id",
        });
    </script>
    @endpush
</x-app-layout>

