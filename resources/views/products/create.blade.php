@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto">
    <!-- Header -->
    <div class="mb-10 text-center">
        <h1 class="text-4xl font-serif font-bold tracking-tight text-maroon-900 mb-3">Add New Piece</h1>
        <div class="w-16 h-0.5 bg-gold mx-auto"></div>
    </div>

    <!-- Form -->
    <div class="bg-white rounded-2xl shadow-xl border border-cream-200 relative overflow-hidden">
        <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cream-paper.png')] opacity-20 pointer-events-none"></div>
        
        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="p-8 sm:p-12 relative z-10">
            @csrf
            
            <div class="space-y-8">
                <!-- Image Upload -->
                <div>
                    <label class="block text-xs font-bold text-maroon-900/60 uppercase tracking-widest mb-4">Piece Image</label>
                    <div class="border-2 border-dashed border-maroon-900/20 rounded-2xl p-8 text-center hover:border-gold transition-colors bg-cream-100/50">
                        <svg class="mx-auto h-12 w-12 text-maroon-900/40 mb-4" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <div class="flex flex-col sm:flex-row text-sm text-maroon-900 justify-center items-center gap-2">
                            <label for="image" class="relative cursor-pointer bg-white rounded-lg font-medium text-gold hover:text-gold-hover focus-within:outline-none px-3 py-1 shadow-sm border border-cream-200">
                                <span>Upload a file</span>
                                <input id="image" name="image" type="file" class="sr-only" accept="image/jpeg, image/png, image/jpg">
                            </label>
                            <p class="pl-1 font-serif italic text-maroon-900/60">or drag and drop</p>
                        </div>
                        <p class="text-xs text-maroon-900/50 mt-3 font-serif">PNG, JPG, JPEG up to 2MB</p>
                    </div>
                    @error('image')
                        <p class="text-rose-600 text-xs font-medium mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Name -->
                <div>
                    <label for="name" class="block text-xs font-bold text-maroon-900/60 uppercase tracking-widest mb-2">Item Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" class="block w-full px-4 py-3 rounded-xl border @error('name') border-rose-500 @else border-maroon-900/20 focus:border-gold focus:ring-1 focus:ring-gold @enderror bg-white text-base font-sans text-maroon-900 focus:outline-none shadow-sm transition-all" placeholder="e.g. Classic Signature Tote">
                    @error('name')
                        <p class="text-rose-600 text-xs font-medium mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Category -->
                <div>
                    <label for="category" class="block text-xs font-bold text-maroon-900/60 uppercase tracking-widest mb-2">Category</label>
                    <input type="text" name="category" id="category" value="{{ old('category') }}" class="block w-full px-4 py-3 rounded-xl border @error('category') border-rose-500 @else border-maroon-900/20 focus:border-gold focus:ring-1 focus:ring-gold @enderror bg-white text-base font-sans text-maroon-900 focus:outline-none shadow-sm transition-all" placeholder="e.g. Handbags">
                    @error('category')
                        <p class="text-rose-600 text-xs font-medium mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Price & Stock Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-10">
                    <div>
                        <label for="price" class="block text-xs font-bold text-maroon-900/60 uppercase tracking-widest mb-2">Price (IDR)</label>
                        <input type="number" step="0.01" min="0" name="price" id="price" value="{{ old('price') }}" class="block w-full px-4 py-3 rounded-xl border @error('price') border-rose-500 @else border-maroon-900/20 focus:border-gold focus:ring-1 focus:ring-gold @enderror bg-white text-base font-sans text-maroon-900 focus:outline-none shadow-sm transition-all" placeholder="0">
                        @error('price')
                            <p class="text-rose-600 text-xs font-medium mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="stock" class="block text-xs font-bold text-maroon-900/60 uppercase tracking-widest mb-2">Available Quantity</label>
                        <input type="number" min="0" name="stock" id="stock" value="{{ old('stock', 0) }}" class="block w-full px-4 py-3 rounded-xl border @error('stock') border-rose-500 @else border-maroon-900/20 focus:border-gold focus:ring-1 focus:ring-gold @enderror bg-white text-base font-sans text-maroon-900 focus:outline-none shadow-sm transition-all">
                        @error('stock')
                            <p class="text-rose-600 text-xs font-medium mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Footer Actions -->
            <div class="mt-12 pt-8 border-t border-maroon-900/10 flex flex-col sm:flex-row items-center justify-between gap-4">
                <a href="{{ route('products.index') }}" class="w-full sm:w-auto text-center px-8 py-3 text-sm tracking-widest uppercase font-medium text-maroon-900 hover:text-gold transition-colors rounded-xl">
                    Cancel
                </a>
                <button type="submit" class="w-full sm:w-auto px-10 py-3 rounded-xl text-sm tracking-widest uppercase font-medium text-maroon-900 bg-gold hover:bg-gold-hover hover:text-white shadow-md transition-colors">
                    Save Piece
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
