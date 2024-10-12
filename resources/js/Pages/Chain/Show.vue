<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, router } from '@inertiajs/vue3';
import Prompt from '@/Components/Prompt.vue';

defineProps({
    chain: {
        type: Object,
    },
});

const redirectToCreate = (chainId) => {
    router.visit(route('chains.prompts.create', chainId));
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
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <h3 class="text-lg font-semibold">{{ chain.name }}</h3>

                    <div class="mt-4" v-for="prompt in chain.prompts" :key="prompt.id">
                        <Prompt :prompt="prompt" />
                    </div>

                    <!-- Centered "+" button at the bottom -->
                    <div class="flex justify-center mt-6">
                        <button @click.prevent="redirectToCreate(chain.id)"
                                class="inline-flex items-center justify-center w-12 h-12 border border-transparent rounded-full shadow-sm text-2xl font-bold text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring focus:ring-blue-500">
                            +
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
