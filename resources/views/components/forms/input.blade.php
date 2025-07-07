<div>
    {{-- resources/views/components/form/login-form.blade.php --}}
    <form action="{{ $action }}" method="POST" class="bg-white p-6 rounded shadow-md w-80">
        @csrf
        <h2 class="text-2xl font-bold mb-4">{{ $title }}</h2>
        <div class="mb-4">
            <label for="email" class="block text-sm">Email</label>
            <input type="email" name="email" id="email" class="w-full border rounded px-3 py-2 mt-1" required>
        </div>

        <div class="mb-4">
            <label for="password" class="block text-sm">Password</label>
            <input type="password" name="password" id="password" class="w-full border rounded px-3 py-2 mt-1" required>
        </div>
        <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded hover:bg-blue-600">{{ $title }}</button>

        @if (session('error'))
        <p class="text-red-500 mt-7">{{ session('error') }}</p>
        @endif
    </form>

</div>