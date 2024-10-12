<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import Prompt from '@/Components/Prompt.vue';
import CreatePrompt from '@/Components/CreatePrompt.vue';
import { ref } from 'vue';

defineProps({
    chain: {
        type: Object,
    },
});

const isCreating = ref(false);
const toggleCreatePrompt = () => {
    isCreating.value = !isCreating.value;
};

const handlePromptCreated = () => {
    isCreating.value = false;
};
</script>

<template>
    <Head :title="chain.name" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ chain.name }}</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="flex justify-between items-center">
                        <div class="w-4/5 max-w-[80%] truncate">{{ chain.description }}</div>
                        <button
                            @click.prevent="redirectToCreate(chain.id)"
                            :disabled="!chain.prompts.length"
                            :class="{'bg-gray-400 cursor-not-allowed': !chain.prompts.length, 'bg-blue-600 hover:bg-blue-700': chain.prompts.length}"
                            class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white focus:outline-none focus:ring focus:ring-blue-500">
                            Run Full Chain
                        </button>
                    </div>

                    <div class="mt-4" v-for="prompt in chain.prompts" :key="prompt.id">
                        <Prompt :prompt="prompt" />
                    </div>

                    <!-- Centered "+" button at the bottom -->
                    <div class="flex justify-center mt-6">
                        <button v-if="!isCreating" @click.prevent="toggleCreatePrompt"
                                class="inline-flex items-center justify-center w-12 h-12 border border-transparent rounded-full shadow-sm text-2xl font-bold text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring focus:ring-blue-500">
                            +
                        </button>
                    </div>

                    <div v-if="isCreating" class="mt-4">
                        <button
                            @click.prevent="toggleCreatePrompt"
                            class="mb-4 inline-flex items-center justify-center w-8 h-8 rounded-full bg-gray-300 text-red-600 hover:bg-red-700 focus:outline-none focus:ring focus:ring-red-500">
                            X
                        </button>
                        <CreatePrompt :chainId="chain.id" @created="handlePromptCreated" />
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
