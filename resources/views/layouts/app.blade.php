<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>@include('layouts.partials-head', ['title' => $title ?? null])</head>
    <body>
        @include('layouts.navigation')

        @isset($header)
            <header class="container page-head">{{ $header }}</header>
        @endisset

        <main class="@isset($header) container page @endisset">
            {{ $slot }}
        </main>

        <footer class="footer">
            <div class="container">
                <span>© {{ date('Y') }} {{ config('app.name') }} · Tugas Rutin 11 — E-Commerce DB + Secure Auth</span>
                <span>Dibangun dengan Laravel {{ app()->version() }} · Breeze · Filament</span>
            </div>
        </footer>
    </body>
</html>
