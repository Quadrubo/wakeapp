<template>
    <app-layout title="Show Info">

        <div class="py-12">
            <div class="max-w-7xl mx-auto px-6">

                <div class="bg-white p-4 shadow-lg rounded-lg">

                    <h1 class="font-semibold text-2xl">Route berechnen</h1>
    
                    <p>Aufstehzeit: {{ info.wake_time }}</p>
                    <p>MussLosZeit: {{ info.start_time }}</p>
                    <p>Ankunftszeit: {{ info.arrival_time }}</p>

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
                //
            }
        },
        props: {
            info: Object,
        },
        methods: {
            submit() {
                this.form.post(this.route('infos.store'), {
                    // onFinish: () => this.form.reset('eta', 'time_to_get_up', 'residence', 'destination', 'transport_type'),
                })
            },
            calculate() {
                console.log(this.form);
                this.form.post(this.route('infos.calc'), {
                    
                });
            }
        }
    })
</script>