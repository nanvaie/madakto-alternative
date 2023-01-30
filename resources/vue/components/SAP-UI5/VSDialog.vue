<template>
    <ui5-dialog
        :draggable="props.draggable"
        :header-text="props.headerText"
        :resizable="props.resizable"
        :state="props.state"
        :stretch="props.stretch"
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
    </ui5-dialog>
</template>

<script setup>

import '@ui5/webcomponents/dist/Dialog';
import ValueState from '@ui5/webcomponents-base/dist/types/ValueState';

const props = defineProps({
    draggable: {
        type: Boolean,
        default: undefined,
    },
    headerText: String,
    resizable: {
        type: Boolean,
        default: undefined,
    },
    state: {
        type: String,
        default: ValueState.None,
        validator(value) {
            return [
                ValueState.None,
                ValueState.Success,
                ValueState.Warning,
                ValueState.Error,
                ValueState.Information,
            ].includes(value);
        },
    },
    stretch: {
        type: Boolean,
        default: undefined,
    },
});

</script>
