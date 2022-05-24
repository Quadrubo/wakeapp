<template>
    <quad-form-section @submitted="updatePassword">
        <template #title>
            Passwort ändern
        </template>

        <template #description>
            Stellen Sie sicher, dass Ihr Konto ein langes und zufälliges Passwort verwendet, um sicher zu bleiben.
        </template>

        <template #form>
            <div class="col-span-6 sm:col-span-4">
                <quad-label for="current_password" value="Aktuelles Passwort" />
                <quad-input id="current_password" type="password" class="mt-1 block w-full" v-model="form.current_password" color="yellow" :strength="200" ref="current_password" autocomplete="current-password" />
                <quad-input-error :message="form.errors.current_password" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-4">
                <quad-label for="password" value="Neues Passwort" />
                <quad-input id="password" type="password" class="mt-1 block w-full" v-model="form.password" color="yellow" :strength="200" ref="password" autocomplete="new-password" />
                <quad-input-error :message="form.errors.password" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-4">
                <quad-label for="password_confirmation" value="Neues Passwort bestätigen" />
                <quad-input id="password_confirmation" type="password" class="mt-1 block w-full" v-model="form.password_confirmation" color="yellow" :strength="200" autocomplete="new-password" />
                <quad-input-error :message="form.errors.password_confirmation" class="mt-2" />
            </div>
        </template>

        <template #actions>
            <quad-action-message :on="form.recentlySuccessful" class="mr-3">
                Gespeichert.
            </quad-action-message>

            <quad-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing" color="yellow" :strength="100">
                Speichern
            </quad-button>
        </template>
    </quad-form-section>
</template>

<script>
    import { defineComponent } from 'vue'
    import QuadActionMessage from '@/Components/ActionMessage.vue'
    import QuadButton from '@/Components/Button.vue'
    import QuadFormSection from '@/Components/FormSection.vue'
    import QuadInput from '@/Components/Input.vue'
    import QuadInputError from '@/Components/InputError.vue'
    import QuadLabel from '@/Components/Label.vue'
    export default defineComponent({
        components: {
            QuadActionMessage,
            QuadButton,
            QuadFormSection,
            QuadInput,
            QuadInputError,
            QuadLabel,
        },
        data() {
            return {
                form: this.$inertia.form({
                    current_password: '',
                    password: '',
                    password_confirmation: '',
                }),
            }
        },
        methods: {
            updatePassword() {
                this.form.put(route('user-password.update'), {
                    errorBag: 'updatePassword',
                    preserveScroll: true,
                    onSuccess: () => this.form.reset(),
                    onError: () => {
                        if (this.form.errors.password) {
                            this.form.reset('password', 'password_confirmation')
                            this.$refs.password.focus()
                        }
                        if (this.form.errors.current_password) {
                            this.form.reset('current_password')
                            this.$refs.current_password.focus()
                        }
                    }
                })
            },
        },
    })
</script>