<script setup>
import { Link, usePage } from '@inertiajs/vue3';
import BackofficeLayout from '@/Layouts/BackofficeLayout.vue';

const page = usePage();
const user = page.props.auth.user;

defineProps({
    stats: Object
});
</script>

<template>
  <BackofficeLayout>
    <div class="max-w-6xl mx-auto">
      <!-- Header -->
      <div class="mb-8">
        <h1 class="text-3xl font-serif font-bold text-maroon-900">Staff Dashboard</h1>
        <p class="mt-2 text-maroon-900/60">Selamat datang, <span class="font-semibold text-maroon-900">{{ user?.name || 'Staff' }}</span>. Berikut ringkasan panel staff Anda.</p>
      </div>

      <!-- Quick Stats Cards -->
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white rounded-2xl shadow-sm border border-maroon-900/10 p-6 hover:shadow-md transition-shadow">
          <div class="flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-amber-100 flex items-center justify-center">
              <svg class="w-6 h-6 text-amber-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
            </div>
            <div>
              <p class="text-xs font-bold tracking-widest uppercase text-maroon-900/50">Laporan</p>
              <p class="text-2xl font-bold text-maroon-900">{{ stats?.reports || 0 }}</p>
            </div>
          </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-maroon-900/10 p-6 hover:shadow-md transition-shadow">
          <div class="flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-emerald-100 flex items-center justify-center">
              <svg class="w-6 h-6 text-emerald-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
            </div>
            <div>
              <p class="text-xs font-bold tracking-widest uppercase text-maroon-900/50">Total Penjualan</p>
              <p class="text-xl font-bold text-maroon-900">{{ stats?.sales || 'Rp 0' }}</p>
            </div>
          </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-maroon-900/10 p-6 hover:shadow-md transition-shadow">
          <div class="flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-blue-100 flex items-center justify-center">
              <svg class="w-6 h-6 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/></svg>
            </div>
            <div>
              <p class="text-xs font-bold tracking-widest uppercase text-maroon-900/50">Stok Produk</p>
              <p class="text-2xl font-bold text-maroon-900">{{ stats?.stock || 0 }}</p>
            </div>
          </div>
        </div>
      </div>

      <!-- Quick Access -->
      <div class="bg-white rounded-2xl shadow-sm border border-maroon-900/10 p-6">
        <h2 class="text-lg font-bold text-maroon-900 mb-4">Akses Cepat</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
          <Link :href="route('staff.reports')" class="flex items-center gap-3 p-4 rounded-xl bg-cream-50 hover:bg-amber-50 transition-colors border border-maroon-900/5">
            <svg class="w-5 h-5 text-amber-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
            <span class="text-sm font-semibold text-maroon-900">Lihat Laporan</span>
          </Link>
          <Link :href="route('staff.sales_stats')" class="flex items-center gap-3 p-4 rounded-xl bg-cream-50 hover:bg-emerald-50 transition-colors border border-maroon-900/5">
            <svg class="w-5 h-5 text-emerald-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
            <span class="text-sm font-semibold text-maroon-900">Statistik Penjualan</span>
          </Link>
          <Link :href="route('staff.stock_management')" class="flex items-center gap-3 p-4 rounded-xl bg-cream-50 hover:bg-blue-50 transition-colors border border-maroon-900/5">
            <svg class="w-5 h-5 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/></svg>
            <span class="text-sm font-semibold text-maroon-900">Manajemen Stok</span>
          </Link>
        </div>
      </div>
    </div>
  </BackofficeLayout>
</template>
