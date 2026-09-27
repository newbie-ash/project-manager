<script setup>
import BackofficeLayout from '@/Layouts/BackofficeLayout.vue';
import { useForm, Link } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({
    product: Object
});

// useForm cannot send files over PUT, so we must use POST and spoof method
const form = useForm({
    _method: 'PUT',
    name: props.product.name,
    category: props.product.category,
    price: props.product.price,
    stock: props.product.stock,
    image: null,
});

const imagePreview = ref(props.product.image ? '/storage/' + props.product.image : null);

const handleImageChange = (e) => {
    const file = e.target.files[0];
    if (file) {
        form.image = file;
        const reader = new FileReader();
        reader.onload = (e) => {
            imagePreview.value = e.target.result;
        };
        reader.readAsDataURL(file);
    }
};

const submitForm = () => {
    form.post(route('products.update', props.product.id), {
        preserveScroll: true,
    });
};
</script>

<template>
    <BackofficeLayout>
        <div class="max-w-3xl mx-auto py-12">
            <div class="mb-10 text-center">
                <h1 class="text-3xl font-serif font-bold tracking-tight text-maroon-900 mb-3">Edit Piece</h1>
                <div class="w-16 h-px bg-gold mx-auto"></div>
            </div>

            <div class="bg-white rounded-none shadow-sm border border-cream-200 relative overflow-hidden">
                <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cream-paper.png')] opacity-20 pointer-events-none"></div>
                
                <form @submit.prevent="submitForm" class="p-8 sm:p-12 relative z-10">
                    <div class="space-y-8">
                        <div>
                            <label class="block text-[10px] font-bold text-maroon-900/60 uppercase tracking-widest mb-4">Piece Image</label>
                            <div class="flex items-center gap-6">
                                <div v-if="imagePreview" class="w-24 h-24 shrink-0 bg-cream-100 border border-maroon-900/10 overflow-hidden flex items-center justify-center">
                                    <img :src="imagePreview" class="w-full h-full object-cover">
                                </div>
                                <div class="flex-1 border-2 border-dashed border-maroon-900/20 p-6 text-center hover:border-gold transition-colors bg-cream-100/50" :class="{'p-8': !imagePreview}">
                                    <svg v-if="!imagePreview" class="mx-auto h-12 w-12 text-maroon-900/40 mb-4" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <div class="flex flex-col sm:flex-row text-[10px] text-maroon-900 justify-center items-center gap-2">
                                        <label for="image" class="relative cursor-pointer bg-white font-bold text-gold tracking-widest uppercase hover:text-maroon-900 focus-within:outline-none px-4 py-2 border border-cream-200 transition-colors">
                                            <span v-if="imagePreview">Change File</span>
                                            <span v-else>Upload File</span>
                                            <input id="image" type="file" class="sr-only" accept="image/jpeg, image/png, image/jpg" @change="handleImageChange">
                                        </label>
                                    </div>
                                    <p class="text-[9px] uppercase tracking-widest text-maroon-900/50 mt-4">PNG, JPG up to 2MB</p>
                                </div>
                            </div>
                            <p v-if="form.errors.image" class="text-rose-600 text-xs font-medium mt-2">{{ form.errors.image }}</p>
                        </div>

                        <div>
                            <label for="name" class="block text-[10px] font-bold text-maroon-900/60 uppercase tracking-widest mb-2">Item Name</label>
                            <input v-model="form.name" type="text" id="name" class="block w-full px-4 py-3 border bg-white text-sm font-sans text-maroon-900 focus:outline-none transition-all" :class="{'border-rose-500': form.errors.name, 'border-maroon-900/20 focus:border-gold focus:ring-1 focus:ring-gold': !form.errors.name}">
                            <p v-if="form.errors.name" class="text-rose-600 text-xs font-medium mt-2">{{ form.errors.name }}</p>
                        </div>

                        <div>
                            <label for="category" class="block text-[10px] font-bold text-maroon-900/60 uppercase tracking-widest mb-2">Category</label>
                            <input v-model="form.category" type="text" id="category" class="block w-full px-4 py-3 border bg-white text-sm font-sans text-maroon-900 focus:outline-none transition-all" :class="{'border-rose-500': form.errors.category, 'border-maroon-900/20 focus:border-gold focus:ring-1 focus:ring-gold': !form.errors.category}">
                            <p v-if="form.errors.category" class="text-rose-600 text-xs font-medium mt-2">{{ form.errors.category }}</p>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-10">
                            <div>
                                <label for="price" class="block text-[10px] font-bold text-maroon-900/60 uppercase tracking-widest mb-2">Price (IDR)</label>
                                <input v-model="form.price" type="number" step="0.01" min="0" id="price" class="block w-full px-4 py-3 border bg-white text-sm font-sans text-maroon-900 focus:outline-none transition-all" :class="{'border-rose-500': form.errors.price, 'border-maroon-900/20 focus:border-gold focus:ring-1 focus:ring-gold': !form.errors.price}">
                                <p v-if="form.errors.price" class="text-rose-600 text-xs font-medium mt-2">{{ form.errors.price }}</p>
                            </div>
                            <div>
                                <label for="stock" class="block text-[10px] font-bold text-maroon-900/60 uppercase tracking-widest mb-2">Available Quantity</label>
                                <input v-model="form.stock" type="number" min="0" id="stock" class="block w-full px-4 py-3 border bg-white text-sm font-sans text-maroon-900 focus:outline-none transition-all" :class="{'border-rose-500': form.errors.stock, 'border-maroon-900/20 focus:border-gold focus:ring-1 focus:ring-gold': !form.errors.stock}">
                                <p v-if="form.errors.stock" class="text-rose-600 text-xs font-medium mt-2">{{ form.errors.stock }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-12 pt-8 border-t border-maroon-900/10 flex flex-col sm:flex-row items-center justify-between gap-4">
                        <Link :href="route('products.index')" class="w-full sm:w-auto text-center px-8 py-3 text-[10px] tracking-widest uppercase font-bold text-maroon-900/60 hover:text-maroon-900 transition-colors border border-transparent hover:border-maroon-900/20">
                            Cancel
                        </Link>
                        <button type="submit" :disabled="form.processing" class="w-full sm:w-auto px-10 py-3 text-[10px] tracking-widest uppercase font-bold text-white bg-maroon-900 hover:bg-gold transition-colors disabled:opacity-50">
                            <span v-if="form.processing">Updating...</span>
                            <span v-else>Update Piece</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </BackofficeLayout>
</template>
