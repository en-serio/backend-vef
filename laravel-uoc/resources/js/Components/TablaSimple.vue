<script setup lang="ts">
import { defineProps } from 'vue';

const props = defineProps({
    data: {
        type: Array as () => Array<any>,
        required: true,
    },
    headers: {
        type: Array as () => Array<string>,
        required: true,
    },
});
</script>
<template>
    <table
        class="min-w-full border border-gray-200 bg-white dark:border-slate-700 dark:bg-slate-700"
    >
        <thead>
            <tr>
                <th
                    v-for="(header, index) in headers"
                    :key="index"
                    class="border-b bg-white px-4 py-2 text-center text-base font-bold text-gray-700 dark:border-slate-600 dark:bg-slate-800 dark:text-white"
                >
                    {{ header }}
                </th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(row, index) in props.data" :key="index">
                <td
                    v-for="(header, idx) in row"
                    :key="idx"
                    class="border-b px-4 py-2 text-center text-base text-gray-800 dark:border-slate-600 dark:text-white"
                >
                    {{ header }}
                </td>
            </tr>
        </tbody>
    </table>
</template>
<style scoped>
table {
    width: 100%;
    border-collapse: collapse;
}
th,
td {
    padding: 10px;
}
</style>
