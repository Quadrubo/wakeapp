<template>
    <Head title="E-Mail-Verifizierung" />

    <quad-authentication-card>
        <template #logo>
            <quad-authentication-card-logo class="text-5xl" />
        </template>

        <div class="mb-4 text-sm text-gray-600">     
            Danke fürs Registrieren! Könnten Sie, bevor Sie beginnen, Ihre E-Mail-Adresse bestätigen, indem Sie auf den Link klicken, den wir Ihnen gerade per E-Mail gesendet haben? Sollten Sie die E-Mail nicht erhalten haben, senden wir Ihnen gerne eine Weitere zu.
        </div>

        <div class="mb-4 font-medium text-sm text-green-600" v-if="verificationLinkSent" >
            Ein neuer Bestätigungslink wurde an die E-Mail-Adresse gesendet, die Sie bei der Registrierung angegeben haben.
        </div>

        <form @submit.prevent="submit">
            <div class="mt-4 flex items-center justify-between">
                <quad-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing" color="yellow" :strength="100">
                    Bestätigungsmail erneut senden
                </quad-button>

                <Link :href="route('logout')" method="post" as="button" class="underline text-sm text-gray-600 hover:text-gray-900">Ausloggen</Link>
            </div>
        </form>
    </quad-authentication-card>
</template>

<script>
    import { defineComponent } from 'vue';
    import { Head, Link } from '@inertiajs/inertia-vue3';

    import QuadAuthenticationCard from '@/Components/AuthenticationCard.vue'
    import QuadAuthenticationCardLogo from '@/Components/AuthenticationCardLogo.vue'
    import QuadButton from '@/Components/Button.vue'
    
    export default defineComponent({
        components: {
            Head,
            Link,
            QuadAuthenticationCard,
            QuadAuthenticationCardLogo,
            QuadButton
        },
        props: {
            status: String
        },
        data() {
            return {
                form: this.$inertia.form()
            }
        },
        methods: {
            submit() {
                this.form.post(this.route('verification.send'))
            },
        },
        computed: {
            verificationLinkSent() {
                return this.status === 'verification-link-sent';
            }
        }
    })
</script>