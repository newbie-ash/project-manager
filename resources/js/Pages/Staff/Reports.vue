<script setup>
import BackofficeLayout from '@/Layouts/BackofficeLayout.vue';

defineProps({
    complaints: Array
});
</script>

<template>
  <BackofficeLayout>
    <div class="max-w-6xl mx-auto">
      <div class="mb-8">
        <h1 class="text-3xl font-serif font-bold text-maroon-900">Staff Reports</h1>
        <p class="mt-2 text-maroon-900/60">Daftar keluhan (complaints) dan laporan pelanggan.</p>
      </div>

      <div class="bg-white rounded-2xl shadow-sm border border-maroon-900/10 overflow-hidden">
        <div class="overflow-x-auto">
          <table class="w-full text-left border-collapse">
            <thead>
              <tr class="bg-cream-50 border-b border-maroon-900/10">
                <th class="px-6 py-4 text-xs font-bold tracking-widest text-maroon-900/60 uppercase">Tanggal</th>
                <th class="px-6 py-4 text-xs font-bold tracking-widest text-maroon-900/60 uppercase">Nama</th>
                <th class="px-6 py-4 text-xs font-bold tracking-widest text-maroon-900/60 uppercase">Pesan</th>
                <th class="px-6 py-4 text-xs font-bold tracking-widest text-maroon-900/60 uppercase">Status</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-maroon-900/5">
              <tr v-if="!complaints || complaints.length === 0">
                <td colspan="4" class="px-6 py-8 text-center text-maroon-900/40 text-sm italic">
                  Belum ada laporan keluhan.
                </td>
              </tr>
              <tr v-for="complaint in complaints" :key="complaint.id" class="hover:bg-cream-50/50 transition-colors">
                <td class="px-6 py-4 text-sm text-maroon-900">
                  {{ new Date(complaint.created_at).toLocaleDateString('id-ID', { day: 'numeric', month: 'short', year: 'numeric' }) }}
                </td>
                <td class="px-6 py-4 text-sm font-semibold text-maroon-900">{{ complaint.name }}</td>
                <td class="px-6 py-4 text-sm text-maroon-900/70 max-w-xs truncate">{{ complaint.message }}</td>
                <td class="px-6 py-4">
                  <span class="px-3 py-1 rounded-full text-xs font-bold tracking-wider uppercase" 
                        :class="complaint.status === 'resolved' ? 'bg-emerald-100 text-emerald-800' : 'bg-amber-100 text-amber-800'">
                    {{ complaint.status === 'resolved' ? 'Selesai' : 'Pending' }}
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
