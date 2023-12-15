<x-guest-layout>
    <div class="w-96">
        <div class="mb-4 lg:w96 text-sm text-gray-600">
            {{ __('Anda Lupa Password? Tidak Masalah. Isi email terdaftarmu di bawah ini untuk mereset password Anda.') }}
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="flex items-center justify-center mt-4">
                <button type="submit" class="justify-center text-white bg-green-600 hover:bg-green-200 hover:text-green-600 focus:ring-2 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                    {{ __('Kirim Reset Password') }}
                </button>
            </div>
        </form>
    </div>
</x-guest-layout>
