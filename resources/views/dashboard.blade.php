{{-- resources/views/dashboard.blade.php --}}
@props(['title' => 'Dashboard'])

<x-layouts.app.sidebar :title="$title">
    <flux:main class="p-0  text-white min-h-screen overflow-hidden">

        {{-- 🚀 Hero Section with Subtle Parallax Effect --}}
        <div 
            x-data="{ current: 0, slides: [
                { title: 'Welcome to Your Dashboard', subtitle: 'Manage everything efficiently', img: '/images/slide1.jpg' },
                { title: 'Empower Your Workflow', subtitle: 'Track and control with ease', img: '/images/slide2.jpg' },
                { title: 'Productivity Unlocked', subtitle: 'Your tools, your rules', img: '/images/slide3.jpg' },
            ] }"
            x-init="setInterval(() => current = (current + 1) % slides.length, 4000)"
            class="relative h-[45vh] overflow-hidden"
        >
            <template x-for="(slide, i) in slides" :key="i">
                <div 
                    x-show="current === i"
                    x-transition.opacity.duration.1000ms
                    class="absolute inset-0 flex items-center justify-center bg-cover bg-center transform-gpu scale-105"
                    :style="`background-image: url(${slide.img});`"
                >
                    <div class="absolute inset-0 bg-black/60 backdrop-blur-sm"></div>
                    <div class="relative z-10 text-center">
                        <h1 class="text-4xl md:text-5xl font-extrabold bg-clip-text text-transparent bg-gradient-to-r from-pink-400 via-purple-500 to-cyan-400 mb-3"
                            x-text="slide.title"></h1>
                        <p class="text-lg text-gray-300" x-text="slide.subtitle"></p>
                    </div>
                </div>
            </template>
        </div>

        {{-- 👋 Animated Welcome Slideshow --}}
        <div 
            x-data="{ index: 0, messages: [
                '👋 Welcome, {{ Auth::user()->name }}!',
                '🧠 Your role: {{ Auth::user()->getRoleNames()->first() ?? 'No Role' }}',
                '🚀 Let’s make today productive!'
            ] }" 
            x-init="setInterval(() => index = (index + 1) % messages.length, 3500)"
            class="text-center py-10"
        >
            <template x-for="(msg, i) in messages" :key="i">
                <p 
                    x-show="index === i"
                    x-transition:enter="transition ease-out duration-700"
                    x-transition:enter-start="opacity-0 -translate-y-4"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    class="text-4xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-orange-400 via-pink-500 to-purple-500"
                    x-text="msg">
                </p>
            </template>
        </div>

        {{-- 📊 3D Glassmorphism Info Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 px-8 mb-12">
            @php
                $cards = [
                    ['title' => 'Total Users', 'icon' => '👥', 'color' => 'from-violet-500 to-indigo-500', 'count' => \App\Models\User::count()],
                    ['title' => 'Total Roles', 'icon' => '🛡️', 'color' => 'from-emerald-500 to-teal-600', 'count' => \Spatie\Permission\Models\Role::count()],
                    ['title' => 'Total Products', 'icon' => '🛍️', 'color' => 'from-pink-500 to-rose-600', 'count' => \App\Models\Product::count()],
                ];
            @endphp

            @foreach ($cards as $card)
                <div class="relative overflow-hidden group rounded-2xl p-6 bg-white/10 backdrop-blur-lg border border-white/20 shadow-[0_8px_30px_rgb(0,0,0,0.4)] transform transition duration-500 hover:scale-105 hover:shadow-[0_10px_40px_rgba(255,255,255,0.2)]">
                    <div class="absolute inset-0 bg-gradient-to-br {{ $card['color'] }} opacity-20 group-hover:opacity-30 blur-2xl transition-all duration-500"></div>
                    <div class="relative z-10">
                        <h2 class="text-lg font-semibold mb-2 flex items-center gap-2">
                            <span>{{ $card['icon'] }}</span> {{ $card['title'] }}
                        </h2>
                        <p class="text-5xl font-extrabold">{{ $card['count'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- 🧩 Animated Glassmorphism Permission Viewer --}}
        <div 
            x-data="{ 
                permissions: @json(Auth::user()->getAllPermissions()->pluck('name')), 
                roles: @json(Auth::user()->getRoleNames()), 
                index: 0 
            }" 
            x-init="if(permissions.length > 0) setInterval(() => index = (index + 1) % permissions.length, 2500)"
            class="mx-8 mb-12 bg-white/10 backdrop-blur-2xl rounded-2xl border border-white/20 shadow-[0_8px_40px_rgba(0,0,0,0.5)] p-10 text-center relative overflow-hidden"
        >
            <div class="absolute inset-0 bg-gradient-to-r from-blue-600/10 via-cyan-500/10 to-purple-500/10 blur-2xl"></div>

            <h2 class="text-3xl font-bold mb-6 bg-clip-text text-transparent bg-gradient-to-r from-cyan-400 to-blue-500 relative z-10">
                🌐 Dynamic Permission Viewer
            </h2>
            


        {{-- start --}}

           {{-- Permissions Section --}}
        <div class="bg-gradient-to-br from-gray-800 to-gray-900 p-8 rounded-2xl shadow-xl border border-gray-700">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-2xl font-bold text-gradient bg-clip-text text-transparent bg-gradient-to-r from-blue-400 to-cyan-400">
                    ⚙️ Your Permissions
                </h2>
                <div class="animate-pulse text-sm text-gray-400">
                    Updated: {{ now()->format('M d, Y H:i') }}
                </div>
            </div>

            <ul class="space-y-2">
                @forelse(Auth::user()->getAllPermissions() as $permission)
                    <li class="flex items-center space-x-2 text-gray-300 hover:text-cyan-400 transition">
                        <span class="w-2 h-2 bg-cyan-400 rounded-full"></span>
                        <span>{{ $permission->name }}</span>
                    </li>
                @empty
                    <li class="text-gray-400 italic">No permissions assigned.</li>
                @endforelse
            </ul>
        </div>

        </div>

        {{-- 🌟 Footer --}}
        <div class="text-center text-gray-500 text-sm pb-10">
            ✨ Built with <span class="text-pink-400">Laravel</span> + <span class="text-blue-400">TailwindCSS</span> + <span class="text-emerald-400">Alpine.js</span>
        </div>
    </flux:main>
</x-layouts.app.sidebar>
