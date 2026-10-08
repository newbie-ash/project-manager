<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Link, useForm } from '@inertiajs/vue3';
import { computed } from 'vue';

const props = defineProps({
    cartItems: Array
});

// Form checkout
const form = useForm({
    shipping_address: '',
    phone: '',
    selected_items: props.cartItems.map(item => item.id), // Default pilih semua
});

// Hitung total harga HANYA untuk item yang dipilih
const cartTotal = computed(() => {
    return props.cartItems
        .filter(item => form.selected_items.includes(item.id))
        .reduce((total, item) => total + (item.product.price * item.quantity), 0);
});

// Pilih semua toggle
const isAllSelected = computed({
    get() {
        return form.selected_items.length === props.cartItems.length && props.cartItems.length > 0;
    },
    set(value) {
        if (value) {
            form.selected_items = props.cartItems.map(item => item.id);
        } else {
            form.selected_items = [];
        }
    }
});

const submitCheckout = () => {
    if (form.selected_items.length === 0) {
        alert("Pilih setidaknya satu barang untuk dicheckout.");
        return;
    }
    form.post(route('checkout.process'));
};
</script>

<template>
    <AdminLayout>
        <div class="max-w-4xl mx-auto px-4 lg:px-8 py-12">
            
            <h1 class="text-2xl font-bold tracking-[0.2em] uppercase text-maroon-900 mb-2">
                Shopping Cart
            </h1>
            <p class="text-xs font-serif italic text-maroon-900/60 mb-10">Review your selected pieces before checkout</p>

            <div v-if="cartItems.length > 0" class="flex flex-col lg:flex-row gap-12">
                
                <!-- Cart Items List -->
                <div class="flex-1">
                    <div class="border-b-2 border-maroon-900 pb-2 mb-6 flex justify-between items-center">
                        <div class="flex items-center gap-3">
                            <input type="checkbox" v-model="isAllSelected" class="w-4 h-4 text-maroon-900 border-maroon-900/30 rounded focus:ring-maroon-900">
                            <span class="text-[10px] font-bold tracking-widest uppercase">Select All</span>
                        </div>
                        <span class="text-[10px] font-bold tracking-widest uppercase">Price</span>
                    </div>

                    <div v-for="item in cartItems" :key="item.id" class="flex justify-between items-center py-6 border-b border-maroon-900/10 transition-colors" :class="{'bg-maroon-900/5': form.selected_items.includes(item.id)}">
                        <div class="flex items-center gap-4 px-2">
                            <input type="checkbox" :value="item.id" v-model="form.selected_items" class="w-4 h-4 text-maroon-900 border-maroon-900/30 rounded focus:ring-maroon-900">
                            
                            <div class="w-20 h-24 bg-maroon-900/10 relative overflow-hidden ml-2">
                                <img v-if="item.product.image" :src="'/storage/' + item.product.image" class="w-full h-full object-cover">
                                <div v-else class="w-full h-full flex items-center justify-center font-serif text-maroon-900/30 text-2xl italic">{{ item.product.name.charAt(0) }}</div>
                            </div>
                            <div>
                                <h3 class="text-xs font-bold tracking-widest uppercase text-maroon-900">{{ item.product.name }}</h3>
                                <p class="text-[10px] font-serif italic text-maroon-900/60 mt-1">Quantity: {{ item.quantity }}</p>
                                
                                <Link :href="route('cart.destroy', item.id)" method="delete" as="button" class="text-[9px] font-bold tracking-widest uppercase text-maroon-900/40 hover:text-rose-700 transition-colors mt-4">
                                    Remove
                                </Link>
                            </div>
                        </div>
                        <div class="text-xs font-serif italic text-maroon-900 pr-2">
                            Rp {{ Number(item.product.price * item.quantity).toLocaleString('id-ID') }}
                        </div>
                    </div>
                </div>

                <!-- Checkout Sidebar -->
                <div class="w-full lg:w-80 bg-white p-6 border border-maroon-900/10 shadow-sm h-fit">
                    <h3 class="text-xs font-bold tracking-widest uppercase text-maroon-900 mb-6 border-b border-maroon-900/10 pb-4">Order Summary</h3>
                    
                    <div class="flex justify-between text-xs font-serif italic text-maroon-900 mb-2">
                        <span>Subtotal</span>
                        <span>Rp {{ cartTotal.toLocaleString('id-ID') }}</span>
                    </div>
                    <div class="flex justify-between text-xs font-serif italic text-maroon-900 mb-6">
                        <span>Shipping</span>
                        <span>Complimentary</span>
                    </div>
                    
                    <div class="flex justify-between text-sm font-bold tracking-widest uppercase text-maroon-900 mb-8 border-t border-maroon-900/10 pt-4">
                        <span>Total</span>
                        <span>Rp {{ cartTotal.toLocaleString('id-ID') }}</span>
                    </div>

                    <form @submit.prevent="submitCheckout">
                        <div class="mb-4">
                            <label class="block text-[9px] font-bold tracking-widest uppercase text-maroon-900 mb-2">Shipping Address</label>
                            <textarea v-model="form.shipping_address" required rows="3" class="w-full px-3 py-2 text-xs border border-maroon-900/20 bg-transparent focus:outline-none focus:border-maroon-900 transition-colors placeholder:text-maroon-900/30" placeholder="Enter full delivery address..."></textarea>
                        </div>
                        <div class="mb-6">
                            <label class="block text-[9px] font-bold tracking-widest uppercase text-maroon-900 mb-2">Phone Number</label>
                            <input v-model="form.phone" required type="text" class="w-full px-3 py-2 text-xs border border-maroon-900/20 bg-transparent focus:outline-none focus:border-maroon-900 transition-colors placeholder:text-maroon-900/30" placeholder="e.g. 08123456789">
                        </div>

                        <button type="submit" :disabled="form.processing" class="w-full bg-maroon-900 text-white text-[10px] font-bold tracking-widest uppercase py-4 hover:bg-gold transition-colors disabled:opacity-50 shadow-md">
                            Proceed to Checkout
                        </button>
                    </form>
                </div>
            </div>

            <!-- Empty Cart -->
            <div v-else class="py-20 text-center">
                <svg class="w-12 h-12 text-maroon-900/20 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                <h3 class="text-sm font-bold tracking-[0.2em] uppercase text-maroon-900 mb-2">Your cart is empty</h3>
                <p class="text-xs font-serif italic text-maroon-900/50 mb-8">Discover our latest collection to add pieces.</p>
                <Link :href="route('products.index')" class="text-[10px] font-bold tracking-widest uppercase border-b border-maroon-900 text-maroon-900 hover:text-gold hover:border-gold transition-colors pb-1">
                    Return to Collection
                </Link>
            </div>

        </div>
    </AdminLayout>
</template>
