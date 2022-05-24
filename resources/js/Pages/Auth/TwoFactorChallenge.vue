<template>
    <Head title="Two-factor Confirmation" />

    <quad-authentication-card>
        <template #logo>
            <quad-authentication-card-logo class="text-5xl" />
        </template>

        <div class="mb-4 text-sm text-gray-600">
            <template v-if="! recovery">
                Please confirm access to your account by entering the authentication code provided by your authenticator application.
            </template>

            <template v-else>
                Please confirm access to your account by entering one of your emergency recovery codes.
            </template>
        </div>

        <quad-validation-errors class="mb-4" />

        <form @submit.prevent="submit">
            <div v-if="! recovery">
                <quad-label for="code" value="Code" />
                <quad-input ref="code" id="code" type="text" inputmode="numeric" class="mt-1 block w-full" v-model="form.code" color="yellow" :strength="200" autofocus autocomplete="one-time-code" />
            </div>

            <div v-else>
                <quad-label for="recovery_code" value="Recovery Code" />
                <quad-input ref="recovery_code" id="recovery_code" type="text" class="mt-1 block w-full" v-model="form.recovery_code" color="yellow" :strength="200" autocomplete="one-time-code" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <button type="button" class="text-sm text-gray-600 hover:text-gray-900 underline cursor-pointer" @click.prevent="toggleRecovery">
                    <template v-if="! recovery">
                        Use a recovery code
                    </template>

                    <template v-else>
                        Use an authentication code
                    </template>
                </button>

                <quad-button class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing" color="yellow" :strength="100">
                    Log in
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
            QuadValidationErrors,
        },

        data() {
            return {
                recovery: false,
                form: this.$inertia.form({
                    code: '',
                    recovery_code: '',
                })
            }
        },

        methods: {
            toggleRecovery() {
                this.recovery ^= true

                this.$nextTick(() => {
                    if (this.recovery) {
                        this.$refs.recovery_code.focus()
                        this.form.code = '';
                    } else {
                        this.$refs.code.focus()
                        this.form.recovery_code = ''
                    }
                })
            },

            submit() {
                this.form.post(this.route('two-factor.login'))
            }
        }
    })
</script>
