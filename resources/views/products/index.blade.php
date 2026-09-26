@extends('layouts.app')

@section('content')
<!-- Header & Search -->
<div class="mb-10 flex flex-col md:flex-row md:items-end justify-between gap-6">
    <div>
        <h1 class="text-4xl font-serif font-bold text-maroon-900 tracking-tight">The Collection</h1>
        <p class="text-maroon-800/70 mt-2 font-medium tracking-wide uppercase text-xs">Curated exclusive items</p>
    </div>
    
    <form action="{{ route('products.index') }}" method="GET" class="relative group w-full md:w-96">
        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
            <svg class="h-4 w-4 text-maroon-900/40 group-focus-within:text-gold transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
        </div>
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search collection..." class="block w-full pl-11 pr-4 py-3.5 border-b-2 border-maroon-900/20 bg-transparent text-maroon-900 placeholder-maroon-900/40 focus:outline-none focus:border-gold transition-colors font-serif text-lg italic">
    </form>
</div>

<!-- Product Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">
    @forelse($products as $product)
        <div class="group bg-white flex flex-col h-full relative shadow-md hover:shadow-2xl transition-all duration-500 overflow-hidden border border-cream-200">
            
            <!-- Luxury Image or Placeholder -->
            <div class="h-56 bg-cream-100 border-b border-cream-200 relative overflow-hidden flex items-center justify-center">
                @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                @else
                    <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cream-paper.png')] opacity-50"></div>
                    <div class="w-16 h-16 rounded-full border border-gold flex items-center justify-center relative z-10 bg-white/50 backdrop-blur-sm">
                        <span class="font-serif text-2xl text-maroon-900 italic">{{ substr($product->name, 0, 1) }}</span>
                    </div>
                @endif
            </div>

            <div class="p-8 flex-grow flex flex-col bg-white">
                <div class="flex justify-between items-start mb-4">
                    <span class="text-[10px] tracking-[0.2em] uppercase text-maroon-900/60 font-bold">
                        {{ $product->category }}
                    </span>
                    @if($product->stock == 0)
                        <span class="text-[10px] tracking-wider uppercase text-rose-600 font-bold">Sold Out</span>
                    @else
                        <span class="text-[10px] tracking-wider uppercase text-gold font-bold">
                            {{ $product->stock }} Available
                        </span>
                    @endif
                </div>
                
                <h2 class="text-2xl font-serif font-bold text-maroon-900 leading-tight mb-6 group-hover:text-gold transition-colors">
                    {{ $product->name }}
                </h2>
                
                <div class="mt-auto pt-6 border-t border-maroon-900/10 flex items-center justify-between">
                    <p class="text-xl font-serif italic text-maroon-900">
                        Rp {{ number_format($product->price, 0, ',', '.') }}
                    </p>
                </div>
            </div>
            
            @if(auth()->user()->role === 'admin')
            <div class="absolute top-4 right-4 flex flex-col gap-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                <a href="{{ route('products.edit', $product->id) }}" class="w-8 h-8 bg-white/90 backdrop-blur rounded-full flex items-center justify-center text-maroon-900 hover:text-gold hover:bg-maroon-900 shadow-lg transition-all" title="Edit">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                </a>
                <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Remove this piece from the collection?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-8 h-8 bg-white/90 backdrop-blur rounded-full flex items-center justify-center text-maroon-900 hover:text-white hover:bg-rose-800 shadow-lg transition-all" title="Delete">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                    </button>
                </form>
            </div>
            @endif
        </div>
    @empty
        <!-- Empty State -->
        <div class="col-span-full bg-white border border-maroon-900/10 p-16 text-center shadow-sm">
            <div class="mx-auto w-20 h-20 border border-gold rounded-full flex items-center justify-center mb-6">
                <svg class="w-8 h-8 text-gold" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                </svg>
            </div>
            <h3 class="text-2xl font-serif font-bold text-maroon-900 mb-2">Collection Empty</h3>
            <p class="text-maroon-900/60 mb-8 max-w-md mx-auto font-serif italic">
                @if(request('search'))
                    No pieces match your search criteria.
                @else
                    The boutique currently holds no items.
                @endif
            </p>
            @if(request('search'))
                <a href="{{ route('products.index') }}" class="inline-block px-8 py-3 border border-maroon-900 text-sm tracking-widest uppercase font-medium text-maroon-900 hover:bg-maroon-900 hover:text-gold transition-colors">
                    Clear Search
                </a>
            @else
                @if(auth()->user()->role === 'admin')
                <a href="{{ route('products.create') }}" class="inline-block px-8 py-3 bg-maroon-900 text-gold text-sm tracking-widest uppercase font-medium hover:bg-maroon-800 transition-colors">
                    Add First Piece
                </a>
                @endif
            @endif
        </div>
    @endforelse
</div>

<!-- Pagination -->
<div class="mt-12 font-serif">
    {{ $products->links() }}
</div>
@endsection
