<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import NavLink from '@/Components/NavLink.vue';
import { Head, useForm, router } from '@inertiajs/vue3';

defineProps({
    chains: {
        type: Array,
    },
});

const deleteForm = useForm({});
const deleteChain = (id) => {
    if (confirm("Are you sure you want to delete this prompt chain?")) {
        deleteForm.delete(route('chains.destroy', { id }));
    }
};

const redirectToCreate = () => {
    router.visit(route('chains.create'));
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
                <button @click.prevent="redirectToCreate"
                        class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring focus:ring-blue-500">
                    New Prompt Chain
                </button>

                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <p v-if="!chains.length" class="text-gray-500">
                        Please add new prompt chains.
                    </p>

                    <div class="mb-4 relative" v-for="chain in chains" :key="chain.id">
                        <button
                            @click.prevent="deleteChain(chain.id)"
                            class="absolute top-0 left-0 inline-flex items-center justify-center w-8 h-8 rounded-full bg-gray-300 text-red-600 hover:bg-red-700 focus:outline-none focus:ring focus:ring-red-500">
                            X
                        </button>

                        <NavLink :active="route().current('chains.show')" :href="route('chains.show', { id: chain.id })">
                            <div class="p-4 sm:p-8 bg-gray-50 border border-gray-200 rounded-lg shadow-md">
                                <h3 class="text-lg font-semibold">{{ chain.name }} ({{ chain.chat_engine_id }})</h3>
                                <p class="text-gray-600">{{ chain.description }}</p>
                            </div>
                        </NavLink>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
