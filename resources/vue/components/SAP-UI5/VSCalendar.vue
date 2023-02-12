<template>
    <ui5-calendar
        :format-pattern="props.formatPattern"
        :hide-week-numbers="props.hideWeekNumbers"
        :max-date="props.maxDate"
        :min-date="props.minDate"
        :primary-calendar-type="props.primaryCalendarType"
        :secondary-calendar-type="props.secondaryCalendarType"
        :selection-mode="props.selectionMode"
    >
        <slot />
    </ui5-calendar>
</template>

<script setup>

import '@ui5/webcomponents/dist/Calendar';
import '@ui5/webcomponents-localization/dist/features/calendar/Buddhist';
import '@ui5/webcomponents-localization/dist/features/calendar/Islamic';
import '@ui5/webcomponents-localization/dist/features/calendar/Japanese';
import '@ui5/webcomponents-localization/dist/features/calendar/Persian';
import { defineProps } from 'vue';
import CalendarSelectionMode from '@ui5/webcomponents/dist/types/CalendarSelectionMode';
import CalendarType from '@ui5/webcomponents-base/dist/types/CalendarType';

const props = defineProps({
    hideWeekNumbers: {
        type: Boolean,
        default: undefined,
    },
    selectionMode: {
        type: String,
        default: CalendarSelectionMode.Single,
        validator(value) {
            return [
                CalendarSelectionMode.Single,
                CalendarSelectionMode.Range,
                CalendarSelectionMode.Multiple,
            ].includes(value);
        },
    },
    formatPattern: String,
    maxDate: String,
    minDate: String,
    primaryCalendarType: {
        type: String,
        validator(value) {
            return [
                CalendarType.Gregorian,
                CalendarType.Islamic,
                CalendarType.Japanese,
                CalendarType.Buddhist,
                CalendarType.Persian,
            ].includes(value);
        },
    },
    secondaryCalendarType: {
        type: String,
        validator(value) {
            return [
                CalendarType.Gregorian,
                CalendarType.Islamic,
                CalendarType.Japanese,
                CalendarType.Buddhist,
                CalendarType.Persian,
            ].includes(value);
        },
    },
});

</script>
