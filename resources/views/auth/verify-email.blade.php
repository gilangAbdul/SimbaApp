<x-guest-layout>
    <div class="mb-4 text-sm lg:w-96 text-gray-600">
        {{ __('Terima Kasih Anda telah melakukan signing up! Sebelumnya, lakukan verifikasi email kamu dengan klik link
        yang telah kami kirimkan ke email kamu. Kamu tidak mendapatkan email verifikasi? Klik tombol dibawah ini untuk mendapatkan email verifikasi kembali.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ __('Link verifikasi baru telah kami kirimkan ke alamat email Anda.') }}
        </div>
    @endif

    <div class="mt-4 flex items-center justify-between">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <div>
                <button type="submit" class="justify-center text-white bg-green-600 hover:bg-green-200 hover:text-green-600 focus:ring-2 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                    {{ __('Resend Email Verification') }}
                </button>
            </div>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                {{ __('Log Out') }}
            </button>
        </form>
    </div>
</x-guest-layout>
