<head>
    <meta charset="UTF-8">
    <title>Login</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<nav class="flex items-center justify-between px-4 py-2 bg-gradient-to-r from-blue-500 to-indigo-600 shadow-md">
    <div x-data="{ open: false }">
        <!-- Tombol hamburger -->
        <button @click="open = !open" class="flex flex-col justify-around h-8 w-8 p-1 rounded focus:outline-none">
            <span
                class="block h-[3px] w-full bg-white rounded transition duration-300"
                :class="open ? 'rotate-45 translate-y-2' : ''"></span>
            <span
                class="block h-[3px] w-full bg-white rounded transition duration-300"
                :class="open ? 'opacity-0' : 'opacity-100'"></span>
            <span
                class="block h-[3px] w-full bg-white rounded transition duration-300"
                :class="open ? '-rotate-45 -translate-y-2' : ''"></span>
        </button>

        <div
            x-show="open"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 -translate-y-10"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 -translate-y-10"
            class="fixed inset-0 bg-gray-300 z-40 flex items-center justify-center mt-12">
            <div class="text-center space-y-2">
                @if(Auth::check() && Auth::user()->is_admin)
                <a href="{{ route('dashboardAdmin') }}" class="hover:text-biru font-bold text-xl">Dashboard Admin</a><br>
                <a href="{{route('inputBarang')}}" class="hover:text-biru font-bold text-xl">Input Gas</a><br>
                <a href="{{ route('showTransaksi') }}" class="hover:text-biru font-bold text-xl">Transaksi</a><br>
                <a href="{{ route('showLaporan') }}" class="hover:text-biru font-bold text-xl">Laporan Penjualan</a><br>
                <a href="{{route('pengguna')}}" class="hover:text-biru font-bold text-xl">Pengguna</a><br>
                <a href="{{ route('logout') }}" class="hover:text-biru font-bold text-xl">Logout</a>
                @else
                <a href="{{ route('dashboardUser') }}" class="hover:text-biru font-bold text-xl">Dashboard</a><br>
                <a href="{{ route('showTransaksi') }}" class="hover:text-biru font-bold text-xl">Transaksi</a><br>
                <a href="{{ route('logout') }}" class="hover:text-biru font-bold text-xl">Logout</a>
                @endif
            </div>
        </div>
    </div>

    <div class="flex items-center gap-2">
        <x-css-profile />
        <p class="font-bold">{{ Auth::user()->username}}</p>
    </div>
</nav>