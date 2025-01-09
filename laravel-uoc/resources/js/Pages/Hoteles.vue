<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import NavDash from '@/Pages/Dash/NavDash.vue';
import { Inertia } from '@inertiajs/inertia';
import { Head } from '@inertiajs/vue3';

import HotelesDash from '@/Pages/Dash/HotelesDash.vue';

const handle = (link: string) => {
    Inertia.visit(link);
};

const props = defineProps({
    hoteles: {
        type: Array as () => {
            id_hotel: number;
            id_zona: number;
            Comision: number;
            usuario: number;
            nombre_hotel: String;
            direccion_hotel: String;
        }[],
        required: true,
    },
    usuarios: {
        type: Array as () => { id: number; name: String }[],
        required: true,
    },
    zonas: {
        type: Array as () => { id_zona: number; descripcion: String }[],
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
            <HotelesDash
                :hoteles="hoteles"
                :usuarios="usuarios"
                :zonas="zonas"
                :rol="props.auth.user.rol"
            />
        </main>
    </AuthenticatedLayout>
</template>
