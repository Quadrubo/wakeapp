<template>
    <teleport to="body">
        <transition leave-active-class="duration-500">
            <div id="overflow_div" v-show="show" class="fixed inset-0 h-screen overflow-y-auto sm:overflow-y-none z-50" scroll-region>
                <transition id="enter_transition" enter-active-class="ease-out duration-300"
                        enter-from-class="opacity-0"
                        enter-to-class="opacity-100"
                        leave-active-class="ease-in duration-200"
                        leave-from-class="opacity-100"
                        leave-to-class="opacity-0">
                    <div v-show="show" class="fixed inset-0 transform transition-all" @click="close">
                        <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                    </div>
                </transition>

                <transition enter-active-class="ease-out duration-300"
                        enter-from-class="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                        enter-to-class="opacity-100 translate-y-0 sm:scale-100"
                        leave-active-class="ease-in duration-200"
                        leave-from-class="opacity-100 translate-y-0 sm:scale-100"
                        leave-to-class="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                        <div id="center_div" v-show="show" class="flex w-screen h-screen justify-center items-center transform transition-all" @click="close">
                            <div class="sm:mb-6 bg-white rounded-lg overflow-hidden shadow-xl sm:w-full sm:mx-auto" :class="maxWidthClass" @click.stop="">
                                <slot></slot>
                            </div>
                        </div>
                </transition>
                
            </div>

        </transition>
    </teleport>
</template>

<script>
import { defineComponent, onMounted, onUnmounted } from "vue";

export default defineComponent({
        emits: ['close'],

        props: {
            show: {
                default: false
            },
            maxWidth: {
                default: '2xl'
            },
            closeable: {
                default: true
            },
        },

        data() {
            return {
                scrollbarWidth: null,
            }
        },

        watch: {
            show: {
                immediate: false,
                handler(show) {
                    if (show) {
                        document.body.style.overflow = 'hidden';
                        document.body.classList.add(`pr-[${this.scrollbarWidth}px]`);
                    } else {
                        document.body.style.overflow = null;
                        document.body.classList.remove(`pr-[${this.scrollbarWidth}px]`);
                    }
                }
            }
        },

        setup(props, {emit}) {
            const close = () => {
                if (props.closeable) {
                    emit('close')
                }
            }

            const closeOnEscape = (e) => {
                if (e.key === 'Escape' && props.show) {
                    close()
                }
            }

            onMounted(() => {
                document.addEventListener('keydown', closeOnEscape);
                const transition = document.getElementById("enter_transition").addEventListener('transitionend', () => {
                    if (document.getElementById("overflow_div").scrollHeight > document.getElementById("overflow_div").clientHeight || document.getElementById("overflow_div").scrollWidth > document.getElementById("overflow_div").clientWidth) {
                        document.getElementById("center_div").classList.remove('h-screen');
                    } else {
                        document.getElementById("center_div").classList.add('h-screen');
                    }
                });
            }) 
            onUnmounted(() => {
                document.removeEventListener('keydown', closeOnEscape)
                document.body.style.overflow = null
            })

            return {
                close,
            }
        },

        mounted() {
            this.scrollbarWidth = this.getScrollbarWidth();
        },

        computed: {
            maxWidthClass() {
                return {
                    'sm': 'sm:max-w-sm',
                    'md': 'sm:max-w-md',
                    'lg': 'sm:max-w-lg',
                    'xl': 'sm:max-w-xl',
                    '2xl': 'sm:max-w-2xl',
                    '3xl': 'sm:max-w-3xl',
                    '4xl': 'sm:max-w-4xl',
                }[this.maxWidth]
            }
        },

        methods: {
            getScrollbarWidth() {
                // Creating invisible container
                const outer = document.createElement('div');
                outer.style.visibility = 'hidden';
                outer.style.overflow = 'scroll'; // forcing scrollbar to appear
                outer.style.msOverflowStyle = 'scrollbar'; // needed for WinJS apps
                document.body.appendChild(outer);

                // Creating inner element and placing it in the container
                const inner = document.createElement('div');
                outer.appendChild(inner);

                // Calculating difference between container's full width and the child width
                const scrollbarWidth = (outer.offsetWidth - inner.offsetWidth);

                // Removing temporary elements from the DOM
                outer.parentNode.removeChild(outer);

                return scrollbarWidth;
            }
        }
    })
</script>
