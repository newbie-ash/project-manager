<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Luxury Manager</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        maroon: {
                            50: '#fdf3f4',
                            100: '#fbe4e7',
                            200: '#f5c6cb',
                            800: '#6d1020',
                            900: '#4a0b16',
                        },
                        cream: {
                            DEFAULT: '#f9f6f0',
                            100: '#fffdf8',
                            200: '#f3ead8',
                        },
                        gold: {
                            DEFAULT: '#d4af37',
                            hover: '#b5952f',
                            light: '#f3e5ab'
                        }
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        serif: ['Playfair Display', 'serif'],
                    }
                }
            }
        }
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400;1,600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .font-serif { font-family: 'Playfair Display', serif; }
        .animate-fade-in-down {
            animation: fadeInDown 0.4s ease-out;
        }
        @keyframes fadeInDown {
            0% { opacity: 0; transform: translateY(-10px); }
            100% { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body class="bg-cream text-slate-800 antialiased selection:bg-gold-light selection:text-maroon-900">
    
    <div class="flex h-screen overflow-hidden">
        
        <!-- Sidebar (Desktop) -->
        <aside class="w-72 bg-maroon-900 text-white flex-col hidden md:flex border-r border-maroon-800 shadow-2xl z-20">
            <!-- Brand -->
            <div class="h-24 flex items-center justify-center border-b border-maroon-800/50">
                <a href="{{ route('products.index') }}" class="flex flex-col items-center">
                    <span class="font-serif text-3xl text-gold font-bold italic tracking-wider">L'Aura</span>
                    <span class="text-[10px] tracking-[0.3em] uppercase text-cream/70 mt-1">Maison de Luxe</span>
                </a>
            </div>
            
            <!-- Navigation -->
            <nav class="flex-1 px-5 py-8 space-y-3">
                <p class="px-4 text-xs font-semibold text-maroon-200/50 uppercase tracking-widest mb-4">Menu</p>
                <a href="{{ route('products.index') }}" class="flex items-center px-4 py-3 bg-maroon-800/60 rounded-xl text-gold font-medium border border-maroon-800 hover:bg-maroon-800 transition-colors shadow-inner">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    Collection
                </a>
                
                @auth
                    @if(auth()->user()->role === 'admin')
                    <a href="{{ route('products.create') }}" class="flex items-center px-4 py-3 text-cream/70 hover:text-gold hover:bg-maroon-800/40 rounded-xl font-medium transition-colors">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4v16m8-8H4"></path></svg>
                        Add New Piece
                    </a>
                    @endif
                @endauth
            </nav>

            <!-- User Area -->
            <div class="p-6 border-t border-maroon-800/50 bg-maroon-900">
                @auth
                <div class="flex items-center gap-4 mb-5">
                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-gold to-yellow-600 flex items-center justify-center text-maroon-900 font-bold font-serif shadow-lg">
                        {{ substr(auth()->user()->name, 0, 1) }}
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-cream">{{ auth()->user()->name }}</p>
                        <p class="text-[11px] text-gold uppercase tracking-wider font-medium">{{ auth()->user()->role }}</p>
                    </div>
                </div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full flex items-center justify-center px-4 py-2 text-sm font-medium text-maroon-200 hover:text-white border border-maroon-800 hover:bg-maroon-800 rounded-lg transition-all">
                        Sign Out
                    </button>
                </form>
                @endauth
            </div>
        </aside>

        <!-- Main Content Wrapper -->
        <div class="flex-1 flex flex-col min-w-0 bg-[url('https://www.transparenttextures.com/patterns/cream-paper.png')]">
            
            <!-- Mobile Header -->
            <header class="bg-maroon-900 border-b border-maroon-800 px-6 py-4 flex items-center justify-between md:hidden shadow-md z-10">
                <span class="font-serif text-2xl text-gold font-bold italic">L'Aura</span>
                @auth
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="text-xs text-cream uppercase tracking-wider">Logout</button>
                </form>
                @endauth
            </header>

            <!-- Main Scrollable Area -->
            <main class="flex-1 overflow-y-auto p-6 sm:p-12">
                <div class="max-w-6xl mx-auto">
                    @if(session('success'))
                        <!-- Floating Popup Toast Success -->
                        <div id="toast-success-app" class="fixed top-8 right-8 z-50 bg-white border border-cream-200 border-l-4 border-l-gold shadow-2xl p-5 min-w-[300px] transform transition-all duration-500 ease-out translate-y-0 opacity-100">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-cream-100 flex items-center justify-center">
                                        <svg class="w-4 h-4 text-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                    </div>
                                    <span class="font-serif italic text-maroon-900 font-medium">{{ session('success') }}</span>
                                </div>
                                <button onclick="closeAppToast('toast-success-app')" class="text-maroon-900/40 hover:text-maroon-900 transition-colors ml-4 focus:outline-none">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                </button>
                            </div>
                        </div>
                    @endif
                    @if(session('error'))
                        <!-- Floating Popup Toast Error -->
                        <div id="toast-error-app" class="fixed top-8 right-8 z-50 bg-white border border-cream-200 border-l-4 border-l-rose-600 shadow-2xl p-5 min-w-[300px] transform transition-all duration-500 ease-out translate-y-0 opacity-100">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-rose-50 flex items-center justify-center">
                                        <svg class="w-4 h-4 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                    </div>
                                    <span class="font-serif italic text-maroon-900 font-medium">{{ session('error') }}</span>
                                </div>
                                <button onclick="closeAppToast('toast-error-app')" class="text-maroon-900/40 hover:text-maroon-900 transition-colors ml-4 focus:outline-none">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                </button>
                            </div>
                        </div>
                    @endif
                    <script>
                        function closeAppToast(id) {
                            const toast = document.getElementById(id);
                            if (toast) {
                                toast.classList.remove('translate-y-0', 'opacity-100');
                                toast.classList.add('-translate-y-4', 'opacity-0');
                                setTimeout(() => toast.remove(), 500);
                            }
                        }
                        setTimeout(() => closeAppToast('toast-success-app'), 4000);
                        setTimeout(() => closeAppToast('toast-error-app'), 5000);
                    </script>

                    @yield('content')
                </div>
            </main>
        </div>
        
    </div>

</body>
</html>
