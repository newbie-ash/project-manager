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
                        <Link :href="route('products.index', {search: filters?.search})" class="text-[10px] font-bold tracking-widest uppercase transition-all" :class="{'text-maroon-900 border-b border-maroon-900 pb-1': !filters?.category, 'text-maroon-900/40 hover:text-maroon-900': filters?.category}">All</Link>
                        <Link :href="route('products.index', {category: 'Handbags', search: filters?.search})" class="text-[10px] font-bold tracking-widest uppercase transition-all" :class="{'text-maroon-900 border-b border-maroon-900 pb-1': filters?.category === 'Handbags', 'text-maroon-900/40 hover:text-maroon-900': filters?.category !== 'Handbags'}">Handbags</Link>
                        <Link :href="route('products.index', {category: 'Accessories', search: filters?.search})" class="text-[10px] font-bold tracking-widest uppercase transition-all" :class="{'text-maroon-900 border-b border-maroon-900 pb-1': filters?.category === 'Accessories', 'text-maroon-900/40 hover:text-maroon-900': filters?.category !== 'Accessories'}">Accessories</Link>
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

                        <!-- Pre-Order Overlay for Buyers and Guests (Appear on Hover) -->
                        <div v-if="!$page.props.auth.user || $page.props.auth.user.role !== 'admin'" class="absolute inset-0 bg-white/50 backdrop-blur-[2px] opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                            <!-- Jika Logged in -> POST ke orders -->
                            <Link v-if="$page.props.auth.user" :href="route('orders.store')" method="post" :data="{ product_id: product.id }" as="button" class="bg-maroon-900 text-white text-[10px] font-bold tracking-widest uppercase px-6 py-3 hover:bg-gold transition-colors shadow-xl">
                                Pre-Order
                            </Link>
                            <!-- Jika Guest -> Redirect ke Login -->
                            <Link v-else :href="route('login')" class="bg-maroon-900 text-white text-[10px] font-bold tracking-widest uppercase px-6 py-3 hover:bg-gold transition-colors shadow-xl inline-block">
                                Pre-Order
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
