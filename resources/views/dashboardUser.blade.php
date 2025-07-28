<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<x-navbar />

<div>
    @if (session('success'))
    <div
        x-data="{ show: true }"
        x-init="setTimeout(() => show = false, 3000)"
        x-show="show"
        x-transition
        class="fixed top-4 right-4 bg-hijau/80 text-white px-4 py-3 rounded shadow-lg z-50 flex items-center justify-between gap-2">
        <span>{{ session('success') }}</span>
        <button @click="show = false" class="font-bold px-2">×</button>
    </div>
    @endif


    <div class="flex mt-2 justify-center">
        <x-card
            title="Stok Gas Isi"
            body="{{$barang}}/200"
            :icon="'elusive-fire'">
        </x-card>

        <x-card
            title="Catatan"
            body=""
            :icon="'css-notes'">
            <ol class="list-decimal ml-5">
                @foreach($notes as $note)
                <li>{{$note}}</li>
                @endforeach
            </ol>
            <div class="mt-4" x-data="{ open: false }">
                <button @click="open = !open" class="text-blue-600 text-sm hover:underline">
                    Tambahkan catatan
                </button>

                <div
                    x-show="open"
                    x-transition
                    class="fixed inset-0 z-50 flex items-center justify-center bg-black/50">
                    <div class="bg-white rounded-lg shadow-xl p-6 w-full max-w-md relative">
                        
                        <button
                            @click="open = false"
                            class="absolute top-2 right-2 text-gray-500 hover:text-red-500 text-md font-bold">
                            tutup
                        </button>

                        <h2 class="text-lg font-semibold mb-4">Tulis Catatan</h2>

                        <form action="{{ route('CreateNotes') }}" method="post" class="space-y-4">
                            @csrf
                            <div>
                                <label class="block text-sm font-medium">Pesan:</label>
                                <input
                                    type="text"
                                    name="notes"
                                    class="w-full border rounded p-2 focus:outline-none focus:ring focus:ring-green-300"
                                    placeholder="Tulis pesan...">
                            </div>
                            <div class="flex justify-end">
                                <button
                                    type="submit"
                                    class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                                    Simpan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </x-card>
    </div>

    <div
        x-data="{ 
        waktu: '', 
        jumlah: 0, 
        harga: 20000, 
        updateTime() { 
        setInterval(() => {
            const now = new Date();
            this.waktu = now.toLocaleTimeString('id-ID', {
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit',
                hour12: false
            });
            const pad = n => n.toString().padStart(2, '0');
            this.$refs.jamInput.value = `${now.getFullYear()}-${pad(now.getMonth()+1)}-${pad(now.getDate())} ${pad(now.getHours())}:${pad(now.getMinutes())}:${pad(now.getSeconds())}`;
        }, 1000);
    }
}"
        x-init="updateTime()">
        <div class="relative bg-hijau/50 text-black p-4 rounded-xl shadow-lg overflow-hidden my-3 mx-1">
            <h3 class="font-semibold text-lg mb-4 uppercase tracking-wide relative text-center">
                Form Pembelian Gas
            </h3>

            <form action="{{ route('TransaksiBarang') }}" method="POST" class="flex flex-col space-y-4">
                @csrf

                <div>
                    <label for="pembeli" class="block font-medium">Nama Pembeli</label>
                    <input type="text" name="pembeli" id="pembeli"
                        class="w-full rounded bg-gray-100 focus:ring focus:ring-green-300 p-2">
                </div>

                <div>
                    <label for="jumlah" class="block font-medium">Jumlah</label>
                    <input type="number" name="jumlah" id="jumlah" x-model.number="jumlah"
                        class="w-full rounded bg-gray-100 focus:ring focus:ring-green-300 p-2" required>
                </div>

                <div>
                    <label for="total" class="block font-medium">Total</label>
                    <input type="text" id="total"
                        :value="'Rp. ' + (jumlah * harga).toLocaleString('id-ID')"
                        readonly class="w-full bg-gray-100 rounded p-2">
                </div>

                <!-- Kirim total dan created_at ke backend -->
                <input type="hidden" name="total" :value="jumlah * harga">
                <input type="hidden" name="created_at" x-ref="jamInput">

                <button type="submit"
                    class="bg-green-700 text-white py-2 rounded hover:bg-green-800 transition">
                    Beli
                </button>
            </form>
        </div>
    </div>
</div>