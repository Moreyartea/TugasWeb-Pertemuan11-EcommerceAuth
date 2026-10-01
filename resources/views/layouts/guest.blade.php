<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>@include('layouts.partials-head', ['title' => $title ?? null])</head>
    <body>
        <div class="auth">
            <aside class="auth-side">
                <a href="{{ route('home') }}" class="brand">
                    <span class="brand-mark"><x-application-logo /></span> {{ config('app.name') }}
                </a>
                <div>
                    <h2>Belanja pintar, akses aman, kontrol penuh.</h2>
                    <p>Platform e-commerce dengan autentikasi berlapis: hak akses berbasis peran untuk admin, editor, dan pelanggan.</p>
                    <ul class="auth-points">
                        <li><b>🔐</b> Login &amp; registrasi aman dengan Laravel Breeze</li>
                        <li><b>🛡️</b> Middleware role &amp; Policy per-record</li>
                        <li><b>📦</b> Katalog 60+ produk dengan relasi Eloquent</li>
                    </ul>
                </div>
                <span class="small" style="color: rgba(255,255,255,.55)">Tugas Rutin 11 · Pemrograman Web</span>
            </aside>

            <section class="auth-main">
                <div class="auth-card">
                    {{ $slot }}
                </div>
            </section>
        </div>
    </body>
</html>
