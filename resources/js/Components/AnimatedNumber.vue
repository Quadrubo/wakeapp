<template>
    <p :class="computeNumberClasses">
        {{ displayNumber }}
    </p>
    <p :class="computeTextClasses">
        {{ displayText }}
    </p>
</template>

<script>
    import { defineComponent } from 'vue';
    
    export default defineComponent({
        props: {
            startNumber: {
                type: Number,
                required: true
            },
            endNumber: {
                type: Number,
                required: true
            },
            startText: {
                type: String,
                default: ''
            },
            endText: {
                type: String,
                default: ''
            },
            divisionAmount: {
                type: Number,
                default: 10
            },
            delay: {
                type: Number,
                default: 20
            },
            endValue: {
                type: String,
                default: undefined
            },
            numberClasses: {
                type: String,
                default: ''
            },
            textClasses: {
                type: String,
                default: ''
            }
        },
        data: function() {
            return {
                displayNumber: 0,
                displayText: '',
                interval: false
            }
        },
        mounted: function () {
            this.displayNumber = this.startNumber;
        },
        methods: {
            resetNumber() {
                clearInterval(this.interval);
                this.displayNumber = this.startNumber;
                this.displayText = this.startText;
            },
            animateNumber() {
                this.resetNumber();

                if (this.endNumber == this.displayNumber) {
                    return;
                }

                this.interval = window.setInterval(function() {
                    if (this.displayNumber != this.endNumber) {
                        var change = (this.endNumber - this.displayNumber) / this.divisionAmount;

                        change = change >= 0 ? Math.ceil(change) : Math.floor(change);

                        if (this.displayNumber + change == this.endNumber) {
                            if (this.endValue != undefined) {
                                this.displayNumber = this.endValue;
                            }
                            this.displayText = this.endText;
                            clearInterval(this.interval);
                        } else {
                            this.displayNumber = this.displayNumber + change;
                        } 
                    }
                }.bind(this), this.delay);

            }
        },
        computed: {
            computeNumberClasses() {
                return this.numberClasses;
            },
            computeTextClasses() {
                return this.textClasses;
            }
        }
    })
</script>