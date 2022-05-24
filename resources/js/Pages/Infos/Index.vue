<template>
    <app-layout title="Team">

        <div class="py-12">
            <div class="max-w-7xl mx-auto px-6">

                <p>{{ infos }}</p>
                
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


                            <!--<img :src="'/storage/' + teacher.image" :alt="teacher.name" class="w-full" />
                            <div class="pt-4 px-4 text-center h-full">
                                <h3>
                                    <a href="javascript:void(0)" class="font-semibold text-dark text-xl sm:text-[22px] md:text-xl lg:text-[22px] xl:text-xl 2xl:text-[22px] mb-4 block hover:text-primary">
                                        {{ teacher.name }}
                                    </a>
                                </h3>
                                <p v-if="teacher.description" class="text-base text-body-color leading-relaxed mb-7">
                                    <span v-html="teacher.raw_description.length < 150 ? teacher.raw_description : teacher.raw_description.substring(0, 150) + '...' "></span>
                                </p>
                            </div>
                            <div v-if="teacher.description" class="pb-6 text-center">
                                <quad-button color="yellow" @click="showModal(teacher)">Mehr lesen</quad-button>
                            </div>-->
                            

                        </div>
                    </div>
                </section>

            </div>
        </div>

    </app-layout>
</template>

<script>
    import { defineComponent } from 'vue'
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
        },
    })
</script>
