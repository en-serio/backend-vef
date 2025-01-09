<script setup lang="ts">
import AeroHotel from '@/Components/AeroHotel.vue';
import HotelAero from '@/Components/HotelAero.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import NavDash from '@/Pages/Dash/NavDash.vue';
import { Inertia } from '@inertiajs/inertia';
import { Head, useForm } from '@inertiajs/vue3';
import { defineProps, ref, watch } from 'vue';

const handle = (link: string) => {
    Inertia.visit(link);
};

interface FormAeroHotel {
    diaLlegada: string;
    horaLlegada: string;
    numeroVuelo: string;
    aeropuertoOrigen: string;
}

interface FormHotelAeropuerto {
    diaVuelo: string;
    horaVuelo: string;
    horaRecogida: string;
    numeroVuelo: string;
}

type Formularios = {
    formAeroHotel: FormAeroHotel;
    formHotelAeropuerto: FormHotelAeropuerto;
};

const form = useForm({
    selectedOption: 0,
    numeroVia: 0,
    hotelDest: 0,
    dirHotel: '',
    nombre: '',
    apellidouno: '',
    apellidodos: '',
    email: '',
    telefono: '',
    direccion: '',
    codigoPostal: '',
    ciudad: '',
    pais: '',
    dni: '',
    diaLlegada: '',
    horaLlegada: '',
    numeroVueloLlegada: '',
    aeropuertoOrigen: '',
    diaVuelo: '',
    horaVuelo: '',
    horaRecogida: '',
    numeroVueloSalida: '',
});

const formHotelAeropuerto = ref<FormHotelAeropuerto>({
    diaVuelo: '',
    horaVuelo: '',
    horaRecogida: '',
    numeroVuelo: '',
});
const formAeroHotel = ref<FormAeroHotel>({
    diaLlegada: '',
    horaLlegada: '',
    numeroVuelo: '',
    aeropuertoOrigen: '',
});

const props = defineProps({
    auth: {
        type: Object,
        required: true,
    },
    usuario: {
        type: Object,
        required: true,
    },
    tipos: {
        type: Array as () => { id_tipo_reserva: number; Descripción: string }[],
        required: true,
    },
    hoteles: {
        type: Array as () => {
            id_hotel: number;
            nombre_hotel: string;
            direccion_hotel: string;
        }[],
        required: true,
    },
});

const isCliente = ref(false);
if (props.auth.user.rol == 3) {
    isCliente.value = true;
}

watch(
    () => form.hotelDest,
    (newVal) => {
        const selectedHotel = props.hoteles.find(
            (hotel) => hotel.id_hotel === newVal,
        );
        form.dirHotel = selectedHotel ? selectedHotel.direccion_hotel : '';
    },
);

const nTipo = ref(0);
const mostrarPrimera = ref(true);
const mostrarSegundaSeccion = ref(false);
const mostrarTercera = ref(false);
const mostrarCuarta = ref(false);
const trayId = ref<string>('tray');
const fechaidaId = ref<string>('fechaida');
const horaidaId = ref<string>('horaida');
const nvueloId = ref<string>('nvuelo');
const aeroId = ref<string>('aero');
const fechavuelId = ref<string>('fechavuel');
const horarecoId = ref<string>('horareco');
const horavuelId = ref<string>('horavuel');
const nvuelovueltaId = ref<string>('nvuelovuelta');
const nviajeroId = ref<string>('nviajero');
const nomhotelId = ref<string>('nomhotel');
const direcchotelId = ref<string>('direcchotel');
const nombreviaId = ref<string>('nombrevia');
const apelluviaId = ref<string>('apelluvia');
const apelldviaId = ref<string>('apelldvia');
const emailviaId = ref<string>('emailvia');
const telviaId = ref<string>('telvia');
const dniviaId = ref<string>('dnivia');

function nextTipo() {
    nTipo.value = form.selectedOption ? form.selectedOption : 0;
    if (nTipo.value === 0) {
        alert('Selecciona un tipo de trayecto');
    } else {
        console.log('Tipo seleccionado: ' + nTipo.value);
        mostrarSegundaSeccion.value = true;
        mostrarPrimera.value = false;
    }
}

