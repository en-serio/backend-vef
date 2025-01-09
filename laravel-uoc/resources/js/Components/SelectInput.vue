<script setup lang="ts">
import { defineEmits, ref } from 'vue';

const props = defineProps({
    options: {
        type: Array as () => any[],
        required: true,
    },
    modelValue: {
        type: String,
        required: true,
    },
});

const emit = defineEmits<{
    (event: 'update:modelValue', value: string): void;
}>();

const select = ref<HTMLSelectElement | null>(null);

const handleChange = (event: Event) => {
    const value = (event.target as HTMLSelectElement).value;
    emit('update:modelValue', value);
};
</script>

<template>
    <select
        class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-indigo-600 dark:focus:ring-indigo-600"
        :value="modelValue"
        @change="handleChange"
        ref="select"
    >
        <option disabled value="">Selecciona un rol</option>
        <option v-for="option in props.options" :key="option" :value="option">
            {{ option }}
        </option>
    </select>
</template>
