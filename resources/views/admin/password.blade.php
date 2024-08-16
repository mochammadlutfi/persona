<x-app-layout>
    <div class="content">
        <div class="content-heading d-flex justify-content-between align-items-center">
            <span>Ubah Password</span>
            <div class="space-x-1">
            </div>
        </div>
        <div class="block block-rounded">
            <div class="block-content p-3">
                <form method="POST" action="{{ route('admin.profil.password') }}">
                    @csrf
                    <div class="row mb-4">
                        <label class="col-sm-3 col-form-label" for="field-password">Password</label>
                        <div class="col-sm-6">
                            <input type="password"
                                class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                                id="field-password" name="password" placeholder="Masukan Password">
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label class="col-sm-3 col-form-label" for="field-password_confirmation ">Konfirmasi
                            Password</label>
                        <div class="col-sm-6">
                            <input type="password"
                                class="form-control {{ $errors->has('password_confirmation ') ? 'is-invalid' : '' }}"
                                id="field-password_confirmation " name="password_confirmation"
                                placeholder="Masukan Konfirmasi Password">
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-lg btn-alt-primary fw-medium">
                        Simpan
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>