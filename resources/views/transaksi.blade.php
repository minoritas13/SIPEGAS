<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<div>
    <x-navbar>
    </x-navbar>

    <div class="py-8 px-4">
        <h1 class="text-2xl font-bold text-center mb-6">Transaksi</h1>

        <form action="{{ route('showTransaksi') }}" method="GET" class="flex flex-wrap justify-center gap-2 mb-4">
            <div>
                <label for="start_date" class="block text-sm font-medium">Dari Tanggal</label>
                <input type="date" id="start_date" name="start_date" value="{{ request('start_date') }}" class="border rounded px-2 py-1">
            </div>
            <div>
                <label for="end_date" class="block text-sm font-medium">Sampai Tanggal</label>
                <input type="date" id="end_date" name="end_date" value="{{ request('end_date') }}" class="border rounded px-2 py-1">
            </div>
            <div class="flex items-center">
                <button type="submit" class="bg-green-500 hover:bg-green-600 text-white p-2 rounded">Filter</button>
            </div>
        </form>

        <div class="overflow-x-auto">
            <div class="bg-white shadow-md rounded p-4 w-full max-w-2xl mx-auto border">
                <table class="min-w-full text-center text-sm">
                    <thead class="border-b font-medium">
                        <tr>
                            <th class="px-4 py-2">No</th>
                            <th class="px-4 py-2">Jumlah</th>
                            <th class="px-4 py-2">Kasir</th>
                            <th class="px-4 py-2">Waktu</th>
                            <th class="px-4 py-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transaksi as $index => $t)
                        <tr class="bg-gradient-to-r from-hijau to-hijau/50 text-black">
                            <td class="px-4 py-2">{{ $index + 1 }}</td>
                            <td class="px-4 py-2">{{ $t->jumlah }}</td>
                            <td class="px-4 py-2">{{ $t->user->username ?? '—' }}</td>
                            <td class="px-4 py-2">{{ \Carbon\Carbon::parse($t->created_at)->format('H:i d/m/Y') }}</td>
                            <td>
                                <form action="{{ route('transaksiUpdateStatus') }}" method="POST" class="inline-block">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $t->id }}">
                                    <select
                                        name="status_pembayaran"
                                        class="border my-3 mx-1 py-2 rounded text-black transition-colors duration-200 {{ $t->status_pembayaran ? 'bg-blue-500 hover:bg-blue-600' : 'bg-red-500 hover:bg-red-600' }}"
                                        onchange="this.form.submit()">
                                        <option value="0" {{ !$t->status_pembayaran ? 'selected' : '' }}>Belum</option>
                                        <option value="1" {{ $t->status_pembayaran ? 'selected' : '' }}>Sudah</option>
                                    </select>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>