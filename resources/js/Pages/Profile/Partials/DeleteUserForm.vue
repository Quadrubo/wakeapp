<template>
    <quad-action-section>
        <template #title>
            Account löschen
        </template>

        <template #description>
            Permanent Ihren Account löschen.
        </template>

        <template #content>
            <div class="max-w-xl text-sm text-gray-600">
                Sobald Ihr Account gelöscht wird, sind alle Ihre Daten dauerhaft gelöscht. 
            </div>

            <div class="mt-5">
                <quad-button @click="confirmUserDeletion" color="red">
                    Account Löschen
                </quad-button>
            </div>

            <!-- Delete Account Confirmation Modal -->
            <quad-dialog-modal :show="confirmingUserDeletion" @close="closeModal">
                <template #title>
                    Account Löschen
                </template>

                <template #content>
                    Sind Sie sicher, dass Sie Ihren Account löschen wollen? Sobald Ihr Account gelöscht wird, sind alle Ihre Daten dauerhaft gelöscht. Bitte geben Sie Ihr Passwort ein, um zu bestätigen, dass Sie Ihren Account löschen wollen.
                    <div class="mt-4">
                        <quad-input type="password" class="mt-1 block w-3/4" placeholder="Password"
                                    ref="password"
                                    v-model="form.password"
                                    @keyup.enter="deleteUser" 
                                    color="red" />

                        <quad-input-error :message="form.errors.password" class="mt-2" />
                    </div>
                </template>

                <template #footer>
                    <quad-button @click="closeModal" color="gray">
                        Abbrechen
                    </quad-button>

                    <quad-button class="ml-3" @click="deleteUser" :class="{ 'opacity-25': form.processing }" :disabled="form.processing" color="red">
                        Account Löschen
                    </quad-button>
                </template>
            </quad-dialog-modal>
        </template>
    </quad-action-section>
</template>

<script>
    import { defineComponent } from 'vue';
    import QuadActionSection from '@/Components/ActionSection.vue';
    import QuadButton from '@/Components/Button.vue';
    import QuadDialogModal from '@/Components/DialogModal.vue';
    import QuadInput from '@/Components/Input.vue';
    import QuadInputError from '@/Components/InputError.vue';

    export default defineComponent({
        components: {
            QuadActionSection,
            QuadButton,
            QuadDialogModal,
            QuadInput,
            QuadInputError
        },

        data() {
            return {
                confirmingUserDeletion: false,
                form: this.$inertia.form({
                    password: '',
                })
            }
        },
        
        methods: {
            confirmUserDeletion() {
                this.confirmingUserDeletion = true;
                setTimeout(() => this.$refs.password.focus(), 250)
            },
            deleteUser() {
                this.form.delete(route('current-user.destroy'), {
                    preserveScroll: true,
                    onSuccess: () => this.closeModal(),
                    onError: () => this.$refs.password.focus(),
                    onFinish: () => this.form.reset(),
                })
            },
            closeModal() {
                this.confirmingUserDeletion = false
                this.form.reset()
            },
        },
    })
</script>