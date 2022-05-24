<template>
    <Head title="Passwort vergessen" />

    <quad-authentication-card>
        <template #logo>
            <quad-authentication-card-logo class="text-5xl"/>
        </template>

        <div class="mb-4 text-sm text-gray-600">
            Haben Sie Ihr Passwort vergessen? Kein Problem. Teilen Sie uns einfach Ihre E-Mail-Adresse mit und wir senden Ihnen per E-Mail einen Link zum Zurücksetzen des Passworts.
        </div>

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>

        <quad-validation-errors class="mb-4" />

        <form @submit.prevent="submit">
            <div>
                <quad-label for="email" value="E-Mail" />
                <quad-input id="email" type="email" class="mt-1 block w-full" v-model="form.email" color="yellow" :strength="200" required autofocus />
            </div>

            <div class="flex items-center justify-end mt-4">
                <quad-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing" color="yellow" :strength="100">
                    Link senden
                </quad-button>
            </div>
        </form>
    </quad-authentication-card>
</template>

<script>
    import { defineComponent } from 'vue'
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
            status: String
        },
        data() {
            return {
                form: this.$inertia.form({
                    email: ''
                })
            }
        },
        methods: {
            submit() {
                this.form.post(this.route('password.email'))
            }
        }
    })
</script>