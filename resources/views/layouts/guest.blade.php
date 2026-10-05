<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        <script src="https://cdn.tailwindcss.com"></script>

        <style>
            @keyframes float-slow {
                0%, 100% { transform: translate(0, 0) scale(1); }
                33% { transform: translate(30px, -40px) scale(1.08); }
                66% { transform: translate(-20px, 25px) scale(0.95); }
            }
            @keyframes float-slower {
                0%, 100% { transform: translate(0, 0) scale(1); }
                50% { transform: translate(-35px, -25px) scale(1.1); }
            }
            @keyframes float-reverse {
                0%, 100% { transform: translate(0, 0) scale(1); }
                40% { transform: translate(-25px, 30px) scale(1.05); }
                70% { transform: translate(20px, -20px) scale(0.9); }
            }
            @keyframes spin-slow {
                from { transform: rotate(0deg); }
                to { transform: rotate(360deg); }
            }
            @keyframes spin-slow-reverse {
                from { transform: rotate(360deg); }
                to { transform: rotate(0deg); }
            }
            @keyframes pulse-soft {
                0%, 100% { opacity: 0.25; transform: scale(1); }
                50% { opacity: 0.5; transform: scale(1.15); }
            }
            @keyframes drift-x {
                0%, 100% { transform: translateX(0); }
                50% { transform: translateX(20px); }
            }
            .blob-1 { animation: float-slow 14s ease-in-out infinite; }
            .blob-2 { animation: float-slower 18s ease-in-out infinite; }
            .blob-3 { animation: float-reverse 16s ease-in-out infinite; }
            .spin-slow { animation: spin-slow 30s linear infinite; }
            .spin-slow-reverse { animation: spin-slow-reverse 24s linear infinite; }
            .pulse-soft { animation: pulse-soft 6s ease-in-out infinite; }
            .drift-x { animation: drift-x 9s ease-in-out infinite; }
            .bg-grid {
                background-image:
                    linear-gradient(to right, rgba(20,184,166,0.08) 1px, transparent 1px),
                    linear-gradient(to bottom, rgba(20,184,166,0.08) 1px, transparent 1px);
                background-size: 48px 48px;
                mask-image: radial-gradient(ellipse 80% 80% at 50% 50%, black 40%, transparent 100%);
            }
        </style>
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="relative min-h-screen flex flex-col justify-center items-center overflow-hidden bg-slate-50 px-4">

            <!-- Grid -->
            <div class="absolute inset-0 bg-grid"></div>

            <!-- Floating background blobs -->
            <div class="pointer-events-none absolute inset-0">
                <div class="blob-1 absolute -top-24 -left-20 w-96 h-96 rounded-full bg-teal-300/40 blur-3xl"></div>
                <div class="blob-2 absolute top-1/3 -right-24 w-[28rem] h-[28rem] rounded-full bg-cyan-200/50 blur-3xl"></div>
                <div class="blob-3 absolute -bottom-32 left-1/4 w-80 h-80 rounded-full bg-emerald-200/40 blur-3xl"></div>
                <div class="blob-2 absolute bottom-10 right-10 w-64 h-64 rounded-full bg-teal-200/30 blur-2xl"></div>
            </div>

            <!-- Decorative shapes -->
            <div class="pointer-events-none absolute inset-0">
                <div class="spin-slow absolute top-16 right-20 w-28 h-28 rounded-full border-2 border-dashed border-teal-400/40"></div>
                <div class="spin-slow-reverse absolute bottom-24 left-16 w-20 h-20 rounded-full border-2 border-dashed border-cyan-400/40"></div>
                <div class="spin-slow absolute top-1/2 left-10 w-14 h-14 rounded-full border border-teal-300/50"></div>

                <svg class="drift-x absolute top-24 left-1/4 w-6 h-6 text-teal-400/50" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" d="M12 4v16M4 12h16"/>
                </svg>
                <svg class="pulse-soft absolute bottom-1/3 right-1/4 w-5 h-5 text-cyan-500/50" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" d="M12 4v16M4 12h16"/>
                </svg>
                <svg class="drift-x absolute top-1/3 right-16 w-4 h-4 text-teal-500/40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" d="M12 4v16M4 12h16"/>
                </svg>

                <div class="pulse-soft absolute top-40 right-1/3 w-3 h-3 rounded-full bg-teal-400/60"></div>
                <div class="pulse-soft absolute bottom-16 right-1/2 w-2.5 h-2.5 rounded-full bg-cyan-400/60" style="animation-delay: 2s;"></div>
                <div class="pulse-soft absolute top-1/4 left-1/3 w-2 h-2 rounded-full bg-emerald-400/60" style="animation-delay: 4s;"></div>
                <div class="pulse-soft absolute bottom-1/4 left-20 w-3 h-3 rounded-full bg-teal-300/60" style="animation-delay: 1s;"></div>

                <div class="drift-x absolute bottom-20 left-1/3 w-10 h-10 border-2 border-teal-400/30 rounded-lg rotate-12"></div>
                <div class="spin-slow-reverse absolute top-20 left-1/2 w-8 h-8 border-2 border-cyan-400/30 rounded-md"></div>
            </div>

            <!-- Logo -->
            <div class="relative z-10 mb-6">
                <a href="/">
                    <x-application-logo class="w-16 h-16 fill-current text-teal-500 drop-shadow-sm" />
                </a>
            </div>

            <!-- Card -->
            <div class="relative z-10 w-full sm:max-w-md p-8 rounded-2xl
                        bg-white/70 backdrop-blur-xl border border-white/60
                        shadow-xl shadow-teal-900/10">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>