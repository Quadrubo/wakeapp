<template>
    <Link :href="'/'">
        <div class="font-bold text-center">
            <span>WakeApp</span>
        </div>
    </Link>
</template>

<script>
    import { defineComponent } from 'vue'
    import { Link } from '@inertiajs/inertia-vue3';

    export default defineComponent({
        components: {
            Link,
        },
    })
</script>
