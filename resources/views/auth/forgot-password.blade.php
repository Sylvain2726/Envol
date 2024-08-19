<x-guest-layout>
    <a href="/" class="flex justify-center items-center mb-4">
        <x-application-logo class="w-10 h-10 fill-current text-gray-500"/>
    </a>

    <div class="mb-4 text-sm  text-white">
        {{ __('Vous avez oublié votre mot de passe ? Pas de problème. Indiquez-nous simplement votre adresse email et nous vous enverrons un lien de réinitialisation de mot de passe qui vous permettra d\'en choisir un nouveau.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <x-input-label class="text-white" for="email" :value="__('Email')"/>
        <x-text-input class="bg-gradient-to-br to-sky-800 shadow-lg shadow-inherit placeholder-blue-950" type="email"
                 name="email"
                 id="email"
                 value="{{ old('email') }}"
                 required
                 autofocus
        />
        <x-input-error :messages="$errors->get('email')" class="mt-2" />

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="w-full bg-white  shadow-sm shadow-black hover:scale-105">
                <samp class="text-black">{{ __('Email Password Reset Link') }}</samp>
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
