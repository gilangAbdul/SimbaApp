<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="py-3 mb-5 text-center">
            <h1
                class="text-xl font-bold leading-tight tracking-tight text-gray-700 md:text-xl dark:text-white">
                Sign in to your account
            </h1>
        </div>
        <!-- Email Address -->
        <div>
            {{-- {{ $_COOKIE['email'] }} --}}
            <x-input-label for="email" :value="__('Email')" />
            @if(isset($_COOKIE['email']))
            <x-text-input id="email" class="mt-2 bg-gray-50 border border-gray-300 text-gray-800 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" type="email" name="email" value="{{ $_COOKIE['email'] }}" required autofocus autocomplete="username" />
            @else
            <x-text-input id="email" class="mt-2 bg-gray-50 border border-gray-300 text-gray-800 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            @endif
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            @if(isset($_COOKIE['password']))
            <x-text-input id="password" class="mt-2 password bg-gray-50 border border-gray-300 text-gray-800 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            type="password"
                            name="password"
                            value="{{ $_COOKIE['password'] }}"
                            required autocomplete="current-password" />
            @else
            <x-text-input id="password" class="mt-2 password bg-gray-50 border border-gray-300 text-gray-800 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />
            @endif
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex flex-col gap-5 items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}"
                class="text-sm font-medium text-green-600 hover:underline dark:text-blue-500">Forgot
                password?</a>
            @endif

            <x-primary-button class="w-full justify-center text-white bg-green-600 hover:bg-green-200 hover:text-green-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                {{ __('Sign In') }}
            </x-primary-button>
            <p class="text-sm text-center font-light text-gray-500 dark:text-gray-400">
                Silakan lakukan <a href="/register"
                    class="font-medium text-green-600 hover:underline dark:text-blue-500">registrasi</a>
                apabila ingin melakukan permintaan barang.
            </p>
        </div>
    </form>
</x-guest-layout>
