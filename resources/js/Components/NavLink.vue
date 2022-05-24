<template>
    <Link :href="href" :class="classes">
        <slot />
    </Link>
</template>

<script>
    import { defineComponent } from 'vue'
    import { Link } from '@inertiajs/inertia-vue3';

    export default defineComponent({
        components: {
            Link,
        },

        props: {
            href: String,
            active: Boolean,
            color: {
                type: String,
                default: "blue"
            }
        },

        computed: {
            classes() {
                if (this.active) {
                    return `text-base text-${this.color}-500 inline-flex items-center px-1 pt-1 border-b-2 border-${this.color}-400 font-medium leading-5 text-gray-900 focus:outline-none focus:border-${this.color}-700 transition`;
                } else {
                    return `text-base inline-flex items-center px-1 pt-1 border-b-2 border-transparent font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition`;
                }
            }
        }
    })
</script>
