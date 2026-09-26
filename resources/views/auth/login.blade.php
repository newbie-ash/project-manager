<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authentication - L'Aura</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        maroon: { 50: '#fdf3f4', 800: '#6d1020', 900: '#4a0b16' },
                        cream: { DEFAULT: '#f9f6f0', 100: '#fffdf8', 200: '#f3ead8' },
                        gold: { DEFAULT: '#d4af37', hover: '#b5952f' }
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        serif: ['Playfair Display', 'serif'],
                    }
                }
            }
        }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&display=swap" rel="stylesheet">
    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="bg-maroon-900 min-h-screen flex items-center justify-center p-4 bg-[url('https://www.transparenttextures.com/patterns/stardust.png')]">
    <div class="max-w-md w-full bg-cream rounded-2xl shadow-2xl overflow-hidden relative">
        <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cream-paper.png')] opacity-40 pointer-events-none"></div>
        
        <div class="p-10 relative z-10">
            <div class="text-center mb-10">
                <h1 class="text-4xl font-serif font-bold text-maroon-900 italic tracking-wider mb-2">L'Aura</h1>
                <p class="text-[10px] tracking-[0.3em] uppercase text-maroon-900/60 font-bold">Maison de Luxe</p>
                <div class="w-12 h-px bg-gold mx-auto mt-6"></div>
            </div>

            @if($errors->any())
                <div class="mb-8 bg-rose-50 border-l-2 border-rose-600 text-rose-800 px-4 py-3 text-sm font-serif italic rounded-r-lg">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            @if(session('success'))
                <!-- Floating Popup Toast -->
                <div id="toast-success" class="fixed top-8 right-8 z-50 bg-white border border-cream-200 border-l-4 border-l-gold shadow-2xl p-5 min-w-[300px] rounded-r-xl rounded-l-md transform transition-all duration-500 ease-out translate-y-0 opacity-100">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-cream-100 flex items-center justify-center">
                                <svg class="w-4 h-4 text-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                            <span class="font-serif italic text-maroon-900 font-medium">{{ session('success') }}</span>
                        </div>
                        <button onclick="closeToast()" class="text-maroon-900/40 hover:text-maroon-900 transition-colors ml-4 focus:outline-none">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </button>
                    </div>
                </div>
                
                <script>
                    function closeToast() {
                        const toast = document.getElementById('toast-success');
                        if (toast) {
                            toast.classList.remove('translate-y-0', 'opacity-100');
                            toast.classList.add('-translate-y-4', 'opacity-0');
                            setTimeout(() => toast.remove(), 500);
                        }
                    }
                    
                    // Auto close after 4 seconds
                    setTimeout(closeToast, 4000);
                </script>
            @endif

            <form action="{{ route('login') }}" method="POST" class="space-y-8">
                @csrf
                <div>
                    <label class="block text-[10px] font-bold text-maroon-900/60 uppercase tracking-widest mb-2">Email Identity</label>
                    <input type="email" name="email" value="{{ old('email') }}" required class="w-full px-4 py-3 rounded-xl bg-white border border-maroon-900/20 focus:border-gold focus:ring-1 focus:ring-gold focus:outline-none transition-all text-maroon-900 font-sans text-base shadow-sm">
                </div>
                <div>
                    <label class="block text-[10px] font-bold text-maroon-900/60 uppercase tracking-widest mb-2">Passphrase</label>
                    <input type="password" name="password" required class="w-full px-4 py-3 rounded-xl bg-white border border-maroon-900/20 focus:border-gold focus:ring-1 focus:ring-gold focus:outline-none transition-all text-maroon-900 font-sans text-base shadow-sm">
                </div>
                
                <button type="submit" class="w-full bg-maroon-900 text-gold text-xs tracking-[0.2em] uppercase font-bold py-4 rounded-xl hover:bg-maroon-800 transition-colors mt-4 shadow-md">
                    Authenticate
                </button>
            </form>
        </div>
    </div>
</body>
</html>
