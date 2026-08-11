<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">

        <title inertia>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link
        href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,400;9..144,500;9..144,600&family=Inter:wght@400;500;600&family=JetBrains+Mono:wght@400;500&display=swap"
        rel="stylesheet"
        />

        <!-- theme-color TANPA media query: ini sengaja satu tag polos yang
             kontennya di-update lewat JS di bawah, supaya warna address
             bar/status bar HP selalu ikut tema AKTIF di halaman (manual
             toggle ATAU preferensi sistem), bukan cuma preferensi sistem. -->
        <meta name="theme-color" id="theme-color-meta" content="#faf9f6" />

        <script>
            (function () {
                var COLOR_LIGHT = '#faf9f6' // samakan dengan bg-paper di tailwind.config.js
                var COLOR_DARK = '#0f1115'  // samakan dengan bg-ink di tailwind.config.js

                function applyThemeColor(isDark) {
                    var meta = document.getElementById('theme-color-meta')
                    if (meta) meta.setAttribute('content', isDark ? COLOR_DARK : COLOR_LIGHT)
                }

                var stored = localStorage.getItem('lumi-theme')
                var prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches
                var isDark = stored === 'dark' || (!stored && prefersDark)

                if (isDark) document.documentElement.classList.add('dark')
                applyThemeColor(isDark)

                // Fallback jaga-jaga: kalau DarkModeToggle.vue nanti diubah
                // dan lupa sinkronkan theme-color, MutationObserver ini
                // otomatis tetap menjaga warna status bar konsisten dengan
                // class 'dark' di <html>, tanpa perlu edit toggle-nya.
                new MutationObserver(function () {
                    applyThemeColor(document.documentElement.classList.contains('dark'))
                }).observe(document.documentElement, { attributes: true, attributeFilter: ['class'] })
            })()
        </script>

        <!-- Scripts -->
        @routes
        @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
        @inertiaHead
    </head>
    <body class="font-sans antialiased">
        @inertia
    </body>
</html>