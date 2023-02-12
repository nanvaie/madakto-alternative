<template>
    <ui5-popover
        :allow-target-overlap="props.allowTargetOverlap"
        :header-text="props.headerText"
        :hide-arrow="props.hideArrow"
        :hide-backdrop="props.hideBackdrop"
        :horizontal-align="props.horizontalAlign"
        :modal="props.modal"
        :placement-type="props.placementType"
        :vertical-align="props.verticalAlign"
    >
        <div
            v-if="$slots.header"
            slot="header"
        >
            <slot name="header" />
        </div>

        <slot />

        <div
            v-if="$slots.footer"
            slot="footer"
        >
            <slot name="footer" />
        </div>
    </ui5-popover>
</template>

<script setup>

import "@ui5/webcomponents/dist/Popover";

const props = defineProps({
    allowTargetOverlap: {
        type: Boolean,
        default: undefined,
    },
    headerText: String,
    hideArrow: {
        type: Boolean,
        default: undefined,
    },
    hideBackdrop: {
        type: Boolean,
        default: undefined,
    },
    horizontalAlign: {
        type: String,
        default: 'Center',
        validator(value) {
            return [
                'Center',
                'Left',
                'Right',
                'Stretch',
            ].includes(value);
        },
    },
    modal: {
        type: Boolean,
        default: undefined,
    },
    placementType: {
        type: String,
        default: 'Right',
        validator(value) {
            return [
                'Left',
                'Right',
                'Top',
                'Bottom',
            ].includes(value);
        },
    },
    verticalAlign: {
        type: String,
        default: 'Center',
        validator(value) {
            return [
                'Center',
                'Top',
                'Bottom',
                'Stretch',
            ].includes(value);
        },
    },
});

</script>
