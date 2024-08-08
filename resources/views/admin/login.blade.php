<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1.0">

        <title>Login Admin - Persona Public Speaking</title>

        <meta name="description" content="Persona Public Speaking">
        <meta name="robots" content="noindex, nofollow">
        <!-- Stylesheets -->
        <!-- Codebase framework -->
        <link rel="stylesheet" id="css-main" href="/css/codebase.min.css">
        @vite(['resources/sass/main.scss', 'resources/js/codebase/app.js',
        'resources/js/app.js'])
    </head>

    <body>
        <div id="page-container" class="main-content-boxed">

            <!-- Main Container -->
            <main id="main-container">
                <!-- Page Content -->
                    <div class="row mx-0 justify-content-center">
                        <div class="hero-static col-lg-6 col-xl-5">
                            <div class="content content-full overflow-hidden">
                                <!-- Header -->
                                <!-- END Header -->
                                <div class="block block-rounded mt-md-5">
                                    <div class="block-content">
                                        <div class="py-4 text-center">
                                            <img src="/images/logo.png" width="200px">
                                        </div>
                                        <h1 class="h4 fw-bold mt-0 mb-2">Login Sekarang</h1>
                                        <form method="POST" action="{{ route('admin.login') }}">
                                            @csrf
                                            <div class="mb-4">
                                                <label class="form-label" for="val-email">Alamat Email
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <input type="text" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" id="val-email" name="email" placeholder="Masukan Email">
                                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                            </div>
                                            <div class="mb-4">
                                                <label class="form-label" for="val-password">Password
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <input type="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" id="val-password" name="password" placeholder="Masukan password">
                                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                            </div>
                                            <div class="mb-4">
                                            <button type="submit" class="btn btn-lg btn-alt-primary fw-medium w-100">
                                                Login
                                            </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <!-- END Sign Up Form -->
                            </div>
                        </div>
                    </div>
                <!-- END Page Content -->
            </main>
            <!-- END Main Container -->
        </div>
        <!-- END Page Container -->
    </body>
</html>