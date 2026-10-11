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
                <div class="w-12 h-12 mx-auto bg-maroon-900 rounded-full flex items-center justify-center text-gold font-serif text-xl mb-3 overflow-hidden border border-maroon-900/20">
                    <img v-if="$page.props.auth.user?.avatar" :src="'/storage/' + $page.props.auth.user.avatar" class="w-full h-full object-cover" />
                    <span v-else class="italic">{{ $page.props.auth.user?.name.charAt(0).toUpperCase() || 'A' }}</span>
                </div>
                <h3 class="text-xs font-bold tracking-widest uppercase text-maroon-900">{{ $page.props.auth.user?.name || 'Admin' }}</h3>
                <p class="text-[9px] tracking-widest text-maroon-900/50 mt-1 uppercase">Backoffice</p>
            </div>

            <!-- Navigation Links -->
            <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
                <!-- Admin Links -->
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

            <div class="p-4 border-t border-maroon-900/10 flex flex-col gap-2">
                <Link :href="route('settings')" class="flex items-center gap-3 px-4 py-3 text-[10px] font-bold tracking-widest uppercase text-maroon-900 hover:bg-cream-100 transition-colors rounded-lg">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    Settings
                </Link>
                <Link :href="route('logout')" method="post" as="button" class="flex items-center gap-3 px-4 py-3 text-[10px] font-bold tracking-widest uppercase text-maroon-900 hover:bg-rose-100 hover:text-rose-900 transition-colors rounded-lg w-full text-left">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    Sign Out
                </Link>
            </div>
        </aside>

        <!-- Main Content Area -->
        <main class="flex-1 ml-64 p-8 relative">
            
            <!-- Global Flash Messages -->
            <div v-if="$page.props.flash.success || $page.props.flash.error" class="fixed top-8 right-8 z-50 flex flex-col gap-4 w-96 max-w-[calc(100vw-2rem)] pointer-events-none">
                <!-- Success Alert -->
                <div v-if="$page.props.flash.success" class="pointer-events-auto bg-green-50 border-l-4 border-green-700 p-4 shadow-xl flex items-start justify-between">
                    <div class="flex">
                        <svg class="w-5 h-5 text-green-700 mr-3 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <p class="text-sm font-medium text-green-900 leading-snug">{{ $page.props.flash.success }}</p>
                    </div>
                </div>
                
                <!-- Error Alert -->
                <div v-if="$page.props.flash.error" class="pointer-events-auto bg-red-50 border-l-4 border-red-700 p-4 shadow-xl flex items-start justify-between">
                    <div class="flex">
                        <svg class="w-5 h-5 text-red-700 mr-3 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <p class="text-sm font-medium text-red-900 leading-snug">{{ $page.props.flash.error }}</p>
                    </div>
                </div>
            </div>

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
