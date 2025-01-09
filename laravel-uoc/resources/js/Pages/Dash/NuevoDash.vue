<script setup lang="ts">
import { computed } from 'vue';

const props = defineProps({
    transfer: {
        type: Object as () => {
            id_reserva: number;
            localizador: string;
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
        },
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
});

const nombreHotel = computed(() => {
    const hotel = props.hoteles.find(
        (h) => h.id_hotel === props.transfer.id_hotel,
    );
    return hotel ? hotel.nombre_hotel : 'Desconocido';
});

const descripcionTransfer = computed(() => {
    const tipo = props.tipoReservas.find(
        (t) => t.id_tipo_reserva === props.transfer.id_tipo_reserva,
    );
    return tipo ? tipo.Descripción : 'Desconocido';
});

const emailCliente = computed(() => {
    const viajero = props.viajeros.find(
        (v) => v.id_viajero === props.transfer.email_cliente,
    );
    return viajero ? viajero.email : 'No encontrado';
});

const destino = computed(() => {
    return nombreHotel;
});
</script>
<template>
    <div
        class="max-width-5/6 lg:max-w-4/6 flex flex-col items-center justify-center bg-gray-100 shadow-2xl shadow-slate-900 md:w-4/6 dark:bg-slate-900"
    >
        <div
            v-if="transfer.id_tipo_reserva === 1"
            class="flex w-full flex-col items-center justify-center"
        >
            <h3 class="px-5 py-7 text-2xl font-thin text-black dark:text-white">
                Reserva {{ descripcionTransfer }}
            </h3>
            <section
                class="grid w-full grid-cols-2 items-center justify-center gap-4 bg-gray-200 p-5 px-56 pb-10 text-xl text-black dark:bg-slate-800 dark:text-white"
            >
                <p>
                    <strong>Localizador de la Reserva:</strong>
                    {{ transfer.localizador }}
                </p>
                <p><strong>Nombre Hotel:</strong> {{ nombreHotel }}</p>
                <p>
                    <strong>Tipo de Transfer:</strong> {{ descripcionTransfer }}
                </p>
                <p><strong>Email Cliente:</strong> {{ emailCliente }}</p>
                <p>
                    <strong>Fecha de la Reserva:</strong>
                    {{ transfer.fecha_reserva }}
                </p>
                <p>
                    <strong>Fecha de Modificación:</strong>
                    {{ transfer.fecha_modificacion }}
                </p>
                <p><strong>Destino:</strong> {{ destino }}</p>
                <p>
                    <strong>Fecha de Llegada:</strong>
                    {{ transfer.fecha_entrada }}
                </p>
                <p>
                    <strong>Hora de Llegada:</strong>
                    {{ transfer.hora_entrada }}
                </p>
                <p>
                    <strong>Número de Vuelo:</strong>
                    {{ transfer.numero_vuelo_entrada }}
                </p>
                <p>
                    <strong>Origen del Vuelo:</strong>
                    {{ transfer.origen_vuelo_entrada }}
                </p>
                <p>
                    <strong>Número de Viajeros:</strong>
                    {{ transfer.num_viajeros }}
                </p>
                <p>
                    <strong>Identificador del Vehículo:</strong>
                    {{ transfer.id_vehiculo }}
                </p>
            </section>
        </div>
        <div
            v-else-if="transfer.id_tipo_reserva === 2"
            class="flex w-full flex-col items-center justify-center"
        >
            <h3 class="px-5 py-7 text-2xl font-thin text-black dark:text-white">
                Reserva {{ descripcionTransfer }}
            </h3>
            <section
                class="bgbg-gray-200 grid w-full grid-cols-2 items-center justify-center gap-4 p-5 px-56 pb-10 text-xl text-black dark:bg-slate-800 dark:text-white"
            >
                <p><strong>Localizador:</strong> {{ transfer.localizador }}</p>
                <p><strong>Nombre Hotel:</strong> {{ nombreHotel }}</p>
                <p>
                    <strong>Tipo de Transfer:</strong> {{ descripcionTransfer }}
                </p>
                <p><strong>Email Cliente:</strong> {{ emailCliente }}</p>
                <p>
                    <strong>Fecha de la Reserva:</strong>
                    {{ transfer.fecha_reserva }}
                </p>
                <p>
                    <strong>Fecha de Modificación:</strong>
                    {{ transfer.fecha_modificacion }}
                </p>
                <p><strong>Destino:</strong> Aeropuerto Local</p>
                <p>
                    <strong>Hora Recogida:</strong> {{ transfer.hora_entrada }}
                </p>
                <p>
                    <strong>Número Vuelo Salida:</strong>
                    {{ transfer.numero_vuelo_entrada }}
                </p>
                <p><strong>Origen Vuelo:</strong> Aeropuerto Local</p>
                <p>
                    <strong>Hora del Vuelo:</strong>
                    {{ transfer.hora_vuelo_salida }}
                </p>
                <p>
                    <strong>Fecha del Vuelo:</strong>
                    {{ transfer.fecha_vuelo_salida }}
                </p>
                <p>
                    <strong>Número de Viajeros:</strong>
                    {{ transfer.num_viajeros }}
                </p>
                <p>
                    <strong>Identificador del Vehículo:</strong>
                    {{ transfer.id_vehiculo }}
                </p>
            </section>
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
