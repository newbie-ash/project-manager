<script setup>
import { useForm, usePage } from '@inertiajs/vue3';
import { onMounted, ref, watch } from 'vue';

const page = usePage();

const form = useForm({
    email: '',
    password: '',
});

const showToast = ref(false);

const checkFlash = () => {
    if (page.props.flash?.success) {
        showToast.value = true;
        setTimeout(() => {
            showToast.value = false;
        }, 4000);
    }
};

onMounted(() => {
    checkFlash();
});

watch(() => page.props.flash, () => {
    checkFlash();
}, { deep: true });

const submit = () => {
    form.post(route('login'));
};
</script>

<template>
    <div class="bg-maroon-900 min-h-screen flex items-center justify-center p-4 relative overflow-hidden">
        <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/stardust.png')] opacity-80 pointer-events-none"></div>
        
        <!-- Toast Popup -->
        <Transition
            enter-active-class="transition ease-out duration-500"
            enter-from-class="transform opacity-0 -translate-y-4"
            enter-to-class="transform opacity-100 translate-y-0"
            leave-active-class="transition ease-in duration-300"
            leave-from-class="transform opacity-100 translate-y-0"
            leave-to-class="transform opacity-0 -translate-y-4"
        >
            <div v-if="showToast" class="fixed top-8 right-8 z-50 bg-white border border-cream-200 border-l-4 border-l-gold shadow-2xl p-5 min-w-[300px] rounded-r-2xl rounded-l-md flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-full bg-cream-100 flex items-center justify-center">
                        <svg class="w-4 h-4 text-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    </div>
                    <span class="font-serif italic text-maroon-900 font-medium">{{ $page.props.flash.success }}</span>
                </div>
                <button @click="showToast = false" class="text-maroon-900/40 hover:text-maroon-900 transition-colors ml-4 focus:outline-none">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
        </Transition>

        <div class="max-w-md w-full bg-cream rounded-3xl shadow-2xl overflow-hidden relative border border-gold/10">
            <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cream-paper.png')] opacity-40 pointer-events-none"></div>
            
            <div class="p-10 relative z-10">
                <div class="text-center mb-10">
                    <h1 class="text-4xl font-serif font-bold text-maroon-900 italic tracking-wider mb-2">A'ritza</h1>
                    <p class="text-[10px] tracking-[0.3em] uppercase text-maroon-900/60 font-bold">Maison de Luxe</p>
                    <div class="w-12 h-px bg-gold mx-auto mt-6"></div>
                </div>

                <div v-if="form.errors.email || form.errors.password" class="mb-8 bg-rose-50 border-l-2 border-rose-600 text-rose-800 px-4 py-3 text-sm font-serif italic rounded-r-2xl">
                    <p v-if="form.errors.email">{{ form.errors.email }}</p>
                    <p v-if="form.errors.password">{{ form.errors.password }}</p>
                </div>

                <form @submit.prevent="submit" class="space-y-8">
                    <div>
                        <label class="block text-[10px] font-bold text-maroon-900/60 uppercase tracking-widest mb-2">Email Identity</label>
                        <input v-model="form.email" type="email" required class="w-full px-5 py-4 rounded-2xl bg-cream-100 border-2 border-maroon-900/30 hover:border-maroon-900/50 focus:border-gold focus:ring-2 focus:ring-gold/30 focus:outline-none transition-all text-maroon-900 font-medium text-base shadow-inner placeholder-maroon-900/30" placeholder="">
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-maroon-900/60 uppercase tracking-widest mb-2">Passphrase</label>
                        <input v-model="form.password" type="password" required class="w-full px-5 py-4 rounded-2xl bg-cream-100 border-2 border-maroon-900/30 hover:border-maroon-900/50 focus:border-gold focus:ring-2 focus:ring-gold/30 focus:outline-none transition-all text-maroon-900 font-medium text-base shadow-inner placeholder-maroon-900/30" placeholder="">
                    </div>
                    
                    <button type="submit" :disabled="form.processing" class="w-full bg-maroon-900 text-gold text-xs tracking-[0.2em] uppercase font-bold py-4 rounded-2xl hover:bg-maroon-800 transition-colors mt-4 shadow-lg hover:shadow-xl disabled:opacity-50">
                        <span v-if="form.processing">Authenticating...</span>
                        <span v-else>Authenticate</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</template>
