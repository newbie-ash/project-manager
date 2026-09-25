@extends('layouts.app')

@section('content')
<!-- Header & Search -->
<div class="mb-8 flex flex-col md:flex-row md:items-end justify-between gap-5">
    <div>
        <h1 class="text-3xl font-bold tracking-tight text-slate-900">Inventory</h1>
        <p class="text-slate-500 mt-1.5 text-sm font-medium">Manage your product catalog and stock levels.</p>
    </div>
    
    <form action="{{ route('products.index') }}" method="GET" class="relative group w-full md:w-80">
        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
            <svg class="h-5 w-5 text-slate-400 group-focus-within:text-indigo-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
        </div>
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name or category..." class="block w-full pl-10 pr-3 py-3 border border-slate-200 rounded-2xl text-sm leading-5 bg-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all shadow-sm hover:shadow-md">
    </form>
</div>

<!-- Product Grid -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
    @forelse($products as $product)
        <div class="group bg-white rounded-3xl border border-slate-200/60 overflow-hidden hover:shadow-xl hover:shadow-indigo-500/5 hover:border-indigo-200 transition-all duration-300 flex flex-col h-full relative">
            
            <div class="p-6 flex-grow flex flex-col">
                <div class="flex justify-between items-start mb-5">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-slate-100 text-slate-700 border border-slate-200/60">
                        {{ $product->category }}
                    </span>
                    @if($product->stock == 0)
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-rose-50 text-rose-700 border border-rose-100">
                            Out of Stock
                        </span>
                    @else
                        <span class="inline-flex items-center text-xs font-medium text-slate-500 bg-white border border-slate-100 shadow-sm px-2.5 py-1 rounded-full">
                            <svg class="w-3.5 h-3.5 mr-1.5 {{ $product->stock < 10 ? 'text-amber-500' : 'text-emerald-500' }}" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path></svg>
                            {{ $product->stock }} left
                        </span>
                    @endif
                </div>
                
                <h2 class="text-lg font-bold text-slate-800 leading-snug mb-1 group-hover:text-indigo-600 transition-colors line-clamp-2" title="{{ $product->name }}">
                    {{ $product->name }}
                </h2>
                
                <div class="mt-auto pt-6 flex items-end justify-between">
                    <div>
                        <p class="text-[11px] text-slate-400 font-bold uppercase tracking-widest mb-1">Price</p>
                        <p class="text-2xl font-black text-slate-900 tracking-tight">Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>
            
            <div class="px-5 py-4 bg-slate-50/50 border-t border-slate-100 flex justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300 focus-within:opacity-100">
                <a href="{{ route('products.edit', $product->id) }}" class="inline-flex items-center justify-center p-2 rounded-xl text-slate-500 hover:text-indigo-600 hover:bg-white hover:shadow-sm border border-transparent hover:border-slate-200 transition-all focus:outline-none focus:ring-2 focus:ring-indigo-500" title="Edit Product">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                </a>
                <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Delete this product permanently?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="inline-flex items-center justify-center p-2 rounded-xl text-slate-500 hover:text-rose-600 hover:bg-white hover:shadow-sm border border-transparent hover:border-slate-200 transition-all focus:outline-none focus:ring-2 focus:ring-rose-500" title="Delete Product">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                    </button>
                </form>
            </div>
            <!-- Focus outline helper for accessibility -->
            <div class="absolute inset-0 border-2 border-transparent group-focus-within:border-indigo-500 rounded-3xl pointer-events-none"></div>
        </div>
    @empty
        <!-- Empty State -->
        <div class="col-span-full bg-white rounded-[2rem] border border-slate-200/60 p-12 text-center shadow-sm">
            <div class="mx-auto w-24 h-24 bg-slate-50 rounded-full flex items-center justify-center mb-6 ring-8 ring-slate-50/50">
                <svg class="w-12 h-12 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                </svg>
            </div>
            <h3 class="text-xl font-bold text-slate-900 mb-2 tracking-tight">No products found</h3>
            <p class="text-slate-500 mb-8 max-w-md mx-auto text-sm leading-relaxed">
                @if(request('search'))
                    We couldn't find anything matching "<span class="font-medium text-slate-800">{{ request('search') }}</span>". Try adjusting your search term.
                @else
                    Your inventory is completely empty. Start by adding your first product to the catalog.
                @endif
            </p>
            @if(request('search'))
                <a href="{{ route('products.index') }}" class="inline-flex items-center justify-center px-6 py-2.5 border border-slate-300 shadow-sm text-sm font-medium rounded-full text-slate-700 bg-white hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                    Clear Search
                </a>
            @else
                <a href="{{ route('products.create') }}" class="inline-flex items-center justify-center px-6 py-3 border border-transparent shadow-sm text-sm font-semibold rounded-full text-white bg-slate-900 hover:bg-slate-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-900 transition-all">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path></svg>
                    Add Your First Product
                </a>
            @endif
        </div>
    @endforelse
</div>

<!-- Pagination -->
<div class="mt-12">
    {{ $products->links() }}
</div>
@endsection
