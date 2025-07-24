<div class="relative bg-hijau/50 text-black p-4 rounded-xl shadow-lg overflow-hidden my-3 mx-1">
    <h3 class="font-semibold text-lg mb-4 uppercase tracking-wide relative z-10 text-center">
        Form Input Gas
    </h3>

    <div class="relative z-10 space-y-4">
        <form action="{{ route('inputBarang') }}" method="POST" class="flex flex-col space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label for="stok_isi" class="block font-medium">Stok Isi:</label>
                <input type="number" name="stok_isi" class="w-full rounded bg-gray-100 focus:ring focus:ring-green-300 p-2">
            </div>

            <div>
                <label for="stok_bocor" class="block font-medium">Stok Bocor</label>
                <input type="number" name="stok_bocor" class="w-full rounded bg-gray-100 focus:ring focus:ring-green-300 p-2">
            </div>

            <button type="submit" class="bg-green-700 text-white py-2 rounded hover:bg-green-800 transition">
                simpan
            </button>
        </form>
    </div>
</div>