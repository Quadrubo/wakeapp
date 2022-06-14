<template>
    <app-layout title="Create Info">

        <div class="py-12">
            <div class="max-w-7xl mx-auto px-6">

                <div class="bg-white p-4 shadow-lg rounded-lg">

                    <h1 class="font-semibold text-2xl">Moin</h1>

                    <form @submit.prevent="submit">

                        <!-- Ankunftszeit -->
                        <div class="mt-4">
                            <quad-label for="eta" value="Ankunftszeit"/>
                            <quad-input id="eta" type="time" class="mt-1 block w-full" v-model="form.eta" color="purple" required autofocus />
                        </div>

                        <!-- Benöigte Zeit zum Fertigmachen -->
                        <div class="mt-4">
                            <quad-label for="time_to_get_up" value="Benötigte Zeit zum Fertigmachen (min.)"/>
                            <quad-input id="time_to_get_up" type="number" class="mt-1 block w-full" v-model="form.time_to_get_up" color="purple" required/>
                        </div>

                        <div class="mt-4">
                            <quad-label for="residence" value="Wohnort" />
                            <quad-input id="residence" type="text" class="mt-1 block w-full" v-model="form.residence" color="yellow" :strength="200" required/>
                        </div>

                        <div class="mt-4">
                            <quad-label for="destination" value="Zielort" />
                            <quad-input id="destination" type="text" class="mt-1 block w-full" v-model="form.destination" color="yellow" :strength="200" required/>
                        </div>

                        <div class="mt-4">
                            <quad-label for="transport_type" value="Weg zur Schule" />
                            <quad-select id="transport_type" class="mt-1 block w-full" v-model="form.transport_type" color="yellow" :strength="200" required>
                                <option value="opnv">ÖPNV</option>
                                <option value="auto">Auto</option>
                            </quad-select>
                        </div>

                        <div class="mt-4 flex flex-row space-x-2">
                            <quad-button id="calculate" class="inline mt-1 w-1/2" type="submit" color="yellow" :strength="100">Berechnen</quad-button>
                            <quad-button id="save" class="mt-1 w-3/4" type="submit" color="yellow" :strength="100">Speichern</quad-button>
                        </div>
                    </form>

                </div>

            </div>
        </div>

    </app-layout>

</template>

<script>
    import { defineComponent } from 'vue'
    import { Head, Link } from '@inertiajs/inertia-vue3';

    import AppLayout from '@/Layouts/AppLayout.vue'

    import QuadAuthenticationCard from '@/Components/AuthenticationCard.vue'
    import QuadAuthenticationCardLogo from '@/Components/AuthenticationCardLogo.vue'
    import QuadSelect from '@/Components/Select.vue'
    import QuadButton from '@/Components/Button.vue'
    import QuadInput from '@/Components/Input.vue'
    import QuadCheckbox from '@/Components/Checkbox.vue'
    import QuadLabel from '@/Components/Label.vue'
    import QuadValidationErrors from '@/Components/ValidationErrors.vue'

    export default defineComponent({
        components: {
            Head,
            Link,
            AppLayout,
            QuadAuthenticationCard,
            QuadAuthenticationCardLogo,
            QuadButton,
            QuadInput,
            QuadCheckbox,
            QuadLabel,
            QuadSelect,
            QuadButton,
            QuadValidationErrors
        },
        data() {
            return {
                form: this.$inertia.form({
                    eta: '',
                    time_to_get_up: '',
                    residence: '',
                    destination: '',
                    transport_type: ''       
                })
            }
        },
        methods: {
            submit() {
                this.form.post(this.route('infos.store'), {
                    onFinish: () => this.form.reset('eta', 'time_to_get_up', 'residence', 'destination', 'transport_type'),
                })
            }
        }
    })
</script>