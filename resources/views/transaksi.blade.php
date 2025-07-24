<head>
    <meta charset="UTF-8">
    <title>Laporan Penjualan</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<div>
    <x-navbar>
    </x-navbar>
   
    <div class="py-8 px-4">
        <h1 class="text-2xl font-bold text-center mb-6">Transaksi</h1>

        <div class="overflow-x-auto">
            <div class="bg-white shadow-md rounded p-4 w-full max-w-2xl mx-auto border">
                <table class="min-w-full text-center text-sm">
                    <thead class="border-b font-medium">
                        <tr>
                            <th class="px-4 py-2">No</th>
                            <th class="px-4 py-2">Jumlah</th>
                            <th class="px-4 py-2">Kasir</th>
                            <th class="px-4 py-2">Waktu</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transaksi as $index => $t)
                        <tr class="bg-gradient-to-r from-hijau to-hijau/50 text-black">
                            <td class="px-4 py-2">{{ $index + 1 }}</td>
                            <td class="px-4 py-2">{{ $t->jumlah }}</td>
                            <td class="px-4 py-2">{{ $t->user->username ?? '—' }}</td>
                            <td class="px-4 py-2">{{ \Carbon\Carbon::parse($t->created_at)->format('H:i d/m/Y') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>