<script setup lang="ts">
import DashCard from '@/Components/DashCards.vue';
import { computed } from 'vue';

// const props = defineProps({
//     data: {
//         type: Array as () => { titulo: string; desc: string; ruta: string }[],
//         required: true,
//     },
// });

const props = defineProps({
    auth: {
        type: Object,
        required: true,
    },
});

const userRole = computed(() => {
    return props.auth?.user ? Number(props.auth.user.rol) : null;
});

console.log('DEBUG: ' + JSON.stringify(userRole.value, null, 2));

const data = [
    {
        titulo: 'Crear Transfer',
        desc: 'Ida, vuelta e ida y vuelta',
        ruta: `crearTransfer`,
        rol: [1, 2, 3],
    },
    {
        titulo: 'Gestionar transfer',
        desc: 'Gestiona todos los transfers existentes',
        ruta: 'transfers',
        rol: [1, 2, 3],
    },
    {
        titulo: 'Panel de calendario',
        desc: 'Consulta el calendario de los transfers',
        ruta: 'calendario',
        rol: [1],
    },
    {
        titulo: 'Gestion de conductor',
        desc: 'Gestiona los conductores de la aplicación',
        ruta: 'vehiculos',
        rol: [1],
    },
    {
        titulo: 'Hotel Admin',
        desc: 'Crea y gestiona los hoteles de la aplicación',
        ruta: 'hoteles',
        rol: [1],
    },
    {
        titulo: 'Hotel',
        desc: 'Crea y gestiona los hoteles de la aplicación',
        ruta: 'hoteles.usuario',
        rol: [2],
    },
    {
        titulo: 'Estadísticas',
        desc: 'Consulta los transfers y comisiones filtradas',
        ruta: 'estadisticas',
        rol: [1],
    },
    {
        titulo: 'Preferencias',
        desc: 'Visualiza e inicializa zonas y tipos de transfers',
        ruta: 'zonas',
        rol: [1],
    },
    {
        titulo: 'Usuarios',
        desc: 'Visualiza y gestiona los usuarios de la aplicación',
        ruta: 'usuarios',
        rol: [1],
    },
];

const filtrarData = computed(() => {
    return data.filter(
        (item) => userRole.value !== null && item.rol.includes(userRole.value),
    );
});

console.log(filtrarData.value);
</script>

<template>
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="overflow-hidden shadow-sm sm:rounded-lg">
            <div
                class="grid-col s-1 grid gap-x-10 gap-y-5 sm:grid-cols-2 lg:grid-cols-3"
            >
                <DashCard
                    v-for="(item, index) in filtrarData"
                    :key="index"
                    :title="item.titulo"
                    :desc="item.desc"
                    :link="item.ruta"
                    class="w-full"
                />
            </div>
        </div>
    </div>
</template>
