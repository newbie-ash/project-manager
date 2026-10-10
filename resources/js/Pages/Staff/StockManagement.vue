<script setup>
import BackofficeLayout from '@/Layouts/BackofficeLayout.vue';

defineProps({
    products: Array
});
</script>

<template>
  <BackofficeLayout>
    <div class="max-w-6xl mx-auto">
      <div class="mb-8 flex justify-between items-end">
        <div>
          <h1 class="text-3xl font-serif font-bold text-maroon-900">Manajemen Stok</h1>
          <p class="mt-2 text-maroon-900/60">Pantau ketersediaan stok produk (diurutkan dari stok terendah).</p>
        </div>
      </div>

      <div class="bg-white rounded-2xl shadow-sm border border-maroon-900/10 overflow-hidden">
        <div class="overflow-x-auto">
          <table class="w-full text-left border-collapse">
            <thead>
              <tr class="bg-cream-50 border-b border-maroon-900/10">
                <th class="px-6 py-4 text-xs font-bold tracking-widest text-maroon-900/60 uppercase">Produk</th>
                <th class="px-6 py-4 text-xs font-bold tracking-widest text-maroon-900/60 uppercase">Kategori</th>
                <th class="px-6 py-4 text-xs font-bold tracking-widest text-maroon-900/60 uppercase">Harga</th>
                <th class="px-6 py-4 text-xs font-bold tracking-widest text-maroon-900/60 uppercase">Stok Tersisa</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-maroon-900/5">
              <tr v-if="!products || products.length === 0">
                <td colspan="4" class="px-6 py-8 text-center text-maroon-900/40 text-sm italic">Belum ada data produk.</td>
              </tr>
              <tr v-for="product in products" :key="product.id" class="hover:bg-cream-50/50 transition-colors">
                <td class="px-6 py-4">
                  <div class="flex items-center gap-4">
                    <img v-if="product.image" :src="'/storage/' + product.image" class="w-10 h-10 object-cover rounded-lg border border-maroon-900/10" />
                    <div v-else class="w-10 h-10 bg-cream-100 rounded-lg border border-maroon-900/10 flex items-center justify-center">
                      <svg class="w-5 h-5 text-maroon-900/30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                    <span class="text-sm font-semibold text-maroon-900">{{ product.name }}</span>
                  </div>
                </td>
                <td class="px-6 py-4 text-sm text-maroon-900">{{ product.category }}</td>
                <td class="px-6 py-4 text-sm text-maroon-900">Rp {{ Number(product.price).toLocaleString('id-ID') }}</td>
                <td class="px-6 py-4">
                  <div class="flex items-center gap-3">
                    <span class="text-lg font-bold" :class="product.stock <= 5 ? 'text-rose-600' : 'text-emerald-600'">
                      {{ product.stock }}
                    </span>
                    <span v-if="product.stock <= 5" class="px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wider bg-rose-100 text-rose-800">
                      Low Stock
                    </span>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </BackofficeLayout>
</template>
