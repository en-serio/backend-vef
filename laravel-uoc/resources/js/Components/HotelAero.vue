<script lang="ts">
export default {
    props: {
        modelValue: {
            type: Object,
            default: () => ({
                diaVuelo: '',
                horaVuelo: '',
                horaRecogida: '',
                numeroVuelo: '',
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
            Transfer del hotel al aeropuerto
        </h2>
        <div class="flex w-full flex-row items-center justify-between gap-7">
            <div
                class="flex w-full flex-col items-center justify-between gap-2"
            >
                <label
                    for="diaVuelo"
                    class="w-full text-xl text-black dark:text-white"
                    >Día del vuelo</label
                >
                <input
                    type="date"
                    id="diaVuelo"
                    class="w-full rounded-xl bg-white text-black dark:bg-slate-700 dark:text-white"
                    :value="modelValue.diaVuelo"
                    @input="
                        updateField(
                            'diaVuelo',
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
                    for="horaVuelo"
                    class="w-full text-xl text-black dark:text-white"
                >
                    Hora del vuelo</label
                >
                <input
                    type="time"
                    id="horaVuelo"
                    class="w-full rounded-xl bg-white text-black dark:bg-slate-700 dark:text-white"
                    :value="modelValue.horaVuelo"
                    @input="
                        updateField(
                            'horaVuelo',
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
                    for="horaRecogida"
                    class="w-full text-xl text-black dark:text-white"
                >
                    Hora de recogida</label
                >
                <input
                    type="time"
                    id="horaRecogida"
                    class="w-full rounded-xl bg-white text-black dark:bg-slate-700 dark:text-white"
                    :value="modelValue.horaRecogida"
                    @input="
                        updateField(
                            'horaRecogida',
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
                    for="numeroVuelo"
                    class="w-full text-xl text-black dark:text-white"
                    >Número de vuelo
                </label>
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
        </div>
    </div>
</template>
