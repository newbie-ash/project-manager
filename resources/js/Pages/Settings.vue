<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { ref } from 'vue';

const activeTab = ref('profil');

const tabs = [
    { id: 'profil', label: 'Profil' },
    { id: 'bank-kartu', label: 'Bank & Kartu' },
    { id: 'alamat', label: 'Alamat' },
    { id: 'ubah-password', label: 'Ubah Password' },
    { id: 'pengaturan-notifikasi', label: 'Pengaturan Notifikasi' },
    { id: 'pengaturan-privasi', label: 'Pengaturan Privasi' }
];
</script>

<template>
    <AdminLayout>
        <div class="max-w-5xl mx-auto px-4 lg:px-8 py-12">
            
            <div class="flex flex-col md:flex-row gap-8">
                <!-- Sidebar Menu -->
                <div class="w-full md:w-64 flex-shrink-0">
                    <!-- Heading: Akun Saya -->
                    <div class="flex items-center gap-3 mb-6 px-4">
                        <svg class="w-6 h-6 text-maroon-900" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        <h2 class="text-lg font-bold text-maroon-900">Akun Saya</h2>
                    </div>

                    <ul class="space-y-3">
                        <li v-for="tab in tabs" :key="tab.id">
                            <button 
                                @click="activeTab = tab.id"
                                class="w-full flex items-center px-4 py-1 text-sm transition-colors text-left"
                                :class="{
                                    'text-rose-600': activeTab === tab.id,
                                    'text-maroon-900/70 hover:text-maroon-900': activeTab !== tab.id
                                }"
                            >
                                {{ tab.label }}
                            </button>
                        </li>
                    </ul>
                </div>

                <!-- Content Area -->
                <div class="flex-1 bg-white p-8 border border-maroon-900/10 shadow-sm min-h-[400px]">
                    <div v-if="activeTab === 'profil'">
                        <h2 class="text-sm font-bold tracking-widest uppercase text-maroon-900 mb-6 border-b border-maroon-900/10 pb-4">Profil Saya</h2>
                        <div class="space-y-6">
                            <div>
                                <label class="block text-[9px] font-bold tracking-widest uppercase text-maroon-900 mb-2">Nama Lengkap</label>
                                <input type="text" :value="$page.props.auth.user?.name" disabled class="w-full max-w-md px-3 py-2 text-xs border border-maroon-900/20 bg-cream-50 text-maroon-900/60">
                            </div>
                            <div>
                                <label class="block text-[9px] font-bold tracking-widest uppercase text-maroon-900 mb-2">Alamat Email</label>
                                <input type="email" :value="$page.props.auth.user?.email" disabled class="w-full max-w-md px-3 py-2 text-xs border border-maroon-900/20 bg-cream-50 text-maroon-900/60">
                            </div>
                        </div>
                    </div>

                    <div v-else-if="activeTab === 'alamat'">
                        <h2 class="text-sm font-bold tracking-widest uppercase text-maroon-900 mb-6 border-b border-maroon-900/10 pb-4">Alamat Saya</h2>
                        <div class="border border-maroon-900/20 p-4 relative">
                            <span class="absolute top-4 right-4 text-[9px] font-bold tracking-widest uppercase text-gold bg-maroon-900 px-2 py-1">Utama</span>
                            <h3 class="text-xs font-bold text-maroon-900">{{ $page.props.auth.user?.name }}</h3>
                            <p class="text-xs font-serif text-maroon-900/70 mt-2 line-clamp-2">
                                Jl. Kemang Raya No. 12<br>
                                Jakarta Selatan, DKI Jakarta 12730<br>
                                Indonesia
                            </p>
                            <button class="mt-4 text-[9px] font-bold tracking-widest uppercase text-maroon-900 border-b border-maroon-900 hover:text-gold hover:border-gold transition-colors pb-0.5">Edit Alamat</button>
                        </div>
                        <button class="mt-6 w-full py-3 border border-dashed border-maroon-900/30 text-maroon-900 text-[10px] font-bold tracking-widest uppercase hover:bg-cream-50 transition-colors">
                            + Tambah Alamat Baru
                        </button>
                    </div>

                    <div v-else-if="activeTab === 'bank-kartu'">
                        <h2 class="text-sm font-bold tracking-widest uppercase text-maroon-900 mb-6 border-b border-maroon-900/10 pb-4">Bank & Kartu</h2>
                        <div class="flex items-center justify-between p-4 border border-maroon-900/20 mb-4">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-8 bg-maroon-900 rounded flex items-center justify-center text-white text-[8px] font-bold tracking-wider">VISA</div>
                                <div>
                                    <h4 class="text-xs font-bold text-maroon-900">BCA - Kartu Kredit</h4>
                                    <p class="text-[10px] font-serif text-maroon-900/60">**** **** **** 1114</p>
                                </div>
                            </div>
                            <span class="text-[9px] font-bold tracking-widest uppercase text-maroon-900/40">Default</span>
                        </div>
                        <button class="w-full py-3 border border-dashed border-maroon-900/30 text-maroon-900 text-[10px] font-bold tracking-widest uppercase hover:bg-cream-50 transition-colors">
                            + Tambah Kartu Baru
                        </button>
                    </div>
                    
                    <div v-else-if="activeTab === 'ubah-password'">
                        <h2 class="text-sm font-bold tracking-widest uppercase text-maroon-900 mb-6 border-b border-maroon-900/10 pb-4">Ubah Password</h2>
                        <div class="space-y-6">
                            <div>
                                <label class="block text-[9px] font-bold tracking-widest uppercase text-maroon-900 mb-2">Password Saat Ini</label>
                                <input type="password" class="w-full max-w-md px-3 py-2 text-xs border border-maroon-900/20 focus:outline-none focus:border-maroon-900">
                            </div>
                            <div>
                                <label class="block text-[9px] font-bold tracking-widest uppercase text-maroon-900 mb-2">Password Baru</label>
                                <input type="password" class="w-full max-w-md px-3 py-2 text-xs border border-maroon-900/20 focus:outline-none focus:border-maroon-900">
                            </div>
                            <button class="px-6 py-2 bg-maroon-900 text-white text-[10px] font-bold tracking-widest uppercase hover:bg-gold transition-colors">Simpan Password</button>
                        </div>
                    </div>

                    <div v-else-if="activeTab === 'pengaturan-notifikasi'">
                        <h2 class="text-sm font-bold tracking-widest uppercase text-maroon-900 mb-6 border-b border-maroon-900/10 pb-4">Pengaturan Notifikasi</h2>
                        <div class="space-y-4">
                            <label class="flex items-center gap-3 cursor-pointer">
                                <input type="checkbox" checked class="w-4 h-4 text-maroon-900 border-maroon-900/30 rounded focus:ring-maroon-900">
                                <span class="text-xs font-serif text-maroon-900">Pembaruan Status Pesanan (Email)</span>
                            </label>
                            <label class="flex items-center gap-3 cursor-pointer">
                                <input type="checkbox" class="w-4 h-4 text-maroon-900 border-maroon-900/30 rounded focus:ring-maroon-900">
                                <span class="text-xs font-serif text-maroon-900">Pesan dari Layanan Pelanggan</span>
                            </label>
                            <label class="flex items-center gap-3 cursor-pointer">
                                <input type="checkbox" checked class="w-4 h-4 text-maroon-900 border-maroon-900/30 rounded focus:ring-maroon-900">
                                <span class="text-xs font-serif text-maroon-900">Promo & Koleksi Terbaru</span>
                            </label>
                        </div>
                    </div>

                    <div v-else-if="activeTab === 'pengaturan-privasi'">
                        <h2 class="text-sm font-bold tracking-widest uppercase text-maroon-900 mb-6 border-b border-maroon-900/10 pb-4">Pengaturan Privasi</h2>
                        <div class="space-y-4">
                            <label class="flex items-center gap-3 cursor-pointer">
                                <input type="checkbox" checked class="w-4 h-4 text-maroon-900 border-maroon-900/30 rounded focus:ring-maroon-900">
                                <span class="text-xs font-serif text-maroon-900">Personalisasi rekomendasi produk</span>
                            </label>
                            <label class="flex items-center gap-3 cursor-pointer">
                                <input type="checkbox" checked class="w-4 h-4 text-maroon-900 border-maroon-900/30 rounded focus:ring-maroon-900">
                                <span class="text-xs font-serif text-maroon-900">Izinkan analitik penggunaan anonim</span>
                            </label>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </AdminLayout>
</template>
