<template>
    <ui5-avatar
        :accessible-name="props.accessibleName"
        :color-scheme="props.colorScheme"
        :icon="props.icon"
        :initials="props.initials"
        :interactive="props.interactive"
        :shape="props.shape"
        :size="props.size"
    >
        <slot />
        <slot name="badge" />
    </ui5-avatar>
</template>

<script setup>

import '@ui5/webcomponents/dist/Avatar.js';
import { defineProps } from 'vue';

const props = defineProps({
    accessibleName: String,
    colorScheme: {
        type: String,
        default: 'Accent6',
        validator(value) {
            return [
                'Accent1',
                'Accent2',
                'Accent3',
                'Accent4',
                'Accent5',
                'Accent6',
                'Accent7',
                'Accent8',
                'Accent9',
                'Accent10',
                'Placeholder',
            ].includes(value);
        },
    },
    icon: String,
    initials: String,
    interactive: {
        type: Boolean,
        default: undefined,
    },
    shape: {
        type: String,
        default: 'Circle',
        validator(value) {
            return [
                'Square',
                'Circle',
            ].includes(value);
        },
    },
    size: {
        type: String,
        default: 'S',
        validator(value) {
            return [
                'XS',
                'S',
                'M',
                'L',
                'XL',
            ].includes(value);
        },
    },
});

</script>
