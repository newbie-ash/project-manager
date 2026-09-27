<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';

defineProps({
    orders: Array
});
</script>

<template>
    <AdminLayout>
        <div class="max-w-[1200px] mx-auto px-4 lg:px-8 py-12">
            
            <div class="flex flex-col md:flex-row justify-between items-center mb-12 gap-6 border-b border-maroon-900/10 pb-6">
                <div>
                    <h1 class="text-2xl font-bold tracking-[0.2em] uppercase text-maroon-900 flex items-center gap-4">
                        Client Orders
                        <div class="w-12 h-0.5 bg-maroon-900 hidden md:block"></div>
                    </h1>
                    <p class="text-xs font-serif italic text-maroon-900/60 mt-2">Manage recent purchases</p>
                </div>
            </div>

            <div class="bg-transparent">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b-2 border-maroon-900">
                            <th class="py-4 text-[10px] font-bold tracking-[0.2em] uppercase text-maroon-900/50">Order ID</th>
                            <th class="py-4 text-[10px] font-bold tracking-[0.2em] uppercase text-maroon-900/50">Client</th>
                            <th class="py-4 text-[10px] font-bold tracking-[0.2em] uppercase text-maroon-900/50">Date</th>
                            <th class="py-4 text-[10px] font-bold tracking-[0.2em] uppercase text-maroon-900/50">Status</th>
                            <th class="py-4 text-[10px] font-bold tracking-[0.2em] uppercase text-maroon-900/50 text-right">Total (IDR)</th>
                            <th class="py-4 text-[10px] font-bold tracking-[0.2em] uppercase text-maroon-900/50 text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="order in orders" :key="order.id" class="border-b border-maroon-900/10 hover:bg-white/50 transition-colors group">
                            <td class="py-6 text-sm font-serif italic text-maroon-900">{{ order.id }}</td>
                            <td class="py-6 text-xs font-bold tracking-widest uppercase text-maroon-900">{{ order.customer }}</td>
                            <td class="py-6 text-xs text-maroon-900/70">{{ order.date }}</td>
                            <td class="py-6">
                                <span class="text-[10px] px-3 py-1 font-bold tracking-widest uppercase"
                                      :class="{
                                          'text-gold border border-gold': order.status === 'Processing',
                                          'text-green-700 border border-green-700': order.status === 'Shipped' || order.status === 'Delivered',
                                          'text-rose-700 border border-rose-700': order.status === 'Pending'
                                      }">
                                    {{ order.status }}
                                </span>
                            </td>
                            <td class="py-6 text-sm font-serif text-maroon-900 text-right">
                                Rp {{ Number(order.total).toLocaleString('id-ID') }}
                            </td>
                            <td class="py-6 text-right">
                                <button class="text-[10px] font-bold tracking-widest uppercase text-maroon-900/30 group-hover:text-gold transition-colors">
                                    View
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <div v-if="orders.length === 0" class="py-32 text-center">
                    <h3 class="text-xl font-bold tracking-[0.2em] uppercase text-maroon-900 mb-4">No Orders Yet</h3>
                    <p class="text-sm font-serif italic text-maroon-900/50">When clients make purchases, they will appear here.</p>
                </div>
            </div>
            
        </div>
    </AdminLayout>
</template>
