<template>
    <input type="checkbox" :value="value" v-model="proxyChecked"
           class="rounded border-gray-300 shadow-sm focus:ring focus:ring-opacity-50" :class="classes">
</template>

<script>
import { defineComponent } from 'vue'

export default defineComponent({
    emits: ['update:checked'],

    props: {
        checked: {
            type: [Array, Boolean],
            default: false,
        },
        value: {
            default: null,
        },
        color: {
            type: String,
            default: "blue"
        }
    },

    computed: {
        proxyChecked: {
            get() {
                return this.checked;
            },

            set(val) {
                this.$emit("update:checked", val);
            },
        },

        classes() {
           return `text-${this.color}-600 focus:border-${this.color}-300 focus:ring-${this.color}-200`;
        }
    },
})
</script>
