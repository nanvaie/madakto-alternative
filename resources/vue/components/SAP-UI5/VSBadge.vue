<template>
    <ui5-badge :color-scheme="props.colorScheme">
        <slot />
        <slot
            slot="icon"
            name="icon"
        />
    </ui5-badge>
</template>

<script setup>

import '@ui5/webcomponents/dist/Badge';
import { defineProps } from 'vue';

const props = defineProps({
    colorScheme: {
        type: String,
        validator(value) {
            return value >= '1' && value <= '10';
        },
    },
});

</script>
