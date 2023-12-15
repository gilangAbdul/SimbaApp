<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Untuk mengamankan aplikasimu. Konfirmasi kembali password kamu untuk melanjutkan.') }}
    </div>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex justify-end mt-4">
            <button type="submit" class="justify-center text-white bg-green-600 hover:bg-green-200 hover:text-green-600 focus:ring-2 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                {{ __('Confirm Password') }}
            </button>
        </div>
    </form>
</x-guest-layout>
