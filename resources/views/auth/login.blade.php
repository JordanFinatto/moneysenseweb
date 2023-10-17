<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')"/>

    <div class="bg-image min-h-screen">
        <div class="flex flex-col items-center sm:justify-center">
            <div class="w-full sm:max-w-md mt-40 px-6 py-4 dark:bg-gray-800 sm:rounded-lg opacity-95">

                <div class="flex justify-center mb-10 mt-5">
                    <x-application-logo class="w-20 h-20 fill-current text-gray-500"/>
                </div>

                <form method="POST" action="{{ route('login') }}" class="">
                    @csrf

                    <div>
                        <x-input-label for="usuario_email" :value="__('Email')"/>
                        <x-text-input
                            id="usuario_email"
                            name="usuario_email"
                            class="block mt-1 w-full" type="email"
                            :value="old('usuario_email')"
                            required autofocus autocomplete="username"
                        />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="password" :value="__('Senha')"/>
                        <x-text-input
                            id="usuario_senha"
                            class="block mt-1 w-full"
                            type="password"
                            name="usuario_senha"
                            required autocomplete="current-password"
                        />
                    </div>

                    <div class="flex items-center justify-end w mt-3">
                        <x-primary-button>
                            {{ __('Entrar') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    @if($errors->any())
        @foreach($errors->all() as $error)
            <script>
                toastr.error("Email ou senha incorretos!");
            </script>
        @endforeach
    @endif
</x-guest-layout>
