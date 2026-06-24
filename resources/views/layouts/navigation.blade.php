<nav x-data="{ open: false }" class="bg-gradient-to-r from-teal-600 to-cyan-700 border-b border-teal-500 shadow-md">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center bg-white p-2 rounded-lg my-2 shadow-sm">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-7 w-auto fill-current text-teal-600" />
                    </a>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <a href="{{ route('dashboard') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('dashboard') ? 'border-white text-white font-bold' : 'border-transparent text-teal-100 hover:text-white hover:border-teal-200' }} text-sm font-medium leading-5 transition duration-150 ease-in-out">
                        Dashboard
                    </a>

                    <a href="{{ url('/faskes-view') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->is('faskes-view*') ? 'border-white text-white font-bold' : 'border-transparent text-teal-100 hover:text-white hover:border-teal-200' }} text-sm font-medium leading-5 transition duration-150 ease-in-out">
                        Pencarian Faskes
                    </a>

                    <a href="{{ url('/jadwal-dokter-view') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->is('jadwal-dokter-view*') ? 'border-white text-white font-bold' : 'border-transparent text-teal-100 hover:text-white hover:border-teal-200' }} text-sm font-medium leading-5 transition duration-150 ease-in-out">
                        Reservasi Jadwal
                    </a>

                    <a href="{{ url('/rekam-medis-view') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->is('rekam-medis-view*') ? 'border-white text-white font-bold' : 'border-transparent text-teal-100 hover:text-white hover:border-teal-200' }} text-sm font-medium leading-5 transition duration-150 ease-in-out">
                        Rekam Medis
                    </a>

                    <a href="{{ url('/resep-obat-view') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->is('resep-obat-view*') ? 'border-white text-white font-bold' : 'border-transparent text-teal-100 hover:text-white hover:border-teal-200' }} text-sm font-medium leading-5 transition duration-150 ease-in-out">
                        Resep Obat
                    </a>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-teal-100 bg-teal-700 bg-opacity-50 hover:bg-opacity-70 hover:text-white focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profil Saya') }}
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Keluar') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <div class="-me-2 flex items-center 'sm:hidden'">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-teal-100 hover:text-white hover:bg-teal-700 focus:outline-none transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-teal-700">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-white">Dashboard</x-responsive-nav-link>
            <x-responsive-nav-link :href="url('/faskes-view')" :active="request()->is('faskes-view*')" class="text-white">Pencarian Faskes</x-responsive-nav-link>
            <x-responsive-nav-link :href="url('/jadwal-dokter-view')" :active="request()->is('jadwal-dokter-view*')" class="text-white">Reservasi Jadwal</x-responsive-nav-link>
            <x-responsive-nav-link :href="url('/rekam-medis-view')" :active="request()->is('rekam-medis-view*')" class="text-white">Rekam Medis</x-responsive-nav-link>
            <x-responsive-nav-link :href="url('/resep-obat-view')" :active="request()->is('resep-obat-view*')" class="text-white">Resep Obat</x-responsive-nav-link>
        </div>
    </div>
</nav>