<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Link } from '@inertiajs/vue3';

defineProps({
    featuredProducts: Array
});
</script>

<template>
    <AdminLayout>
        <!-- Full Width Banner (Chanel Style) -->
        <div class="relative w-full h-[60vh] min-h-[500px] flex items-center justify-center overflow-hidden">
            <!-- Luxury Background Image -->
            <div class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1549439602-43ebca2327af?q=80&w=2070&auto=format&fit=crop')] bg-cover bg-center transition-transform duration-[20s] hover:scale-110"></div>
            <!-- Subtle Overlay -->
            <div class="absolute inset-0 bg-maroon-900/40"></div>
            
            <div class="relative z-10 text-center px-4">
                <p class="text-xs md:text-sm text-gold tracking-[0.4em] uppercase mb-4 font-bold drop-shadow-md">Maison de Luxe</p>
                <h1 class="text-4xl md:text-7xl font-serif text-cream font-bold italic drop-shadow-lg max-w-4xl mx-auto leading-tight">
                    Discover the Collection
                </h1>
                <div class="mt-10">
                    <Link :href="route('products.index')" class="inline-block px-10 py-4 bg-white/10 backdrop-blur-md border border-white/30 text-white text-[10px] font-bold tracking-[0.2em] uppercase hover:bg-gold hover:border-gold hover:text-white transition-all shadow-lg">
                        Explore Now
                    </Link>
                </div>
            </div>
        </div>

        <!-- Featured Collection -->
        <div class="max-w-[1400px] mx-auto px-4 lg:px-8 py-24">
            <div class="text-center mb-16">
                <h2 class="text-2xl font-serif font-bold text-maroon-900 italic">Signature Pieces</h2>
                <div class="w-12 h-px bg-gold mx-auto mt-6"></div>
                <p class="text-[10px] font-bold tracking-[0.2em] uppercase text-maroon-900/50 mt-6">Curated from our latest arrivals</p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-x-6 gap-y-16">
                
                <div v-for="product in featuredProducts" :key="product.id" class="group relative">
                    
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
            
            <div class="text-center mt-16">
                <Link :href="route('products.index')" class="inline-block border-b border-maroon-900 pb-1 text-[10px] font-bold tracking-[0.2em] uppercase text-maroon-900 hover:text-gold hover:border-gold transition-colors">
                    View Complete Catalog
                </Link>
            </div>
        </div>
    </AdminLayout>
</template>
