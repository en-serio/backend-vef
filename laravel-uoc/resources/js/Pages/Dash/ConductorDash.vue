<script setup lang="ts">
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TablaDatos from '@/Components/TablaDatos.vue';
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const form = useForm({
    idVehiculo: 0,
    desc: '',
    emailCond: '',
    plazas: 0,
    password: '',
});

const props = defineProps({
    vehiculos: {
        type: Array as () => {
            id_vehiculo: number;
            Descripción: String;
            email_conductor: String;
            plazas: number;
        }[],
        required: true,
    },
});

function resetForm() {
    form.idVehiculo = 0;
    form.desc = '';
    form.emailCond = '';
    form.plazas = 0;
    form.password = '';
}

function comprobarVacio() {
    if (form.desc === '' || form.emailCond === '') {
        alert('Faltan datos por rellenar');
        return false;
    }
    return true;
}

const headerZona = ['Id Vehículo', 'Descripción', 'Email Conductor', 'Plazas'];

const handleEdit = (row: any) => {
    isNuevo.value = false;
    editModal(row);
};

const handleDelete = (row: any) => {
    form.idVehiculo = row.id_vehiculo;
    form.delete(route('vehiculo.destroy'), {
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
    form.idVehiculo = row.id_vehiculo;
    form.desc = row.Descripción;
    form.emailCond = row.email_conductor;
    form.plazas = row.plazas;
    isModalOpen.value = true;
    console.log('Edit modal', row);
}

const isNuevo = ref(false);

const isModalOpen = ref(false);

const nuevoModal = () => {
    isNuevo.value = true;
    form.idVehiculo = 0;
    form.plazas = 0;
    resetForm();
    isModalOpen.value = true;
};

const confirmar = () => {
    form.password = '1234';
    if (!comprobarVacio()) {
        return;
    }
    if (isNuevo.value) {
        form.post(route('vehiculo.store'), {
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
        form.put(route('vehiculo.update'), {
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
            Gestión de Vehículos
        </h3>
        <PrimaryButton
            class="m-3 mb-5 ms-4 w-56 justify-center"
            :disabled="false"
            id="addHotel"
            @click="nuevoModal"
        >
            Añadir Nuevo Conductor
        </PrimaryButton>
        <div class="flex w-full flex-row">
            <TablaDatos
                :headers="headerZona"
                :data="vehiculos"
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
                    Vehiculo
                </h2>
                <div
                    class="flex w-full flex-row items-center justify-between gap-6"
                >
                    <div class="mt-4 w-full">
                        <label
                            for="dirM"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300"
                            >Descripción:
                        </label>
                        <input
                            type="text"
                            name="dirM"
                            id="dirM"
                            v-model="form.desc"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-indigo-600 dark:focus:ring-indigo-600"
                        />
                    </div>
                </div>
                <div
                    class="flex w-full flex-row items-center justify-between gap-6"
                >
                    <div class="mt-4 w-full">
                        <label
                            for="plazas"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300"
                            >Plazas:
                        </label>
                        <input
                            type="number"
                            name="plazas"
                            id="plazas"
                            v-model="form.plazas"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-indigo-600 dark:focus:ring-indigo-600"
                        />
                    </div>
                    <div class="mt-4 w-full">
                        <label
                            for="dirM"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300"
                            >Email conductor:
                        </label>
                        <input
                            type="email"
                            name="dirM"
                            id="dirM"
                            v-model="form.emailCond"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-indigo-600 dark:focus:ring-indigo-600"
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
