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
    onEdit: {
        type: Function as () => Function,
        required: true,
    },
    onDelete: {
        type: Function as () => Function,
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
                <th
                    class="w-5 border-b bg-white py-2 text-center text-sm font-semibold text-gray-700 dark:border-slate-600 dark:bg-slate-800 dark:text-white"
                >
                    <span></span>
                </th>
                <th
                    class="w-5 border-b bg-white py-2 text-center text-sm font-semibold text-gray-700 dark:border-slate-600 dark:bg-slate-800 dark:text-white"
                >
                    <span></span>
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
                <td
                    class="border-b py-2 text-center text-sm text-gray-800 dark:border-slate-600 dark:text-white"
                >
                    <button
                        class="rounded bg-blue-500 px-4 py-2 font-bold text-white hover:bg-blue-700"
                        @click="() => props.onEdit(row)"
                    >
                        Editar
                    </button>
                </td>
                <td
                    class="border-b py-2 text-center text-sm text-gray-800 dark:border-slate-600 dark:text-white"
                >
                    <button
                        class="rounded bg-red-500 px-4 py-2 font-bold text-white hover:bg-red-700"
                        @click="() => props.onDelete(row)"
                    >
                        Eliminar
                    </button>
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
