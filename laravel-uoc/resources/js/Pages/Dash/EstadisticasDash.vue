<script setup lang="ts">
import TablaSimple from '@/Components/TablaSimple.vue';
import { useForm } from '@inertiajs/vue3';
import { computed, ref } from 'vue';

const form = useForm({
    idhotel: 0,
    idzona: 0,
    zonaname: '',
    comision: '',
    idusuario: 0,
    usuarioname: '',
    hotelname: '',
    dirhotel: '',
});

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
    rol: {
        type: String,
        required: true,
    },
});

const mesSelect = ref<number | null>(null);

const transFiltrado = computed(() => {
    if (mesSelect.value === null) {
        return props.transfers;
    }

    return props.transfers.filter((transfer) => {
        const fecha =
            transfer.id_tipo_reserva === 1
                ? new Date(transfer.fecha_entrada)
                : new Date(transfer.fecha_vuelo_salida);

        return fecha.getMonth() + 1 === mesSelect.value;
    });
});

const grupoDatos = computed(() => {
    const transfersXHotel = transFiltrado.value.reduce(
        (acc, transfer) => {
            const hotel = props.hoteles.find(
                (h) => h.id_hotel === transfer.id_hotel,
            );
            if (!hotel) return acc;

            if (!acc[hotel.id_hotel]) {
                acc[hotel.id_hotel] = {
                    hotel: `${hotel.id_hotel} - ${hotel.nombre_hotel}`,
                    usuario:
                        (props.usuarios.find((u) => u.id === hotel.usuario)?.name as string) ||
                        'Desconocido',
                   /* usuario:
                        props.usuarios.find((u) => u.id === hotel.usuario)
                            ?.name || 'Desconocido',*/
                    comision: hotel.Comision,
                    numeroTransfers: 0,
                    total: 0,
                };
            }

            acc[hotel.id_hotel].numeroTransfers++;
            acc[hotel.id_hotel].total =
                acc[hotel.id_hotel].comision *
                acc[hotel.id_hotel].numeroTransfers;

            return acc;
        },
        {} as Record<
            number,
            {
                hotel: string;
                usuario: string;
                comision: number;
                numeroTransfers: number;
                total: number;
            }
        >,
    );

    return Object.values(transfersXHotel);
});

const months = [
    { value: null, label: 'Todos' },
    { value: 1, label: 'Enero' },
    { value: 2, label: 'Febrero' },
    { value: 3, label: 'Marzo' },
    { value: 4, label: 'Abril' },
    { value: 5, label: 'Mayo' },
    { value: 6, label: 'Junio' },
    { value: 7, label: 'Julio' },
    { value: 8, label: 'Agosto' },
    { value: 9, label: 'Septiembre' },
    { value: 10, label: 'Octubre' },
    { value: 11, label: 'Noviembre' },
    { value: 12, label: 'Diciembre' },
];
const header = ['Hotel', 'Usuario', 'Comisión', 'Número de transfers', 'Total'];
</script>
<template>
    <div class="flex w-4/6 flex-col bg-gray-100 dark:bg-slate-900">
        <h3 class="w-full px-5 pt-5 text-xl font-semibold dark:text-white">
            Estadísticas
        </h3>
        <div class="flex w-full flex-row justify-between rounded px-5 py-5">
            <select
                v-model="mesSelect"
                class="w-1/6 rounded-lg bg-white p-2 text-black dark:bg-slate-700 dark:text-white"
            >
                <option
                    v-for="month in months"
                    :key="month.value ?? 'defaultKey'"
                    :value="month.value"
                >
                    {{ month.label }}
                </option>
            </select>
        </div>
        <div class="flex w-full flex-row overflow-x-scroll">
            <TablaSimple :headers="header" :data="grupoDatos" />
        </div>
    </div>
</template>
<style scoped>
.dashboard-layout {
    display: flex;
}

.sidebar {
    width: 200px;
    background: #f3f4f6;
    padding: 1rem;
}

.content {
    flex: 1;
    padding: 2rem;
}

/* Las flechitas */
input[type='number']::-webkit-outer-spin-button,
input[type='number']::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}
input[type='number'] {
    -moz-appearance: textfield;
    appearance: textfield;
}
</style>
