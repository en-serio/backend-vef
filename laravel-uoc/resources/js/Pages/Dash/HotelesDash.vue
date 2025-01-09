<script setup lang="ts">
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TablaDatos from '@/Components/TablaDatos.vue';
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
    rol: {
        type: String,
        required: true,
    },
});

const header = [
    'Hotel ID',
    'Zona',
    'Comision',
    'Usuario',
    'Nombre',
    'Direccion Hotel',
];

function resetForm() {
    form.idhotel = 0;
    form.idzona = 0;
    form.comision = '';
    form.idusuario = 0;
    form.hotelname = '';
    form.dirhotel = '';
}

function comprobarVacio() {
    if (
        form.idzona === 0 ||
        form.comision === '' ||
        form.idusuario === 0 ||
        form.hotelname === '' ||
        form.dirhotel === ''
    ) {
        alert('Faltan datos por rellenar');
        return false;
    }
    return true;
}

const handleEdit = (row: any) => {
    isNuevo.value = false;
    editModal(row);
};

const handleDelete = (row: any) => {
    form.idhotel = row.id_hotel;
    form.delete(route('hoteles.destroy'), {
        preserveScroll: true,
        onSuccess: () => {
            console.log('Deleted');
        },
        onError: (errors) => {
            console.error(errors);
        },
    });
};

function editModal(row: any) {
    form.idhotel = row.id_hotel;
    let as = row.zona.split(' ');
    let idz = props.zonas.find((z) => z.id_zona === Number(as[0]));
    if (idz) {
        form.idzona = idz.id_zona;
    } else {
        form.idzona = 0;
    }
    form.comision = row.Comision;
    let us = row.usuario.split(' ');
    let idu = props.usuarios.find((u) => u.id === Number(us[0]));
    if (idu) {
        form.idusuario = idu.id;
    } else {
        form.idusuario = 0;
    }
    form.hotelname = row.nombre_hotel;
    form.dirhotel = row.direccion_hotel;
    isModalOpen.value = true;
}

const isModalOpen = ref(false);

const isNuevo = ref(false);

const nuevoModal = () => {
    isNuevo.value = true;
    form.idhotel = 0;
    resetForm();
    isModalOpen.value = true;
};

const confirmar = () => {
    if (!comprobarVacio()) {
        return;
    }
    if (props.rol == '1') {
        postAdmin();
    } else {
        postCorpo();
    }
    isModalOpen.value = false;
    resetForm();
};

function postAdmin() {
    if (isNuevo.value) {
        form.post(route('hoteles.store'), {
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
        form.put(route('hoteles.update'), {
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
}

function postCorpo() {
    console.log('corpo');
    if (isNuevo.value) {
        form.post(route('hotelesuser.store'), {
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
        form.put(route('hotelesuser.update'), {
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
}

const transHotel = computed(() => {
    return props.hoteles.map((hotel) => {
        const zona = props.zonas.find((zona) => zona.id_zona === hotel.id_zona);
        const usuario = props.usuarios.find(
            (usuario) => usuario.id === hotel.usuario,
        );
        return {
            id_hotel: hotel.id_hotel,
            zona: zona
                ? `${hotel.id_zona} - ${zona.descripcion}`
                : `${hotel.id_zona}`,
            Comision: hotel.Comision,
            usuario: usuario
                ? `${hotel.usuario} -  ${usuario.name}`
                : `${hotel.usuario}`,
            nombre_hotel: hotel.nombre_hotel,
            direccion_hotel: hotel.direccion_hotel,
        };
    });
});

const cancelar = () => {
    isModalOpen.value = false;
    resetForm();
};
</script>
<template>
    <div class="flex w-4/6 flex-col bg-gray-100 dark:bg-slate-900">
        <h3 class="w-full px-5 pt-5 text-xl font-semibold dark:text-white">
            Gestión de Hoteles
        </h3>
        <PrimaryButton
            class="m-3 mb-5 ms-4 w-52 justify-center"
            :disabled="false"
            id="addHotel"
            @click="nuevoModal"
        >
            Añadir nuevo hotel
        </PrimaryButton>
        <div class="flex w-full flex-row overflow-x-scroll">
            <TablaDatos
                :headers="header"
                :data="transHotel"
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
                    Hotel
                </h2>
                <div class="flex flex-row justify-between gap-6">
                    <div class="mt-4 w-2/6">
                        <label
                            for="idZonaM"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300"
                            >Zona:
                        </label>
                        <select
                            name="idZonaM"
                            id="idZonaM"
                            v-model="form.idzona"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-indigo-600 dark:focus:ring-indigo-600"
                        >
                            <option disabled value="">
                                Seleciona una zona
                            </option>
                            <option
                                v-for="(idz, index) in zonas"
                                :key="index"
                                :value="idz.id_zona"
                            >
                                {{ idz.id_zona + ' - ' + idz.descripcion }}
                            </option>
                        </select>
                    </div>
                    <div class="mt-4 w-2/6">
                        <label
                            for="comisionM"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300"
                            >Comisión:
                        </label>
                        <input
                            type="number"
                            name="comisionM"
                            id="comisionM"
                            v-model="form.comision"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-indigo-600 dark:focus:ring-indigo-600"
                        />
                    </div>
                    <div class="mt-4 w-2/6">
                        <label
                            for="idUsuerioM"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300"
                            >Usuario:
                        </label>
                        <select
                            name="idUsuerioM"
                            id="idUsuerioM"
                            v-model="form.idusuario"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-indigo-600 dark:focus:ring-indigo-600"
                        >
                            <option disabled value="">
                                Seleciona un usuario
                            </option>
                            <option
                                v-for="(idn, index) in usuarios"
                                :key="index"
                                :value="idn.id"
                            >
                                {{ idn.id + ' - ' + idn.name }}
                            </option>
                        </select>
                    </div>
                </div>
                <div
                    class="flex w-full flex-row items-center justify-between gap-6"
                >
                    <div class="mt-4 w-3/6">
                        <label
                            for="nombreHotelM"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300"
                            >Nombre Hotel:
                        </label>
                        <input
                            type="text"
                            name="nombreHotelM"
                            id="nombreHotelM"
                            v-model="form.hotelname"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-indigo-600 dark:focus:ring-indigo-600"
                        />
                    </div>
                    <div class="mt-4 w-3/6">
                        <label
                            for="dirM"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300"
                            >Dirección:
                        </label>
                        <input
                            type="text"
                            name="dirM"
                            id="dirM"
                            v-model="form.dirhotel"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-indigo-600 dark:focus:ring-indigo-600"
                        />
                    </div>
                </div>
                <div class="flex flex-row justify-center gap-6">
                    <PrimaryButton
                        class="m-2 mt-5 w-52 justify-center"
                        :disabled="false"
                        id="addHotel"
                        @click="confirmar()"
                    >
                        Confirmar
                    </PrimaryButton>
                    <PrimaryButton
                        class="m-2 mt-5 w-52 justify-center"
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
