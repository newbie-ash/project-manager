<script setup>
import { ref } from 'vue';
import { useForm, usePage, Head, Link } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import BackofficeLayout from '@/Layouts/BackofficeLayout.vue';
import LuxuryLayout from '@/Layouts/LuxuryLayout.vue';

const page = usePage();
const user = page.props.auth.user;

// Pilih layout berdasarkan role agar nyambung dengan tampilan mereka
// Admin menggunakan BackofficeLayout, buyer menggunakan LuxuryLayout
const resolveLayout = () => {
    if (user?.role === 'admin') {
        return BackofficeLayout;
    }
    return LuxuryLayout;
}

const activeTab = ref('keamanan_akun');

const tabs = [
    { id: 'keamanan_akun', name: 'Keamanan & Akun' },
    { id: 'alamat_saya', name: 'Alamat Saya' },
    { id: 'kartu_rekening', name: 'Kartu/Rekening' },
    { id: 'pengaturan_privasi', name: 'Pengaturan Privasi' },
    { id: 'pengaturan_chat', name: 'Pengaturan Chat' },
    { id: 'pengaturan_pesanan', name: 'Pengaturan Pesanan' },
];

const form = useForm({
    name: user.name,
    email: user.email,
    avatar: null,
});

const photoPreview = ref(user.avatar ? '/storage/' + user.avatar : null);
const photoInput = ref(null);

const selectNewPhoto = () => {
    photoInput.value.click();
};

const updatePhotoPreview = () => {
    const photo = photoInput.value.files[0];
    if (!photo) return;
    
    form.avatar = photo;

    const reader = new FileReader();
    reader.onload = (e) => {
        photoPreview.value = e.target.result;
    };
    reader.readAsDataURL(photo);
};

const updateProfile = () => {
    form.post(route('settings.profile.update'), {
        preserveScroll: true,
        onSuccess: () => {
            // Toast flash message akan muncul otomatis

        },
    });
};

</script>

