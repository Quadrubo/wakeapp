<template>
    <quad-action-section>
        <template #title>
            Browsersitzungen
        </template>

        <template #description>
            Verwalten und melden Sie Ihre aktiven Sitzungen auf anderen Browsern und Geräten ab.
        </template>

        <template #content>
            <div class="max-w-xl text-sm text-gray-600">
                Bei Bedarf können Sie sich von all Ihren anderen Browsersitzungen auf anderen Geräten abmelden. Ihre kürzlichen Sitzungen sind unten aufgelistet. Wenn Sie denken, dass Ihr Account gefährdet ist, sollten Sie auch Ihr Passwort ändern. 
            </div>

            <!-- Other Browser Sessions -->
            <div class="mt-5 space-y-6" v-if="sessions.length > 0">
                <div class="flex items-center" v-for="(session, i) in sessions" :key="i">
                    <div>
                        <svg fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor" class="w-8 h-8 text-gray-500" v-if="session.agent.is_desktop">
                            <path d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>

                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" class="w-8 h-8 text-gray-500" v-else>
                            <path d="M0 0h24v24H0z" stroke="none"></path><rect x="7" y="4" width="10" height="16" rx="1"></rect><path d="M11 5h2M12 17v.01"></path>
                        </svg>
                    </div>

                    <div class="ml-3">
                        <div class="text-sm text-gray-600">
                            {{ session.agent.platform ? session.agent.platform : 'Unknown' }} - {{ session.agent.browser ? session.agent.browser : 'Unknown' }}
                        </div>

                        <div>
                            <div class="text-xs text-gray-500">
                                {{ session.ip_address }},

                                <span class="text-green-500 font-semibold" v-if="session.is_current_device">Dieses Gerät</span>
                                <span v-else>Zuletzt aktiv {{ session.last_active }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex items-center mt-5">
                <quad-button @click="confirmLogout" color="yellow" :strength="100">
                    Aus anderen Browsersitzungen abmelden
                </quad-button>

                <quad-action-message :on="form.recentlySuccessful" class="ml-3">
                    Fertig.
                </quad-action-message>
            </div>

            <!-- Log Out Other Devices Confirmation Modal -->
            <quad-dialog-modal :show="confirmingLogout" @close="closeModal">
                <template #title>
                    Aus anderen Browsersitzungen abmelden
                </template>

                <template #content>
                    Bitte geben Sie Ihr Passwort ein, um zu bestätigen, dass Sie sich aus anderen Browsersitzungen abmelden wollen.

                    <div class="mt-4">
                        <quad-input type="password" class="mt-1 block w-3/4" placeholder="Password"
                                    ref="password"
                                    v-model="form.password"
                                    @keyup.enter="logoutOtherBrowserSessions"
                                    color="yellow" :strength="200" />

                        <quad-input-error :message="form.errors.password" class="mt-2" />
                    </div>
                </template>

                <template #footer>
                    <quad-button @click="closeModal" color="gray">
                        Abbrechen
                    </quad-button>

                    <quad-button class="ml-3" @click="logoutOtherBrowserSessions" :class="{ 'opacity-25': form.processing }" :disabled="form.processing" color="yellow" :strength="100">
                        Aus anderen Browsersitzungen abmelden
                    </quad-button>
                </template>
            </quad-dialog-modal>
        </template>
    </quad-action-section>
</template>

<script>
    import { defineComponent } from 'vue';

    import QuadActionMessage from '@/Components/ActionMessage.vue';
    import QuadActionSection from '@/Components/ActionSection.vue';
    import QuadButton from '@/Components/Button.vue';
    import QuadDialogModal from '@/Components/DialogModal.vue';
    import QuadInput from '@/Components/Input.vue';
    import QuadInputError from '@/Components/InputError.vue';

    export default defineComponent({
        props: ['sessions'],
        components: {
            QuadActionMessage,
            QuadActionSection,
            QuadButton,
            QuadDialogModal,
            QuadInput,
            QuadInputError,
        },
        data() {
            return {
                confirmingLogout: false,
                form: this.$inertia.form({
                    password: '',
                })
            }
        },
        methods: {
            confirmLogout() {
                this.confirmingLogout = true
                setTimeout(() => this.$refs.password.focus(), 250)
            },
            logoutOtherBrowserSessions() {
                this.form.delete(route('other-browser-sessions.destroy'), {
                    preserveScroll: true,
                    onSuccess: () => this.closeModal(),
                    onError: () => this.$refs.password.focus(),
                    onFinish: () => this.form.reset(),
                })
            },
            closeModal() {
                this.confirmingLogout = false
                this.form.reset()
            },
        },
    })
</script>