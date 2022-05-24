<template>
    <quad-action-section>
        <template #title>
            Two Factor Authentication
        </template>

        <template #description>
            Add additional security to your account using two factor authentication.
        </template>

        <template #content>
            <h3 class="text-lg font-medium text-gray-900" v-if="twoFactorEnabled">
                You have enabled two factor authentication.
            </h3>

            <h3 class="text-lg font-medium text-gray-900" v-else>
                You have not enabled two factor authentication.
            </h3>

            <div class="mt-3 max-w-xl text-sm text-gray-600">
                <p>
                    When two factor authentication is enabled, you will be prompted for a secure, random token during authentication. You may retrieve this token from your phone's Google Authenticator application.
                </p>
            </div>

            <div v-if="twoFactorEnabled">
                <div v-if="qrCode">
                    <div class="mt-4 max-w-xl text-sm text-gray-600">
                        <p class="font-semibold">
                            Two factor authentication is now enabled. Scan the following QR code using your phone's authenticator application.
                        </p>
                    </div>

                    <div class="mt-4" v-html="qrCode">
                    </div>
                </div>

                <div v-if="recoveryCodes.length > 0">
                    <div class="mt-4 max-w-xl text-sm text-gray-600">
                        <p class="font-semibold">
                            Store these recovery codes in a secure password manager. They can be used to recover access to your account if your two factor authentication device is lost.
                        </p>
                    </div>

                    <div class="grid gap-1 max-w-xl mt-4 px-4 py-4 font-mono text-sm bg-gray-100 rounded-lg">
                        <div v-for="code in recoveryCodes" :key="code">
                            {{ code }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-5">
                <div v-if="! twoFactorEnabled">
                    <quad-confirms-password @confirmed="enableTwoFactorAuthentication">
                        <quad-button type="button" :class="{ 'opacity-25': enabling }" :disabled="enabling" color="yellow" :strength="100">
                            Enable
                        </quad-button>
                    </quad-confirms-password>
                </div>

                <div v-else>
                    <quad-confirms-password @confirmed="regenerateRecoveryCodes">
                        <quad-button class="mr-3"
                                        v-if="recoveryCodes.length > 0" color="gray">
                            Regenerate Recovery Codes
                        </quad-button>
                    </quad-confirms-password>

                    <quad-confirms-password @confirmed="showRecoveryCodes">
                        <quad-button class="mr-3" v-if="recoveryCodes.length === 0" color="gray">
                            Show Recovery Codes
                        </quad-button>
                    </quad-confirms-password>

                    <quad-confirms-password @confirmed="disableTwoFactorAuthentication">
                        <quad-button
                                        :class="{ 'opacity-25': disabling }"
                                        :disabled="disabling" color="yellow" :strength="100">
                            Disable
                        </quad-button>
                    </quad-confirms-password>
                </div>
            </div>
        </template>
    </quad-action-section>
</template>

<script>
    import { defineComponent } from 'vue'
    import QuadActionSection from '@/Components/ActionSection.vue'
    import QuadButton from '@/Components/Button.vue'
    import QuadConfirmsPassword from '@/Components/ConfirmsPassword.vue'

    export default defineComponent({
        components: {
            QuadActionSection,
            QuadButton,
            QuadConfirmsPassword,
        },

        data() {
            return {
                enabling: false,
                disabling: false,

                qrCode: null,
                recoveryCodes: [],
            }
        },

        methods: {
            enableTwoFactorAuthentication() {
                this.enabling = true

                this.$inertia.post('/user/two-factor-authentication', {}, {
                    preserveScroll: true,
                    onSuccess: () => Promise.all([
                        this.showQrCode(),
                        this.showRecoveryCodes(),
                    ]),
                    onFinish: () => (this.enabling = false),
                })
            },

            showQrCode() {
                return axios.get('/user/two-factor-qr-code')
                        .then(response => {
                            this.qrCode = response.data.svg
                        })
            },

            showRecoveryCodes() {
                return axios.get('/user/two-factor-recovery-codes')
                        .then(response => {
                            this.recoveryCodes = response.data
                        })
            },

            regenerateRecoveryCodes() {
                axios.post('/user/two-factor-recovery-codes')
                        .then(response => {
                            this.showRecoveryCodes()
                        })
            },

            disableTwoFactorAuthentication() {
                this.disabling = true

                this.$inertia.delete('/user/two-factor-authentication', {
                    preserveScroll: true,
                    onSuccess: () => (this.disabling = false),
                })
            },
        },

        computed: {
            twoFactorEnabled() {
                return ! this.enabling && this.$page.props.user.two_factor_enabled
            }
        }
    })
</script>