function transSig() {
    let camposInvalidos = [];
    if (nTipo.value === 1) {
        camposInvalidos = validarCampos(formAeroHotel.value);
    } else if (nTipo.value === 2) {
        camposInvalidos = validarCampos(formHotelAeropuerto.value);
    } else if (nTipo.value === 3) {
        camposInvalidos = [
            ...validarCampos(formAeroHotel.value),
            ...validarCampos(formHotelAeropuerto.value),
        ];
    } else {
        alert('Tipo de trayecto no disponible');
        return;
    }
    const errores = validarFechas(
        formAeroHotel.value,
        formHotelAeropuerto.value,
        nTipo.value,
    );
    if (errores.length > 0) {
        alert('Errores encontrados:\n' + errores.join('\n'));
        return;
    }

    if (camposInvalidos.length > 0) {
        alert(`Por favor, completa todos los campos`); //aqui habia pensado en poner los nombres pero son muchos
        return;
    }
    mostrarTercera.value = true;
    console.log(props.auth);
    console.log(isCliente.value);
    if (isCliente.value) {
        console.log(props.auth);
        // form.nombre = props.auth.user.name;
        // form.apellidouno = props.auth.user.apellido1;
        // form.apellidodos = props.auth.user.apellido2;
        // form.email = props.auth.user.email;
        // form.telefono = props.auth.user.telefono;
        // form.dni = props.auth.user.dni;
    }
    mostrarSegundaSeccion.value = false;
}

function validarCampos<T extends Record<string, any>>(formulario: T): string[] {
    const camposFaltantes: string[] = [];
    for (const campo in formulario) {
        if (!formulario[campo]) {
            camposFaltantes.push(campo);
        }
    }
    return camposFaltantes;
}
function validarFechas(
    formAeroHotel: FormAeroHotel,
    formHotelAeropuerto: FormHotelAeropuerto,
    tipo: number,
): string[] {
    const errores: string[] = [];
    const fechaActual = new Date();
    const limiteCliente = new Date(fechaActual.getTime() + 48 * 60 * 60 * 1000);

    if (tipo === 1 || tipo === 3) {
        const diaLlegada = new Date(formAeroHotel.diaLlegada);
        if (isNaN(diaLlegada.getTime())) {
            errores.push('La fecha de llegada no es válida.');
        } else if (diaLlegada < fechaActual) {
            errores.push(
                'La fecha de llegada debe ser posterior a la fecha actual.',
            );
        }
        if (isCliente.value && diaLlegada < limiteCliente) {
            errores.push(
                'Los clientes no pueden crear reservas con menos de 48 horas de antelación.',
            );
        }
    }

    if (tipo === 2 || tipo === 3) {
        const diaVuelo = new Date(formHotelAeropuerto.diaVuelo);
        if (isNaN(diaVuelo.getTime())) {
            errores.push('La fecha de vuelo no es válida.');
        } else if (diaVuelo < fechaActual) {
            errores.push(
                'La fecha de vuelo debe ser posterior a la fecha actual.',
            );
        }
        if (isCliente.value && diaVuelo < limiteCliente) {
            errores.push(
                'Los clientes no pueden crear reservas con menos de 48 horas de antelación.',
            );
        }
    }

    if (tipo === 3) {
        const diaLlegada = new Date(formAeroHotel.diaLlegada);
        const diaVuelo = new Date(formHotelAeropuerto.diaVuelo);
        if (
            !isNaN(diaLlegada.getTime()) &&
            !isNaN(diaVuelo.getTime()) &&
            diaVuelo < diaLlegada
        ) {
            errores.push(
                'La fecha de vuelta no puede ser anterior a la fecha de ida.',
            );
        }
    }
    return errores;
}

function datosSig() {
    const errores = validarCamposDatos();

    if (errores.length > 0) {
        alert('Errores encontrados:\n' + errores.join('\n'));
        return;
    }
    trayId.value =
        props.tipos.find((tipo) => tipo.id_tipo_reserva === nTipo.value)
            ?.Descripción ?? '';
    fechaidaId.value = formAeroHotel.value.diaLlegada;
    horaidaId.value = formAeroHotel.value.horaLlegada;
    nvueloId.value = formAeroHotel.value.numeroVuelo;
    aeroId.value = formAeroHotel.value.aeropuertoOrigen;
    fechavuelId.value = formHotelAeropuerto.value.diaVuelo;
    horarecoId.value = formHotelAeropuerto.value.horaRecogida;
    horavuelId.value = formHotelAeropuerto.value.horaVuelo;
    nvuelovueltaId.value = formHotelAeropuerto.value.numeroVuelo;
    nviajeroId.value = form.numeroVia.toString();
    nomhotelId.value =
        props.hoteles.find((hotel) => hotel.id_hotel === form.hotelDest)
            ?.nombre_hotel ?? '';
    direcchotelId.value = form.dirHotel;
    nombreviaId.value = form.nombre;
    apelluviaId.value = form.apellidouno;
    apelldviaId.value = form.apellidodos;
    emailviaId.value = form.email;
    telviaId.value = form.telefono;
    dniviaId.value = form.dni;
    mostrarCuarta.value = true;
    mostrarTercera.value = false;
}

