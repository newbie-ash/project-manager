<script setup>
import BackofficeLayout from '@/Layouts/BackofficeLayout.vue';
import { Link } from '@inertiajs/vue3';

defineProps({
    complaints: Array
});
</script>

<template>
    <BackofficeLayout>
        <div class="mb-10">
            <h1 class="text-2xl font-bold tracking-[0.2em] uppercase text-maroon-900 mb-2">Customer Complaints</h1>
            <p class="text-sm font-serif italic text-maroon-900/60">Manage client support tickets</p>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-maroon-900/5 overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-cream-50 border-b border-maroon-900/10">
                        <th class="py-4 px-6 text-[10px] font-bold tracking-[0.2em] uppercase text-maroon-900/50">Client Info</th>
                        <th class="py-4 px-6 text-[10px] font-bold tracking-[0.2em] uppercase text-maroon-900/50">Message</th>
                        <th class="py-4 px-6 text-[10px] font-bold tracking-[0.2em] uppercase text-maroon-900/50">Date</th>
                        <th class="py-4 px-6 text-[10px] font-bold tracking-[0.2em] uppercase text-maroon-900/50 text-right">Status / Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="c in complaints" :key="c.id" class="border-b border-maroon-900/5 hover:bg-cream-50/50 transition-colors">
                        <td class="py-4 px-6">
                            <p class="text-xs font-bold tracking-widest uppercase text-maroon-900">{{ c.name }}</p>
                            <p class="text-[10px] text-maroon-900/50 mt-1">{{ c.email }}</p>
                        </td>
                        <td class="py-4 px-6 text-xs text-maroon-900/80 max-w-md truncate">
                            {{ c.message }}
                        </td>
                        <td class="py-4 px-6 text-[10px] font-serif text-maroon-900/60 italic">
                            {{ new Date(c.created_at).toLocaleDateString() }}
                        </td>
                        <td class="py-4 px-6 text-right">
                            <span v-if="c.status === 'Resolved'" class="text-[10px] font-bold tracking-widest uppercase text-green-600 bg-green-100 px-3 py-1 rounded">Resolved</span>
                            <Link v-else :href="route('complaints.update', c.id)" method="patch" as="button" class="text-[10px] font-bold tracking-widest uppercase text-gold border border-gold hover:bg-gold hover:text-white px-3 py-1 transition-colors">
                                Resolve
                            </Link>
                        </td>
                    </tr>
                </tbody>
            </table>
            
            <div v-if="complaints.length === 0" class="p-12 text-center">
                <p class="text-sm font-serif italic text-maroon-900/50">No complaints found. Your clients are happy!</p>
            </div>
        </div>
    </BackofficeLayout>
</template>
