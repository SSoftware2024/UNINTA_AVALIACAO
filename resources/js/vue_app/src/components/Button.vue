<template>

    <button
        class="btn"
        :disabled="isLoading"
    >
        {{ isLoading ? 'Carregando...':text }}
    </button>
</template>

<script setup>
    const props = defineProps({
        isLoading: {
            type: Boolean,
            default: false,
        },
        text: {
            type: String,
            default: 'Button',
        }
    });
</script>
