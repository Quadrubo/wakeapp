<template>
    <span>
        <Link
            :href="href" 
            class="w-100 items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest focus:outline-none focus:ring disabled:opacity-25 transition"
            :class="classes"
            :method="method"
            preserve-scroll
        >
            <slot></slot>
        </Link>
    </span>
</template>

<script>
    import { defineComponent } from 'vue';
    import { Link } from '@inertiajs/inertia-vue3';

    export default defineComponent({
        components: {
            Link
        },

        props: {
            href: {
                type: String,
                default: null
            },
            method: {
                type: String,
                default: 'get'
            },
            color: {
                type: String,
                default: 'blue'
            },
        },
        computed: {
            classes() {
                return `bg-${this.color}-500 hover:bg-${this.color}-600 active:bg-${this.color}-700 focus:border-${this.color}-700 focus:ring-${this.color}-300`;
            }
        }
    })
</script>