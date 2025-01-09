<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import NavDash from '@/Pages/Dash/NavDash.vue';
import { Inertia } from '@inertiajs/inertia';
import { Head } from '@inertiajs/vue3';

import UsuariosDash from '@/Pages/Dash/UsuariosDash.vue';

const handle = (link: string) => {
    Inertia.visit(link);
};

const props = defineProps({
    usuarios: {
        type: Array as () => {
            id: number;
            name: String;
            apellido1: String;
            apellido2: String;
            email: String;
            rol: number;
            id_viajero: number;
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
            <UsuariosDash :usuarios="usuarios" :rol="props.auth.user.rol" />
        </main>
    </AuthenticatedLayout>
</template>
