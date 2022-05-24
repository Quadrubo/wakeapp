<template>
    <app-layout title="Start">

        <div class="py-12">
            <div class="max-w-7xl mx-auto px-6">
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
        },

        data() {
            return {
                activeItem: [],
                showingModal: false
            }
        }

    })
</script>
