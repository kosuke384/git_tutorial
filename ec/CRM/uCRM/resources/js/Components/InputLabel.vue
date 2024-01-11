<script setup>
defineProps({
    value: {
        type: String,
    },
});

defineEmits(['update:modelValue']);
</script>

<template>
    <label class="block font-medium text-sm text-gray-700">
        <span v-if="value">{{ value }}</span>
        <span v-else><slot /></span>
    </label>
    <input type="text" @input="$emit('update:modelValue',$event.target.value)">
</template>
