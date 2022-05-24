<template>

    <div :class="classes" v-show="!this.isEmpty(this.$slots.default)" role="alert"> 
        <p class="mr-1">
            <slot></slot>
        </p>
    </div>
    
</template>

<script>
    import { defineComponent } from 'vue';
    
    export default defineComponent({
        props: {
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
                return `bg-${this.color}-${100 + this.strength} rounded-lg py-5 px-6 text-base text-${this.color}-${700 + this.strength} inline-flex items-center w-full fade show`;
            },
            
        },

        methods: {
            isEmpty(slot, data) {
                return slot(data)[0].children == '';
            }
        }

    });


</script>