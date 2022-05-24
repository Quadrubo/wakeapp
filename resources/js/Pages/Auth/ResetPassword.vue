<template>
    <Head title="Passwort zurücksetzen" />

    <quad-authentication-card>
        <template #logo>
            <quad-authentication-card-logo class="text-5xl" />
        </template>

        <quad-validation-errors class="mb-4" />

        <form @submit.prevent="submit">
            <div>
                <quad-label for="email" value="E-Mail" />
                <quad-input id="email" type="email" class="mt-1 block w-full" v-model="form.email" color="yellow" :strength="200" required autofocus />
            </div>

            <div class="mt-4">
                <quad-label for="password" value="Passwort" />
                <quad-input id="password" type="password" class="mt-1 block w-full" v-model="form.password" color="yellow" :strength="200" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <quad-label for="password_confirmation" value="Passwort bestätigen" />
                <quad-input id="password_confirmation" type="password" class="mt-1 block w-full" v-model="form.password_confirmation" color="yellow" :strength="200" required autocomplete="new-password" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <quad-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing" color="yellow" :strength="100">
                    Passwort zurücksetzen
                </quad-button>
            </div>
        </form>
    </quad-authentication-card>
</template>

<script>
    import { defineComponent } from 'vue';
    import { Head } from '@inertiajs/inertia-vue3';
    import QuadAuthenticationCard from '@/Components/AuthenticationCard.vue'
    import QuadAuthenticationCardLogo from '@/Components/AuthenticationCardLogo.vue'
    import QuadButton from '@/Components/Button.vue'
    import QuadInput from '@/Components/Input.vue'
    import QuadLabel from '@/Components/Label.vue'
    import QuadValidationErrors from '@/Components/ValidationErrors.vue'
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
        props: {
            email: String,
            token: String,
        },
        data() {
            return {
                form: this.$inertia.form({
                    token: this.token,
                    email: this.email,
                    password: '',
                    password_confirmation: '',
                })
            }
        },
        methods: {
            submit() {
                this.form.post(this.route('password.update'), {
                    onFinish: () => this.form.reset('password', 'password_confirmation'),
                })
            }
        }
    })
</script>