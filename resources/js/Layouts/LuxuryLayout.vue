<script setup>
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div class="min-h-screen bg-cream-100 font-sans text-maroon-900 selection:bg-gold selection:text-white relative">
        <!-- Background Texture -->
        <div class="fixed inset-0 bg-[url('https://www.transparenttextures.com/patterns/cream-paper.png')] opacity-30 pointer-events-none z-0"></div>

        <!-- Top Navbar -->
        <header class="relative z-20 bg-maroon-900 text-cream shadow-md sticky top-0">
            <div class="max-w-[1400px] mx-auto px-4 lg:px-8 h-20 flex items-center justify-between gap-8">
                
                <!-- Logo -->
                <div class="flex-shrink-0">
                    <Link :href="route('products.index')" class="flex flex-col">
                        <span class="text-3xl font-serif font-bold text-gold italic leading-none">A'ritza</span>
                        <span class="text-[10px] tracking-[0.3em] font-medium text-cream-200 mt-1 uppercase">Maison de Luxe</span>
                    </Link>
                </div>

                <!-- Search Bar -->
                <div class="flex-1 max-w-2xl mx-auto relative group hidden md:block">
                    <form @submit.prevent="$inertia.get(route('products.index'), { search: $event.target.search.value })">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="h-4 w-4 text-maroon-900/60 group-focus-within:text-gold transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <input type="text" name="search" placeholder="Search collection..." class="block w-full pl-11 pr-4 py-2.5 rounded-full bg-cream-100 border-none text-maroon-900 placeholder-maroon-900/60 focus:ring-2 focus:ring-gold transition-all font-serif italic text-sm">
                    </form>
                </div>

                <!-- Auth/User Controls -->
                <div class="flex-shrink-0 flex items-center gap-4">
                    <div v-if="$page.props.auth.user" class="flex items-center gap-4">
                        <div class="text-right hidden sm:block">
                            <p class="text-sm font-medium text-gold">{{ $page.props.auth.user.name }}</p>
                            <p class="text-[10px] uppercase tracking-widest text-cream-200">{{ $page.props.auth.user.role }}</p>
                        </div>
                        <Link :href="route('logout')" method="post" as="button" class="px-5 py-2.5 rounded-full border border-gold/30 hover:border-gold hover:bg-gold/10 text-gold text-xs font-medium tracking-widest uppercase transition-all">
                            Sign Out
                        </Link>
                    </div>
                    <div v-else class="flex gap-4">
                        <Link :href="route('login')" class="px-5 py-2.5 rounded-full border border-gold/30 hover:border-gold hover:bg-gold/10 text-gold text-xs font-medium tracking-widest uppercase transition-all">
                            Sign In
                        </Link>
                    </div>
                </div>
            </div>
        </header>

        <!-- Main Body -->
        <div class="max-w-[1400px] mx-auto px-4 lg:px-8 py-8 flex flex-col md:flex-row gap-8 relative z-10">
            
            <!-- Left Sidebar (Categories) -->
            <aside class="w-full md:w-64 flex-shrink-0">
                <div class="bg-white rounded-2xl shadow-xl border border-cream-200 overflow-hidden sticky top-28">
                    <div class="bg-maroon-900 px-6 py-4 border-b border-gold/20">
                        <h2 class="text-sm font-bold tracking-widest text-gold uppercase">Categories</h2>
                    </div>
                    <ul class="py-2">
                        <li>
                            <Link :href="route('products.index')" class="block px-6 py-3 text-sm font-medium text-maroon-900 hover:bg-cream-100 hover:text-gold transition-colors border-l-4 border-transparent hover:border-gold" :class="{ 'bg-cream-100 border-gold text-gold': $page.url === '/products' || $page.url === '/' }">
                                All Pieces
                            </Link>
                        </li>
                        <li>
                            <Link :href="route('products.index', { category: 'Handbags' })" class="block px-6 py-3 text-sm font-medium text-maroon-900 hover:bg-cream-100 hover:text-gold transition-colors border-l-4 border-transparent hover:border-gold">
                                Handbags
                            </Link>
                        </li>
                        <li>
                            <Link :href="route('products.index', { category: 'Accessories' })" class="block px-6 py-3 text-sm font-medium text-maroon-900 hover:bg-cream-100 hover:text-gold transition-colors border-l-4 border-transparent hover:border-gold">
                                Accessories
                            </Link>
                        </li>
                        <li>
                            <Link :href="route('products.index', { category: 'Footwear' })" class="block px-6 py-3 text-sm font-medium text-maroon-900 hover:bg-cream-100 hover:text-gold transition-colors border-l-4 border-transparent hover:border-gold">
                                Footwear
                            </Link>
                        </li>
                        <li>
                            <Link :href="route('products.index', { category: 'Jewelry' })" class="block px-6 py-3 text-sm font-medium text-maroon-900 hover:bg-cream-100 hover:text-gold transition-colors border-l-4 border-transparent hover:border-gold">
                                Fine Jewelry
                            </Link>
                        </li>
                    </ul>
                    
                    <!-- Admin Actions -->
                    <div v-if="$page.props.auth.user && $page.props.auth.user.role === 'admin'" class="p-6 border-t border-maroon-900/10 bg-cream-50">
                        <Link :href="route('products.create')" class="flex items-center justify-center w-full px-4 py-3 bg-maroon-900 text-gold text-xs font-bold tracking-widest uppercase rounded-xl hover:bg-maroon-800 hover:shadow-lg transition-all">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                            Add New Piece
                        </Link>
                    </div>
                </div>
            </aside>

            <!-- Main Content Area -->
            <main class="flex-1 min-w-0">
                <slot />
            </main>
        </div>
    </div>
</template>
