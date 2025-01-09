<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import NavDash from '@/Pages/Dash/NavDash.vue';
import { Inertia } from '@inertiajs/inertia';
import { Head } from '@inertiajs/vue3';

import TransferDash from './Dash/TransferDash.vue';

const handle = (link: string) => {
    Inertia.visit(link);
};

const props = defineProps({
    transfers: {
        type: Array as () => {
            id_reserva: number;
            localizador: String;
            id_hotel: number;
            id_tipo_reserva: number;
            email_cliente: number;
            fecha_reserva: Date;
            fecha_modificacion: Date;
            id_destino: number;
            fecha_entrada: Date;
            hora_entrada: string;
            numero_vuelo_entrada: string;
            origen_vuelo_entrada: string;
            hora_vuelo_salida: string;
            fecha_vuelo_salida: Date;
            num_viajeros: number;
            id_vehiculo: number;
        }[],
        required: true,
    },
    hoteles: {
        type: Array as () => { id_hotel: number; nombre_hotel: String }[],
        required: true,
    },
    usuarios: {
        type: Array as () => { id: number; email: String }[],
        required: true,
    },
    tipoReservas: {
        type: Array as () => { id_tipo_reserva: number; Descripción: String }[],
        required: true,
    },
    viajeros: {
        type: Array as () => {
            id_viajero: number;
            email: String;
            nombre: String;
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
            <TransferDash
                :transfers="transfers"
                :hoteles="hoteles"
                :usuarios="usuarios"
                :tipoReservas="tipoReservas"
                :viajeros="viajeros"
                :auth="auth"
            />
        </main>
    </AuthenticatedLayout>
</template>
