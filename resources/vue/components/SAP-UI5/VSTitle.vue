<template>
    <ui5-title
        :level="props.level"
        :wrapping-type="props.wrappingType"
    >
        <slot />
    </ui5-title>
</template>

<script setup>

import '@ui5/webcomponents/dist/Title';
import { defineProps } from 'vue';

const props = defineProps({
    level: {
        type: String,
        default: 'H2',
        validator(value) {
            return [
                'H1',
                'H2',
                'H3',
                'H4',
                'H5',
                'H6',
            ].includes(value);
        },
    },
    wrappingType: {
        type: String,
        default: 'None',
        validator(value) {
            return [
                'None',
                'Normal',
            ].includes(value);
        },
    },
});

</script>
