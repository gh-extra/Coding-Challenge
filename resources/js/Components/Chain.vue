<script setup>
defineProps({
    chain: {
        type: Object,
        required: true
    },
});
</script>

<template>
    <div class="p-4 sm:p-8 bg-gray-50 border border-gray-200 rounded-lg shadow-md">
        <h3 class="text-lg font-semibold">{{ chain.name }}</h3>
        <p class="text-gray-600">{{ chain.description }}</p>
    </div>
</template>
