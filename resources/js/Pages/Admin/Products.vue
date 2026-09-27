<script setup>
import BackofficeLayout from '@/Layouts/BackofficeLayout.vue';
import { Link } from '@inertiajs/vue3';

defineProps({
    products: Array
});
</script>

<template>
    <BackofficeLayout>
        <div class="mb-10 flex justify-between items-end">
            <div>
                <h1 class="text-2xl font-bold tracking-[0.2em] uppercase text-maroon-900 mb-2">Inventory Management</h1>
                <p class="text-sm font-serif italic text-maroon-900/60">Manage your catalog pieces</p>
            </div>
            <Link :href="route('products.create')" class="bg-maroon-900 text-gold hover:bg-gold hover:text-white px-6 py-3 text-[10px] font-bold tracking-widest uppercase transition-colors shadow-lg rounded-lg flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Add New Piece
            </Link>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-maroon-900/5 overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-cream-50 border-b border-maroon-900/10">
                        <th class="py-4 px-6 text-[10px] font-bold tracking-[0.2em] uppercase text-maroon-900/50">Piece</th>
                        <th class="py-4 px-6 text-[10px] font-bold tracking-[0.2em] uppercase text-maroon-900/50">Category</th>
                        <th class="py-4 px-6 text-[10px] font-bold tracking-[0.2em] uppercase text-maroon-900/50 text-right">Price (IDR)</th>
                        <th class="py-4 px-6 text-[10px] font-bold tracking-[0.2em] uppercase text-maroon-900/50 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="product in products" :key="product.id" class="border-b border-maroon-900/5 hover:bg-cream-50/50 transition-colors group">
                        <td class="py-4 px-6 flex items-center gap-4">
                            <div class="w-12 h-12 rounded bg-cream-100 flex items-center justify-center overflow-hidden border border-maroon-900/10">
                                <img v-if="product.image" :src="'/storage/' + product.image" class="w-full h-full object-cover">
                                <span v-else class="font-serif text-lg text-maroon-900/30 italic">{{ product.name.charAt(0) }}</span>
                            </div>
                            <span class="text-xs font-bold tracking-widest uppercase text-maroon-900">{{ product.name }}</span>
                        </td>
                        <td class="py-4 px-6 text-xs text-maroon-900/70 uppercase tracking-widest">{{ product.category || 'N/A' }}</td>
                        <td class="py-4 px-6 text-sm font-serif text-maroon-900 text-right">Rp {{ Number(product.price).toLocaleString('id-ID') }}</td>
                        <td class="py-4 px-6 text-right space-x-3">
                            <Link :href="route('products.edit', product.id)" class="text-[10px] font-bold tracking-widest uppercase text-maroon-900 hover:text-gold transition-colors inline-block">Edit</Link>
                            <Link :href="route('products.destroy', product.id)" method="delete" as="button" class="text-[10px] font-bold tracking-widest uppercase text-rose-500 hover:text-rose-700 transition-colors inline-block">Delete</Link>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div v-if="products.length === 0" class="p-12 text-center">
                <p class="text-sm font-serif italic text-maroon-900/50">No pieces found in the catalog.</p>
            </div>
        </div>
    </BackofficeLayout>
</template>
