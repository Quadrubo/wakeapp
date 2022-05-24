

<template>
    <div class="relative" style="height: 65vh;">
        <img :src="src" class="w-full h-full bg-cover object-cover absolute" />
        <div class="opacity-50 bg-gradient-to-t from-gray-900 w-full h-full absolute"></div>
        <div class="flex flex-col items-center justify-center text-center w-full h-full absolute px-4">
            <h1 class="font-bold font-roboto">
                <span class="text-7xl font-[1000]">Studio<span class="text-red-700">27</span></span><br>
                <span class="text-3xl"><span class="text-red-700">Yoga</span> und mehr</span> 
            </h1>
            <h2 class="text-white text-xl font-light mt-2">
                <span>„…und meine Seele spannte weit ihre Flügel aus, zog durch die stillen Lande, als flöge sie nach Haus.“</span><br>
                <span>Joseph von Eichendorff <i>„Mondnacht“</i></span>
            </h2>
            <div class="flex flex-row space-x-4 mt-4">
                <Link href="/kursplan" class="bg-yellow-500 hover:bg-yellow-600 active:bg-yellow-700 focus:border-yellow-700 focus:ring-yellow-300 w-100 items-center px-4 py-3 border border-transparent rounded-md font-semibold text-xs text-black uppercase tracking-widest focus:outline-none focus:ring disabled:opacity-25 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </Link>
                <Link href="/kontakt" class="bg-yellow-500 hover:bg-yellow-600 active:bg-yellow-700 focus:border-yellow-700 focus:ring-yellow-300 w-100 items-center px-4 py-3 border border-transparent rounded-md font-semibold text-xs text-black uppercase tracking-widest focus:outline-none focus:ring disabled:opacity-25 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 4H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-2m-4-1v8m0 0l3-3m-3 3L9 8m-5 5h2.586a1 1 0 01.707.293l2.414 2.414a1 1 0 00.707.293h3.172a1 1 0 00.707-.293l2.414-2.414a1 1 0 01.707-.293H20" />
                    </svg>
                </Link>
                <a href="https://www.instagram.com/studio27yogaundmehr/" target="_blank" class="bg-yellow-500 hover:bg-yellow-600 active:bg-yellow-700 focus:border-yellow-700 focus:ring-yellow-300 w-100 items-center px-4 py-3 border border-transparent rounded-md font-semibold text-xs text-black uppercase tracking-widest focus:outline-none focus:ring disabled:opacity-25 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                    </svg>
                </a>
            </div>
        </div>
    </div>
</template>

<script>
    import { defineComponent } from 'vue';
    import { Link } from '@inertiajs/inertia-vue3';
    import QuadLink from '@/Components/Link.vue';

    export default defineComponent({
        components: {
            Link,
            QuadLink,
        },
        props: {
            src: {
                type: String,
                required: true
            },
        }
    })
</script>
