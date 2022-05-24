<template>
    <Head title="Einloggen" />

    <quad-authentication-card>
        <template #logo>
            <quad-authentication-card-logo class="text-5xl" />
        </template>

        <quad-validation-errors class="mb-4" />

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}    
        </div>

        <form @submit.prevent="submit">
            <div>
                <quad-label for="email" value="E-Mail" />
                <quad-input id="email" type="email" class="mt-1 block w-full" v-model="form.email" color="yellow" :strength="200" required autofocus />
            </div>

            <div class="mt-4">
                <quad-label for="password" value="Passwort" />
                <quad-input id="password" type="password" class="mt-1 block w-full" v-model="form.password" color="yellow" :strength="200" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label class="flex items-center">
                    <quad-checkbox name="remember" v-model:checked="form.remember" color="yellow" :strength="100" />
                    <span class="ml-2 text-sm text-gray-600">Login speichern</span>
                </label>
            </div>

            <div class="flex items-center justify-end space-x-4 mt-4">
                <Link v-if="canResetPassword" :href="route('password.request')" class="underline text-sm text-gray-600 hover:text-gray-900">
                    Passwort vergessen?
                </Link>

                <quad-button class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing" type="submit" color="yellow" :strength="100">
                    Einloggen
                </quad-button>
            </div>
        </form>
    </quad-authentication-card>
</template>

<script>
    import { defineComponent } from 'vue'
    import { Head, Link } from '@inertiajs/inertia-vue3';

    import QuadAuthenticationCard from '@/Components/AuthenticationCard.vue';
    import QuadAuthenticationCardLogo from '@/Components/AuthenticationCardLogo.vue';
    import QuadButton from '@/Components/Button.vue';
    import QuadCheckbox from '@/Components/Checkbox.vue';
    import QuadInput from '@/Components/Input.vue';
    import QuadLabel from '@/Components/Label.vue';
    import QuadValidationErrors from '@/Components/ValidationErrors.vue';

    export default defineComponent({
        components: {
            Head,
            Link,
            QuadAuthenticationCard,
            QuadAuthenticationCardLogo,
            QuadButton,
            QuadCheckbox,
            QuadInput,
            QuadLabel,
            QuadValidationErrors
        },
        props: {
            canResetPassword: Boolean,
            status: String
        },
        data() {
            return {
                form: this.$inertia.form({
                    email: '',
                    password: '',
                    remember: false
                })
            }
        },
        methods: {
            submit() {
                this.form
                    .transform(data => ({
                        ... data,
                        remember: this.form.remember ? 'on' : ''
                    }))
                    .post(this.route('login'), {
                        onFinish: () => this.form.reset('password'),
                    })
            }
        }
    })
</script>