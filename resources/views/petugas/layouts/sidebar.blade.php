{{-- <aside id="logo-sidebar"
class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 font-inter"
aria-label="Sidebar">
    <div class="h-full px-4 py-4 overflow-y-auto bg-white dark:bg-gray-800">
        <ul class="space-y-2 top-1 mb-6 max-w-xs text-xs md:text-sm lg:text-sm xl:text-sm">
            <li>
                <a href="/petugas"
                    class="flex items-center p-2  text-gray-600 rounded-lg hover:text-yellow-300 hover:bg-yellow-50 hover:border-yellow-100
                    {{ request()->routeIs('petugas') ? 'activeNav':'' }}">
                    <img src="{!! asset('img/component/home_icon.svg') !!}" alt="home">
                    <span class="ml-3">Beranda</span>
                </a>
            </li>
            <li>
                <a href="/petugas/input"
                    class="flex items-center p-2 text-gray-600 rounded-lg hover:text-yellow-300 hover:bg-yellow-50 hover:border-yellow-100
                    {{ request()->is('petugas/input') ? 'activeNav':'' }}">
                    <img src="{!! asset('img/component/input_icon.svg') !!}" alt="input">
                    <span class="ml-3">Input Barang</span>
                </a>
            </li>
            <li>
                <a href="/petugas/list_approve"
                    class="flex items-center p-2  text-gray-600 rounded-lg hover:text-yellow-300 hover:bg-yellow-50 hover:border-yellow-100
                    {{ request()->routeIs('/petugas/list_approve') ? 'activeNav':'' }}">
                    <img src="{!! asset('img/component/list_form_acc_icon.svg') !!}" alt="list_approve">
                    <span class="ml-3">List Form Disetujui</span>
                </a>
            </li>
            <li>
                <a href="/petugas/list_barang"
                    class="flex items-center p-2 text-gray-600 rounded-lg transition duration-100 group hover:bg-yellow-50 hover:border-l-4 hover:text-yellow-300 hover:border-yellow-100
                    {{ request()->is('petugas/list_barang') ? 'activeNav':'' }}">
                    <img src="{!! asset('img/component/box_icon.svg') !!}" alt="list_barang">
                    <span class="ml-3">List Barang</span>
                </a>
            </li>
        </ul>
        <span class="line-through">
            <hr>
        </span>
        <ul class="space-y-2 mt-6 font-normal max-w-xs text-xs md:text-sm lg:text-sm xl:text-sm">
            @if (Auth::user()->role_id == 3)
                <li>
                    <a href="/dashboard"
                        class="flex items-center p-2 text-gray-600 rounded-lg transition duration-100 group hover:bg-yellow-50 hover:border-l-4 hover:text-yellow-300 hover:border-yellow-100">
                        <img src="{!! asset('img/component/open_new.svg') !!}" alt="open_newtab">
                        <span class="ml-3">Masuk Dashboard</span>
                    </a>
                </li>
            @endif
            <li>
                <a href="/profile/"
                    class="flex items-center p-2 text-gray-600 rounded-lg transition duration-100 group
                    hover:bg-yellow-50 hover:border-l-4 {{ request()->routeIs('profile.*') ? 'activeNav':'' }}
                    hover:text-yellow-300 hover:border-yellow-100">
                    <img src="{!! asset('img/component/user_icon_sidebar.svg') !!}" alt="open_newtab">
                    <span class="ml-3">Edit Profile</span>
                </a>
            </li>
            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                            this.closest('form').submit();"
                        class="flex items-center p-2 text-gray-600 rounded-lg transition duration-100 group hover:bg-red-100 hover:border-l-4 hover:text-red-300 hover:border-red-300">
                        <img src="{!! asset('img/component/logout_icon.svg') !!}" alt="logout">
                        <span class="ml-3">Logout</span>
                    </a>
                </form>
            </li>
        </ul>

        <div class="fixed bottom-0 mb-6 items-center">
            <div class="flex items-center ml-3">
                <div class="flex items-center cursor-pointer" data-dropdown-toggle="dropdown-user"
                    aria-expanded="false">
                    <div>
                        <img class="rounded-full w-8" src="{!! asset('img/component/user_dummy.png') !!}" alt="user">
                    </div>
                    <div class="px-4" role="none">
                        <p class="max-w-xs text-sm md:text-sm lg:text-sm xl:text-sm text-gray-500" role="none">
                            {{ Auth::user()->name }}
                        </p>
                        <p class="max-w-xs text-sm md:text-sm lg:text-sm xl:text-xs font-normal text-gray-400 truncate "
                            role="none">
                            {{ Auth::user()->email }}
                        </p>
                    </div>
                </div>
                <div class="z-20 hidden py-2 my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow "
                    id="dropdown-user">
                    <div class="px-8 py-2 text-sm text-gray-500">
                        <div class="font-medium">{{ Auth::user()->name }}</div>
                        <div class="text-sm font-light text-gray-500 mb-5">{{ Auth::user()->email }}</div>
                        <div class="font-light whitespace-nowrap text-gray-500">{{ Auth::user()->divisi->nama_divisi }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
</aside> --}}

<aside id="logo-sidebar"
class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 lg:translate-x-0 font-inter"
aria-label="Sidebar">
    <div class="h-full px-4 py-4 overflow-y-auto bg-white dark:bg-gray-800">
        <ul class="space-y-2 top-1 mb-6 max-w-xs text-xs md:text-sm lg:text-sm xl:text-sm">
            <li>
                <a href="/petugas"
                    class="flex items-center p-2  text-gray-600 rounded-lg hover:text-yellow-300 hover:bg-yellow-50 hover:border-yellow-100
                    {{ request()->routeIs('petugas') ? 'activeNav':'' }}">
                    <img src="{!! asset('img/component/home_icon.svg') !!}" alt="home">
                    <span class="ml-3">Beranda</span>
                </a>
            </li>
            <li>
                <a href="/petugas/input"
                    class="flex items-center p-2 text-gray-600 rounded-lg hover:text-yellow-300 hover:bg-yellow-50 hover:border-yellow-100
                    {{ request()->is('petugas/input') ? 'activeNav':'' }}">
                    <img src="{!! asset('img/component/input_icon.svg') !!}" alt="input">
                    <span class="ml-3">Input Barang</span>
                </a>
            </li>
            <li>
                <a href="/petugas/list_approve"
                    class="flex items-center p-2  text-gray-600 rounded-lg hover:text-yellow-300 hover:bg-yellow-50 hover:border-yellow-100
                    {{str(request()->segment(2))->is('list_approve') ? 'activeNav':'' }}">
                    {{-- {{ dd(Request::segment(2))}} --}}
                    <img src="{!! asset('img/component/list_form_acc_icon.svg') !!}" alt="list_approve">
                    <span class="ml-3">List Form Disetujui</span>
                </a>
            </li>
            <li>
                <a href="/petugas/list_barang"
                    class="flex items-center p-2 text-gray-600 rounded-lg transition duration-100 group hover:bg-yellow-50 hover:border-l-4 hover:text-yellow-300 hover:border-yellow-100
                    {{ request()->is('petugas/list_barang*') ? 'activeNav':'' }}">
                    <img src="{!! asset('img/component/box_icon.svg') !!}" alt="list_barang">
                    <span class="ml-3">List Barang</span>
                </a>
            </li>
        </ul>
        <span class="line-through">
            <hr>
        </span>
        <ul class="space-y-2 mt-6 font-normal max-w-xs text-xs md:text-sm lg:text-sm xl:text-sm">
            @if (Auth::user()->role_id == 3)
                <li>
                    <a href="/dashboard"
                        class="flex items-center p-2 text-gray-600 rounded-lg transition duration-100 group hover:bg-yellow-50 hover:border-l-4 hover:text-yellow-300 hover:border-yellow-100">
                        <img src="{!! asset('img/component/open_new.svg') !!}" alt="open_newtab">
                        <span class="ml-3">Masuk Dashboard</span>
                    </a>
                </li>
            @endif
            <li>
                <a href="/profile/"
                    class="flex items-center p-2 text-gray-600 rounded-lg transition duration-100 group
                    hover:bg-yellow-50 hover:border-l-4 {{ request()->routeIs('profile.*') ? 'activeNav':'' }}
                    hover:text-yellow-300 hover:border-yellow-100">
                    <img src="{!! asset('img/component/user_icon_sidebar.svg') !!}" alt="open_newtab">
                    <span class="ml-3">Edit Profile</span>
                </a>
            </li>
            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                            this.closest('form').submit();"
                        class="flex items-center p-2 text-gray-600 rounded-lg transition duration-100 group hover:bg-red-100 hover:border-l-4 hover:text-red-300 hover:border-red-300">
                        <img src="{!! asset('img/component/logout_icon.svg') !!}" alt="logout">
                        <span class="ml-3">Logout</span>
                    </a>
                </form>
            </li>
        </ul>

        <div class="fixed bottom-0 mb-6 items-center">
            <div class="flex items-center">
                <div class="flex items-center cursor-pointer" data-dropdown-toggle="dropdown-user"
                    aria-expanded="false">
                    {{-- <div>
                        <img class="rounded-full" src="{!! asset('img/component/user_dummy.png') !!}" alt="user">
                    </div> --}}
                    <div class="px-4" role="none">
                        <p class="max-w-xs text-sm text-gray-500 lg:text-base" role="none">
                            {{ Auth::user()->name }}
                        </p>
                        <p class="max-w-xs text-sm font-normal lg:text-base text-gray-400 truncate "
                            role="none">
                            {{ Auth::user()->email }}
                        </p>
                    </div>
                </div>
                <div class="z-20 hidden py-2 my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow "
                    id="dropdown-user">
                    <div class="px-8 py-2 text-sm text-gray-500">
                        <div class="font-medium">{{ Auth::user()->fname }}</div>
                        <div class="text-sm font-light text-gray-500 mb-5">{{ Auth::user()->email }}</div>
                        <div class="font-light whitespace-nowrap text-gray-500">{{ Auth::user()->divisi->nama_divisi }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
</aside>

