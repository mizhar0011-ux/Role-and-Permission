{{-- resources/views/dashboard.blade.php --}}

@props(['title' => 'Dashboard'])

<x-layouts.app.sidebar :title="$title">
    <flux:main class="p-6 bg-gray-900 text-white min-h-screen">

        {{-- Animated Role & Permissions --}}
        <div x-data="{ show: true }" x-init="setInterval(() => show = !show, 3000)" class="mb-6">
            <p x-show="show" class="text-xl transition-opacity duration-500 ease-in-out">👤 Welcome, <strong>{{ Auth::user()->name }}</strong></p>
            <p x-show="!show" class="text-xl transition-opacity duration-500 ease-in-out">🔐 Your role: <strong>{{ Auth::user()->getRoleNames()->first() ?? 'No Role' }}</strong></p>
        </div>

        {{-- Info Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            <div class="bg-gray-800 p-4 rounded shadow-lg">
                <h2 class="text-lg font-semibold mb-2">Total Users</h2>
                <p class="text-3xl">{{ \App\Models\User::count() }}</p>
            </div>

            <div class="bg-gray-800 p-4 rounded shadow-lg">
                <h2 class="text-lg font-semibold mb-2">Total Roles</h2>
                <p class="text-3xl">{{ \Spatie\Permission\Models\Role::count() }}</p>
            </div>

            <div class="bg-gray-800 p-4 rounded shadow-lg">
                <h2 class="text-lg font-semibold mb-2">Total Products</h2>
                <p class="text-3xl">{{ \App\Models\Product::count() }}</p>
            </div>
        </div>

        {{-- Permissions Table --}}
        <div class="bg-gray-800 p-6 rounded shadow-lg">
            <h2 class="text-2xl font-bold mb-4">Your Permissions</h2>
            <ul class="list-disc pl-5">
                @forelse(Auth::user()->getAllPermissions() as $permission)
                    <li>{{ $permission->name }}</li>
                @empty
                    <li>No permissions assigned.</li>
                @endforelse
            </ul>
        </div>

    </flux:main>
</x-layouts.app.sidebar>
