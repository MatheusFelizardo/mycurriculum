<script setup>
import NavLink from '@/Components/NavLink.vue'; 
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">You're logged in!</div>
                </div>

                <div class="pt-6">
                    <p class="text-sm mb-2">File: example.pdf</p>
                    <NavLink class="bg-gray-300 text-black rounded-sm" :href="route('pdf.read')">Read PDF</NavLink>
                </div>
            </div>
        </div>

    
       
    </AuthenticatedLayout>
</template>
