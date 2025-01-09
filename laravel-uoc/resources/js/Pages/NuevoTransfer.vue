<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import NavDash from '@/Pages/Dash/NavDash.vue';
import { Inertia } from '@inertiajs/inertia';
import { Head } from '@inertiajs/vue3';
import DatosDash from './Dash/DatosDash.vue';
import NuevoDash from './Dash/NuevoDash.vue';

const handle = (link: string) => {
    Inertia.visit(link);
};

const props = defineProps({
    transfers: {
        type: Array as () => {
            id_reserva: number;
            localizador: string;
            id_hotel: number;
            id_tipo_reserva: number;
            email_cliente: number;
            fecha_reserva: Date;
            fecha_modificacion: Date;
            id_destino: number;
            id_vehiculo: number;
            fecha_entrada: Date;
            hora_entrada: string;
            numero_vuelo_entrada: string;
            origen_vuelo_entrada: string;
            fecha_salida: Date;
            hora_salida: string;
            numero_vuelo_salida: string;
            destino_vuelo_salida: string;
            hora_vuelo_salida: string;
            fecha_vuelo_salida: Date;
            num_viajeros: number;
        }[],
        required: true,
    },
    hoteles: {
        type: Array as () => {
            id_hotel: number;
            id_zona: number;
            Comision: number;
            usuario: number;
            nombre_hotel: string;
            direccion_hotel: string;
        }[],
        required: true,
    },
    tipoReservas: {
        type: Array as () => {
            id_tipo_reserva: number;
            Descripción: string;
        }[],
        required: true,
    },
    viajeros: {
        type: Array as () => {
            id_viajero: number;
            email: string;
        }[],
        required: true,
    },
    datos: {
        type: Array as () => {
            contrasenya: string;
            localizador: string;
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
        <main
            class="flex w-full flex-col items-center justify-center gap-10 bg-white py-6 dark:bg-slate-800"
        >
            <div class="flex w-full justify-center">
                <DatosDash :datos="datos" />
            </div>
            <div
                class="flex w-full justify-center"
                v-for="(transfer, index) in transfers"
                :key="index"
            >
                <NuevoDash
                    :transfer="transfer"
                    :hoteles="hoteles"
                    :tipoReservas="tipoReservas"
                    :viajeros="viajeros"
                    :key="index"
                />
            </div>
        </main>
    </AuthenticatedLayout>
</template>
