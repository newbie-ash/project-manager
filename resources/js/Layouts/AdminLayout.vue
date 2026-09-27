<script setup>
import { ref } from 'vue';
import { Link, usePage, router } from '@inertiajs/vue3';

const isDrawerOpen = ref(false);
const page = usePage();

const isSearchOpen = ref(false);
const searchQuery = ref(page.props.filters?.search || '');

const handleSearch = () => {
    router.get(route('products.index'), { 
        search: searchQuery.value, 
        category: page.props.filters?.category 
    }, { preserveState: true });
};
</script>

<template>
    <div class="min-h-screen bg-cream-100 font-sans text-maroon-900">
        <!-- Balenciaga-style Top Navbar -->
        <header class="sticky top-0 z-50 bg-cream-100 border-b-2 border-maroon-900">
            <div class="px-4 lg:px-8 h-20 flex items-center justify-between">
                
                <!-- Left: Inline Navigation -->
                <nav class="hidden md:flex gap-8 items-center flex-1">
                    <!-- Admin Only Links -->
                    <Link v-if="$page.props.auth.user?.role === 'admin'" :href="route('dashboard')" class="text-[11px] font-bold tracking-widest uppercase transition-all" :class="{'text-maroon-900 border-b border-maroon-900 pb-1': $page.url === '/dashboard', 'text-maroon-900/50 hover:text-maroon-900': $page.url !== '/dashboard'}">
                        Dashboard
                    </Link>
                    
                    <Link :href="route('products.index')" class="text-[11px] font-bold tracking-widest uppercase transition-all" :class="{'text-maroon-900 border-b border-maroon-900 pb-1': $page.url.startsWith('/products'), 'text-maroon-900/50 hover:text-maroon-900': !$page.url.startsWith('/products')}">
                        Collection
                    </Link>
                    
                    <!-- Admin Only Links -->
                    <Link v-if="$page.props.auth.user?.role === 'admin'" :href="route('orders.index')" class="text-[11px] font-bold tracking-widest uppercase transition-all" :class="{'text-maroon-900 border-b border-maroon-900 pb-1': $page.url.startsWith('/orders'), 'text-maroon-900/50 hover:text-maroon-900': !$page.url.startsWith('/orders')}">
                        Orders
                    </Link>

                    <!-- Buyer Only Links -->
                    <Link v-if="$page.props.auth.user?.role !== 'admin'" :href="route('purchases.index')" class="text-[11px] font-bold tracking-widest uppercase transition-all" :class="{'text-maroon-900 border-b border-maroon-900 pb-1': $page.url.startsWith('/my-purchases'), 'text-maroon-900/50 hover:text-maroon-900': !$page.url.startsWith('/my-purchases')}">
                        My Purchases
                    </Link>
                </nav>

                <!-- Center: Logo -->
                <div class="flex-1 flex justify-center">
                    <Link :href="route('products.index')" class="flex flex-col items-center">
                        <span class="text-3xl lg:text-4xl font-serif font-bold text-maroon-900 italic leading-none tracking-wider">A'ritza</span>
                    </Link>
                </div>

                <!-- Right: Icons & Hamburger -->
                <div class="flex-1 flex justify-end items-center gap-6">
                    <!-- Search Input Form -->
                    <form @submit.prevent="handleSearch" class="relative flex items-center">
                        <input v-if="isSearchOpen || searchQuery" v-model="searchQuery" type="text" placeholder="Search collection..." class="w-48 px-3 py-1 text-xs border-b border-maroon-900 bg-transparent focus:outline-none focus:border-gold transition-all mr-2 font-serif italic text-maroon-900 placeholder:text-maroon-900/30" @blur="!searchQuery ? isSearchOpen = false : null" autoFocus>
                        <button type="button" @click="searchQuery ? handleSearch() : isSearchOpen = !isSearchOpen" class="text-maroon-900 hover:text-gold transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </button>
                    </form>

                    <button @click="isDrawerOpen = true" class="flex items-center text-maroon-900 hover:text-gold transition-colors group">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                    </button>
                </div>
            </div>
        </header>

        <!-- Right Side Drawer (Hamburger Menu) -->
        <div v-if="isDrawerOpen" class="fixed inset-0 z-[60] overflow-hidden">
            <!-- Overlay -->
            <div class="absolute inset-0 bg-maroon-900/20 backdrop-blur-sm transition-opacity" @click="isDrawerOpen = false"></div>
            
            <!-- Drawer Panel -->
            <div class="absolute inset-y-0 right-0 w-80 max-w-full bg-cream-100 shadow-2xl flex flex-col transform transition-transform border-l border-gold/20">
                <div class="p-6 flex justify-end border-b border-maroon-900/10">
                    <button @click="isDrawerOpen = false" class="text-maroon-900 hover:text-gold transition-colors flex items-center gap-2">
                        <span class="text-[10px] font-bold tracking-widest uppercase">Close</span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>
                
                <div class="p-8 flex-1 overflow-y-auto">
                    <!-- Profile Snippet -->
                    <div class="mb-10 text-center">
                        <div class="w-16 h-16 rounded-full bg-maroon-900 text-gold flex items-center justify-center font-serif text-2xl italic mx-auto mb-3 shadow-inner">
                            {{ $page.props.auth.user ? $page.props.auth.user.name.charAt(0).toUpperCase() : 'G' }}
                        </div>
                        <h3 class="text-sm font-bold text-maroon-900">{{ $page.props.auth.user ? $page.props.auth.user.name : 'Guest' }}</h3>
                        <p class="text-[9px] tracking-widest uppercase text-maroon-900/50 mt-1">
                            {{ $page.props.auth.user ? 'Logged In' : 'Welcome to A\'ritza' }}
                        </p>
                    </div>

                    <!-- Drawer Links -->
                    <ul class="space-y-6">
                        <li>
                            <a href="#" class="block text-xs font-bold tracking-[0.2em] uppercase text-maroon-900 hover:text-gold transition-colors">Settings</a>
                        </li>
                        <li>
                            <a href="#" class="block text-xs font-bold tracking-[0.2em] uppercase text-maroon-900 hover:text-gold transition-colors">Help Center</a>
                        </li>
                        <li>
                            <a href="#" class="block text-xs font-bold tracking-[0.2em] uppercase text-maroon-900 hover:text-gold transition-colors">FAQ</a>
                        </li>
                        <li class="pt-6 border-t border-maroon-900/10">
                            <!-- If Logged In -->
                            <Link v-if="$page.props.auth.user" :href="route('logout')" method="post" as="button" class="block w-full text-left text-xs font-bold tracking-[0.2em] uppercase text-maroon-900 hover:text-rose-700 transition-colors">
                                Sign Out
                            </Link>
                            <!-- If Guest -->
                            <Link v-else :href="route('login')" class="block w-full text-left text-xs font-bold tracking-[0.2em] uppercase text-maroon-900 hover:text-gold transition-colors">
                                Sign In / Register
                            </Link>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <main class="w-full">
            <slot />
        </main>
    </div>
</template>
