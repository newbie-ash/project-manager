<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
</script>

<template>
    <AdminLayout>
        <div class="max-w-3xl mx-auto px-4 lg:px-8 py-20">
            <div class="text-center mb-16">
                <h1 class="text-3xl font-bold tracking-[0.2em] uppercase text-maroon-900 mb-4">Frequently Asked Questions</h1>
                <p class="text-sm font-serif italic text-maroon-900/60">Curated answers to our most common inquiries.</p>
            </div>

            <div class="space-y-8">
                <div class="border-b border-maroon-900/10 pb-8">
                    <h3 class="text-sm font-bold tracking-widest uppercase text-maroon-900 mb-3">What are your shipping policies?</h3>
                    <p class="text-sm font-serif italic text-maroon-900/70 leading-relaxed">
                        We offer complimentary worldwide shipping on all orders. Each piece is meticulously packaged in our signature A'ritza box and dispatched via express courier with full tracking and insurance.
                    </p>
                </div>
                <div class="border-b border-maroon-900/10 pb-8">
                    <h3 class="text-sm font-bold tracking-widest uppercase text-maroon-900 mb-3">Do you accept returns or exchanges?</h3>
                    <p class="text-sm font-serif italic text-maroon-900/70 leading-relaxed">
                        Returns are accepted within 14 days of delivery, provided the item is in pristine, unworn condition with all security tags intact. Bespoke or personalized items are strictly non-refundable.
                    </p>
                </div>
                <div class="border-b border-maroon-900/10 pb-8">
                    <h3 class="text-sm font-bold tracking-widest uppercase text-maroon-900 mb-3">How do I care for my A'ritza leather goods?</h3>
                    <p class="text-sm font-serif italic text-maroon-900/70 leading-relaxed">
                        Our leathers are carefully selected for their exceptional quality. To maintain their beauty, avoid prolonged exposure to direct sunlight or moisture. Clean gently with a soft, dry cloth.
                    </p>
                </div>
                <div class="pb-8">
                    <h3 class="text-sm font-bold tracking-widest uppercase text-maroon-900 mb-3">Are the diamonds ethically sourced?</h3>
                    <p class="text-sm font-serif italic text-maroon-900/70 leading-relaxed">
                        Absolutely. A'ritza is committed to responsible sourcing. All our diamonds are conflict-free and adhere to the strict guidelines of the Kimberley Process.
                    </p>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>
