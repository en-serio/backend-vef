<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import NavDash from '@/Pages/Dash/NavDash.vue';
import dayGridPlugin from '@fullcalendar/daygrid';
import interactionPlugin from '@fullcalendar/interaction';
import FullCalendar from '@fullcalendar/vue3';
import { Inertia } from '@inertiajs/inertia';
import { Head } from '@inertiajs/vue3';
import { computed, ref } from 'vue';

const handle = (link: string) => {
    Inertia.visit(link);
};

interface Event {
    title: string;
    description: string;
    location: string;
    transfer: {
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
    };
}

const eventDetails = computed(() => {
    if (!selectedEvent.value) return [];

    const event = selectedEvent.value;
    const transfer = event.transfer;
    const hotel = props.hoteles.find((h) => h.id_hotel === transfer.id_hotel);
    const transferType = props.tipoReservas.find(
        (t) => t.id_tipo_transfer === transfer.id_tipo_reserva,
    );
    const client = props.viajeros.find(
        (v) => v.id_viajero === transfer.email_cliente,
    );

    if (transfer.id_tipo_reserva === 1) {
        return [
            { label: 'Localizador de la Reserva', value: transfer.localizador },
            {
                label: 'Nombre Hotel',
                value: hotel?.nombre_hotel || 'No encontrado',
            },
            {
                label: 'Tipo de transfer',
                value: transferType?.Descripción || 'No encontrado',
            },
            { label: 'Email Cliente', value: client?.email || 'No encontrado' },
            {
                label: 'Fecha de la Reserva',
                value: transfer.fecha_reserva.toLocaleDateString(),
            },
            {
                label: 'Fecha de Modificación',
                value: transfer.fecha_modificacion.toLocaleDateString(),
            },
            { label: 'Destino', value: hotel?.nombre_hotel || 'No encontrado' },
            {
                label: 'Fecha de Llegada',
                value: transfer.fecha_entrada.toLocaleDateString(),
            },
            { label: 'Hora de Llegada', value: transfer.hora_entrada },
            { label: 'Número de vuelo', value: transfer.numero_vuelo_entrada },
            { label: 'Origen del vuelo', value: transfer.origen_vuelo_entrada },
            { label: 'Número de viajeros', value: transfer.num_viajeros },
            {
                label: 'Identificador del vehículo',
                value: transfer.id_vehiculo,
            },
        ];
    }

    return [
        { label: 'Localizador', value: transfer.localizador },
        {
            label: 'Nombre Hotel',
            value: hotel?.nombre_hotel || 'No encontrado',
        },
        {
            label: 'Tipo de transfer',
            value: transferType?.Descripción || 'No encontrado',
        },
        { label: 'Email Cliente', value: client?.email || 'No encontrado' },
        {
            label: 'Fecha de la Reserva',
            value: transfer.fecha_reserva.toLocaleDateString(),
        },
        {
            label: 'Fecha de Modificación',
            value: transfer.fecha_modificacion.toLocaleDateString(),
        },
        { label: 'Destino', value: 'Aeropuerto Local' },
        { label: 'Hora recogida', value: transfer.hora_entrada },
        { label: 'Número Vuelo Salida', value: transfer.numero_vuelo_entrada },
        { label: 'Origen Vuelo', value: 'Aeropuerto Local' },
        { label: 'Hora del Vuelo', value: transfer.hora_vuelo_salida },
        {
            label: 'Fecha del Vuelo',
            value: transfer.fecha_vuelo_salida.toLocaleDateString(),
        },
        { label: 'Número de viajeros', value: transfer.num_viajeros },
        { label: 'Identificador del vehículo', value: transfer.id_vehiculo },
    ];
});

const props = defineProps({
    auth: {
        type: Object,
        required: true,
    },
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
    viajeros: {
        type: Array as () => {
            id_viajero: number;
            email: string;
        }[],
        required: true,
    },
    hoteles: {
        type: Array as () => {
            id_hotel: number;
            nombre_hotel: string;
        }[],
        required: true,
    },
    tipoReservas: {
        type: Array as () => {
            id_tipo_transfer: number;
            Descripción: string;
        }[],
        required: true,
    },
});

