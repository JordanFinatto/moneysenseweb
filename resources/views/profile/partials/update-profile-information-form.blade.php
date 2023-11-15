<section>
    <header>
        <h2 class="text-lg font-medium text-gray-500">
            {{ __('Informações de perfil') }}
        </h2>

        <p class="mt-1 text-sm text-gray-500">
            {{ __("Altere seu nome de perfil ou e-mail.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="nome" :value="__('Name')"/>
            <x-text-input id="nome" name="nome" type="text" class="mt-1 block w-full" :value="old('nome', $usuario->nome)" required autofocus autocomplete="nome"/>
            <x-input-error class="mt-2" :messages="$errors->get('name')"/>
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')"/>
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $usuario->email)" required autocomplete="username"/>
            <x-input-error class="mt-2" :messages="$errors->get('email')"/>

            @if ($usuario instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $usuario->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-500">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-500 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-success-button>{{ __('Salvar') }}</x-success-button>

            @if (session('status') === 'profile-updated')
                <script>
                    toastr.success("Perfil salvo com sucesso!");
                </script>
            @endif
        </div>
    </form>


</section>
