<x-app-layout title="Profil">
    <x-slot name="header">
        <div class="row" style="gap:16px">
            <span class="avatar avatar-lg">{{ mb_strtoupper(mb_substr(auth()->user()->name, 0, 1)) }}</span>
            <div>
                <h1>Profil saya</h1>
                <p>{{ auth()->user()->email }} · <span class="badge badge-brand">{{ ucfirst(auth()->user()->role) }}</span></p>
            </div>
        </div>
    </x-slot>

    <div class="stack" style="max-width: 720px; --gap: 20px">
        <div class="card card-pad">@include('profile.partials.update-profile-information-form')</div>
        <div class="card card-pad">@include('profile.partials.update-password-form')</div>
        <div class="card card-pad danger-zone">@include('profile.partials.delete-user-form')</div>
    </div>
</x-app-layout>
