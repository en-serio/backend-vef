<script setup lang="ts">
import { Link } from '@inertiajs/inertia-vue3';
import { defineProps } from 'vue';

const props = defineProps({
    title: {
        type: String,
        required: true,
    },
    desc: {
        type: String,
        required: true,
    },
    link: {
        type: String,
        required: true,
    },
});
</script>

<template>
    <Link
        :href="route(props.link)"
        class="cursor-pointer rounded-lg bg-white px-6 py-3 shadow-lg transition-all hover:bg-gray-100 dark:bg-slate-500 dark:text-gray-100 dark:hover:text-black"
    >
        <h3 class="text-xl font-semibold">
            {{ props.title }}
        </h3>

        <p class="mt-2 text-sm">
            {{ props.desc }}
        </p>
    </Link>
</template>
