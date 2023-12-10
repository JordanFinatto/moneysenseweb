<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'MoneySense') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet">

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.6/jquery.inputmask.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        @vite(['resources/scss/app.scss', 'resources/js/app.js', 'resources/css/custom.css'])
    </head>

    <body class="d-flex flex-column min-h-screen font-sans antialiased">
        @include('layouts.navigation')

        <div class="flex flex-nowrap h-full" style="flex: 1">
            <div class="d-flex bg-gray-200 items-start w-72 border-r-2 dark:border-gray-700">
                <div class="d-flex flex-column w-100">
                    <button type="button" class="btn-menu text-left" onclick="window.location='{{route("topico.listagem")}}'" style="border-top: 1px solid #545662">
                        <i class="fa-solid fa-book mr-2 ml-4"></i>
                        {{__('Tópicos')}}
                    </button>

                    <button type="button" class="btn-menu text-left" onclick="window.location='{{route("orientador.listagem")}}'">
                        <i class="fa-solid fa-user-graduate mr-2 ml-4"></i>
                        {{__('Orientadores')}}
                    </button>

                    <button type="button" class="btn-menu text-left" onclick="window.location='{{route("usuario.listagem")}}'">
                        <i class="fa-solid fa-user mr-2 ml-4"></i>
                        {{__('Usuários')}}
                    </button>
                </div>
            </div>

            <main class="w-full dark:bg-gray-100">
                <header class="header-main dark:bg-gray-800 shadow">
                    @if (isset($header))
                        <div class="my-auto">
                            <h2 class="font-semibold text-xl text-gray-600 leading-tight">
                                {{ $header }}
                            </h2>
                        </div>
                    @endif

                    @if (isset($headerButton))
                        <div class="my-auto">
                            {{$headerButton}}
                        </div>
                    @endif
                </header>

                {{ $slot }}
            </main>
        </div>
    </body>

    @if(session()->has('sucesso'))
        <script>
            toastr.success("{{session()->get('sucesso')}}");
        </script>
    @elseif($errors->any())
        <script>
            toastr.error("{{$errors->first()}}");
        </script>
    @endif

    <script>
        (() => {
            const forms = document.querySelectorAll('.needs-validation');

            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                        form.classList.add('was-validated');
                        toastr.error("Preencha todos os campos obrigatórios!");
                    }
                }, false);
            });
        })();

        // $(document).ready(function(){
        //     $('#telefone').inputmask('(99) 99999-9999');
        // });
    </script>
</html>
