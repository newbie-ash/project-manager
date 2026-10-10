<script setup>
import BackofficeLayout from '@/Layouts/BackofficeLayout.vue';

defineProps({
    stats: Object,
    recent_orders: Array
});
</script>

<template>
  <BackofficeLayout>
    <div class="max-w-6xl mx-auto">
      <div class="mb-8">
        <h1 class="text-3xl font-serif font-bold text-maroon-900">Sales Statistics</h1>
        <p class="mt-2 text-maroon-900/60">Ringkasan penjualan dan riwayat pesanan terbaru.</p>
      </div>

      <!-- Highlight Stats -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <div class="bg-maroon-900 rounded-2xl p-6 text-cream-50 shadow-lg relative overflow-hidden">
          <div class="relative z-10">
            <p class="text-xs font-bold tracking-widest uppercase text-gold/80 mb-1">Total Pendapatan</p>
            <p class="text-3xl font-serif italic text-gold">{{ stats?.total_revenue || 'Rp 0' }}</p>
          </div>
          <svg class="absolute -bottom-4 -right-4 w-32 h-32 text-white/5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm.31-8.86c-1.77-.45-2.34-.94-2.34-1.67 0-.84.79-1.43 2.1-1.43 1.38 0 1.9.66 1.94 1.64h1.71c-.05-1.34-.87-2.57-2.49-2.97V5H10.9v1.69c-1.51.32-2.72 1.3-2.72 2.81 0 1.79 1.49 2.69 3.66 3.21 1.95.46 2.34 1.15 2.34 1.87 0 .53-.39 1.64-2.25 1.64-1.74 0-2.1-.96-2.17-1.92H8c.07 1.84 1.32 3.01 2.9 3.42V20h2.33v-1.62c1.67-.32 2.87-1.41 2.87-2.98 0-2.07-1.55-2.79-3.79-3.26z"/></svg>
        </div>

        <div class="bg-white border border-maroon-900/10 rounded-2xl p-6 shadow-sm">
          <p class="text-xs font-bold tracking-widest uppercase text-maroon-900/50 mb-1">Total Pesanan</p>
          <p class="text-3xl font-bold text-maroon-900">{{ stats?.total_orders || 0 }}</p>
        </div>
      </div>

      <!-- Recent Orders Table -->
      <div class="bg-white rounded-2xl shadow-sm border border-maroon-900/10 overflow-hidden">
        <div class="px-6 py-5 border-b border-maroon-900/10 bg-cream-50">
          <h2 class="text-sm font-bold tracking-widest uppercase text-maroon-900">Pesanan Terbaru</h2>
        </div>
        <div class="overflow-x-auto">
          <table class="w-full text-left border-collapse">
            <thead>
              <tr class="bg-white border-b border-maroon-900/5">
                <th class="px-6 py-4 text-xs font-bold tracking-widest text-maroon-900/40 uppercase">No. Pesanan</th>
                <th class="px-6 py-4 text-xs font-bold tracking-widest text-maroon-900/40 uppercase">Pelanggan</th>
                <th class="px-6 py-4 text-xs font-bold tracking-widest text-maroon-900/40 uppercase">Total</th>
                <th class="px-6 py-4 text-xs font-bold tracking-widest text-maroon-900/40 uppercase">Status</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-maroon-900/5">
              <tr v-if="!recent_orders || recent_orders.length === 0">
                <td colspan="4" class="px-6 py-8 text-center text-maroon-900/40 text-sm italic">Belum ada data pesanan.</td>
              </tr>
              <tr v-for="order in recent_orders" :key="order.id" class="hover:bg-cream-50/50 transition-colors">
                <td class="px-6 py-4 text-sm font-mono text-maroon-900">{{ order.order_number }}</td>
                <td class="px-6 py-4 text-sm text-maroon-900">{{ order.user?.name || 'Guest' }}</td>
                <td class="px-6 py-4 text-sm font-semibold text-maroon-900">
                  Rp {{ Number(order.total_price).toLocaleString('id-ID') }}
                </td>
                <td class="px-6 py-4">
                  <span class="px-3 py-1 rounded-full text-xs font-bold tracking-wider uppercase" 
                        :class="{
                          'bg-emerald-100 text-emerald-800': order.status === 'paid' || order.status === 'completed',
                          'bg-amber-100 text-amber-800': order.status === 'pending',
                          'bg-rose-100 text-rose-800': order.status === 'cancelled'
                        }">
                    {{ order.status }}
                  </span>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </BackofficeLayout>
</template>