console.log(props.transfers);

const events = ref(
    props.transfers.map((transfer) => {
        const title = `${transfer.id_reserva} - ${transfer.localizador}`;
        let start, color;

        const fechaEntrada = new Date(transfer.fecha_entrada);
        const fechaVueloSalida = new Date(transfer.fecha_vuelo_salida);

        if (transfer.id_tipo_reserva === 1 && !isNaN(fechaEntrada.getTime())) {
            start = `${fechaEntrada.toISOString().split('T')[0]}T${transfer.hora_entrada}`;
            color = '#1155ff'; // Color para id_tipo_reserva 1
        } else if (
            transfer.id_tipo_reserva === 2 &&
            !isNaN(fechaVueloSalida.getTime())
        ) {
            start = `${fechaVueloSalida.toISOString().split('T')[0]}T${transfer.hora_entrada}`;
            color = '#ff5511'; // Color para id_tipo_reserva 2
        }

        return {
            title,
            start,
            description: transfer.email_cliente.toString(),
            location: transfer.id_hotel.toString(),
            color,
            transfer: {
                ...transfer,
                hotelName:
                    props.hoteles.find((h) => h.id_hotel === transfer.id_hotel)
                        ?.nombre_hotel || 'No encontrado',
                transferTypeDescription:
                    props.tipoReservas.find(
                        (t) => t.id_tipo_transfer === transfer.id_tipo_reserva,
                    )?.Descripción || 'No encontrado',
                clientEmail:
                    props.viajeros.find(
                        (v) => v.id_viajero === transfer.email_cliente,
                    )?.email || 'No encontrado',
            },
        };
    }),
);

const selectedEvent = ref<any | null>(null);
const modalVisible = ref(false);

const openModal = (event: any) => {
    selectedEvent.value = event;
    console.log(event);
    modalVisible.value = true;
};

