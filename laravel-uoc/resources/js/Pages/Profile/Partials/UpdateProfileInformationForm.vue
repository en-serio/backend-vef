<script setup lang="ts">
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Link, useForm, usePage } from '@inertiajs/vue3';

const props = defineProps<{
    mustVerifyEmail?: Boolean;
    status?: String;
}>();

const user = usePage().props.auth.user;
console.log('EL user');
console.log(user);

const form = useForm({
    name: user.name,
    email: user.email,
    apellido1: user.apellido1,
    apellido2: user.apellido2,
});
</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                Inforción de la cuenta
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                Actualiza tu nombre y email
            </p>
        </header>

        <form
            @submit.prevent="form.patch(route('profile.update'))"
            class="mt-6 space-y-6"
        >
            <div>
                <InputLabel for="name" value="Name" />

                <TextInput
                    id="name"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.name"
                    required
                    autofocus
                    autocomplete="name"
                />

                <InputError class="mt-2" :message="form.errors.name" />
            </div>
            <div>
                <InputLabel for="ApellidoUno" value="Primer Apellido" />

                <TextInput
                    id="ApellidoUno"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.apellido1"
                    required
                    autofocus
                />

                <InputError class="mt-2" :message="form.errors.apellido1" />
            </div>
            <div>
                <InputLabel for="ApellidoDos" value="Segundo apellido" />

                <TextInput
                    id="ApellidoDos"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.apellido2"
                    required
                    autofocus
                />

                <InputError class="mt-2" :message="form.errors.apellido2" />
            </div>

            <div>
                <InputLabel for="email" value="Email" />

                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full"
                    v-model="form.email"
                    required
                    autocomplete="username"
                />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div v-if="mustVerifyEmail && user.email_verified_at === null">
                <p class="mt-2 text-sm text-gray-800 dark:text-gray-200">
                    Tu email no esta verificado. Por favor verifica tu email.
                    <Link
                        :href="route('verification.send')"
                        method="post"
                        as="button"
                        class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:text-gray-400 dark:hover:text-gray-100 dark:focus:ring-offset-gray-800"
                    >
                        Reenviar verificación
                    </Link>
                </p>

                <div
                    v-show="status === 'verification-link-sent'"
                    class="mt-2 text-sm font-medium text-green-600 dark:text-green-400"
                >
                    Una nueva verificación se envio a tu cuenta
                </div>
            </div>

            <div class="flex items-center gap-4">
                <PrimaryButton :disabled="form.processing"
                    >Guardar</PrimaryButton
                >

                <Transition
                    enter-active-class="transition ease-in-out"
                    enter-from-class="opacity-0"
                    leave-active-class="transition ease-in-out"
                    leave-to-class="opacity-0"
                >
                    <p
                        v-if="form.recentlySuccessful"
                        class="text-sm text-gray-600 dark:text-gray-400"
                    >
                        Guardado!
                    </p>
                </Transition>
            </div>
        </form>
    </section>
</template>
