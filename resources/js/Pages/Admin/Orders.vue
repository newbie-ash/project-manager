<script setup>
import BackofficeLayout from '@/Layouts/BackofficeLayout.vue';
import { Link, router } from '@inertiajs/vue3';

defineProps({
    orders: Array
});

const updateStatus = (id, newStatus) => {
    router.patch(route('orders.update', id), { status: newStatus }, {
        preserveScroll: true
    });
};
</script>

<template>
    <BackofficeLayout>
        <div class="max-w-[1200px] mx-auto px-4 lg:px-8 py-12">
            
            <div class="flex flex-col md:flex-row justify-between items-center mb-12 gap-6 border-b border-maroon-900/10 pb-6">
                <div>
                    <h1 class="text-2xl font-bold tracking-[0.2em] uppercase text-maroon-900">
                        Client Orders
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
                                          'text-maroon-900 border border-maroon-900': order.status === 'Unpaid',
                                          'text-rose-700 border border-rose-700': order.status === 'Cancelled'
                                      }">
                                    {{ order.status }}
                                </span>
                            </td>
                            <td class="py-6 text-sm font-serif text-maroon-900 text-right">
                                Rp {{ Number(order.total).toLocaleString('id-ID') }}
                            </td>
                            <td class="py-6 text-right">
                                <!-- Status Dropdown -->
                                <select 
                                    :value="order.status" 
                                    @change="updateStatus(order.database_id, $event.target.value)"
                                    class="text-[10px] font-bold tracking-widest uppercase bg-transparent border border-maroon-900/20 text-maroon-900 py-1.5 px-2 rounded focus:outline-none focus:border-maroon-900 cursor-pointer"
                                >
                                    <option value="Unpaid">Unpaid</option>
                                    <option value="Processing">Processing</option>
                                    <option value="Shipped">Shipped</option>
                                    <option value="Delivered">Delivered</option>
                                    <option value="Cancelled">Cancelled</option>
                                </select>
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
    </BackofficeLayout>
</template>
