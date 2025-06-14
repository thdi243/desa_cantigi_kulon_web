<x-guest-layout>
    @section('title', 'Login | ' . config('app.name'))
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="text-center flex flex-col items-center justify-center mb-8">
        {{-- <img src="{{ asset('images/logo/logo_desa.png') }}" class="w-15 mx-auto mb-5" alt=""> --}}
        <h2 class="text-3xl font-bold text-gray-800">Selamat Datang!</h2>
        <p class="text-gray-600 mt-2">Silakan masuk ke akun Anda</p>
    </div>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div class="mb-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email"
                class="block mt-1 w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mb-4">
            <x-input-label for="password" :value="__('Kata Sandi')" />

            <x-text-input id="password"
                class="block mt-1 w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                type="password" name="password" required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me & Forgot Password -->
        {{-- <div class="flex items-center justify-between mb-4">
            <div class="flex items-center justify-center">
                <label for="remember_me" class="ml-2 block text-sm text-gray-700">
                    <input id="remember_me" type="checkbox"
                        class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                    <span class="ms-2 text-sm text-gray-600">{{ __('Ingat saya') }}</span>
                </label>
            </div>

            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    href="{{ route('password.request') }}">
                    {{ __('Lupa kata sandi Anda?') }}
                </a>
            @endif

        </div> --}}

        <!-- Submit Button -->
        <div>
            <x-primary-button
                class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                {{ __('Masuk') }}
            </x-primary-button>
        </div>
        <div class="px-8 py-4 bg-gray-50 border-t border-gray-100 flex justify-center">
            <p class="text-sm text-gray-600">
                Belum punya akun?
                <a href="{{ route('register') }}" class="font-medium text-indigo-600 hover:text-indigo-500">
                    Daftar
                </a>
            </p>
        </div>
    </form>
</x-guest-layout>
