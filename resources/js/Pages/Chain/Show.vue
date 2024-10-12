<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import Prompt from '@/Components/Prompt.vue';


defineProps({
    chain: {
        type: Object,
    },
});
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
                    <!-- <p class="text-gray-600">{{ chain.description }}</p> -->

                    <div class="mt-4" v-for="prompt in chain.prompts" :key="prompt.id">
                        <Prompt :prompt="prompt" />
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
