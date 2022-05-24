<template>
    <app-layout title="Start">

        <quad-front-page-image :src="'/storage/' + (page_image ? page_image.image : null)">
        </quad-front-page-image>

        <div class="py-12">
            <div class="max-w-7xl mx-auto px-6">
                
                <section>
                    <div class="container py-6 grid grid-cols-1 m-auto">
                        <div v-for="(single_news, key) in news" :key="key" class="col-span-1 flex flex-col bg-white rounded-xl overflow-hidden shadow-lg mb-10">
                            <div class="p-4 h-full">
                                <p class="text-yellow-500 font-extrabold">{{ single_news.tag }}</p>
                                <h3 class="font-semibold text-dark text-xl block">
                                    {{ single_news.title }}
                                </h3>
                                <p class="text-gray-700 pb-2 border-b-2">
                                    {{ single_news.date }}
                                </p>
                                <article v-if="single_news.description" v-html="convert(single_news.description)" class="prose max-w-none">
                                </article>
                            </div>
                        </div>
                    </div>
                </section>

                <section>
                    <div class="flex flex-col bg-white rounded-xl overflow-hidden shadow-lg mb-10">
                        <div class="p-4 h-full space-y-2">
                            <h2 class="font-semibold text-dark text-2xl">
                                Anfahrt
                            </h2>
                            <p>
                                Unser Studio befindet sich in der <a href="https://www.google.com/maps/place/Studio27+-+Yoga+und+mehr/@52.418004,13.303603,17z/data=!3m1!4b1!4m5!3m4!1s0x47a85b2b75e1a063:0x4a740ca5f6284e33!8m2!3d52.418004!4d13.3057917" target="_blank" class="underline">Lindenstr. 27</a>, 12207 Berlin.
                            </p>
                            <iframe 
                                width=""
                                height="550"
                                src="https://maps.google.de/maps?hl=de&q=Yoga-Studio27%20%20+Lindenstr.+27%20Berlin&t=&z=14&ie=utf8&iwloc=b&output=embed"
                                frameborder="0"
                                scrolling="no"
                                marginheight="0"
                                marginwidth="0"
                                class="border-y-2 py-2 w-full">
                            </iframe>
                            <p>Wir freuen uns auf Sie!</p>
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
    import QuadFrontPageImage from '@/Components/FrontPageImage.vue'
    import QuadActionSection from '@/Components/ActionSection.vue'
    import QuadInput from '@/Components/Input.vue'
    import QuadInputError from '@/Components/InputError.vue'

    export default defineComponent({
        components: {
            AppLayout,
            QuadButton,
            QuadFrontPageImage,
            QuadActionSection,
            QuadInput,
            QuadInputError
        },
        props: {
            news: Object,
            page_image: Object
        },

        data() {
            return {
                activeItem: [],
                showingModal: false
            }
        }
        
    })
</script>
