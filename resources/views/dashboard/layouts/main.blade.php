<x-app-layout>
    @include('dashboard.layouts.sidebar')
    <div class="p-6 sm:py-6 sm:mx-auto">
        <div class="p-2 lg:ml-64 rounded-lg mt-14 space-y-4 font-inter">
            <div class="text-base sm:text-lg md:text-xl lg:text-2xl text-gray-700 ">
                @yield('menu')
            </div>
            <div class="flow-root mr-8 sm:mr-16">
                <div class="text-gray-400 font-normal mb-2">
                    @yield('title_card')
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 sm:gap-4 gap-6 lg:pr-20">
                    @yield('card')
                </div>
            </div>
            <div class="flex items-center pt-4 h-max mb-4 w-full rounded ">
                @yield('content')
            </div>
            <div class="grid gap-4 mb-4 w-full">
                @yield('desk_content')
            </div>
        </div>
        @yield('script')
    </div>
</x-app-layout>
