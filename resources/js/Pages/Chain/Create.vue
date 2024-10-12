<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';

const CHAT_ENGINE_GPT_3_5_TURBO = 'gpt-3.5-turbo';
const CHAT_ENGINE_GPT_4_MINI = 'gpt-4-mini';

const form = useForm({
    name: '',
    description: '',
    chat_engine_id: CHAT_ENGINE_GPT_3_5_TURBO,
});

const submit = () => {
    form.post(route('chains.store'), {
        onSuccess: () => {
            form.reset();
        },
    });
};
</script>

<template>
    <Head title="New Prompt Chain" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Create New Prompt Chain</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <form @submit.prevent="submit" class="space-y-6">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                            <input
                                v-model="form.name"
                                type="text"
                                id="name"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                required
                                maxlength="45"
                            />
                        </div>

                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                            <input
                                v-model="form.description"
                                type="text"
                                id="description"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                maxlength="255"
                            />
                        </div>

                        <div>
                            <label for="chat_engine_id" class="block text-sm font-medium text-gray-700">Select Chat Engine</label>
                            <select
                                v-model="form.chat_engine_id"
                                id="chat_engine_id"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                required
                            >
                                <option :value="CHAT_ENGINE_GPT_3_5_TURBO">ChatGPT 3.5 Turbo</option>
                                <option :value="CHAT_ENGINE_GPT_4_MINI">ChatGPT 4 Mini</option>
                            </select>
                        </div>

                        <div>
                            <button
                                type="submit"
                                class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring focus:ring-blue-500"
                            >
                                Create Chain
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
