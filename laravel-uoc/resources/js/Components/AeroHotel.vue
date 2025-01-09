<script lang="ts">
export default {
    props: {
        modelValue: {
            type: Object,
            default: () => ({
                diaLlegada: '',
                horaLlegada: '',
                numeroVuelo: '',
                aeropuertoOrigen: '',
            }),
        },
    },
    emits: ['update:modelValue'],
    methods: {
        updateField(field: string, value: string, event: Event) {
            const input = event.target as HTMLInputElement | null;
            if (input) {
                this.$emit('update:modelValue', {
                    ...this.modelValue,
                    [field]: value,
                });
            }
        },
    },
};
</script>
<template>
    <div class="flex w-full flex-col items-center justify-between gap-5 py-2">
        <h2 class="text-lg text-black dark:text-white">
            Transfer del aeropuerto al hotel
        </h2>
        <div class="flex w-full flex-row items-center justify-between gap-7">
            <div
                class="flex w-full flex-col items-center justify-between gap-2"
            >
                <label
                    for="diallegada"
                    class="w-full text-xl text-black dark:text-white"
                    >Día llegada</label
                >
                <input
                    type="date"
                    id="diallegada"
                    class="w-full rounded-xl bg-white text-black dark:bg-slate-700 dark:text-white"
                    :value="modelValue.diaLlegada"
                    @input="
                        updateField(
                            'diaLlegada',
                            ($event.target as HTMLInputElement)?.value || '',
                            $event,
                        )
                    "
                />
            </div>
            <div
                class="flex w-full flex-col items-center justify-between gap-2"
            >
                <label
                    for="horaLlegada"
                    class="w-full text-xl text-black dark:text-white"
                >
                    Hora llegada</label
                >
                <input
                    type="time"
                    id="horaLlegada"
                    class="w-full rounded-xl bg-white text-black dark:bg-slate-700 dark:text-white"
                    :value="modelValue.horaLlegada"
                    @input="
                        updateField(
                            'horaLlegada',
                            ($event.target as HTMLInputElement)?.value || '',
                            $event,
                        )
                    "
                />
            </div>
        </div>
        <div class="flex w-full flex-row items-center justify-between gap-7">
            <div
                class="flex w-full flex-col items-center justify-between gap-2"
            >
                <label
                    for="numeroVuelo"
                    class="w-full text-xl text-black dark:text-white"
                >
                    Número Vuelo</label
                >
                <input
                    type="text"
                    id="numeroVuelo"
                    class="w-full rounded-xl bg-white text-black dark:bg-slate-700 dark:text-white"
                    :value="modelValue.numeroVuelo"
                    @input="
                        updateField(
                            'numeroVuelo',
                            ($event.target as HTMLInputElement)?.value || '',
                            $event,
                        )
                    "
                />
            </div>
            <div
                class="flex w-full flex-col items-center justify-between gap-2"
            >
                <label
                    for="aeropuertoOrigen"
                    class="w-full text-xl text-black dark:text-white"
                    >Aeropuerto de Origen
                </label>
                <input
                    type="text"
                    id="aeropuertoOrigen"
                    class="w-full rounded-xl bg-white text-black dark:bg-slate-700 dark:text-white"
                    :value="modelValue.aeropuertoOrigen"
                    @input="
                        updateField(
                            'aeropuertoOrigen',
                            ($event.target as HTMLInputElement)?.value || '',
                            $event,
                        )
                    "
                />
            </div>
        </div>
    </div>
</template>
