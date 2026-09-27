<script setup>
import BackofficeLayout from '@/Layouts/BackofficeLayout.vue';
import { Chart as ChartJS, Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale, ArcElement } from 'chart.js';
import { Bar, Doughnut } from 'vue-chartjs';

ChartJS.register(CategoryScale, LinearScale, BarElement, Title, Tooltip, Legend, ArcElement);

defineProps({
    stats: Object,
});

const chartData = {
    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
    datasets: [{
        label: 'Revenue (M)',
        backgroundColor: '#611624', // maroon-900
        hoverBackgroundColor: '#c8a97e', // gold
        data: [120, 150, 180, 130, 220, 480]
    }]
};

const chartOptions = {
    responsive: true,
    maintainAspectRatio: false,
    scales: {
        y: { beginAtZero: true, grid: { color: '#f3f4f6' } },
        x: { grid: { display: false } }
    },
    plugins: { legend: { display: false } }
};

const donutData = {
    labels: ['Handbags', 'Accessories', 'Shoes'],
    datasets: [{
        backgroundColor: ['#611624', '#c8a97e', '#ebdcc2'],
        data: [55, 30, 15]
    }]
};

const donutOptions = {
    responsive: true,
    maintainAspectRatio: false,
    cutout: '70%',
    plugins: { legend: { position: 'bottom' } }
};
</script>

<template>
    <BackofficeLayout>
        
        <div class="mb-10">
            <h1 class="text-2xl font-bold tracking-[0.2em] uppercase text-maroon-900 mb-2">Executive Dashboard</h1>
            <p class="text-sm font-serif italic text-maroon-900/60">Overview of A'ritza's business performance</p>
        </div>

        <!-- Metric Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
            <!-- Card 1 -->
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-maroon-900/5 flex flex-col">
                <div class="flex justify-between items-center mb-4">
                    <p class="text-[10px] font-bold tracking-widest uppercase text-maroon-900/50">Total Revenue</p>
                    <div class="w-8 h-8 rounded-full bg-gold/10 flex items-center justify-center text-gold">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                </div>
                <h3 class="text-3xl font-serif text-maroon-900 mb-1">Rp 480M</h3>
                <p class="text-xs text-green-600 font-bold tracking-wide">+12.5% <span class="text-maroon-900/40 font-normal">from last month</span></p>
            </div>

            <!-- Card 2 -->
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-maroon-900/5 flex flex-col">
                <div class="flex justify-between items-center mb-4">
                    <p class="text-[10px] font-bold tracking-widest uppercase text-maroon-900/50">Total Orders</p>
                    <div class="w-8 h-8 rounded-full bg-maroon-900/10 flex items-center justify-center text-maroon-900">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                    </div>
                </div>
                <h3 class="text-3xl font-serif text-maroon-900 mb-1">{{ stats.transactions }}</h3>
                <p class="text-xs text-green-600 font-bold tracking-wide">+5.2% <span class="text-maroon-900/40 font-normal">from last month</span></p>
            </div>

            <!-- Card 3 -->
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-maroon-900/5 flex flex-col">
                <div class="flex justify-between items-center mb-4">
                    <p class="text-[10px] font-bold tracking-widest uppercase text-maroon-900/50">Active Clients</p>
                    <div class="w-8 h-8 rounded-full bg-maroon-900/10 flex items-center justify-center text-maroon-900">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    </div>
                </div>
                <h3 class="text-3xl font-serif text-maroon-900 mb-1">{{ stats.customers }}</h3>
                <p class="text-xs text-green-600 font-bold tracking-wide">+18 <span class="text-maroon-900/40 font-normal">new this week</span></p>
            </div>

            <!-- Card 4 -->
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-maroon-900/5 flex flex-col">
                <div class="flex justify-between items-center mb-4">
                    <p class="text-[10px] font-bold tracking-widest uppercase text-maroon-900/50">Products</p>
                    <div class="w-8 h-8 rounded-full bg-maroon-900/10 flex items-center justify-center text-maroon-900">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path></svg>
                    </div>
                </div>
                <h3 class="text-3xl font-serif text-maroon-900 mb-1">{{ stats.products }}</h3>
                <p class="text-xs text-maroon-900/50 font-bold tracking-wide">In current collection</p>
            </div>
        </div>

        <!-- Charts & Data Section -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Real Chart using Vue-ChartJS -->
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-maroon-900/5 lg:col-span-2">
                <h3 class="text-xs font-bold tracking-widest uppercase text-maroon-900 mb-6">Revenue Analytics (YTD)</h3>
                <div class="w-full h-72 relative">
                    <Bar :data="chartData" :options="chartOptions" />
                </div>
            </div>

            <!-- Doughnut Chart (Sales by Category) -->
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-maroon-900/5">
                <h3 class="text-xs font-bold tracking-widest uppercase text-maroon-900 mb-6">Sales by Category</h3>
                <div class="w-full h-64 relative flex items-center justify-center">
                    <Doughnut :data="donutData" :options="donutOptions" />
                </div>
            </div>
        </div>
        
    </BackofficeLayout>
</template>
