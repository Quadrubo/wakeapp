<template>
    <app-layout title="Team">

        <div class="py-12">
            <div class="max-w-7xl mx-auto px-6">
                
                <section>
                    <div class="container py-6 grid sm:grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4 m-auto">
                        <div v-for="(teacher, key) in teachers" :key="key" class="col-span-1 flex flex-col bg-white rounded-lg overflow-hidden shadow-lg mb-10">
                            <img :src="'/storage/' + teacher.image" :alt="teacher.name" class="w-full" />
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
                            </div>
                        </div>
                    </div>
                </section>

            </div>
        </div>

        <!-- Delete Account Confirmation Modal -->
        <quad-teacher-modal :show="showingModal" @close="closeModal" max-width="4xl">
            <template #name>
                {{ activeItem.name }}
            </template>

            <template #image>
                <img :src="'/storage/' + activeItem.image" :alt="activeItem.name" class="w-full" />
            </template>

            <template #description>
                <span v-html="activeItem.description"></span>
            </template>

            <template #footer>
                <quad-button color="gray" @click="closeModal">
                    Schließen
                </quad-button>
            </template>
        </quad-teacher-modal>

    </app-layout>
</template>

<script>
    import { defineComponent } from 'vue'
    import AppLayout from '@/Layouts/AppLayout.vue'
    import QuadButton from '@/Components/Button.vue'
    import QuadPageImage from '@/Components/PageImage.vue'
    import QuadActionSection from '@/Components/ActionSection.vue'
    import QuadTeacherModal from '@/Components/TeacherModal.vue'
    import QuadInput from '@/Components/Input.vue'
    import QuadInputError from '@/Components/InputError.vue'


    export default defineComponent({
        components: {
            AppLayout,
            QuadButton,
            QuadPageImage,
            QuadActionSection,
            QuadTeacherModal,
            QuadInput,
            QuadInputError
        },
        props: {
            teachers: Object,
            page_image: Object
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
