<template>
    <div>
        <Head :title="title" />
        
        <quad-banner />

        <div class="flex flex-col min-h-screen justify-between bg-gray-100">
            <nav class="bg-white border-b border-gray-100 sticky top-0 z-50">
                <!-- Primary Navigation Menu -->
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex">
                            <!-- Logo -->
                            <div class="shrink-0 flex items-center">
                                <Link :href="route('home')">
                                    <quad-application-mark class="block h-9 w-auto" />
                                </Link>
                            </div>

                            <!-- Navigation Links -->
                            <div class="hidden space-x-8 lg:-my-px lg:ml-10 lg:flex">
                                <quad-nav-link :href="route('home')" :active="route().current('home')" color="red">
                                    Start
                                </quad-nav-link>
                                <quad-nav-link :href="route('infos.index')" :active="route().current('infos.index')" color="red">
                                    Infos
                                </quad-nav-link>
                            </div>
                        </div>

                        <div v-if="$page.props.user !== null" class="hidden lg:flex lg:items-center lg:ml-6">

                            <!-- Settings Dropdown -->
                            <div class="ml-3 relative">
                                <quad-dropdown align="right" width="48">
                                    <template #trigger>
                                        <span class="inline-flex rounded-md">
                                            <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-base leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-red-500 focus:text-red-500 focus:outline-none transition">
                                                Mein Profil

                                                <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                        </span>
                                    </template>

                                    <template #content>
                                        <!-- Account Management -->
                                        <div class="block px-4 py-2 text-sm text-gray-400">
                                            Mein Account
                                        </div>

                                        <quad-dropdown-link :href="route('profile.show')" :active="route().current('profile.show')">
                                            Einstellungen
                                        </quad-dropdown-link>
                                        
                                        <div class="border-t border-gray-100"></div>

                                        <!-- Authentication -->
                                        <form @submit.prevent="logout">
                                            <quad-dropdown-link as="button">
                                                Ausloggen
                                            </quad-dropdown-link>
                                        </form>
                                    </template>
                                </quad-dropdown>
                            </div>
                        </div>

                        <div v-else class="flex">
                            <div class="hidden space-x-8 lg:-my-px lg:ml-10 lg:flex">
                                <quad-nav-link :href="route('login')">
                                    Einloggen
                                </quad-nav-link>
                                <quad-nav-link :href="route('register')">
                                    Registrieren
                                </quad-nav-link>
                            </div>
                        </div>

                        <!-- Hamburger -->
                        <div class="-mr-2 flex items-center lg:hidden">
                            <button @click="showingNavigationDropdown = ! showingNavigationDropdown" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition">
                                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                    <path :class="{'hidden': showingNavigationDropdown, 'inline-flex': ! showingNavigationDropdown }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                    <path :class="{'hidden': ! showingNavigationDropdown, 'inline-flex': showingNavigationDropdown }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Responsive Navigation Menu -->
                <div :class="{'block': showingNavigationDropdown, 'hidden': ! showingNavigationDropdown}" class="lg:hidden">
                    <div class="pt-2 pb-3 space-y-1">
                        <quad-responsive-nav-link :href="route('home')" :active="route().current('home')" color="red">
                            Start
                        </quad-responsive-nav-link>
                         <quad-responsive-nav-link :href="route('infos.index')" :active="route().current('infos.index')" color="red">
                            Info
                        </quad-responsive-nav-link>
                    </div>

                    <!-- Responsive Settings Options -->
                    <div v-if="$page.props.user !== null">
                        <div class="pb-1 border-t border-gray-200">
                            <div class="mt-3 space-y-1">
                                <quad-responsive-nav-link :href="route('profile.show')" :active="route().current('profile.show')" color="red">
                                    Einstellungen
                                </quad-responsive-nav-link>
                            </div>
                        </div>
                        <div class="pb-1 border-t border-gray-200">
                            <div class="mt-1 space-y-1">
                                <!-- Authentication -->
                                <form method="POST" @submit.prevent="logout">
                                    <quad-responsive-nav-link as="button" color="red">
                                        Ausloggen
                                    </quad-responsive-nav-link>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div v-else>
                        <div class="pb-1 border-t border-gray-200">
                            <div class="mt-3 space-y-1">
                                <quad-responsive-nav-link :href="route('login')" :active="route().current('login')" color="red">
                                    Einloggen
                                </quad-responsive-nav-link>

                                <quad-responsive-nav-link :href="route('register')" :active="route().current('register')" color="red">
                                    Registrieren
                                </quad-responsive-nav-link>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Page Content -->
            <main class="mb-auto">
                <slot></slot>
            </main>

        </div>
    </div>
</template>

<script>
    import { defineComponent } from 'vue'

    import QuadApplicationMark from '@/Components/ApplicationMark.vue';
    import QuadBanner from '@/Components/Banner.vue';
    import QuadDropdown from '@/Components/Dropdown.vue';
    import QuadDropdownLink from '@/Components/DropdownLink.vue';
    import QuadNavLink from '@/Components/NavLink.vue';
    import QuadResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
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
            logout() {
                this.$inertia.post(route('logout'));
            },
        }
    })
</script>
