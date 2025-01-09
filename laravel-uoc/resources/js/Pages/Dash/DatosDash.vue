<script setup lang="ts">
const props = defineProps({
    datos: {
        type: Array as () => {
            contrasenya: string;
            localizador: string;
        }[],
        required: true,
    },
});

const localizadorArray = props.datos[0].localizador.split('-');

const isDos = localizadorArray.length > 1;

const localizadorPart1 = localizadorArray[0] || '';
const localizadorPart2 = localizadorArray[1] || '';
</script>
<template>
    <div
        class="max-width-5/6 lg:max-w-4/6 flex flex-col items-center justify-center bg-gray-100 shadow-2xl shadow-slate-900 md:w-4/6 dark:bg-slate-900"
    >
        <div class="flex w-full flex-col items-center justify-center">
            <h3 class="px-5 py-7 text-2xl font-thin text-black dark:text-white">
                Datos De la Reserva
            </h3>
            <section
                class="grid w-full grid-cols-2 items-center justify-center gap-4 bg-gray-200 p-5 px-56 pb-10 text-xl text-black dark:bg-slate-800 dark:text-white"
            >
                <p>
                    <strong>Localizador de la Reserva:</strong>
                    {{ localizadorPart1 }}
                </p>
                <p>
                    <strong>Contraseña de la Reserva:</strong>
                    {{ datos[0].contrasenya }}
                </p>
            </section>
            <section
                class="grid w-full grid-cols-2 items-center justify-center gap-4 bg-gray-200 p-5 px-56 pb-10 text-xl text-black dark:bg-slate-800 dark:text-white"
                v-if="isDos"
            >
                <p>
                    <strong>Localizador de la Reserva:</strong>
                    {{ localizadorPart2 }}
                </p>
                <p>
                    <strong>Contraseña de la Reserva:</strong>
                    {{ datos[0].contrasenya }}
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
