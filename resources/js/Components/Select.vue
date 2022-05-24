<template>
    <select :class="classes" class="border-gray-300 focus:ring focus:ring-opacity-50 rounded-md shadow-sm" :value="modelValue" @input="$emit('update:modelValue', $event.target.value)" ref="select">
        <slot></slot>
    </select>
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
        },

        emits: ['update:modelValue'],

        methods: {
            focus() {
                this.$refs.select.focus()
            }
        },

        computed: {
            classes() {
                return `focus:border-${this.color}-300 focus:ring-${this.color}-200`;
            }
        }
    })
</script>
