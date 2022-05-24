<template>
    <a :href="href" :class="classes">
        <slot />
    </a>
</template>

<script>
    import { defineComponent } from 'vue'

    export default defineComponent({

        props: {
            href: String,
            color: {
                type: String,
                default: "blue"
            }
        },

        computed: {
            classes() {
                return `inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition`;
            }
        }
    })
</script>
