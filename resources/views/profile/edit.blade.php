<x-app-layout>
    @if (str_contains(URL::previous(), 'petugas'))
        @include('petugas.layouts.sidebar')
    @elseif (str_contains(URL::previous(), 'pegawai'))
        @include('pegawai.layouts.sidebar')
    @else
        @include('dashboard.layouts.sidebar')
    @endif
    <input type="text" id="url" class="hidden" value="{{ URL::previous() }}">
    <div class="p-6 lg:ml-64 bg-zinc-100 min-h-screen h-fit">
        <div class="p-2 rounded-lg mt-14 space-y-4 font-inter">
            <div class="p-4 sm:p-8 bg-white shadow rounded-xl sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>
            <div class="p-4 sm:p-8 bg-white shadow rounded-xl sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>
            <div class="p-4 sm:p-8 bg-white shadow rounded-xl sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

