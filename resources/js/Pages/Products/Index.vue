<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Link } from '@inertiajs/vue3';

defineProps({
    products: Object,
    filters: Object
});
</script>

<template>
    <AdminLayout>
        
        <div class="max-w-[1400px] mx-auto px-4 lg:px-8 py-12">
            
            <!-- Page Header (Minimalist) -->
            <div class="flex flex-col md:flex-row justify-between items-center mb-12 gap-6 border-b border-maroon-900/10 pb-6">
                <div>
                    <h1 class="text-2xl font-bold tracking-[0.2em] uppercase text-maroon-900">
                        The Collection
                    </h1>
                    <p class="text-xs font-serif italic text-maroon-900/60 mt-2">Latest additions to the Maison</p>
                </div>
                
                <div class="flex items-center gap-6">
                    <!-- Filters -->
                    <div class="flex gap-4">
                        <Link :href="route('products.index')" class="text-[10px] font-bold tracking-widest uppercase transition-all" :class="{'text-maroon-900 border-b border-maroon-900 pb-1': !filters.category, 'text-maroon-900/40 hover:text-maroon-900': filters.category}">All</Link>
                        <Link :href="route('products.index', {category: 'Handbags'})" class="text-[10px] font-bold tracking-widest uppercase transition-all" :class="{'text-maroon-900 border-b border-maroon-900 pb-1': filters.category === 'Handbags', 'text-maroon-900/40 hover:text-maroon-900': filters.category !== 'Handbags'}">Handbags</Link>
                        <Link :href="route('products.index', {category: 'Accessories'})" class="text-[10px] font-bold tracking-widest uppercase transition-all" :class="{'text-maroon-900 border-b border-maroon-900 pb-1': filters.category === 'Accessories', 'text-maroon-900/40 hover:text-maroon-900': filters.category !== 'Accessories'}">Accessories</Link>
                    </div>

                    <!-- Add Button for Admin -->
                    <div v-if="$page.props.auth.user && $page.props.auth.user.role === 'admin'" class="pl-6 border-l border-maroon-900/20">
                        <Link :href="route('products.create')" class="text-[10px] font-bold tracking-widest uppercase text-white bg-maroon-900 hover:bg-gold px-5 py-2.5 transition-colors flex items-center gap-2">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                            Add Piece
                        </Link>
                    </div>
                </div>
            </div>

            <!-- Product Grid (H&M / Balenciaga Style) -->
            <!-- Clean, borderless, shadowless, large images -->
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-x-6 gap-y-16">
                
                <div v-for="product in products.data" :key="product.id" class="group relative">
                    
                    <!-- Image Area -->
                    <div class="w-full aspect-[3/4] bg-transparent border border-transparent relative overflow-hidden mb-4 flex items-center justify-center group-hover:border-maroon-900/10 transition-colors">
                        <img v-if="product.image" :src="'/storage/' + product.image" :alt="product.name" class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-105">
                        <template v-else>
                            <span class="font-serif text-4xl text-maroon-900/20 italic">{{ product.name.charAt(0) }}</span>
                        </template>

                        <!-- Invisible CRUD Actions (Appear on Hover) -->
                        <div v-if="$page.props.auth.user && $page.props.auth.user.role === 'admin'" class="absolute top-4 right-4 flex flex-col gap-3 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <Link :href="route('products.edit', product.id)" class="w-8 h-8 bg-white/90 backdrop-blur-sm shadow flex items-center justify-center text-maroon-900 hover:text-gold transition-colors" title="Edit">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                            </Link>
                            <Link :href="route('products.destroy', product.id)" method="delete" as="button" class="w-8 h-8 bg-white/90 backdrop-blur-sm shadow flex items-center justify-center text-maroon-900 hover:text-rose-600 transition-colors" title="Delete">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </Link>
                        </div>
                    </div>

                    <!-- Text Details -->
                    <div class="text-center px-2">
                        <h2 class="text-[11px] font-bold tracking-[0.1em] uppercase text-maroon-900 leading-snug mb-2 group-hover:text-gold transition-colors">
                            {{ product.name }}
                        </h2>
                        <p class="text-[11px] font-serif italic text-maroon-900/60">
                            Rp {{ Number(product.price).toLocaleString('id-ID') }}
                        </p>
                    </div>

                </div>
            </div>

            <!-- Empty State -->
            <div v-if="products.data.length === 0" class="py-32 text-center">
                <h3 class="text-xl font-bold tracking-[0.2em] uppercase text-maroon-900 mb-4">No Pieces Found</h3>
                <p class="text-sm font-serif italic text-maroon-900/50">The collection is currently empty.</p>
            </div>
            
        </div>
    </AdminLayout>
</template>
