<script setup lang="ts">
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TablaDatos from '@/Components/TablaDatos.vue';
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const form = useForm({
    id: 0,
    name: '',
    apellido1: '',
    apellido2: '',
    email: '',
    rol: 0,
    id_viajero: 0,
});

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
    rol: {
        type: String,
        required: true,
    },
});

const header = [
    'Id Usuario',
    'Nombre',
    'Apellido 1',
    'Apellido 2',
    'Email',
    'Rol',
    'Id Viajero',
];

function resetForm() {
    form.id = 0;
    form.name = '';
    form.apellido1 = '';
    form.apellido2 = '';
    form.email = '';
    form.rol = 0;
    form.id_viajero = 0;
}

function comprobarVacio() {
    if (
        form.name == '' ||
        form.email == '' ||
        form.rol == 0 ||
        form.apellido1 == '' ||
        form.apellido2 == ''
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
    form.id = row.id;
    form.delete(route('usuarios.destroy'), {
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
    form.id = row.id;
    form.name = row.name;
    form.apellido1 = row.apellido1;
    form.apellido2 = row.apellido2;
    form.email = row.email;
    form.rol = row.rol;
    isModalOpen.value = true;
    console.log('Edit modal', row);
}

const isModalOpen = ref(false);

const isNuevo = ref(false);

const nuevoModal = () => {
    isNuevo.value = true;
    form.id = 0;
    resetForm();
    isModalOpen.value = true;
};

const confirmar = () => {
    if (!comprobarVacio()) {
        return;
    }
    postAdmin();
    isModalOpen.value = false;
    resetForm();
};

function postAdmin() {
    if (isNuevo.value) {
        form.post(route('usuarios.store'), {
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
        form.put(route('usuarios.update'), {
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

const cancelar = () => {
    isModalOpen.value = false;
    resetForm();
};
</script>
<template>
    <div class="flex w-4/6 flex-col bg-gray-100 dark:bg-slate-900">
        <h3 class="w-full px-5 pt-5 text-xl font-semibold dark:text-white">
            Gestión de Usuarios
        </h3>
        <PrimaryButton
            class="m-3 mb-5 ms-4 w-52 justify-center"
            :disabled="false"
            id="addHotel"
            @click="nuevoModal"
        >
            Añadir nuevo Usuario
        </PrimaryButton>
        <div class="flex w-full flex-row overflow-x-scroll">
            <TablaDatos
                :headers="header"
                :data="props.usuarios"
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
                    Usuarios
                </h2>
                <div
                    class="flex w-full flex-row items-center justify-between gap-6"
                >
                    <div class="mt-4 w-3/6">
                        <label
                            for="id"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300"
                            >Id:
                        </label>
                        <input
                            type="number"
                            name="id"
                            id="id"
                            v-model="form.id"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-indigo-600 dark:focus:ring-indigo-600"
                            readonly
                        />
                    </div>
                    <div class="mt-4 w-3/6">
                        <label
                            for="rol"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300"
                            >rol:
                        </label>
                        <input
                            type="number"
                            name="rol"
                            id="rol"
                            v-model="form.rol"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-indigo-600 dark:focus:ring-indigo-600"
                        />
                    </div>
                    <div class="mt-4 w-3/6">
                        <label
                            for="idV"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300"
                            >Id Viajero:
                        </label>
                        <input
                            type="number"
                            name="idV"
                            id="idV"
                            v-model="form.id_viajero"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-indigo-600 dark:focus:ring-indigo-600"
                            readonly
                        />
                    </div>
                </div>
                <div
                    class="flex w-full flex-row items-center justify-between gap-6"
                >
                    <div class="mt-4 w-3/6">
                        <label
                            for="email"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300"
                            >Email:
                        </label>
                        <input
                            type="email"
                            name="email"
                            id="email"
                            v-model="form.email"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-indigo-600 dark:focus:ring-indigo-600"
                        />
                    </div>
                    <div class="mt-4 w-3/6">
                        <label
                            for="name"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300"
                            >Nombre:
                        </label>
                        <input
                            type="text"
                            name="name"
                            id="name"
                            v-model="form.name"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-indigo-600 dark:focus:ring-indigo-600"
                        />
                    </div>
                </div>
                <div
                    class="flex w-full flex-row items-center justify-between gap-6"
                >
                    <div class="mt-4 w-3/6">
                        <label
                            for="apellido1"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300"
                            >Apellido 1:
                        </label>
                        <input
                            type="text"
                            name="apellido1"
                            id="apellido1"
                            v-model="form.apellido1"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-indigo-600 dark:focus:ring-indigo-600"
                        />
                    </div>
                    <div class="mt-4 w-3/6">
                        <label
                            for="apellido2"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300"
                            >Apellido 2:
                        </label>
                        <input
                            type="text"
                            name="apellido2"
                            id="apellido2"
                            v-model="form.apellido2"
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