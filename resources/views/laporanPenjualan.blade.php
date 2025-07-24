<head>
    <meta charset="UTF-8">
    <title>Laporan Penjualan</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<x-navbar />

<form method="GET" action="{{ route('filter') }}" class="text-center mb-6 space-x-2 mt-5">
    @foreach(['Harian', 'Mingguan', 'Bulanan', 'Tahunan'] as $opt)
    <button
        type="submit"
        name="filter"
        value="{{ $opt }}"
        class="px-4 py-2 rounded text-sm font-semibold transition
                {{ request('filter', 'Harian') === $opt ? 'bg-blue-600 text-white' : 'bg-gray-300' }}">
        {{ $opt }}
    </button>
    @endforeach
</form>


<div class="bg-white p-4 max-w-5xl mx-auto mt-6">
    <table class="w-full table-auto text-sm text-center border">
        <thead class="bg-gray-200 font-semibold">
            <tr>
                <th class="p-2">Periode</th>
                <th class="p-2">Jumlah</th>
                <th class="p-2">Total</th>
            </tr>
        </thead>
        <tbody>
            @forelse($transaksi as $item)
            <tr class="border-t hover:bg-gray-50">
                <td class="p-2">
                    @if ($filter === 'Tahunan')
                        {{ $item['tanggal'] }}
                    @elseif ($filter === 'Bulanan')
                        {{ \Carbon\Carbon::createFromFormat('Y-m', $item['tanggal'])->translatedFormat('F Y') }}
                    @else
                        {{ \Carbon\Carbon::parse($item['tanggal'])->format('d/m/Y') }}
                    @endif
                </td>
                <td class="p-2">{{ $item['jumlah'] }}</td>
                <td class="p-2">{{ number_format($item['total'], 0, ',', '.') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="3" class="p-4 text-center text-gray-500">Tidak ada data.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4 text-right">
        <span class="bg-blue-600 text-white px-4 py-1 rounded shadow">
            Total: {{ number_format($total, 0, ',', '.') }}
        </span>
    </div>
</div>