function validarCamposDatos(): string[] {
    const errores: string[] = [];
    if (form.numeroVia <= 0) {
        errores.push('El número de viajeros debe ser mayor a 0.');
    }
    if (form.hotelDest <= 0) {
        errores.push('Debes seleccionar un hotel de destino.');
    }
    if (!form.dirHotel.trim()) {
        errores.push('La dirección del hotel no puede estar vacía.');
    }
    if (!form.nombre.trim()) {
        errores.push('El nombre no puede estar vacío.');
    }
    if (!form.apellidouno.trim()) {
        errores.push('El primer apellido no puede estar vacío.');
    }
    if (!form.apellidodos.trim()) {
        errores.push('El segundo apellido no puede estar vacío.');
    }
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!form.email.trim() || !emailRegex.test(form.email)) {
        errores.push('Debes proporcionar un correo electrónico válido.');
    }
    const telefonoRegex = /^[0-9]{9}$/;
    if (!telefonoRegex.test(form.telefono)) {
        errores.push('El número de teléfono debe tener 9 dígitos.');
    }
    const dniRegex = /^[0-9]{8}[A-Za-z]$/;
    if (!dniRegex.test(form.dni)) {
        errores.push('El DNI debe tener 8 dígitos seguidos de una letra.');
    }
    const cPostalR = /^[0-9]{5}$/;
    if (!cPostalR.test(form.codigoPostal)) {
        errores.push('El código postal debe tener 5 dígitos.');
    }
    if (!form.direccion.trim()) {
        errores.push('La dirección no puede estar vacía.');
    }
    if (!form.ciudad.trim()) {
        errores.push('La ciudad no puede estar vacía.');
    }
    if (!form.pais.trim()) {
        errores.push('El país no puede estar vacío.');
    }
    return errores;
}

function antTrans() {
    form.numeroVia = 0;
    form.hotelDest = 0;
    form.dirHotel = '';
    form.nombre = '';
    form.apellidouno = '';
    form.apellidodos = '';
    form.email = '';
    form.telefono = '';
    form.dni = '';
    mostrarTercera.value = false;
    mostrarSegundaSeccion.value = true;
}

function antTipo() {
    formHotelAeropuerto.value.diaVuelo = '';
    formHotelAeropuerto.value.horaVuelo = '';
    formHotelAeropuerto.value.horaRecogida = '';
    formHotelAeropuerto.value.numeroVuelo = '';
    formAeroHotel.value.diaLlegada = '';
    formAeroHotel.value.horaLlegada = '';
    formAeroHotel.value.numeroVuelo = '';
    formAeroHotel.value.aeropuertoOrigen = '';
    mostrarPrimera.value = true;
    mostrarSegundaSeccion.value = false;
}

function antDatos() {
    trayId.value = '';
    fechaidaId.value = '';
    horaidaId.value = '';
    nvueloId.value = '';
    aeroId.value = '';
    fechavuelId.value = '';
    horarecoId.value = '';
    horavuelId.value = '';
    nvuelovueltaId.value = '';
    nviajeroId.value = '';
    nomhotelId.value = '';
    direcchotelId.value = '';
    nombreviaId.value = '';
    apelluviaId.value = '';
    apelldviaId.value = '';
    emailviaId.value = '';
    telviaId.value = '';
    dniviaId.value = '';
    mostrarTercera.value = true;
    mostrarCuarta.value = false;
}

