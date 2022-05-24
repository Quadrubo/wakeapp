<template>
    <div>
        <a :href="href" :class="classes">
            <slot />
        </a>
    </div>
</template>

<script>
    import { defineComponent } from 'vue';
    import { Link } from '@inertiajs/inertia-vue3';

    export default defineComponent({
        components: {
            Link,
        },

        props: {
            active: Boolean,
            href: String,
            as: String,
            color: {
                type: String,
                default: "blue"
            }
        },

        computed: {
            classes() {
                if (this.active) {
                    return `block pl-3 pr-4 py-2 border-l-4 border-${this.color}-400 text-base font-medium text-${this.color}-700 bg-${this.color}-50 focus:outline-none focus:text-${this.color}-800 focus:bg-${this.color}-100 focus:border-${this.color}-700 transition`;
                } else {
                    return `block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 focus:outline-none focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300 transition`;
                }
            }
        }
    })
</script>
