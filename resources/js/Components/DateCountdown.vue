<template>
    <div class="grid justify-items-center text-center gap-4" :class="classes">
        <div v-if="this.years">
            <p :class="computeNumberClasses">{{ displayYears }}</p>
            <p :class="computeTextClasses">Jahr<span v-if="displayYears != '1'">e</span></p>
        </div>
        <div v-if="this.months">
            <p :class="computeNumberClasses">{{ displayMonths }}</p>
            <p :class="computeTextClasses">Monat<span v-if="displayMonths != '1'">e</span></p>
        </div>
        <div v-if="this.weeks">
            <p :class="computeNumberClasses">{{ displayWeeks }}</p>
            <p :class="computeTextClasses">Woche<span v-if="displayWeeks != '1'">n</span></p>
        </div>
        <div v-if="this.days">
            <p :class="computeNumberClasses">{{ displayDays }}</p>
            <p :class="computeTextClasses">Tag<span v-if="displayDays != '1'">e</span></p>
        </div>
        <div v-if="this.hours">
            <p :class="computeNumberClasses">{{ displayHours }}</p>
            <p :class="computeTextClasses">Stunde<span v-if="displayHours != '1'">n</span></p>
        </div>
        <div v-if="this.minutes">
            <p :class="computeNumberClasses">{{ displayMinutes }}</p>
            <p :class="computeTextClasses">Minute<span v-if="displayMinutes != '1'">n</span></p>
        </div>
        <div v-if="this.seconds">
            <p :class="computeNumberClasses">{{ displaySeconds }}</p>
            <p :class="computeTextClasses">Sekunde<span v-if="displaySeconds != '1'">n</span></p>
        </div>
    </div>
    
</template>

<script>
    import { defineComponent } from 'vue';
    
    export default defineComponent({
        props: {
            date: {
                type: Date,
                required: true
            },
            years: {
                type: Boolean,
                default: true
            },
            months: {
                type: Boolean,
                default: true
            },
            weeks: {
                type: Boolean,
                default: false
            },
            days: {
                type: Boolean,
                default: true
            },
            hours: {
                type: Boolean,
                default: true
            },
            minutes: {
                type: Boolean,
                default: true
            },
            seconds: {
                type: Boolean,
                default: true
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
                timeSince: 0,
                displayYears: 0,
                displayMonths: 0,
                displayWeeks: 0,
                displayDays: 0,
                displayHours: 0,
                displayMinutes: 0,
                displaySeconds: 0
            }
        },
        mounted: function () {
            this.timer();
        },
        methods: {
            timer() {
                const self = this;
                setInterval(function() {
                    self.refreshTimeSince();
                }, 1000);
            },
            refreshTimeSince() {
                let seconds = Math.floor((new Date() - this.date) / 1000);
                let secondsRemaining = seconds;
                let factor = 31356000;

                if (this.years) {
                    this.displayYears = Math.floor(secondsRemaining / factor);
                    secondsRemaining = Math.round(((secondsRemaining / factor) % 1) * factor);
                }

                factor = 2592000;
                if (this.months) {
                    this.displayMonths = Math.floor(secondsRemaining / factor);
                    secondsRemaining = Math.round(((secondsRemaining / factor) % 1) * factor);
                }

                factor = 604800;
                if (this.weeks) {
                    this.displayWeeks = Math.floor(secondsRemaining / factor);
                    secondsRemaining = Math.round(((secondsRemaining / factor) % 1) * factor);
                }

                factor = 86400;
                if (this.days) {
                    this.displayDays = Math.floor(secondsRemaining / factor);
                    secondsRemaining = Math.round(((secondsRemaining / factor) % 1) * factor);
                }

                factor = 3600;
                if (this.hours) {
                    this.displayHours = Math.floor(secondsRemaining / factor);
                    secondsRemaining = Math.round(((secondsRemaining / factor) % 1) * factor);
                }

                factor = 60;
                if (this.minutes) {
                    this.displayMinutes = Math.floor(secondsRemaining / factor);
                    secondsRemaining = Math.round(((secondsRemaining / factor) % 1) * factor);
                }

                factor = 1;
                if (this.seconds) {
                    this.displaySeconds = Math.floor(secondsRemaining / factor);
                    secondsRemaining = Math.round(((secondsRemaining / factor) % 1) * factor);
                }
            }
        },
        computed: {
           classes() {
                let units = [this.years, this.months, this.weeks, this.days, this.hours, this.minutes, this.seconds];
                let unitCounter = 0;
                units.forEach(unit => {
                    if (unit) {
                        unitCounter++;
                    }
                });
                return "grid-cols-" + Math.ceil(unitCounter / 2) + " sm:grid-cols-" + unitCounter;
            },
            computeNumberClasses() {
                return this.numberClasses;
            },
            computeTextClasses() {
                return this.textClasses;
            }
        }  
    })
</script>