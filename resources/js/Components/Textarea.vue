<template>
    <textarea :class="classes" class="border-gray-300 focus:ring focus:ring-opacity-50 rounded-md shadow-sm" rows="6" :value="modelValue" @input="$emit('update:modelValue', $event.target.value)" ref="input">
    </textarea>
</template>

<script>
    import { defineComponent } from 'vue'

    export default defineComponent({
        props: {
            modelValue: {
                type: String
            },
            color: {
                type: String,
                default: 'blue'
            },
            strength: {
                type: Number,
                default: 0
            }
        },

        emits: ['update:modelValue'],

        methods: {
            focus() {
                this.$refs.input.focus()
            }
        },

        computed: {
            classes() {
                return `focus:border-${this.color}-${300 + this.strength}  focus:ring-${this.color}-${200 + this.strength}`;
            }
        }
    })
</script>
