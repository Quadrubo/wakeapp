

<template>
    <div class="relative" style="height: 65vh;">
        <img :src="src" class="w-full h-full bg-cover object-cover absolute" />
        <div class="opacity-50 bg-gradient-to-t from-gray-900 w-full h-full absolute"></div>
        <div class="flex flex-col items-center justify-center text-center w-full h-full absolute px-4">
            <h1 class="text-red-700 text-6xl font-bold font-roboto">
                <slot name="title"></slot>
            </h1>
            <h2 class="text-white text-3xl font-light mt-2">
                <slot name="description"></slot>
            </h2>
        </div>
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
            src: {
                type: String,
                required: true
            },
        }
    })
</script>
