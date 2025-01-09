<script setup lang="ts">
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TablaDatos from '@/Components/TablaDatos.vue';
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const form = useForm({
    id_tipo_reserva: 0,
    tipoName: '',
});

const props = defineProps({
    tipos: {
        type: Array as () => { id_tipo_reserva: number; Descripción: String }[],
        required: true,
    },
});

function resetForm() {
    form.tipoName = '';
}

function comprobarVacio() {
    if (form.tipoName === '') {
        alert('Faltan datos por rellenar');
        return false;
    }
    return true;
}

const headerTipo = ['Id Tipo Reserva', 'Descripción'];

const handleEdit = (row: any) => {
    isNuevo.value = false;
    editModal(row);
};

const handleDelete = (row: any) => {
    if (
        row.id_tipo_reserva != 1 &&
        row.id_tipo_reserva != 2 &&
        row.id_tipo_reserva != 3
    ) {
        form.id_tipo_reserva = row.id_tipo_reserva;
        form.delete(route('tipos.destroy'), {
            preserveScroll: true,
            onSuccess: () => {
                console.log('Deleted');
            },
            onError: (errors) => {
                console.error(errors);
            },
        });
    } else {
        alert('Lo sentimos, no se pueden borrar los tipos de transfer');
    }
};

function editModal(row: any) {
    form.id_tipo_reserva = row.id_tipo_reserva;
    form.tipoName = row.Descripción;
    isModalOpen.value = true;
    console.log('Edit modal', row);
}

const isModalOpen = ref(false);

const isNuevo = ref(false);

const nuevoModal = () => {
    isNuevo.value = true;
    form.id_tipo_reserva = 0;
    resetForm();
    isModalOpen.value = true;
};

const confirmar = () => {
    if (!comprobarVacio()) {
        return;
    }
    if (isNuevo.value) {
        form.post(route('tipos.store'), {
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
        form.put(route('tipos.update'), {
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
    <div class="flex w-4/6 flex-col bg-gray-100 lg:max-w-3xl dark:bg-slate-900">
        <h3 class="px-5 pt-5 text-xl font-semibold text-black dark:text-white">
            Gestión de Tipos de Transfers
        </h3>
        <PrimaryButton
            class="m-3 mb-5 ms-4 w-52 justify-center"
            :disabled="false"
            id="addHotel"
            @click="nuevoModal"
        >
            Añadir nuevo Tipo
        </PrimaryButton>
        <div class="flex w-full flex-row overflow-x-scroll">
            <TablaDatos
                :headers="headerTipo"
                :data="tipos"
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
                    Tipo de Transfer
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
                            v-model="form.tipoName"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-indigo-600 dark:focus:ring-indigo-600"
                        />
                    </div>
                </div>
                <div class="flex flex-col items-center justify-center">
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
