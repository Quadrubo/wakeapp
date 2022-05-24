s<template>
    <div>
        <Head :title="title" />

        <div class="min-h-screen bg-gray-100">

            <div class="flex flex-col text-center items-center justify-center h-screen">
                <div class="text-red-900 border-b-4 pb-12">
                    <small class="text-5xl font-semibold uppercase">Error</small>
                    <h1 class="text-9xl font-semibold">
                        <slot name="error-number"></slot>
                    </h1>
                </div>
                <div class="text-gray-500 pt-12 space-y-4">
                    <div class="text-4xl">
                        <slot name="error-title"></slot>
                    </div>
                    <div class="text-xl">
                        <slot name="error-description"></slot>
                    </div>
                </div>
            </div>
            <!-- Page Content -->
            <main>
                <slot></slot>
            </main>
        </div>
    </div>
</template>

<script>
    import { defineComponent } from 'vue'

    import QuadApplicationMark from '@/Components/ApplicationMark.vue'
    import QuadBanner from '@/Components/Banner.vue'
    import QuadDropdown from '@/Components/Dropdown.vue'
    import QuadDropdownLink from '@/Components/DropdownLink.vue'
    import QuadNavLink from '@/Components/NavLink.vue'
    import QuadResponsiveNavLink from '@/Components/ResponsiveNavLink.vue'
    import { Head, Link } from '@inertiajs/inertia-vue3';

    export default defineComponent({
        props: {
            title: String,
        },

        components: {
            Head,
            QuadApplicationMark,
            QuadBanner,
            QuadDropdown,
            QuadDropdownLink,
            QuadNavLink,
            QuadResponsiveNavLink,
            Link,
        },

        computed: {
            console: () => console
        },

        data() {
            return {
                showingNavigationDropdown: false,
            }
        },

        methods: {
            switchToTeam(team) {
                this.$inertia.put(route('current-team.update'), {
                    'team_id': team.id
                }, {
                    preserveState: false
                })
            },

            logout() {
                this.$inertia.post(route('logout'));
            },
        }
    })
</script>
