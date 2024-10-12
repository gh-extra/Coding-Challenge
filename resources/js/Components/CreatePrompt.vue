<script setup>
import { useForm } from '@inertiajs/vue3';
import { defineEmits } from 'vue';

const emit = defineEmits();

const props = defineProps({
    chainId: {
        type: Number,
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
            emit('created');
        },
    });
};
</script>

<template>
    <form @submit.prevent="submit(chainId)" class="space-y-6">
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
</template>
