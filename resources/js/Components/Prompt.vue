<script setup>
import { useForm } from '@inertiajs/vue3';
import { defineProps } from 'vue';

const props = defineProps({
    prompt: {
        type: Object,
        required: true
    },
});

const deleteForm = useForm({});

const deletePrompt = (id) => {
    // TODO: what if there is not ID?
    if (confirm("Are you sure you want to delete this prompt?")) {
        deleteForm.delete(route('chains.prompts.destroy', { chain: props.prompt.chain_id, prompt: id }));
    }
};

const form = useForm({
    input: props.prompt.input,
});

const submit = () => {
    if (props.prompt.id) {
        form.patch(route('chains.prompts.update', { id: props.prompt.id }));
    } else {
        form.post(route('chains.prompts.store'));
    }
};

</script>

<template>
    <div class="p-4 relative sm:p-8 bg-gray-50 border border-gray-200 rounded-lg shadow-md">
        <button
            @click.prevent="deletePrompt(props.prompt.id)"
            class="absolute top-0 left-0 inline-flex items-center justify-center w-8 h-8 rounded-full bg-gray-300 text-red-600 hover:bg-red-700 focus:outline-none focus:ring focus:ring-red-500">
            X
        </button>

        <form @submit.prevent="submit">
            <div class="mb-4 flex flex-col">
                <label for="input" class="text-sm font-medium text-gray-700">Prompt Input</label>
                <textarea
                    id="input"
                    name="input"
                    rows="3"
                    placeholder="Prompt away!"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500 focus:border-blue-500"
                    v-model="form.input">{{ props.prompt.input }}</textarea>
            </div>

            <div aria-hidden="true">
                <div class="flex items-center">

                    <div class="ml-2">
                        <button type="submit"
                                class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring focus:ring-blue-500">
                            Run
                        </button>
                    </div>
                </div>
            </div>

            <div v-if="props.prompt.output" class="p-mb-4 mt-4 sm:p-4 bg-gray-50 border border-gray-200 rounded-lg shadow-md">
                <p class="text-gray-600">{{ props.prompt.output }}</p>
            </div>
        </form>
    </div>
</template>