function confirmar() {
    form.diaLlegada = formAeroHotel.value.diaLlegada;
    form.horaLlegada = formAeroHotel.value.horaLlegada;
    form.numeroVueloLlegada = formAeroHotel.value.numeroVuelo;
    form.aeropuertoOrigen = formAeroHotel.value.aeropuertoOrigen;
    form.diaVuelo = formHotelAeropuerto.value.diaVuelo;
    form.horaVuelo = formHotelAeropuerto.value.horaVuelo;
    form.horaRecogida = formHotelAeropuerto.value.horaRecogida;
    form.numeroVueloSalida = formHotelAeropuerto.value.numeroVuelo;

    form.post(route('transfer.store'), {
        preserveScroll: true,
        onError: (errors) => {
            console.error('Errores al enviar el formulario:', errors);
        },
    });
}
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
            class="flex flex-col items-center justify-center bg-white py-6 pt-10 dark:bg-slate-800"
        >
            <section
                class="flex w-full flex-col items-center justify-center rounded-lg bg-gray-100 shadow-2xl xl:w-2/4 dark:bg-gray-900"
            >
                <h1
                    class="my-2 py-5 text-3xl font-bold text-black dark:text-white"
                >
                    Crear Transfer
                </h1>
                <form
                    action=""
                    class="flex w-full flex-col items-center justify-center"
                >
                    <!-- PRIMERA PARTE -->
                    <article
                        :class="{ hidden: !mostrarPrimera }"
                        class="flex w-full flex-col items-center justify-center bg-gray-200 shadow-md dark:bg-slate-800"
                    >
                        <h2
                            class="py-4 pb-2 text-xl font-bold text-black dark:text-white"
                            id="titModal"
                        >
                            Paso 1
                        </h2>
                        <p class="pb-6 text-black dark:text-white">
                            Selecciona el tipo de trayecto que quieres reservar.
                        </p>
                        <div
                            class="flex flex-col items-start justify-start gap-2 py-2 text-black xl:w-1/6 dark:text-white"
                        >
                            <div v-for="(tipo, key) in tipos" :key="key">
                                <label :for="`tipo-${tipo.id_tipo_reserva}`">
                                    <input
                                        type="radio"
                                        :id="`tipo-${tipo.id_tipo_reserva}`"
                                        name="tipo"
                                        :value="tipo.id_tipo_reserva"
                                        v-model="form.selectedOption"
                                        class="h-4 w-4 border-gray-600 bg-gray-700 text-gray-800 focus:outline-none focus:ring-1 focus:ring-gray-500 focus:ring-opacity-20 dark:border-gray-200 dark:bg-gray-300 dark:text-gray-600 focus:dark:ring-gray-100"
                                    />
                                    {{ tipo.Descripción }}
                                </label>
                            </div>
                        </div>
                        <div class="flex w-full flex-row">
                            <button
                                type="button"
                                class="m-4 ml-auto mr-6 self-end rounded-xl bg-white p-3 text-black hover:bg-gray-200 dark:bg-slate-700 dark:text-white dark:hover:bg-gray-900"
                                @click="nextTipo()"
                            >
                                Siguiente
                            </button>
                        </div>
                    </article>
                    <!-- SEGUNDA PARTE -->
                    <article
                        :class="{ hidden: !mostrarSegundaSeccion }"
                        id="segunda"
                        class="flex w-full flex-col items-center justify-center bg-gray-200 shadow-md dark:bg-slate-800"
                    >
                        <h2
                            class="py-4 pb-2 text-xl font-bold text-black dark:text-white"
                            id="titModal"
                        >
                            Paso 2
                        </h2>
                        <p class="pb-6 text-black dark:text-white">
                            Introduce la información respectiva al trayecto
                        </p>
                        <div
                            v-if="nTipo === 1"
                            class="flex w-3/4 flex-col items-center justify-between gap-2 py-2"
                        >
                            <p
                                class="self-center text-xl text-black dark:text-white"
                            >
                                {{
                                    props.tipos.find(
                                        (tipo) => tipo.id_tipo_reserva === 1,
                                    )?.Descripción
                                }}
                            </p>
                            <AeroHotel v-model="formAeroHotel" />
                        </div>
                        <div
                            v-else-if="nTipo === 2"
                            class="flex w-3/4 flex-col items-center justify-between gap-2 py-2"
                        >
                            <p
                                class="self-center text-xl text-black dark:text-white"
                            >
                                {{
                                    props.tipos.find(
                                        (tipo) => tipo.id_tipo_reserva === 2,
                                    )?.Descripción
                                }}
                            </p>
                            <HotelAero v-model="formHotelAeropuerto" />
                        </div>
                        <div
                            v-else-if="nTipo === 3"
                            class="flex w-3/4 flex-col items-center justify-between gap-2 py-2"
                        >
                            <p
                                class="self-center text-xl text-black dark:text-white"
                            >
                                {{
                                    props.tipos.find(
                                        (tipo) => tipo.id_tipo_reserva === 3,
                                    )?.Descripción
                                }}
                            </p>
                            <AeroHotel v-model="formAeroHotel" />
                            <HotelAero v-model="formHotelAeropuerto" />
                        </div>
                        <div
                            v-else
                            class="flex flex-col items-start justify-start gap-2 py-2"
                        >
                            <p class="self-center">
                                {{
                                    props.tipos.find(
                                        (tipo) =>
                                            tipo.id_tipo_reserva === nTipo,
                                    )?.Descripción
                                }}
                            </p>
                            <p>Lo sentimos, aun no está disponible</p>
                        </div>
                        <div class="flex w-full flex-row">
                            <button
                                type="button"
                                class="m-4 ml-6 mr-auto self-end rounded-xl bg-white p-3 text-black hover:bg-gray-200 dark:bg-slate-700 dark:text-white dark:hover:bg-gray-900"
                                @click="antTipo()"
                            >
                                Anterior
                            </button>
                            <button
                                type="button"
                                class="m-4 ml-auto mr-6 self-end rounded-xl bg-white p-3 text-black hover:bg-gray-200 dark:bg-slate-700 dark:text-white dark:hover:bg-gray-900"
                                @click="transSig()"
                            >
                                Siguiente
                            </button>
                        </div>
                    </article>
                    <!--  Dia llegada,  hora llegada,  número vuelo,  aeropuerto origen  -->
                    <!--  Dia vuelo,    hora vuelo,    número vuelo,  hora recogida  -->
                    <article
                        :class="{ hidden: !mostrarTercera }"
                        class="flex w-full flex-col items-center justify-center bg-gray-200 shadow-md dark:bg-slate-800"
                    >
                        <h2
                            class="py-4 pb-2 text-xl font-bold text-black dark:text-white"
                            id="titModal"
                        >
                            Paso 3
                        </h2>
                        <p class="pb-6 text-black dark:text-white">
                            Introduce la información adicional para el trayecto
                            y los datos personales
                        </p>
                        <div
                            class="flex w-full flex-col items-center justify-center bg-gray-200 shadow-md dark:bg-slate-800"
                        >
                            <div
                                class="flex w-3/4 flex-col items-center justify-between gap-2 py-2"
                            >
                                <h2
                                    class="self-center text-xl text-black dark:text-white"
                                >
                                    Transfer del hotel al aeropuerto
                                </h2>
                                <div
                                    class="flex w-full flex-row items-center justify-between gap-7"
                                >
                                    <div
                                        class="flex w-full flex-col items-center justify-between gap-2"
                                    >
                                        <label
                                            for="numeroVia"
                                            class="w-full text-xl text-black dark:text-white"
                                            >Número de Viajeros</label
                                        >
                                        <input
                                            type="number"
                                            id="numeroVia"
                                            class="w-full rounded-xl bg-white text-black dark:bg-slate-700 dark:text-white"
                                            v-model="form.numeroVia"
                                        />
                                    </div>
                                    <div
                                        class="flex w-full flex-col items-center justify-between gap-2"
                                    >
                                        <label
                                            for="hotelDest"
                                            class="w-full text-xl text-black dark:text-white"
                                        >
                                            Hotel destino/recogida</label
                                        >
                                        <select
                                            name="hotelDest"
                                            id="hotelDest"
                                            class="w-full rounded-xl bg-white text-black dark:bg-slate-700 dark:text-white"
                                            v-model="form.hotelDest"
                                        >
                                            <option value="">
                                                Selecciona un hotel
                                            </option>
                                            <option
                                                v-for="(
                                                    hotel, index
                                                ) in hoteles"
                                                :key="index"
                                                :value="hotel.id_hotel"
                                            >
                                                {{ hotel.nombre_hotel }}
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div
                                    class="flex w-full flex-row items-center justify-between gap-7"
                                >
                                    <div
                                        class="flex w-full flex-col items-center justify-between gap-2"
                                    >
                                        <label
                                            class="w-full text-xl text-black dark:text-white"
                                            >Dirección hotel</label
                                        >
                                        <input
                                            type="text"
                                            id="dirHotel"
                                            class="w-full rounded-xl bg-white text-black dark:bg-slate-700 dark:text-white"
                                            readonly
                                            v-model="form.dirHotel"
                                        />
                                    </div>
                                </div>
                            </div>
                            <div
                                class="mb-6 flex w-3/4 flex-col items-center justify-between gap-2 py-2"
                            >
                                <h2 class="text-lg text-black dark:text-white">
                                    Datos personales
                                </h2>
                                <div
                                    class="flex w-full flex-row items-center justify-between gap-7"
                                >
                                    <div
                                        class="flex w-full flex-col items-center justify-between gap-2"
                                    >
                                        <label
                                            for="nombre"
                                            class="w-full text-xl text-black dark:text-white"
                                            >Nombre</label
                                        >
                                        <input
                                            type="text"
                                            id="nombre"
                                            class="w-full rounded-xl bg-white text-black dark:bg-slate-700 dark:text-white"
                                            v-model="form.nombre"
                                            v-bind:readonly="isCliente"
                                        />
                                    </div>
                                    <div
                                        class="flex w-full flex-col items-center justify-between gap-2"
                                    >
                                        <label
                                            for="apellido1"
                                            class="w-full text-xl text-black dark:text-white"
                                            >Apellido 1</label
                                        >
                                        <input
                                            type="text"
                                            id="apellido1"
                                            class="w-full rounded-xl bg-white text-black dark:bg-slate-700 dark:text-white"
                                            v-model="form.apellidouno"
                                            v-bind:readonly="isCliente"
                                        />
                                    </div>
                                </div>
                                <div
                                    class="flex w-full flex-row items-center justify-between gap-7"
                                >
                                    <div
                                        class="flex w-full flex-col items-center justify-between gap-2"
                                    >
                                        <label
                                            for="apellido2"
                                            class="w-full text-xl text-black dark:text-white"
                                            >Apellido 2</label
                                        >
                                        <input
                                            type="text"
                                            id="apellido2"
                                            class="w-full rounded-xl bg-white text-black dark:bg-slate-700 dark:text-white"
                                            v-model="form.apellidodos"
                                            v-bind:readonly="isCliente"
                                        />
                                    </div>
                                    <div
                                        class="flex w-full flex-col items-center justify-between gap-2"
                                    >
                                        <label
                                            for="email"
                                            class="w-full text-xl text-black dark:text-white"
                                            >Email</label
                                        >
                                        <input
                                            type="email"
                                            id="email"
                                            class="w-full rounded-xl bg-white text-black dark:bg-slate-700 dark:text-white"
                                            v-model="form.email"
                                            v-bind:readonly="isCliente"
                                        />
                                    </div>
                                </div>
                                <div
                                    class="flex w-full flex-row items-center justify-between gap-7"
                                >
                                    <div
                                        class="flex w-full flex-col items-center justify-between gap-2"
                                    >
                                        <label
                                            for="telefono"
                                            class="w-full text-xl text-black dark:text-white"
                                            >Teléfono</label
                                        >
                                        <input
                                            type="number"
                                            id="telefono"
                                            class="w-full rounded-xl bg-white text-black dark:bg-slate-700 dark:text-white"
                                            v-model="form.telefono"
                                        />
                                    </div>
                                    <div
                                        class="flex w-full flex-col items-center justify-between gap-2"
                                    >
                                        <label
                                            for="dni"
                                            class="w-full text-xl text-black dark:text-white"
                                            >DNI/Pasaporte</label
                                        >
                                        <input
                                            type="text"
                                            id="dni"
                                            class="w-full rounded-xl bg-white text-black dark:bg-slate-700 dark:text-white"
                                            v-model="form.dni"
                                        />
                                    </div>
                                </div>
                                <div
                                    class="flex w-full flex-row items-center justify-between gap-7"
                                >
                                    <div
                                        class="flex w-full flex-col items-center justify-between gap-2"
                                    >
                                        <label
                                            for="direccion"
                                            class="w-full text-xl text-black dark:text-white"
                                            >Dirección</label
                                        >
                                        <input
                                            type="text"
                                            id="direccion"
                                            class="w-full rounded-xl bg-white text-black dark:bg-slate-700 dark:text-white"
                                            v-model="form.direccion"
                                        />
                                    </div>
                                    <div
                                        class="flex w-full flex-col items-center justify-between gap-2"
                                    >
                                        <label
                                            for="codigoPostal"
                                            class="w-full text-xl text-black dark:text-white"
                                            >Codigo Postal</label
                                        >
                                        <input
                                            type="text"
                                            id="codigoPostal"
                                            class="w-full rounded-xl bg-white text-black dark:bg-slate-700 dark:text-white"
                                            v-model="form.codigoPostal"
                                        />
                                    </div>
                                </div>
                                <div
                                    class="flex w-full flex-row items-center justify-between gap-7"
                                >
                                    <div
                                        class="flex w-full flex-col items-center justify-between gap-2"
                                    >
                                        <label
                                            for="ciudad"
                                            class="w-full text-xl text-black dark:text-white"
                                            >Ciudad</label
                                        >
                                        <input
                                            type="text"
                                            id="ciudad"
                                            class="w-full rounded-xl bg-white text-black dark:bg-slate-700 dark:text-white"
                                            v-model="form.ciudad"
                                        />
                                    </div>
                                    <div
                                        class="flex w-full flex-col items-center justify-between gap-2"
                                    >
                                        <label
                                            for="pais"
                                            class="w-full text-xl text-black dark:text-white"
                                            >Pais</label
                                        >
                                        <input
                                            type="text"
                                            id="pais"
                                            class="w-full rounded-xl bg-white text-black dark:bg-slate-700 dark:text-white"
                                            v-model="form.pais"
                                        />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex w-full flex-row">
                            <button
                                type="button"
                                class="m-4 ml-6 mr-auto self-end rounded-xl bg-white p-3 text-black hover:bg-gray-200 dark:bg-slate-700 dark:text-white dark:hover:bg-gray-900"
                                @click="antTrans()"
                            >
                                Anterior
                            </button>
                            <button
                                type="button"
                                class="m-4 ml-auto mr-6 self-end rounded-xl bg-white p-3 text-black hover:bg-gray-200 dark:bg-slate-700 dark:text-white dark:hover:bg-gray-900"
                                @click="datosSig()"
                            >
                                Siguiente
                            </button>
                        </div>
                    </article>
                    <article
                        :class="{ hidden: !mostrarCuarta }"
                        class="flex w-full flex-col items-center justify-center bg-gray-200 shadow-md dark:bg-slate-800"
                    >
                        <h2
                            class="py-4 pb-2 text-xl font-bold text-black dark:text-white"
                            id="titModal"
                        >
                            Paso 4
                        </h2>
                        <p class="pb-6 text-black dark:text-white">
                            Revise los datos y confirme su reserva.
                        </p>
                        <div
                            class="flex w-full flex-col items-center justify-center bg-gray-200 shadow-md dark:bg-slate-800"
                        >
                            <div
                                class="flex w-3/4 flex-col items-center justify-between gap-2 py-2"
                            >
                                <h2
                                    class="self-center text-xl text-black dark:text-white"
                                >
                                    Resumen de la Reserva
                                </h2>
                                <div
                                    class="flex w-full flex-row items-center justify-between gap-7"
                                >
                                    <div
                                        class="flex w-full flex-col items-center justify-between gap-1 text-xl text-black dark:text-gray-300"
                                    >
                                        <span class="font-bold">Trayecto: </span
                                        ><span :id="trayId">{{ trayId }}</span>
                                    </div>
                                    <div
                                        class="flex w-full flex-col items-center justify-between gap-1 text-xl text-black dark:text-gray-300"
                                    >
                                        <span class="font-bold"
                                            >Número viajeros: </span
                                        ><span :id="nviajeroId">{{
                                            nviajeroId
                                        }}</span>
                                    </div>
                                </div>
                                <div
                                    class="flex w-full flex-row items-center justify-between gap-7"
                                    v-if="nTipo === 1 || nTipo === 3"
                                >
                                    <div
                                        class="flex w-full flex-col items-center justify-between gap-1 text-xl text-black dark:text-gray-300"
                                    >
                                        <span class="font-bold"
                                            >Fecha Ida: </span
                                        ><span :id="fechaidaId">{{
                                            fechaidaId
                                        }}</span>
                                    </div>
                                    <div
                                        class="flex w-full flex-col items-center justify-between gap-1 text-xl text-black dark:text-gray-300"
                                    >
                                        <span class="font-bold">Hora Ida: </span
                                        ><span :id="horaidaId">{{
                                            horaidaId
                                        }}</span>
                                    </div>
                                </div>
                                <div
                                    class="flex w-full flex-row items-center justify-between gap-7"
                                    v-if="nTipo === 1 || nTipo === 3"
                                >
                                    <div
                                        class="flex w-full flex-col items-center justify-between gap-1 text-xl text-black dark:text-gray-300"
                                    >
                                        <span class="font-bold"
                                            >Número de vuelo: </span
                                        ><span :id="nvueloId">{{
                                            nvueloId
                                        }}</span>
                                    </div>
                                    <div
                                        class="flex w-full flex-col items-center justify-between gap-1 text-xl text-black dark:text-gray-300"
                                    >
                                        <span class="font-bold"
                                            >Aeropuerto: </span
                                        ><span :id="aeroId">{{ aeroId }}</span>
                                    </div>
                                </div>
                                <div
                                    class="flex w-full flex-row items-center justify-between gap-7"
                                    v-if="nTipo === 2 || nTipo === 3"
                                >
                                    <div
                                        class="flex w-full flex-col items-center justify-between gap-1 text-xl text-black dark:text-gray-300"
                                    >
                                        <span class="font-bold"
                                            >Fecha vuelta: </span
                                        ><span :id="fechavuelId">{{
                                            fechavuelId
                                        }}</span>
                                    </div>
                                    <div
                                        class="flex w-full flex-col items-center justify-between gap-1 text-xl text-black dark:text-gray-300"
                                    >
                                        <span class="font-bold"
                                            >Hora recogida: </span
                                        ><span :id="horarecoId">{{
                                            horarecoId
                                        }}</span>
                                    </div>
                                </div>
                                <div
                                    class="flex w-full flex-row items-center justify-between gap-7"
                                    v-if="nTipo === 2 || nTipo === 3"
                                >
                                    <div
                                        class="flex w-full flex-col items-center justify-between gap-1 text-xl text-black dark:text-gray-300"
                                    >
                                        <span class="font-bold"
                                            >Hora del vuelo: </span
                                        ><span :id="horavuelId">{{
                                            horavuelId
                                        }}</span>
                                    </div>
                                    <div
                                        class="flex w-full flex-col items-center justify-between gap-1 text-xl text-black dark:text-gray-300"
                                    >
                                        <span class="font-bold"
                                            >Número vuelo vuelta: </span
                                        ><span :id="nvuelovueltaId">{{
                                            nvuelovueltaId
                                        }}</span>
                                    </div>
                                </div>
                                <div
                                    class="flex w-full flex-row items-center justify-between gap-7"
                                >
                                    <div
                                        class="flex w-full flex-col items-center justify-between gap-1 text-xl text-black dark:text-gray-300"
                                    >
                                        <span class="font-bold">Hotel: </span
                                        ><span :id="nomhotelId">{{
                                            nomhotelId
                                        }}</span>
                                    </div>
                                    <div
                                        class="flex w-full flex-col items-center justify-between gap-1 text-xl text-black dark:text-gray-300"
                                    >
                                        <span class="font-bold"
                                            >Dirección: </span
                                        ><span :id="direcchotelId">{{
                                            direcchotelId
                                        }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div
                            class="flex w-full flex-col items-center justify-center bg-gray-200 pb-6 shadow-md dark:bg-slate-800"
                        >
                            <div
                                class="flex w-3/4 flex-col items-center justify-between gap-2 py-2"
                            >
                                <h2
                                    class="self-center text-xl text-black dark:text-white"
                                >
                                    Datos personales
                                </h2>
                                <div
                                    class="flex w-full flex-row items-center justify-between gap-7"
                                >
                                    <div
                                        class="flex w-full flex-col items-center justify-between gap-1 text-xl text-black dark:text-gray-300"
                                    >
                                        <span class="font-bold">Nombre: </span
                                        ><span :id="nombreviaId">{{
                                            nombreviaId
                                        }}</span>
                                    </div>
                                    <div
                                        class="flex w-full flex-col items-center justify-between gap-1 text-xl text-black dark:text-gray-300"
                                    >
                                        <span class="font-bold"
                                            >Apellido 1: </span
                                        ><span :id="apelluviaId">{{
                                            apelluviaId
                                        }}</span>
                                    </div>
                                </div>
                                <div
                                    class="flex w-full flex-row items-center justify-between gap-7"
                                >
                                    <div
                                        class="flex w-full flex-col items-center justify-between gap-1 text-xl text-black dark:text-gray-300"
                                    >
                                        <span class="font-bold"
                                            >Apellido 2: </span
                                        ><span :id="apelldviaId">{{
                                            apelldviaId
                                        }}</span>
                                    </div>
                                    <div
                                        class="flex w-full flex-col items-center justify-between gap-1 text-xl text-black dark:text-gray-300"
                                    >
                                        <span class="font-bold">Email: </span
                                        ><span :id="emailviaId">{{
                                            emailviaId
                                        }}</span>
                                    </div>
                                </div>
                                <div
                                    class="flex w-full flex-row items-center justify-between gap-7"
                                >
                                    <div
                                        class="flex w-full flex-col items-center justify-between gap-1 text-xl text-black dark:text-gray-300"
                                    >
                                        <span class="font-bold">Teléfono: </span
                                        ><span :id="telviaId">{{
                                            telviaId
                                        }}</span>
                                    </div>
                                    <div
                                        class="flex w-full flex-col items-center justify-between gap-1 text-xl text-black dark:text-gray-300"
                                    >
                                        <span class="font-bold"
                                            >DNI/Pasaporte: </span
                                        ><span :id="dniviaId">{{
                                            dniviaId
                                        }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex w-full flex-row">
                            <button
                                type="button"
                                class="m-4 ml-6 mr-auto self-end rounded-xl bg-white p-3 text-black hover:bg-gray-200 dark:bg-slate-700 dark:text-white dark:hover:bg-gray-900"
                                @click="antDatos()"
                            >
                                Anterior
                            </button>
                            <button
                                type="button"
                                class="m-4 ml-auto mr-6 self-end rounded-xl bg-white p-3 text-black hover:bg-gray-200 dark:bg-slate-700 dark:text-white dark:hover:bg-gray-900"
                                @click="confirmar()"
                            >
                                Confirmar
                            </button>
                        </div>
                    </article>
                </form>
            </section>
        </main>
    </AuthenticatedLayout>
</template>
<style lang="css" scoped>
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
