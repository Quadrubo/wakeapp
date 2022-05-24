<template>
    <Head title="Registrieren" />

    <quad-authentication-card>
        <template #logo>
            <quad-authentication-card-logo class="text-5xl"/>
        </template>

        <quad-validation-errors class="mb-4" />

        <form @submit.prevent="submit">


            <div class="mt-4">
                <quad-label for="name" value="Name" />
                <quad-input id="name" type="text" class="mt-1 block w-full" v-model="form.name" color="yellow" :strength="200" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <quad-label for="email" value="E-Mail" />
                <quad-input id="email" type="email" class="mt-1 block w-full" v-model="form.email" color="yellow" :strength="200" required />
            </div>

            <div class="mt-4">
                <quad-label for="password" value="Passwort" />
                <quad-input id="password" type="password" class="mt-1 block w-full" v-model="form.password" color="yellow" :strength="200" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <quad-label for="password_confirmation" value="Passwort bestätigen" />
                <quad-input id="password_confirmation" type="password" class="mt-1 block w-full" v-model="form.password_confirmation" color="yellow" :strength="200" required autocomplete="new-password" />
            </div>

            <div class="mt-4" v-if="$page.props.jetstream.hasTermsAndPrivacyPolicyFeature">
                <quad-label for="terms">
                    <div class="flex items-center">
                        <quad-checkbox name="terms" id="terms" v-model:checked="form.terms" color="yellow" :strength="100" />

                        <div class="ml-2">
                            Ich habe die <a target="_blank" :href="route('terms.show')" class="underline text-sm text-gray-600 hover:text-gray-900">Nutzungsbedingungen</a> und die <a target="_blank" :href="route('policy.show')" class="underline text-sm text-gray-600 hover:text-gray-900">Datenschutzerklärung</a> gelesen und erkläre mich mit diesen einverstanden.
                        </div>
                    </div>
                </quad-label>
            </div>

            <div class="flex items-center justify-end mt-4">
                <Link :href="route('login')" class="underline text-sm text-gray-600 hover:text-gray-900">
                    Bereits registriert?
                </Link>

                <quad-button class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing" type="submit" color="yellow" :strength="100">
                    Registrieren
                </quad-button>
            </div>
        </form>
    </quad-authentication-card>
</template>

<script>
    import { defineComponent } from 'vue'
    import { Head, Link } from '@inertiajs/inertia-vue3';

    import QuadAuthenticationCard from '@/Components/AuthenticationCard.vue'
    import QuadAuthenticationCardLogo from '@/Components/AuthenticationCardLogo.vue'
    import QuadButton from '@/Components/Button.vue'
    import QuadInput from '@/Components/Input.vue'
    import QuadCheckbox from '@/Components/Checkbox.vue'
    import QuadLabel from '@/Components/Label.vue'
    import QuadValidationErrors from '@/Components/ValidationErrors.vue'

    export default defineComponent({
        components: {
            Head,
            Link,
            QuadAuthenticationCard,
            QuadAuthenticationCardLogo,
            QuadButton,
            QuadInput,
            QuadCheckbox,
            QuadLabel,
            QuadValidationErrors
        },
        data() {
            return {
                form: this.$inertia.form({
                    name: '',
                    email: '',
                    password: '',
                    password_confirmation: '',
                    terms: false,
                })
            }
        },
        methods: {
            submit() {
                this.form.post(this.route('register'), {
                    onFinish: () => this.form.reset('password', 'password_confirmation'),
                })
            }
        }
    })
</script>