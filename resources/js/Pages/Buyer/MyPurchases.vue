<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { router } from '@inertiajs/vue3';

defineProps({
    purchases: Array
});

const triggerSnap = (token, orderIdDatabase) => {
    if (window.snap) {
        window.snap.pay(token, {
            onSuccess: function (result) {
                // Post ke backend agar status diupdate jadi Processing
                router.post(route('orders.mark_paid', orderIdDatabase), {}, {
                    preserveScroll: true
                });
            },
            onPending: function (result) {
                console.log('Pending:', result);
            },
            onError: function (result) {
                console.log('Error:', result);
            },
            onClose: function () {
                console.log('User closed popup without finishing payment');
            }
        });
    } else {
        alert("Sistem pembayaran sedang tidak tersedia.");
    }
};
</script>

<template>
    <AdminLayout>
        <div class="max-w-[1200px] mx-auto px-4 lg:px-8 py-12">
            
            <div class="flex flex-col md:flex-row justify-between items-center mb-12 gap-6 border-b border-maroon-900/10 pb-6">
                <div>
                    <h1 class="text-2xl font-bold tracking-[0.2em] uppercase text-maroon-900">
                        My Purchases
                    </h1>
                    <p class="text-xs font-serif italic text-maroon-900/60 mt-2">Your collection journey with A'ritza</p>
                </div>
            </div>

            <div class="bg-transparent">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b-2 border-maroon-900">
                            <th class="py-4 text-[10px] font-bold tracking-[0.2em] uppercase text-maroon-900/50">Order ID</th>
                            <th class="py-4 text-[10px] font-bold tracking-[0.2em] uppercase text-maroon-900/50">Date</th>
                            <th class="py-4 text-[10px] font-bold tracking-[0.2em] uppercase text-maroon-900/50">Items</th>
                            <th class="py-4 text-[10px] font-bold tracking-[0.2em] uppercase text-maroon-900/50">Status</th>
                            <th class="py-4 text-[10px] font-bold tracking-[0.2em] uppercase text-maroon-900/50 text-right">Total (IDR)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="order in purchases" :key="order.id" class="border-b border-maroon-900/10 hover:bg-white/50 transition-colors group">
                            <td class="py-6 text-sm font-serif italic text-maroon-900">{{ order.id }}</td>
                            <td class="py-6 text-xs text-maroon-900/70">{{ order.date }}</td>
                            <td class="py-6 text-xs font-bold tracking-widest uppercase text-maroon-900">{{ order.items }}</td>
                            <td class="py-6">
                                <span class="text-[10px] px-3 py-1 font-bold tracking-widest uppercase mr-3"
                                      :class="{
                                          'text-gold border border-gold': order.status === 'Processing',
                                          'text-green-700 border border-green-700': order.status === 'Shipped' || order.status === 'Delivered',
                                          'text-rose-700 border border-rose-700': order.status === 'Pending',
                                          'text-maroon-900 border border-maroon-900': order.status === 'Unpaid'
                                      }">
                                    {{ order.status }}
                                </span>
                            </td>
                            <td class="py-6 text-sm font-serif text-maroon-900 text-right">
                                Rp {{ Number(order.total).toLocaleString('id-ID') }}
                                
                                <div v-if="order.status === 'Unpaid' && order.snap_token" class="mt-3">
                                    <button @click="triggerSnap(order.snap_token, order.database_id)" class="bg-maroon-900 text-white text-[10px] font-bold tracking-widest uppercase px-4 py-2 hover:bg-gold transition-colors shadow-md">
                                        Pay Now
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <div v-if="purchases.length === 0" class="py-32 text-center">
                    <h3 class="text-xl font-bold tracking-[0.2em] uppercase text-maroon-900 mb-4">No Purchases Yet</h3>
                    <p class="text-sm font-serif italic text-maroon-900/50">Start your luxury journey by exploring our collection.</p>
                </div>
            </div>
            
        </div>
    </AdminLayout>
</template>
