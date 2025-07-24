<head>
    <meta charset="UTF-8">
    <title>Laporan Penjualan</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<x-navbar />

<div class="max-w-4xl mx-auto p-6 bg-white" x-data="{ showForm: false }">
    <h2 class="text-xl font-bold mb-4">Manajemen Pengguna</h2>

    <!-- Alert -->
    @if(session('success'))
    <div
        x-data="{ show: true }"
        x-init="setTimeout(() => show = false, 3000)"
        x-show="show"
        x-transition
        class="mb-4 p-3 bg-green-100 text-green-700 rounded">
        {{ session('success') }}
    </div>
    @endif


    <!-- Tombol Tampilkan Form -->
    <div class="mb-4">
        <button @click="showForm = !showForm"
            class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
            Tambah Pengguna
        </button>
    </div>

    <!-- Form Tambah Pengguna -->
    <div x-show="showForm" class="mb-6 bg-gray-50 p-4 rounded shadow">
        <form action="{{ route('pengguna.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium">Username</label>
                <input type="text" name="username" class="w-full border rounded px-3 py-2" required>
            </div>

            <div>
                <label class="block text-sm font-medium">Email</label>
                <input type="email" name="email" class="w-full border rounded px-3 py-2" required>
            </div>

            <div>
                <label class="block text-sm font-medium">Password</label>
                <input type="password" name="password" class="w-full border rounded px-3 py-2" required>
            </div>

            <div>
                <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">
                    Simpan
                </button>
            </div>
        </form>
    </div>

    <!-- Tabel Pengguna -->
    <table class="w-full table-auto text-sm text-left border">
        <thead class="bg-gray-200">
            <tr>
                <th class="p-2">Username</th>
                <th class="p-2">Email</th>
                <th class="p-2">Dibuat</th>
                <th class="p-2 text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $user)
            <tr class="border-t hover:bg-gray-50">
                <td class="p-2">{{ $user->username }}</td>
                <td class="p-2">{{ $user->email }}</td>
                <td class="p-2">{{ $user->created_at->format('d-m-Y') }}</td>
                <td>
                    <form action="{{ route('pengguna.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Yakin ingin hapus?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="text-center p-4 text-gray-500">Belum ada pengguna.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>