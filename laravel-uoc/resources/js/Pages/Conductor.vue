<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import NavDash from '@/Pages/Dash/NavDash.vue';
import { Inertia } from '@inertiajs/inertia';
import { Head } from '@inertiajs/vue3';

import ConductorDash from '@/Pages/Dash/ConductorDash.vue';

const handle = (link: string) => {
    Inertia.visit(link);
};

const props = defineProps({
    vehiculos: {
        type: Array as () => {
            id_vehiculo: number;
            Descripción: String;
            email_conductor: String;
            plazas: number;
        }[],
        required: true,
    },
    auth: {
        type: Object,
        required: true,
    },
});
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
        <main class="flex justify-center bg-white py-6 dark:bg-slate-800">
            <ConductorDash :vehiculos="vehiculos" />
        </main>
    </AuthenticatedLayout>
</template>
