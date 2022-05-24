

<template>
    <div class="pt-12">
        <div class="flex flex-col items-center justify-center text-center w-full px-4">
            <h1 class="text-red-700 text-6xl font-semibold font-roboto">
                <slot name="title"></slot>
            </h1>
            <h2 class="text-gray-800 text-3xl font-light mt-2">
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
        }
    })
</script>
