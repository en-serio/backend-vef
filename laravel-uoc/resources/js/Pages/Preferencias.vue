<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import NavDash from '@/Pages/Dash/NavDash.vue';
import { Inertia } from '@inertiajs/inertia';
import { Head } from '@inertiajs/vue3';

import TiposDash from '@/Pages/Dash/TiposDash.vue';
import ZonasDash from './Dash/ZonasDash.vue';

const handle = (link: string) => {
    Inertia.visit(link);
};

const props = defineProps({
    zonas: {
        type: Array as () => { id_zona: number; nombre_zona: String }[],
        required: true,
    },
    tiposReserva: {
        type: Array as () => { id_tipo_reserva: number; Descripción: String }[],
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
        <main
            class="flex flex-col items-center justify-center gap-10 bg-white py-6 dark:bg-slate-800"
        >
            <TiposDash :tipos="tiposReserva" />
            <ZonasDash :zonas="zonas" />
        </main>
    </AuthenticatedLayout>
</template>
