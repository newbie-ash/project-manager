<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';

defineProps({
    stats: Object,
});
</script>

<template>
    <AdminLayout>
        <!-- Full Width Banner (Chanel Style) -->
        <div class="relative w-full h-[50vh] min-h-[400px] flex items-center justify-center overflow-hidden">
            <!-- Luxury Background Image (Unsplash fashion fallback) -->
            <div class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1549439602-43ebca2327af?q=80&w=2070&auto=format&fit=crop')] bg-cover bg-center"></div>
            <!-- Subtle Overlay -->
            <div class="absolute inset-0 bg-maroon-900/30"></div>
            
            <div class="relative z-10 text-center px-4">
                <p class="text-xs md:text-sm text-gold tracking-[0.4em] uppercase mb-4 font-bold drop-shadow-md">Administration</p>
                <h1 class="text-4xl md:text-6xl font-serif text-cream font-bold italic drop-shadow-lg max-w-3xl leading-tight">
                    Overview of the Maison
                </h1>
                <div class="mt-8">
                    <a href="#stats" class="inline-block px-8 py-3 bg-white/10 backdrop-blur-md border border-white/30 text-white text-xs font-bold tracking-[0.2em] uppercase hover:bg-white hover:text-maroon-900 transition-all">
                        View Insights
                    </a>
                </div>
            </div>
        </div>

        <!-- Elegant Minimalist Stats (Chanel/Balenciaga Typography) -->
        <div id="stats" class="max-w-[1400px] mx-auto px-4 lg:px-8 py-24">
            <div class="text-center mb-16">
                <h2 class="text-2xl font-serif font-bold text-maroon-900 italic">Current Performance</h2>
                <div class="w-12 h-px bg-gold mx-auto mt-6"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 text-center">
                
                <!-- Stat 1 -->
                <div class="group">
                    <p class="text-[10px] font-bold tracking-[0.3em] uppercase text-maroon-900/50 mb-4 transition-colors group-hover:text-gold">Total Clients</p>
                    <h3 class="text-6xl font-serif text-maroon-900">{{ stats.customers }}</h3>
                </div>

                <!-- Stat 2 -->
                <div class="group">
                    <p class="text-[10px] font-bold tracking-[0.3em] uppercase text-maroon-900/50 mb-4 transition-colors group-hover:text-gold">Pieces in Catalog</p>
                    <h3 class="text-6xl font-serif text-maroon-900">{{ stats.products }}</h3>
                </div>

                <!-- Stat 3 -->
                <div class="group">
                    <p class="text-[10px] font-bold tracking-[0.3em] uppercase text-maroon-900/50 mb-4 transition-colors group-hover:text-gold">New Requests</p>
                    <h3 class="text-6xl font-serif text-maroon-900">{{ stats.new_orders }}</h3>
                </div>

                <!-- Stat 4 -->
                <div class="group">
                    <p class="text-[10px] font-bold tracking-[0.3em] uppercase text-maroon-900/50 mb-4 transition-colors group-hover:text-gold">Transactions</p>
                    <h3 class="text-6xl font-serif text-maroon-900">{{ stats.transactions }}</h3>
                </div>

            </div>
        </div>
    </AdminLayout>
</template>
