@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto">
    <!-- Header -->
    <div class="mb-8 flex items-center justify-between">
        <div class="flex items-center gap-3">
            <a href="{{ route('products.index') }}" class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white border border-slate-200 text-slate-500 hover:text-slate-700 hover:bg-slate-50 transition-colors focus:outline-none focus:ring-2 focus:ring-indigo-500">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <div>
                <h1 class="text-2xl font-bold tracking-tight text-slate-900">Edit Product</h1>
                <p class="text-sm text-slate-500 font-medium">Update details for {{ $product->name }}</p>
            </div>
        </div>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-[2rem] border border-slate-200/60 shadow-sm overflow-hidden">
        <form action="{{ route('products.update', $product->id) }}" method="POST" class="p-6 sm:p-10">
            @csrf
            @method('PUT')
            
            <div class="space-y-6">
                <!-- Name -->
                <div>
                    <label for="name" class="block text-sm font-semibold text-slate-700 mb-1.5">Product Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}" class="block w-full px-4 py-3 border @error('name') border-rose-300 focus:border-rose-500 focus:ring-rose-500/20 @else border-slate-200 focus:border-indigo-500 focus:ring-indigo-500/20 @enderror rounded-xl text-sm transition-colors focus:outline-none focus:ring-4 bg-slate-50/50 focus:bg-white" placeholder="e.g. Mechanical Keyboard">
                    @error('name')
                        <p class="text-rose-500 text-xs font-medium mt-2 flex items-center"><svg class="w-3.5 h-3.5 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg> {{ $message }}</p>
                    @enderror
                </div>

                <!-- Category -->
                <div>
                    <label for="category" class="block text-sm font-semibold text-slate-700 mb-1.5">Category</label>
                    <input type="text" name="category" id="category" value="{{ old('category', $product->category) }}" class="block w-full px-4 py-3 border @error('category') border-rose-300 focus:border-rose-500 focus:ring-rose-500/20 @else border-slate-200 focus:border-indigo-500 focus:ring-indigo-500/20 @enderror rounded-xl text-sm transition-colors focus:outline-none focus:ring-4 bg-slate-50/50 focus:bg-white" placeholder="e.g. Electronics">
                    @error('category')
                        <p class="text-rose-500 text-xs font-medium mt-2 flex items-center"><svg class="w-3.5 h-3.5 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg> {{ $message }}</p>
                    @enderror
                </div>

                <!-- Price & Stock Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <label for="price" class="block text-sm font-semibold text-slate-700 mb-1.5">Price (Rp)</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <span class="text-slate-400 font-medium sm:text-sm">Rp</span>
                            </div>
                            <input type="number" step="0.01" min="0" name="price" id="price" value="{{ old('price', (float)$product->price) }}" class="block w-full pl-11 pr-4 py-3 border @error('price') border-rose-300 focus:border-rose-500 focus:ring-rose-500/20 @else border-slate-200 focus:border-indigo-500 focus:ring-indigo-500/20 @enderror rounded-xl text-sm transition-colors focus:outline-none focus:ring-4 bg-slate-50/50 focus:bg-white" placeholder="0">
                        </div>
                        @error('price')
                            <p class="text-rose-500 text-xs font-medium mt-2 flex items-center"><svg class="w-3.5 h-3.5 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg> {{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="stock" class="block text-sm font-semibold text-slate-700 mb-1.5">Stock Available</label>
                        <input type="number" min="0" name="stock" id="stock" value="{{ old('stock', $product->stock) }}" class="block w-full px-4 py-3 border @error('stock') border-rose-300 focus:border-rose-500 focus:ring-rose-500/20 @else border-slate-200 focus:border-indigo-500 focus:ring-indigo-500/20 @enderror rounded-xl text-sm transition-colors focus:outline-none focus:ring-4 bg-slate-50/50 focus:bg-white">
                        @error('stock')
                            <p class="text-rose-500 text-xs font-medium mt-2 flex items-center"><svg class="w-3.5 h-3.5 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg> {{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Footer Actions -->
            <div class="mt-10 pt-6 border-t border-slate-100 flex items-center justify-end gap-3">
                <a href="{{ route('products.index') }}" class="px-5 py-2.5 rounded-full text-sm font-semibold text-slate-600 bg-white border border-slate-200 hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-slate-200 transition-colors">
                    Cancel
                </a>
                <button type="submit" class="px-6 py-2.5 rounded-full text-sm font-semibold text-white bg-slate-900 hover:bg-slate-800 shadow-sm focus:outline-none focus:ring-2 focus:ring-slate-900 focus:ring-offset-2 transition-all">
                    Update Product
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
