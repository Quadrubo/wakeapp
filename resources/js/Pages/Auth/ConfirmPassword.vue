<template>
    <Head title="sicherer Bereich" />

    <quad-authentication-card>
        <template #logo>
            <quad-authentication-card-logo />
        </template>

        <div class="mb-4 text-sm text-gray-600">
            Dies ist ein sicherer Bereich der Anwendung. Bitte bestätigen Sie Ihr Passwort, um fortzufahren.
        </div>

        <quad-validation-errors class="mb-4" />

        <form @submit.prevent="submit">
            <div>
                <quad-label for="password" value="Passwort" />
                <quad-input id="password" type="password" class="mt-1 block w-full" v-model="form.password" color="yellow" :strength="200" required autocomplete="current-password" autofocus />
            </div>

            <div class="flex justify-end mt-4">
                <quad-button class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing" color="yellow" :strength="100">
                    Bestätigen
                </quad-button>
            </div>
        </form>
    </quad-authentication-card>
</template>

<script>
    import { defineComponent } from 'vue';
    import { Head } from '@inertiajs/inertia-vue3';

    import QuadAuthenticationCard from '@/Components/AuthenticationCard.vue';
    import QuadAuthenticationCardLogo from '@/Components/AuthenticationCardLogo.vue';
    import QuadButton from '@/Components/Button.vue';
    import QuadInput from '@/Components/Input.vue';
    import QuadLabel from '@/Components/Label.vue';
    import QuadValidationErrors from '@/Components/ValidationErrors.vue';

    export default defineComponent({
        components: {
            Head,
            QuadAuthenticationCard,
            QuadAuthenticationCardLogo,
            QuadButton,
            QuadInput,
            QuadLabel,
            QuadValidationErrors
        },
        data() {
            return {
                form: this.$inertia.form({
                    password: '',
                })
            }
        },
        methods: {
            submit() {
                this.form.post(this.route('password.confirm'), {
                    onFinish: () => this.form.reset(),
                })
            }
        }
    })
</script>