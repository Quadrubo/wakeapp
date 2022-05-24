<template>
    <modal :show="show" :max-width="maxWidth" :closeable="closeable" @close="close">
        <div class="px-6 py-4"> 
            <div class="flex flex-row pb-2 border-b-2">
                <div class="text-xl font-semibold">
                    Kursanmeldung
                </div>
                <div class="ml-auto">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 hover:text-gray-600 active:text-gray-700" viewBox="0 0 20 20" fill="currentColor" @click="close">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </div>
            </div>

            <div class="flex flex-col">
                <div class="mt-4">
                    <slot name="brief"></slot>
                </div>

                <div class="mt-4">
                    <slot name="form"></slot>
                </div>

                <div class="grid grid-cols-1 gap-2 mt-4">
                    <slot name="success"></slot>
                    <slot name="error"></slot>
                </div>
            </div>
            
        </div>

        
        <div class="flex flex-row justify-end px-6 py-4 bg-gray-100 text-right">
            <slot name="footer"></slot>
        </div>
    </modal>
</template>

<script>
    import { defineComponent } from 'vue'
    import Modal from './Modal.vue'
    import QuadAlert from '@/Components/Alert.vue'

    export default defineComponent({
        emits: ['close'],

        components: {
            Modal,
            QuadAlert,
        },

        props: {
            show: {
                default: false
            },
            maxWidth: {
                default: '2xl'
            },
            closeable: {
                default: true
            },
        },

        methods: {
            close() {
                this.$emit('close')
            },
        }
    })
</script>
