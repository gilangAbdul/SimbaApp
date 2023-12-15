<nav class="fixed z-50 w-full bg-white border-b border-gray-200 font-inter">
    <div class="mx-auto p-3 pr-5">
        <div class="flex items-center justify-between">
            <div class="flex items-center justify-start">
                <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar"
                    type="button"
                    class="inline-flex items-center text-sm text-gray-500 rounded-lg lg:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 ">
                    <span class="sr-only">Open sidebar</span>
                    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path clip-rule="evenodd" fill-rule="evenodd"
                            d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
                        </path>
                    </svg>
                </button>
                <a href="{{ app('router')->getRoutes()->match(app('request')->create(url()->previous()))->getName() }}"
                    class="flex ml-2 md:mr-24">
                    <img src="{!! asset('img/logo/logo.png') !!}" class="h-10 mr-3" alt="Simba Logo" />
                    <span
                        class="self-center font-poppins text-3xl font-bold sm:text-2xl whitespace-nowrap text-yellow-300 hover:text-yellow-100">SIMBA</span>
                </a>
            </div>
            <div class="flex items-center">
                <div class="flex items-center ml-3 gap-4">
                    <div class="px-4 place-items-end md:block" role="none">
                        <p class="text-sm font-medium text-gray-500 dark:text-white" role="none">
                            Hello! {{ Auth::user()->name }}
                        </p>
                        <p class="text-xs  text-gray-500 truncate dark:text-gray-300" role="none">
                            Welcome Back To Dashboard
                        </p>
                    </div>
                    <div>
                        {{-- {{ dd(auth()->user()->Notifications) }} --}}

                        <button type="button" data-dropdown-toggle="dropdownNotification"
                            class="relative inline-flex items-center ">
                            <img class="w-10 h-9" src="{!! asset('img/component/pemberitahuan.svg') !!}" alt="notif">
                            <span class="sr-only">Notifications</span>
                            @if(auth()->user()->unreadNotifications->count() > 0 )
                                <div
                                    class="absolute inline-flex items-center justify-center w-6 h-6 text-xs text-white bg-blue-500 border-2 border-white rounded-full -top-2 -end-2">
                                    {{ auth()->user()->unreadNotifications->count() }}
                                </div>
                            @endif
                        </button>
                    </div>
                    <div id="dropdownNotification" class="w-full max-w-xs pb-6 rounded-lg shadow hidden mb-4 h-80 bg-white">
                        <div class="flex justify-between pt-4 items-center px-4 mb-3">
                            <span class="text-sm text-center font-semibold text-gray-600 ">
                                Notification
                            </span>
                        </div>
                        <div class="h-64 py-3 overflow-y-auto z-10 text-gray-700">
                            @foreach (auth()->user()->Notifications as $notif)
                                {{-- {{ dd($notif->data) }} --}}
                                @if ($notif->read_at == null)
                                    <div class="flex items-center bg-blue-50 hover:bg-blue-50 py-4 justify-between border gap-6 w-full">
                                        <div class="text-sm font-semibold">
                                            <div class="text-sm font-normal px-4 text-gray-600 whitespace-nowrap">{{ $notif->data['pesan'] }}
                                            </div>
                                            <div class="text-xs font-normal text-gray-400 px-4">{{ $notif->created_at->format('d M Y') }}</div>
                                        </div>
                                        <div class="right-1">
                                            <a href="{{ $notif->data['url'] }}"
                                                class="py-1.5 px-4 mr-4 mb-2 text-sm font-normal active:{{ $notif->markAsRead() }}
                                            text-gray-600 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-blue-50 focus:z-10 focus:ring-4 focus:ring-gray-200">
                                                Lihat
                                            </a>
                                        </div>
                                    </div>
                                @else
                                    <div class="flex items-center py-4 hover:bg-blue-50 justify-between shadow-sm gap-6 w-full">
                                        <div class="text-sm font-semibold">
                                            <div class="text-sm font-normal px-4 text-gray-600 whitespace-nowrap">{{ $notif->data['pesan'] }}</div>
                                            <div class="text-xs font-normal px-4 text-gray-400">{{ $notif->created_at->format('d M Y') }}</div>
                                        </div>
                                        <div class="right-1">
                                            <a href="{{ $notif->data['url'] }}"
                                                class="py-1.5 px-4 mr-4 mb-2 text-sm font-normal
                                            text-gray-600 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-blue-50 focus:z-10 focus:ring-4 focus:ring-gray-200">
                                                Lihat
                                            </a>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                            {{-- <div class="flex items-center gap-6 w-full">
                                <div class="relative inline-block shrink-0 left-0">
                                    <img src="{!! asset('img/component/process.png') !!}" alt="cancel" class="w-10 h-10">
                                </div>
                                <div class="text-sm font-semibold">
                                    <div class="text-sm font-normal text-gray-600 whitespace-nowrap">Permintaan Diproses
                                    </div>
                                    <div class="text-xs font-normal text-gray-400">1 Nov 2023</div>
                                    <span class="text-xs font-medium text-gray-600 ">10 Barang</span>
                                </div>
                                <div class=" right-1">
                                    <button type="button"
                                        class="py-1.5 px-4 mr-2 mb-2 text-sm font-normal
                                     text-gray-600 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-yellow-100 focus:z-10 focus:ring-4 focus:ring-gray-200">
                                        Lihat
                                    </button>
                                </div>
                            </div>
                            <div class="flex items-center gap-5 w-full">
                                <div class="relative inline-block shrink-0 left-0">
                                    <img src="{!! asset('img/component/check.png') !!}" alt="check" class="w-10 h-10">
                                </div>
                                <div class="text-sm font-semibold">
                                    <div class="text-sm font-normal text-gray-600 whitespace-nowrap">Permintaan Diterima
                                    </div>
                                    <div class="text-xs font-normal text-gray-400">26 Okt 2023</div>
                                    <span class="text-xs font-medium text-gray-600 ">5 Barang</span>
                                </div>
                                <div>
                                    <button type="button"
                                        class="py-1.5 px-4 mr-2 mb-2 text-sm font-normal ml-2
                                     text-gray-600 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-yellow-100 focus:z-10 focus:ring-4 focus:ring-gray-200 ">
                                        Lihat
                                    </button>
                                </div>
                            </div>
                            <div class="flex items-center gap-5 w-full left-0">
                                <div class="relative inline-block shrink-0 left-0">
                                    <img src="{!! asset('img/component/cancel.png') !!}" alt="cancel" class="w-10 h-10">
                                    <span
                                        class="absolute bottom-0 right-0 inline-flex items-center justify-center w-6 h-6 bg-blue-600 rounded-full">
                                        <img src="{!! asset('img/component/cancel.png') !!}" alt="cancel" srcset="">
                                        <span class="sr-only">Notifikasi Permintaan</span>
                                    </span>
                                </div>
                                <div class="text-sm font-semibold">
                                    <div class="text-sm font-normal text-gray-600 whitespace-nowrap">Permintaan Ditolak
                                    </div>
                                    <div class="text-xs font-normal text-gray-400">28 Okt 2023</div>
                                    <span class="text-xs font-medium text-gray-600 ">20 Barang</span>
                                </div>
                                <div>
                                    <button type="button"
                                        class="py-1.5 px-4 mr-2 mb-2 text-sm font-normal ml-4
                                     text-gray-600 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-yellow-100 focus:z-10 focus:ring-4 focus:ring-gray-200 ">
                                        Lihat
                                    </button>
                                </div>
                            </div>
                             --}}
                        </div>
                        <div class="h-10 flex py-4"></div>
                    </div>
                </div>
            </div>
        </div>
</nav>
