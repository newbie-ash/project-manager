<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
</script>

<template>
    <AdminLayout>
        <div class="max-w-4xl mx-auto px-4 lg:px-8 py-20 text-center">
            <svg class="w-16 h-16 text-maroon-900/20 mx-auto mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
            <h1 class="text-3xl font-bold tracking-[0.2em] uppercase text-maroon-900 mb-4">Help Center</h1>
            <p class="text-sm font-serif italic text-maroon-900/60 leading-relaxed max-w-lg mx-auto mb-10">
                Our concierges are at your service. For immediate assistance with your orders, styling advice, or bespoke requests, please contact our support team.
            </p>
            <a href="mailto:concierge@aritza.com" class="inline-block bg-maroon-900 text-white px-8 py-4 text-[10px] font-bold tracking-widest uppercase hover:bg-gold transition-colors">
                Contact Concierge
            </a>
        </div>
    </AdminLayout>
</template>
