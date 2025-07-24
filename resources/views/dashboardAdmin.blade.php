<head>
    <meta charset="UTF-8">
    <title>Login</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<div>
    <x-navbar />
    @if ($success !== null)
    <div
        x-data="{ show: true }"
        x-init="setTimeout(() => show = false, 3000)"
        x-show="show"
        x-transition
        class="fixed top-4 right-4 bg-biru/80 text-white px-4 py-3 rounded shadow-lg z-50 flex items-center justify-between gap-2">
        <span>{{ $success }} {{ Auth::user()->username }}</span>
        <button @click="show = false" class="font-bold px-2">×</button>
    </div>
    @endif

    <div class="mt-2 w-full">
        <x-card title="Total Penjualan"
            body="Rp {{ number_format($totalBulanIni, 0, ',', '.') }}"
            :icon="'iconoir-coins'">
        </x-card>
    </div>
    <div class="flex mt-2 justify-center">
        <x-card
            title="Stok Gas Isi"
            body="{{$barang}}/200"
            :icon="'elusive-fire'">
        </x-card>
        <x-card
            title="Total Transaksi"
            body="{{$totalHariIni}}"
            :icon="'iconpark-transactionorder-o'">
        </x-card>
    </div>
    <div class="flex mt-2 justify-center">
        @php
        $bodyText = $stok_bocor ? $stok_bocor : '-';
        @endphp
        <x-card
            title="Stok Bocor"
            :body="$bodyText"
            :icon="'solar-bonfire-broken'">
        </x-card>
        
        <x-card
            title="Alokasi Tukar"
            :body="$bodyText"
            :icon="'gmdi-change-circle-o'">
        </x-card>
    </div>
    <div class="mt-2 w-full">
        <x-card
            title="Catatan"
            body=""
            :icon="'css-notes'">

            @if(!empty($notes) && count($notes) > 0)
            <ol class="list-decimal ml-5 text-left">
                @foreach($notes as $note)
                <li>{{ $note }}</li>
                @endforeach
            </ol>
            @else
            <p class="text-gray-600">Belum ada catatan</p>
            @endif

        </x-card>
    </div>


</div>