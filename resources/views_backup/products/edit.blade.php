@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto">
    <!-- Header -->
    <div class="mb-10 text-center">
        <h1 class="text-4xl font-serif font-bold tracking-tight text-maroon-900 mb-3">Edit Piece</h1>
        <p class="text-maroon-800/70 mb-4 font-serif italic">{{ $product->name }}</p>
        <div class="w-16 h-0.5 bg-gold mx-auto"></div>
    </div>

    <!-- Form -->
    <div class="bg-white rounded-2xl shadow-xl border border-cream-200 relative overflow-hidden">
        <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cream-paper.png')] opacity-20 pointer-events-none"></div>
        
        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="p-8 sm:p-12 relative z-10">
            @csrf
            @method('PUT')
            
            <div class="space-y-8">
                <!-- Image Upload & Preview -->
                <div>
                    <label class="block text-xs font-bold text-maroon-900/60 uppercase tracking-widest mb-4">Piece Image</label>
                    
                    <div class="flex items-center gap-6">
                        <!-- Preview -->
                        <div class="w-24 h-24 shrink-0 bg-cream-100 border border-maroon-900/10 rounded-xl overflow-hidden flex items-center justify-center">
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                            @else
                                <span class="font-serif text-2xl text-maroon-900/40 italic">{{ substr($product->name, 0, 1) }}</span>
                            @endif
                        </div>
                        
                        <!-- Upload Input -->
                        <div class="flex-1 border-2 border-dashed border-maroon-900/20 rounded-2xl p-4 text-center hover:border-gold transition-colors bg-cream-100/50">
                            <div class="flex flex-col sm:flex-row text-sm text-maroon-900 justify-center items-center gap-2">
                                <label for="image" class="relative cursor-pointer bg-white rounded-lg font-medium text-gold hover:text-gold-hover focus-within:outline-none px-3 py-1 shadow-sm border border-cream-200">
                                    <span>Upload new file</span>
                                    <input id="image" name="image" type="file" class="sr-only" accept="image/jpeg, image/png, image/jpg">
                                </label>
                            </div>
                            <p class="text-[10px] text-maroon-900/50 mt-2 font-serif uppercase tracking-widest">Optional. PNG, JPG max 2MB</p>
                        </div>
                    </div>
                    @error('image')
                        <p class="text-rose-600 text-xs font-medium mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Name -->
                <div>
                    <label for="name" class="block text-xs font-bold text-maroon-900/60 uppercase tracking-widest mb-2">Item Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}" class="block w-full px-4 py-3 rounded-xl border @error('name') border-rose-500 @else border-maroon-900/20 focus:border-gold focus:ring-1 focus:ring-gold @enderror bg-white text-base font-sans text-maroon-900 focus:outline-none shadow-sm transition-all" placeholder="e.g. Classic Signature Tote">
                    @error('name')
                        <p class="text-rose-600 text-xs font-medium mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Category -->
                <div>
                    <label for="category" class="block text-xs font-bold text-maroon-900/60 uppercase tracking-widest mb-2">Category</label>
                    <input type="text" name="category" id="category" value="{{ old('category', $product->category) }}" class="block w-full px-4 py-3 rounded-xl border @error('category') border-rose-500 @else border-maroon-900/20 focus:border-gold focus:ring-1 focus:ring-gold @enderror bg-white text-base font-sans text-maroon-900 focus:outline-none shadow-sm transition-all" placeholder="e.g. Handbags">
                    @error('category')
                        <p class="text-rose-600 text-xs font-medium mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Price & Stock Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-10">
                    <div>
                        <label for="price" class="block text-xs font-bold text-maroon-900/60 uppercase tracking-widest mb-2">Price (IDR)</label>
                        <input type="number" step="0.01" min="0" name="price" id="price" value="{{ old('price', (float)$product->price) }}" class="block w-full px-4 py-3 rounded-xl border @error('price') border-rose-500 @else border-maroon-900/20 focus:border-gold focus:ring-1 focus:ring-gold @enderror bg-white text-base font-sans text-maroon-900 focus:outline-none shadow-sm transition-all" placeholder="0">
                        @error('price')
                            <p class="text-rose-600 text-xs font-medium mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="stock" class="block text-xs font-bold text-maroon-900/60 uppercase tracking-widest mb-2">Available Quantity</label>
                        <input type="number" min="0" name="stock" id="stock" value="{{ old('stock', $product->stock) }}" class="block w-full px-4 py-3 rounded-xl border @error('stock') border-rose-500 @else border-maroon-900/20 focus:border-gold focus:ring-1 focus:ring-gold @enderror bg-white text-base font-sans text-maroon-900 focus:outline-none shadow-sm transition-all">
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
                    Update Piece
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
