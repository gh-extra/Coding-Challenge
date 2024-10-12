<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import NavLink from '@/Components/NavLink.vue';
import { Head, useForm } from '@inertiajs/vue3';

defineProps({
    chains: {
        type: Array,
    },
});

const deleteForm = useForm({});

const deleteChain = (id) => {
    if (confirm("Are you sure you want to delete this prompt chain?")) {
        deleteForm.delete(route('chain.destroy', { id }));
    }
};

</script>

<template>
    <Head title="Prompt Chains" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Prompt Chains</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <!-- <form @submit.prevent="submit">
                    <button type="submit"
                            class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring focus:ring-blue-500">
                        New Prompt Chain
                    </button>
                </form> -->

                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="mb-4" v-for="chain in chains" :key="chain.id">
                        <NavLink :active="route().current('chain.show')" :href="route('chain.show', { id: chain.id })">
                            <div class="p-4 sm:p-8 bg-gray-50 border border-gray-200 rounded-lg shadow-md">
                                <h3 class="text-lg font-semibold">{{ chain.name }}</h3>
                                <p class="text-gray-600">{{ chain.description }}</p>
                                <!-- You can display more chain details here -->
                            </div>
                        </NavLink>
                        <button
                            @click.prevent="deleteChain(chain.id)"
                            class="ml-2 inline-flex items-center justify-center w-8 h-8 rounded-full bg-red-600 text-white hover:bg-red-700 focus:outline-none focus:ring focus:ring-red-500">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20" class="w-5 h-5">
                                <path fill-rule="evenodd" d="M10 1a1 1 0 011 1v1h4a1 1 0 011 1v1h-1v11a3 3 0 01-3 3H5a3 3 0 01-3-3V4a1 1 0 011-1h4V2a1 1 0 011-1h4zM6 4h8v11H6V4zM8 5v1h4V5H8z" clip-rule="evenodd"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
