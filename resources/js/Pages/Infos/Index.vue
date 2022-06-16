<template>
    <app-layout title="Team">

        <div class="py-12">
            <div class="max-w-7xl mx-auto px-6">

                <quad-link href="/infos/create/" color="purple">Erstellen</quad-link>
                
                <section>
                    <div class="container py-6 grid grid-cols-1 gap-4 m-auto">
                        <div v-for="(info, key) in infos" :key="key" class="p-4 items-center col-span-1 flex flex-row justify-between bg-white rounded-lg overflow-hidden shadow-lg mb-10">
                            
                            <!-- eta -->
                            <div>
                                <h3 class="font-semibold text-dark text-2xl">{{ info.eta }}</h3>
                            </div>

                            <!-- from -> to -->
                            <div class="flex flex-row">
                                <div>
                                    {{ info.residence_longitude }} {{ info.residence_latitude }}
                                </div>
                                ------->
                                <div>
                                    {{ info.destination_longitude }} {{ info.destination_latitude }}
                                </div>
                            </div>

                            <div>
                                <p class="font-semibold text-dark text-xl">{{ info.transport_type }}</p>
                            </div>

                            <quad-link :href="'/infos/' + info.id" color="purple">Berechnen</quad-link>
                            <quad-button @click="deleteInfo(info)" color="red">Löschen</quad-button>

                        </div>
                    </div>
                </section>

            </div>
        </div>

    </app-layout>
</template>

<script>
    import { defineComponent } from 'vue'
    import { Inertia } from '@inertiajs/inertia'
    import AppLayout from '@/Layouts/AppLayout.vue'
    import QuadButton from '@/Components/Button.vue'
    import QuadPageImage from '@/Components/PageImage.vue'
    import QuadActionSection from '@/Components/ActionSection.vue'
    import QuadInput from '@/Components/Input.vue'
    import QuadInputError from '@/Components/InputError.vue'
    import QuadLink from '@/Components/Link.vue'


    export default defineComponent({
        components: {
            AppLayout,
            QuadButton,
            QuadPageImage,
            QuadActionSection,
            QuadInput,
            QuadInputError,
            QuadLink
        },
        props: {
            infos: Object
        },

        data() {
            return {
                activeItem: [],
                showingModal: false
            }
        },

        methods: {
            showModal(item) {
                this.activeItem = item;
                this.showingModal = true;
            },

            closeModal() {
                this.showingModal = false;
            },
            deleteInfo(info) {
                this.$inertia.delete(`/infos/${info.id}`);
            }
        },
    })
</script>
