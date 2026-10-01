@php
    $user = Auth::user();
    $initial = $user ? mb_strtoupper(mb_substr($user->name, 0, 1)) : null;
@endphp
<nav class="nav" x-data="{ open: false }">
    <div class="container nav-inner">
        <a href="{{ route('home') }}" class="brand">
            <span class="brand-mark"><x-application-logo /></span> {{ config('app.name') }}
        </a>

        <div class="nav-links">
            <x-nav-link :href="route('home')" :active="request()->routeIs('home')">Toko</x-nav-link>
            @auth
                <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">Dashboard</x-nav-link>
                @if ($user->hasRole('admin', 'editor'))
                    <x-nav-link :href="route('posts.index')" :active="request()->routeIs('posts.*')">Konten</x-nav-link>
                    <x-nav-link :href="route('editor.area')" :active="request()->routeIs('editor.area', 'demo.eager')">Area Editor</x-nav-link>
                @endif
                @if ($user->isAdmin())
                    <x-nav-link :href="route('admin.area')" :active="request()->routeIs('admin.area')">Area Admin</x-nav-link>
                @endif
            @endauth
        </div>

        <div class="nav-right">
            @auth
                @if ($user->hasRole('admin', 'editor'))
                    <a href="/admin" class="btn btn-soft btn-sm hide-sm">Panel Filament ↗</a>
                @endif
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="user-chip" type="button">
                            <span class="avatar">{{ $initial }}</span>
                            <span class="hide-sm">{{ \Illuminate\Support\Str::limit($user->name, 18) }}</span>
                            <span class="muted">▾</span>
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <div class="menu-head">
                            <b>{{ $user->name }}</b>
                            <div class="small muted">{{ $user->email }}</div>
                            <span class="badge badge-brand" style="margin-top:8px">{{ ucfirst($user->role) }}</span>
                        </div>
                        <x-dropdown-link :href="route('profile.edit')">Profil saya</x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">Keluar</x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            @else
                <a href="{{ route('login') }}" class="btn btn-ghost btn-sm">Masuk</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="btn btn-primary btn-sm hide-sm">Daftar</a>
                @endif
            @endauth

            <button class="nav-toggle" @click="open = ! open" aria-label="Menu" type="button">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M4 7h16M4 12h16M4 17h16"/></svg>
            </button>
        </div>
    </div>

    <div class="mobile-menu" :class="{ 'open': open }">
        <div class="container">
            <x-responsive-nav-link :href="route('home')">Toko</x-responsive-nav-link>
            @auth
                <x-responsive-nav-link :href="route('dashboard')">Dashboard</x-responsive-nav-link>
                @if ($user->hasRole('admin', 'editor'))
                    <x-responsive-nav-link :href="route('posts.index')">Konten</x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('editor.area')">Area Editor</x-responsive-nav-link>
                    <x-responsive-nav-link href="/admin">Panel Filament</x-responsive-nav-link>
                @endif
                @if ($user->isAdmin())
                    <x-responsive-nav-link :href="route('admin.area')">Area Admin</x-responsive-nav-link>
                @endif
                <x-responsive-nav-link :href="route('profile.edit')">Profil saya</x-responsive-nav-link>
            @else
                <x-responsive-nav-link :href="route('register')">Daftar</x-responsive-nav-link>
            @endauth
        </div>
    </div>
</nav>
