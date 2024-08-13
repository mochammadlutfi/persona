<x-app-layout>
    <div class="content">
        <div class="content-heading d-flex justify-content-between align-items-center">
            <span>Ubah Profil</span>
            <div class="space-x-1">
            </div>
        </div>
        <div class="block block-rounded">
            <div class="block-content p-3">
                <form method="post" action="{{ route('admin.profil.edit') }}">
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <x-input-field type="text" id="nama" name="nama" label="Nama" :required="true" value="{{ $data->nama }}"/>

                        </div>
                        <div class="col-6">
                            <x-input-field type="text" id="email" name="email" label="Email" :required="true" value="{{ $data->email }}"/>

                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        Simpan
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>