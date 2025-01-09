<script setup lang="ts">
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TablaDatos from '@/Components/TablaDatos.vue';
import { Inertia } from '@inertiajs/inertia';
import { useForm } from '@inertiajs/vue3';
import { computed, ref } from 'vue';

const form = useForm({
    id_reserva: 0,
    localizador: '',
    id_hotel: 0,
    id_tipo_reserva: 0,
    email_cliente: 0,
    fecha_reserva: '',
    fecha_modificacion: '',
    id_destino: 0,
    fecha_entrada: '',
    hora_entrada: '',
    numero_vuelo_entrada: '',
    origen_vuelo_entrada: '',
    hora_vuelo_salida: '',
    fecha_vuelo_salida: '',
    num_viajeros: 0,
    id_vehiculo: 0,
    tipoReserva: '',
    cliente: '',
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

const transformedData = computed(() => {
    return props.transfers.map((transfer) => {
        const hotel = props.hoteles.find(
            (h) => h.id_hotel === transfer.id_hotel,
        );
        const usuario = props.viajeros.find(
            (u) => u.id_viajero === transfer.email_cliente,
        );
        const tipo = props.tipoReservas.find(
            (t) => t.id_tipo_reserva === transfer.id_tipo_reserva,
        );
        let entr = '';
        let sal = '';
        if (tipo?.id_tipo_reserva == 1) {
            entr = `${transfer.fecha_entrada} ${transfer.hora_entrada}`;
            sal = ' ';
        } else {
            entr = ' ';
            sal = `${transfer.fecha_vuelo_salida} ${transfer.hora_vuelo_salida}`;
        }

        return {
            idReserva: transfer.id_reserva,
            localizador: transfer.localizador,
            hotel: hotel
                ? `${transfer.id_hotel} - ${hotel.nombre_hotel}`
                : `${transfer.id_hotel}`,
            tipoReserva: tipo
                ? `${transfer.id_tipo_reserva} - ${tipo.Descripción}`
                : `${transfer.id_tipo_reserva}`,
            cliente: usuario
                ? `${usuario.id_viajero} - ${usuario.email}`
                : `${transfer.email_cliente}`,
            destino: `${transfer.id_destino}`,
            entrada: entr,
            salida: sal,
        };
    });
});

const isTipo = ref(false);
const isCliente = ref(false);

function resetForm() {
    form.id_reserva = 0;
    form.localizador = '';
    form.id_hotel = 0;
    form.id_tipo_reserva = 0;
    form.email_cliente = 0;
    form.fecha_reserva = '';
    form.fecha_modificacion = '';
    form.id_destino = 0;
    form.fecha_entrada = '';
    form.hora_entrada = '';
    form.numero_vuelo_entrada = '';
    form.origen_vuelo_entrada = '';
    form.hora_vuelo_salida = '';
    form.fecha_vuelo_salida = '';
    form.num_viajeros = 0;
    form.id_vehiculo = 0;
}

function comprobarVacio() {
    if (
        form.id_reserva === 0 ||
        form.localizador === '' ||
        form.id_hotel === 0 ||
        form.id_tipo_reserva === 0 ||
        form.email_cliente === 0 ||
        form.fecha_reserva === '' ||
        form.fecha_modificacion === '' ||
        form.id_destino === 0 ||
        // form.fecha_entrada === '' ||
        form.hora_entrada === '' ||
        form.numero_vuelo_entrada === '' ||
        form.origen_vuelo_entrada === '' ||
        // form.hora_vuelo_salida === '' ||
        // form.fecha_vuelo_salida === '' ||
        form.num_viajeros === 0 ||
        form.id_vehiculo === 0
    ) {
        alert('Faltan datos por rellenar');
        return false;
    }
    if (form.id_tipo_reserva === 1) {
        if (form.fecha_entrada === '') {
            alert('Faltan datos por rellenar');
            return false;
        }
    } else {
        if (form.fecha_vuelo_salida === '' || form.hora_vuelo_salida === '') {
            alert('Faltan datos por rellenar');
            return false;
        }
    }
    return true;
}

const headerZona = [
    'Id Reserva',
    'Localizador',
    'Hotel',
    'Tipo Reserva',
    'Cliente',
    'Destino',
    'Entrada',
    'Salida',
];

const handleEdit = (row: any) => {
    const nowMas48 = new Date(Date.now() + 48 * 60 * 60 * 1000);
    const reg = props.transfers.find((t) => t.id_reserva === row.idReserva);
    if (reg?.id_tipo_reserva == 1) {
        isTipo.value = true;
    } else {
        isTipo.value = false;
    }
    if (props.auth.user.rol == 1) {
        isCliente.value = true;
        if (reg?.id_tipo_reserva == 1) {
            isTipo.value = true;
            const fechaHora = `${reg?.fecha_entrada}T${reg?.hora_entrada}`;
            const fechaEntrada = new Date(fechaHora);
            if (fechaEntrada.getTime() >= nowMas48.getTime()) {
                console.log('modificación válida');
            } else {
                alert(
                    'modificación no válida: menos de 48 horas para la reserva.',
                );
                return;
            }
        } else {
            isTipo.value = false;
            const fechaHora = `${reg?.fecha_vuelo_salida}T${reg?.hora_entrada}`;
            const fechaEntrada = new Date(fechaHora);
            if (fechaEntrada.getTime() >= nowMas48.getTime()) {
                console.log('modificación válida');
            } else {
                alert(
                    'modificación no válida: menos de 48 horas para la reserva.',
                );
                return;
            }
        }
    }
    if (reg) {
        editModal(reg, row);
    }
};

const handleDelete = (row: any) => {
    const nowMas48 = new Date(Date.now() + 48 * 60 * 60 * 1000);
    const reg = props.transfers.find((t) => t.id_reserva === row.idReserva);
    form.id_reserva = row.idReserva;
    if (props.auth.user.rol == 1) {
        isCliente.value = true;
        if (reg?.id_tipo_reserva == 1) {
            isTipo.value = true;
            const fechaHora = `${reg?.fecha_entrada}T${reg?.hora_entrada}`;
            const fechaEntrada = new Date(fechaHora);
            if (fechaEntrada.getTime() >= nowMas48.getTime()) {
                form.delete(route('transfer.destroy'), {
                    preserveScroll: true,
                    onSuccess: () => {
                        alert('Transfer eliminado');
                    },
                    onError: (errors) => {
                        console.error(errors);
                    },
                });
            } else {
                alert(
                    'modificación no válida: menos de 48 horas para la reserva.',
                );
            }
        } else {
            isTipo.value = false;
            const fechaHora = `${reg?.fecha_vuelo_salida}T${reg?.hora_entrada}`;
            const fechaEntrada = new Date(fechaHora);
            if (fechaEntrada.getTime() >= nowMas48.getTime()) {
                form.delete(route('transfer.destroy'), {
                    preserveScroll: true,
                    onSuccess: () => {
                        isModalOpen.value = false;
                        resetForm();
                    },
                    onError: (errors) => {
                        console.error(errors);
                    },
                });
            } else {
                alert(
                    'modificación no válida: menos de 48 horas para la reserva.',
                );
            }
        }
    }
};

const addHotelButton = document.getElementById('addHotel');
if (addHotelButton) {
    addHotelButton.addEventListener('click', () => {
        console.log('Add hotel');
    });
}

function editModal(row: any, reg: any) {
    form.id_reserva = row.id_reserva;
    form.id_destino = row.id_destino;
    form.localizador = row.localizador;
    form.id_hotel = row.id_hotel;
    form.id_tipo_reserva = row.id_tipo_reserva;
    form.tipoReserva = reg.tipoReserva;
    form.email_cliente = row.email_cliente;
    form.cliente = reg.cliente;
    form.fecha_entrada = row.fecha_entrada;
    form.fecha_vuelo_salida = row.fecha_vuelo_salida;
    if (row.id_tipo_reserva == 1) {
        form.hora_entrada = row.hora_entrada;
    } else {
        form.hora_entrada = row.hora_vuelo_salida;
    }
    isModalOpen.value = true;
    console.log('Edit modal', row);
}

const isNuevo = ref(false);

const isModalOpen = ref(false);

function addNuevoTransfer() {
    Inertia.visit('/crearTransfer');
}

function comprobarFecha() {
    const ahora = new Date();
    if (isTipo.value) {
        //entrada
        const fechaHoraEntrada = new Date(
            `${form.fecha_entrada}T${form.hora_entrada}`,
        );
        console.log(`Fecha y hora de entrada: ${fechaHoraEntrada}`);
        if (fechaHoraEntrada > ahora) {
            const diferenciaHoras =
                (fechaHoraEntrada.getTime() - ahora.getTime()) /
                (1000 * 60 * 60);

            if (diferenciaHoras >= 1) {
                if (isCliente.value) {
                    if (diferenciaHoras >= 48) {
                        return true;
                    } else {
                        alert('La fecha y hora son demasiado próximas.');
                        return false;
                    }
                }
                return true;
            } else {
                alert('La fecha y hora son demasiado próximas.');
                return false;
            }
        } else {
            alert('La fecha y hora no son válidas.');
            return false;
        }
    } else {
        //salida
        const fechaHoraEntrada = new Date(
            `${form.fecha_vuelo_salida}T${form.hora_entrada}`,
        );
        console.log(`Fecha y hora de entrada: ${fechaHoraEntrada}`);
        if (fechaHoraEntrada > ahora) {
            const diferenciaHoras =
                (fechaHoraEntrada.getTime() - ahora.getTime()) /
                (1000 * 60 * 60);

            if (diferenciaHoras >= 1) {
                if (isCliente.value) {
                    if (diferenciaHoras >= 48) {
                        return true;
                    } else {
                        alert('La fecha y hora son demasiado próximas.');
                        return false;
                    }
                }
                return true;
            } else {
                alert('La fecha y hora son demasiado próximas.');
                return false;
            }
        } else {
            alert('La fecha y hora no son válidas.');
            return false;
        }
    }
}

const confirmar = () => {
    console.log(form.id_hotel);
    if (
        form.id_reserva === 0 ||
        form.localizador === '' ||
        form.email_cliente === 0
    ) {
        return;
    }
    if (!comprobarFecha()) {
        return;
    }
    if (isNuevo.value) {
        alert('No se puede llegar aqui');
    } else {
        form.put(route('transfer.update'), {
            preserveScroll: true,
            onSuccess: () => {
                isModalOpen.value = false;
                resetForm();
            },
            onError: (errors) => {
                console.error(errors);
            },
        });
    }
    isModalOpen.value = false;
    resetForm();
};

const cancelar = () => {
    isModalOpen.value = false;
    resetForm();
};
</script>
<template>
    <div class="flex w-4/6 flex-col bg-gray-100 dark:bg-slate-900">
        <h3 class="px-5 pt-5 text-xl font-semibold dark:text-white">
            Gestión de Transfers
        </h3>
        <PrimaryButton
            class="m-3 mb-5 ms-4 w-52 justify-center"
            :disabled="false"
            id="addHotel"
            @click="addNuevoTransfer()"
        >
            Añadir Nuevo transfer
        </PrimaryButton>
        <div class="flex w-full flex-row overflow-x-scroll">
            <TablaDatos
                :headers="headerZona"
                :data="transformedData"
                :onEdit="handleEdit"
                :onDelete="handleDelete"
            />
        </div>
        <div
            v-if="isModalOpen"
            class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50"
        >
            <div class="rounded bg-white p-6 shadow-md dark:bg-slate-900">
                <h2
                    class="text-xl font-bold text-black dark:text-white"
                    id="titModal"
                >
                    Transfer
                </h2>
                <div
                    class="flex w-full flex-row items-center justify-between gap-6"
                >
                    <div class="mt-4 w-full">
                        <label
                            for="localizador"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300"
                            >Localizador:
                        </label>
                        <input
                            type="text"
                            name="localizador"
                            id="localizador"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-indigo-600 dark:focus:ring-indigo-600"
                            v-model="form.localizador"
                            readonly
                        />
                    </div>
                    <div class="mt-4 w-full">
                        <label
                            for="hotelDest"
                            class="w-full text-xl text-black dark:text-white"
                        >
                            Hotel</label
                        >
                        <select
                            name="hotelDest"
                            id="hotelDest"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-indigo-600 dark:focus:ring-indigo-600"
                            v-model="form.id_hotel"
                        >
                            <option value="">Selecciona un hotel</option>
                            <option
                                v-for="(hotel, index) in hoteles"
                                :key="index"
                                :value="hotel.id_hotel"
                            >
                                {{ hotel.nombre_hotel }}
                            </option>
                        </select>
                    </div>
                    <div class="mt-4 w-full">
                        <label
                            for="tipoReserva"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300"
                            >Tipo Reserva:
                        </label>
                        <!-- v-model="form.emailCond" -->
                        <input
                            type="text"
                            name="tipoReserva"
                            id="tipoReserva"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-indigo-600 dark:focus:ring-indigo-600"
                            v-model="form.tipoReserva"
                            readonly
                        />
                    </div>
                </div>
                <div
                    class="flex w-full flex-row items-center justify-between gap-6"
                >
                    <div class="mt-4 w-full">
                        <label
                            for="cliente"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300"
                            >Viajero:
                        </label>
                        <input
                            type="text"
                            name="cliente"
                            id="cliente"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-indigo-600 dark:focus:ring-indigo-600"
                            v-model="form.cliente"
                            readonly
                        />
                    </div>
                    <div class="mt-4 w-full" v-if="isTipo">
                        <label
                            for="fecha"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300"
                            >Fecha Entrada:
                        </label>
                        <!-- v-model="form.emailCond" -->
                        <input
                            type="date"
                            name="fecha"
                            id="fecha"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-indigo-600 dark:focus:ring-indigo-600"
                            v-model="form.fecha_entrada"
                        />
                    </div>
                    <div class="mt-4 w-full" v-else>
                        <label
                            for="fecha"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300"
                            >Fecha Salida:
                        </label>
                        <!-- v-model="form.emailCond" -->
                        <input
                            type="date"
                            name="fecha"
                            id="fecha"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-indigo-600 dark:focus:ring-indigo-600"
                            v-model="form.fecha_vuelo_salida"
                        />
                    </div>
                    <div class="mt-4 w-full" v-if="isTipo">
                        <label
                            for="hora"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300"
                            >Hora Entrada:
                        </label>
                        <!-- v-model="form.emailCond" -->
                        <input
                            type="time"
                            name="hora"
                            id="hora"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-indigo-600 dark:focus:ring-indigo-600"
                            v-model="form.hora_entrada"
                        />
                    </div>
                    <div class="mt-4 w-full" v-else>
                        <label
                            for="hora"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300"
                            >Hora Salida:
                        </label>
                        <!-- v-model="form.emailCond" -->
                        <input
                            type="time"
                            name="hora"
                            id="hora"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-indigo-600 dark:focus:ring-indigo-600"
                            v-model="form.hora_entrada"
                        />
                    </div>
                </div>
                <div class="flex flex-row items-center justify-center gap-6">
                    <PrimaryButton
                        class="mt-5 w-52 justify-center"
                        :disabled="false"
                        id="addHotel"
                        @click="confirmar()"
                    >
                        Confirmar
                    </PrimaryButton>
                    <PrimaryButton
                        class="mt-5 w-52 justify-center"
                        :disabled="false"
                        id="addHotel"
                        @click="cancelar()"
                    >
                        Cancelar
                    </PrimaryButton>
                </div>
            </div>
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