<template>
    <Head title="Pengaturan Akun" />

    <component :is="resolveLayout()" :hideSidebar="true">
        <div class="max-w-[1200px] mx-auto px-4 lg:px-8 py-8 md:py-12">
            
            <div class="flex flex-col md:flex-row gap-8">
                <!-- Sidebar Pengaturan -->
                <aside class="w-full md:w-64 flex-shrink-0">
                    <div class="bg-white rounded-2xl shadow-sm border border-maroon-900/10 overflow-hidden sticky top-28">
                        <div class="px-6 py-4 bg-cream-50 border-b border-maroon-900/10 flex items-center gap-4">
                            <img v-if="user.avatar" :src="'/storage/' + user.avatar" class="w-12 h-12 rounded-full object-cover border border-maroon-900/20" />
                            <div v-else class="w-12 h-12 rounded-full bg-maroon-900 text-gold flex items-center justify-center font-serif text-lg italic">
                                {{ user.name.charAt(0).toUpperCase() }}
                            </div>
                            <div>
                                <p class="text-sm font-bold text-maroon-900 truncate">{{ user.name }}</p>
                                <p class="text-[10px] text-maroon-900/50 uppercase tracking-wider flex gap-1">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                                    Ubah Profil
                                </p>
                            </div>
                        </div>

                        <ul class="py-2">
                            <li v-for="tab in tabs" :key="tab.id">
                                <button @click="activeTab = tab.id" 
                                        class="w-full text-left px-6 py-3 text-sm font-medium transition-colors border-l-4" 
                                        :class="activeTab === tab.id ? 'bg-cream-100 border-gold text-maroon-900 font-bold' : 'border-transparent text-maroon-900/70 hover:bg-cream-50 hover:text-maroon-900'">
                                    {{ tab.name }}
                                </button>
                            </li>
                        </ul>
                    </div>
                </aside>

                <!-- Konten Pengaturan -->
                <main class="flex-1 min-w-0">
                    <div class="bg-white rounded-2xl shadow-sm border border-maroon-900/10 p-6 md:p-8">
                        
                        <!-- TAB: Keamanan & Akun -->
                        <div v-if="activeTab === 'keamanan_akun'">
                            <div class="border-b border-maroon-900/10 pb-4 mb-6">
                                <h2 class="text-xl font-bold text-maroon-900">Profil Saya</h2>
                                <p class="text-sm text-maroon-900/60 mt-1">Kelola informasi profil Anda untuk mengontrol, melindungi dan mengamankan akun</p>
                            </div>

                            <form @submit.prevent="updateProfile" class="flex flex-col-reverse md:flex-row gap-8">
                                <!-- Form Fields -->
                                <div class="flex-1 space-y-6">
                                    <div>
                                        <label class="block text-xs font-bold tracking-widest text-maroon-900/70 uppercase mb-2">Nama Lengkap</label>
                                        <input v-model="form.name" type="text" class="w-full px-4 py-2 bg-cream-50 border border-maroon-900/20 rounded-lg focus:ring-2 focus:ring-gold focus:border-gold transition-colors text-maroon-900" required>
                                        <div v-if="form.errors.name" class="text-rose-600 text-xs mt-1">{{ form.errors.name }}</div>
                                    </div>

                                    <div>
                                        <label class="block text-xs font-bold tracking-widest text-maroon-900/70 uppercase mb-2">Email</label>
                                        <input v-model="form.email" type="email" class="w-full px-4 py-2 bg-cream-50 border border-maroon-900/20 rounded-lg focus:ring-2 focus:ring-gold focus:border-gold transition-colors text-maroon-900" required>
                                        <div v-if="form.errors.email" class="text-rose-600 text-xs mt-1">{{ form.errors.email }}</div>
                                    </div>

                                    <div>
                                        <label class="block text-xs font-bold tracking-widest text-maroon-900/70 uppercase mb-2">Role Saat Ini</label>
                                        <input :value="user.role.toUpperCase()" type="text" class="w-full px-4 py-2 bg-gray-100 border border-gray-200 rounded-lg text-gray-500 cursor-not-allowed" disabled>
                                    </div>

                                    <div class="pt-4">
                                        <button type="submit" :disabled="form.processing" class="px-6 py-3 bg-maroon-900 text-gold text-xs font-bold tracking-widest uppercase rounded-lg hover:bg-maroon-800 transition-colors disabled:opacity-50">
                                            Simpan Perubahan
                                        </button>
                                    </div>
                                </div>

                                <!-- Photo Upload Area -->
                                <div class="w-full md:w-64 flex flex-col items-center border-l-0 md:border-l border-maroon-900/10 pl-0 md:pl-8">
                                    <div class="w-32 h-32 rounded-full overflow-hidden border-2 border-maroon-900/20 bg-cream-50 mb-4 flex items-center justify-center text-maroon-900">
                                        <img v-if="photoPreview" :src="photoPreview" class="w-full h-full object-cover" />
                                        <div v-else class="text-4xl font-serif italic">{{ user.name.charAt(0).toUpperCase() }}</div>
                                    </div>
                                    
                                    <input type="file" class="hidden" ref="photoInput" @change="updatePhotoPreview" accept="image/*">
                                    
                                    <button type="button" @click="selectNewPhoto" class="px-4 py-2 border border-maroon-900 text-maroon-900 text-xs font-bold tracking-widest uppercase rounded-lg hover:bg-maroon-900 hover:text-gold transition-colors mb-3">
                                        Pilih Gambar
                                    </button>
                                    
                                    <p class="text-[10px] text-maroon-900/40 text-center leading-tight">
                                        Ukuran gambar: maks. 2 MB<br>
                                        Format gambar: .JPEG, .PNG
                                    </p>
                                    <div v-if="form.errors.avatar" class="text-rose-600 text-xs mt-2 text-center">{{ form.errors.avatar }}</div>
                                </div>
                            </form>
                        </div>

                        <!-- TAB: Mock untuk lainnya -->
                        <div v-else>
                            <div class="border-b border-maroon-900/10 pb-4 mb-6">
                                <h2 class="text-xl font-bold text-maroon-900">{{ tabs.find(t => t.id === activeTab).name }}</h2>
                                <p class="text-sm text-maroon-900/60 mt-1">Pengaturan {{ tabs.find(t => t.id === activeTab).name.toLowerCase() }} Anda.</p>
                            </div>
                            
                            <div class="py-12 flex flex-col items-center justify-center text-maroon-900/40">
                                <svg class="w-16 h-16 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/></svg>
                                <p class="text-sm font-medium">Fitur ini sedang dalam tahap pengembangan.</p>
                            </div>
                        </div>

                    </div>
                </main>
            </div>
            
        </div>
    </component>
</template>
