<template>
    <ui5-label
        :for="props.for"
        :required="props.required"
        :show-colon="props.showColon"
        :wrapping-type="props.wrappingType"
    >
        <slot />
    </ui5-label>
</template>

<script setup>

import '@ui5/webcomponents/dist/Label';
import { defineProps } from 'vue';

const props = defineProps({
    for: String,
    required: {
        type: Boolean,
        default: undefined,
    },
    showColon: {
        type: Boolean,
        default: undefined,
    },
    wrappingType: {
        type: Boolean,
        default: undefined,
    },
});

</script>