const closeModal = () => {
    modalVisible.value = false;
};
const calendarOptions = ref({
    plugins: [dayGridPlugin, interactionPlugin],
    initialView: 'dayGridMonth',
    events: events.value,
    firstDay: 1,
    headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,dayGridWeek,dayGridDay',
    },
    eventClick: (info: any) => openModal(info.event),
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
            <FullCalendar
                :options="calendarOptions"
                class="calendar-size w-3/4 bg-white p-5 dark:bg-slate-700"
            />
            <div
                v-if="modalVisible"
                class="modal fixed inset-0 z-50 flex items-center justify-center bg-gray-500 bg-opacity-50"
            >
                <div
                    class="modal-content flex flex-col gap-5 rounded-lg bg-white p-6 text-black shadow-lg dark:bg-slate-800 dark:text-gray-300"
                >
                    <h2
                        class="text-xl font-semibold text-black dark:text-white"
                    >
                        Detalles del Evento
                    </h2>
                    <p>
                        <strong>Reserva:</strong>
                        {{
                            selectedEvent?.extendedProps.transfer.id_reserva ??
                            'No seleccionado'
                        }}
                    </p>
                    <p>
                        <strong>Localizador:</strong>
                        {{
                            selectedEvent?.extendedProps.transfer.localizador ??
                            'No seleccionado'
                        }}
                    </p>
                    <p>
                        <strong>Hotel:</strong>
                        {{
                            selectedEvent?.extendedProps.transfer.hotelName ??
                            'No seleccionado'
                        }}
                    </p>
                    <p>
                        <strong>Email cliente :</strong>
                        {{
                            selectedEvent?.extendedProps.transfer.clientEmail ??
                            'No seleccionado'
                        }}
                    </p>
                    <p>
                        <strong>Fecha Reserva:</strong>
                        {{
                            selectedEvent?.extendedProps.transfer
                                .fecha_reserva ?? 'No seleccionado'
                        }}
                    </p>
                    <p>
                        <strong>Fecha Modificación:</strong>
                        {{
                            selectedEvent?.extendedProps.transfer
                                .fecha_modificacion ?? 'No seleccionado'
                        }}
                    </p>
                    <p>
                        <strong>Destino:</strong>
                        {{
                            selectedEvent?.extendedProps.transfer.hotelName ??
                            'No seleccionado'
                        }}
                    </p>
                    <p
                        v-if="
                            selectedEvent?.extendedProps.transfer
                                .id_tipo_reserva === 1
                        "
                    >
                        <strong>Fecha de Llegada:</strong>
                        {{
                            selectedEvent?.extendedProps.transfer
                                .fecha_entrada ?? 'No seleccionado'
                        }}
                    </p>
                    <p
                        v-if="
                            selectedEvent?.extendedProps.transfer
                                .id_tipo_reserva === 1
                        "
                    >
                        <strong>Hora de llegada:</strong>
                        {{
                            selectedEvent?.extendedProps.transfer
                                .hora_entrada ?? 'No seleccionado'
                        }}
                    </p>
                    <p v-else>
                        <strong>Hora de Recogida:</strong>
                        {{
                            selectedEvent?.extendedProps.transfer
                                .hora_entrada ?? 'No seleccionado'
                        }}
                    </p>
                    <p>
                        <strong>Número de vuelo:</strong>
                        {{
                            selectedEvent?.extendedProps.transfer
                                .numero_vuelo_entrada ?? 'No seleccionado'
                        }}
                    </p>
                    <p>
                        <strong>Origen Vuelo:</strong>
                        {{
                            selectedEvent?.extendedProps.transfer
                                .origen_vuelo_entrada ?? 'No seleccionado'
                        }}
                    </p>
                    <p
                        v-if="
                            selectedEvent?.extendedProps.transfer
                                .id_tipo_reserva === 2
                        "
                    >
                        <strong>Hora del vuelo:</strong>
                        {{
                            selectedEvent?.extendedProps.transfer
                                .hora_vuelo_salida ?? 'No seleccionado'
                        }}
                    </p>
                    <p
                        v-if="
                            selectedEvent?.extendedProps.transfer
                                .id_tipo_reserva === 2
                        "
                    >
                        <strong>Fecha del vuelo:</strong>
                        {{
                            selectedEvent?.extendedProps.transfer
                                .fecha_vuelo_salida ?? 'No seleccionado'
                        }}
                    </p>
                    <p>
                        <strong>Número de viajeros:</strong>
                        {{
                            selectedEvent?.extendedProps.transfer
                                .num_viajeros ?? 'No seleccionado'
                        }}
                    </p>
                    <p>
                        <strong>Identificador Vehículo:</strong>
                        {{
                            selectedEvent?.extendedProps.transfer.id_vehiculo ??
                            'No seleccionado'
                        }}
                    </p>
                    <button
                        @click="closeModal"
                        class="mt-4 rounded bg-blue-500 px-4 py-2 text-white hover:bg-blue-400 hover:text-black dark:bg-blue-800"
                    >
                        Cerrar
                    </button>
                </div>
            </div>
        </main>
    </AuthenticatedLayout>
</template>
<style scoped>
.calendar-size {
    height: 800px;
}

::v-deep .fc-daygrid-day {
    border: 1px solid #ccc;
}

::v-deep .fc-daygrid-day.fc-empty {
    border: 1px dashed #ddd;
}

::v-deep .fc-daygrid-day-number {
    color: #333;
}

@media (prefers-color-scheme: dark) {
    ::v-deep .fc-daygrid-day {
        border: 1px solid #444;
    }

    ::v-deep .fc-daygrid-day-number {
        color: #fff;
    }

    ::v-deep .fc-day-header {
        border-bottom: 2px solid #333;
    }
}

::v-deep .fc-day-header {
    background-color: #f0f0f0;
    border-bottom: 2px solid #ccc;
    color: #333;
}

::v-deep .fc-daygrid-day.fc-day-today {
    background-color: #ddd;
    color: #333;
}
</style>
