<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';

defineProps({
    chain: {
        type: Object,
        required: true,
    },
});

const form = useForm({
    input: '',
});

const submit = (chainId) => {
    form.post(route('chains.prompts.store', chainId), {
        onSuccess: () => {
            form.reset('input');
        },
    });
};
</script>

<template>
    <Head title="Create New Prompt" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Create New Prompt</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <form @submit.prevent="submit(chain.id)" class="space-y-6">
                        <div class="mb-4 flex flex-col">
                            <label for="input" class="text-sm font-medium text-gray-700">Prompt Input</label>
                            <textarea
                                id="input"
                                name="input"
                                rows="3"
                                placeholder="Prompt away!"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500 focus:border-blue-500"
                                v-model="form.input"></textarea>
                        </div>

                        <div>
                            <button
                                type="submit"
                                class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring focus:ring-blue-500"
                            >
                                Create Prompt
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
