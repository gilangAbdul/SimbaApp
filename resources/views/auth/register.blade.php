<x-guest-layout>
            <form method="POST" action="{{ route('register') }}" class="space-y-2 md:space-y-4">
                @csrf
                <div class="py-3 mb-5 text-center">
                    <h1
                        class="text-xl font-bold leading-tight tracking-tight text-gray-700 md:text-xl dark:text-white">
                        Register Your Account
                    </h1>
                </div>
                <!-- Nama -->
                <div class="mt-2">
                    <x-input-label for="name" :value="__('Nama')" />
                    <x-text-input id="name" class="block mt-1 w-full bg-slate-50" type="text" name="name" :value="old('name')" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>
                <div class="flex space-x-4">
                    <div class="flex-1">
                        <x-input-label for="nip" :value="__('NIP')" class="block mb-2 text-sm font-medium text-gray-700"/>
                        <x-text-input id="nip" class="bg-slate-50 border border-gray-300 text-gray-700 sm:text-sm rounded-lg
                        focus:ring-blue-400 focus:border-blue-400
                        block w-full p-2.5" type="text" name="nip" :value="old('nip')" required/>
                        <x-input-error :messages="$errors->get('nip')" class="mt-2" />
                    </div>
                    <div class="flex-1">
                        <label for="position" class="block mb-2 text-sm font-medium text-gray-700 ">Divisi</label>
                        <select required name="position" id="position" class="bg-slate-50 border border-gray-300 text-gray-700 mb-3 text-sm rounded-lg focus:ring-blue-400 focus:border-blue-400 block w-full p-2.5">
                            <option selected>Pilih Bagian</option>
                            @foreach ($divisis as $divisi)
                                <option value="{{ $divisi->id }}">{{ $divisi->nama_divisi }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Email Address -->
                <div class="mt-2">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 bg-slate-50 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-2">
                    <x-input-label for="password" :value="__('Password')" />

                    <x-text-input id="password" class="block mt-1 bg-slate-50 w-full"
                                    type="password"
                                    name="password"
                                    required autocomplete="new-password" />

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div class="mt-2">
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                    <x-text-input id="password_confirmation" class="block mt-1 bg-slate-50 w-full"
                                    type="password"
                                    name="password_confirmation" required autocomplete="new-password" />

                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <p class="text-sm font-light text-center text-gray-400 dark:text-gray-400">
                    Jika Anda telah mempunyai akun <a href="{{ route('login') }}"
                        class="font-medium text-green-600 hover:underline dark:text-blue-400">Masuk disini</a>
                        untuk login
                </p>

                <x-primary-button class=" justify-center w-full text-white bg-green-600 hover:bg-green-200 hover:text-green-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5">
                    {{ __('Create Account') }}
                </x-primary-button>
            </form>
</x-guest-layout>
