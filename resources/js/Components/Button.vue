<template>
    <span>
        <button
            :type="type"
            class="w-full items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest focus:outline-none focus:ring disabled:opacity-25 transition"
            :class="classes"
        >
            <slot></slot>
        </button>
    </span>
</template>

<script>
    import { defineComponent } from 'vue';
    
    export default defineComponent({
        props: {
            type: {
                type: String,
                default: null
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
        computed: {
            classes() {
                return `bg-${this.color}-${500 + this.strength} hover:bg-${this.color}-${600 + this.strength} active:bg-${this.color}-${700 + this.strength}} focus:border-${this.color}-${700 + this.strength} focus:ring-${this.color}-${300 + this.strength}`;
            }
        }
    })
</script>