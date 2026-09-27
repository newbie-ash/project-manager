<script setup>
import { Link, usePage } from '@inertiajs/vue3';

const page = usePage();
</script>

<template>
    <div class="min-h-screen bg-cream-50 flex font-sans text-maroon-900">
        
        <!-- Left Sidebar -->
        <aside class="w-64 bg-cream-100 border-r border-maroon-900/10 flex flex-col fixed inset-y-0 shadow-lg z-20">
            <!-- Brand -->
            <div class="h-20 flex items-center justify-center border-b border-maroon-900/10">
                <Link :href="route('welcome')" class="font-serif text-3xl font-bold italic text-maroon-900">
                    A'ritza
                </Link>
            </div>

            <!-- Admin Info -->
            <div class="p-6 border-b border-maroon-900/5 text-center">
                <div class="w-12 h-12 mx-auto bg-maroon-900 rounded-full flex items-center justify-center text-gold font-serif text-xl italic mb-3">
                    {{ $page.props.auth.user?.name.charAt(0).toUpperCase() || 'A' }}
                </div>
                <h3 class="text-xs font-bold tracking-widest uppercase text-maroon-900">{{ $page.props.auth.user?.name || 'Admin' }}</h3>
                <p class="text-[9px] tracking-widest text-maroon-900/50 mt-1 uppercase">Backoffice</p>
            </div>

            <!-- Navigation Links -->
            <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
                <Link :href="route('dashboard')" class="flex items-center gap-3 px-4 py-3 text-[10px] font-bold tracking-widest uppercase transition-colors rounded-lg" :class="{'bg-maroon-900 text-gold shadow-md': $page.url === '/dashboard', 'text-maroon-900/60 hover:bg-white hover:text-maroon-900': $page.url !== '/dashboard'}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                    Dashboard
                </Link>

                <p class="px-4 pt-4 pb-2 text-[8px] font-bold tracking-[0.2em] text-maroon-900/40 uppercase">Inventory</p>
                <Link :href="route('admin.products.index')" class="flex items-center gap-3 px-4 py-3 text-[10px] font-bold tracking-widest uppercase transition-colors rounded-lg" :class="{'bg-maroon-900 text-gold shadow-md': $page.url.startsWith('/admin/products') || $page.url.includes('/products/create') || $page.url.includes('/edit'), 'text-maroon-900/60 hover:bg-white hover:text-maroon-900': !($page.url.startsWith('/admin/products') || $page.url.includes('/products/create') || $page.url.includes('/edit'))}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    Manage Products
                </Link>
                
                <p class="px-4 pt-4 pb-2 text-[8px] font-bold tracking-[0.2em] text-maroon-900/40 uppercase">Transactions</p>
                <Link :href="route('orders.index')" class="flex items-center gap-3 px-4 py-3 text-[10px] font-bold tracking-widest uppercase transition-colors rounded-lg" :class="{'bg-maroon-900 text-gold shadow-md': $page.url.startsWith('/orders'), 'text-maroon-900/60 hover:bg-white hover:text-maroon-900': !$page.url.startsWith('/orders')}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                    Client Orders
                </Link>

                <p class="px-4 pt-4 pb-2 text-[8px] font-bold tracking-[0.2em] text-maroon-900/40 uppercase">Support</p>
                <Link :href="route('complaints.index')" class="flex items-center gap-3 px-4 py-3 text-[10px] font-bold tracking-widest uppercase transition-colors rounded-lg" :class="{'bg-maroon-900 text-gold shadow-md': $page.url.startsWith('/complaints'), 'text-maroon-900/60 hover:bg-white hover:text-maroon-900': !$page.url.startsWith('/complaints')}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
                    Complaints
                </Link>
            </nav>

            <div class="p-4 border-t border-maroon-900/10">
                <Link :href="route('logout')" method="post" as="button" class="w-full flex items-center justify-center gap-2 px-4 py-3 text-[10px] font-bold tracking-widest uppercase text-maroon-900 hover:bg-rose-100 hover:text-rose-900 transition-colors rounded-lg">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    Sign Out
                </Link>
            </div>
        </aside>

        <!-- Main Content Area -->
        <main class="flex-1 ml-64 p-8">
            <slot />
        </main>
    </div>
</template>

<style>
/* Add a custom cream color specifically for the backoffice background if needed */
.bg-cream-50 {
    background-color: #fdfaf6;
}
</style>
