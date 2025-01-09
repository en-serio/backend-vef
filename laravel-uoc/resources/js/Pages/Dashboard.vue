<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import NavDash from '@/Pages/Dash/NavDash.vue';
import { Head } from '@inertiajs/vue3';

import { Inertia } from '@inertiajs/inertia';

const props = defineProps({
    auth: {
        type: Object,
        required: false,
        default: () => ({}),
    },
});

console.log('DEBUG: ' + JSON.stringify(props.auth, null, 2));

const handle = (link: string) => {
    Inertia.visit(link);
    console.log('DEBUG: ' + link);
};
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <!-- <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200"
            >
                Dashboard
            </h2>
        </template> -->

        <div class="nowrap items-cent flex flex-row justify-center py-6">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <NavDash @navigate="handle" :auth="props.auth" />
            </div>
        </div>
        <main
            class="nowrap items-cent flex flex-col items-center justify-center bg-white py-6 dark:bg-slate-800"
        >
            <span class="text-4xl font-bold text-black dark:text-white"
                >Bienvenido</span
            >
            <span class="text-2xl font-bold text-black dark:text-white"
                >Porfavor seleccione una opción.</span
            >
        </main>
    </AuthenticatedLayout>
</template>
