<template>
    <ui5-button
        :slot="props.slot"
        :accessibility-attributes="props.accessibilityAttributes"
        :accessible-name="props.accessibleName"
        :accessible-name-ref="props.accessibleNameRef"
        :design="props.design"
        :disabled="props.disabled ? props.disabled : null"
        :icon="props.icon"
        :icon-end="props.iconEnd"
        :submits="props.submits"
        :tooltip="props.tooltip"
    >
        <slot />
    </ui5-button>
</template>

<script setup>

import '@ui5/webcomponents/dist/Button';
import { defineProps } from 'vue';
import ButtonDesign from '@ui5/webcomponents/dist/types/ButtonDesign';

const props = defineProps({
    accessibilityAttributes: Object,
    accessibleName: String,
    accessibleNameRef: String,
    design: {
        type: String,
        default: ButtonDesign.Default,
        validator(value) {
            return [
                ButtonDesign.Default,
                ButtonDesign.Emphasized,
                ButtonDesign.Positive,
                ButtonDesign.Negative,
                ButtonDesign.Transparent,
                ButtonDesign.Attention,
            ].includes(value);
        },
    },
    disabled: {
        type: Boolean,
        default: undefined,
    },
    icon: String,
    iconEnd: {
        type: Boolean,
        default: undefined,
    },
    slot: String,
    submits: {
        type: Boolean,
        default: undefined,
    },
    tooltip: String,
});

</script>
