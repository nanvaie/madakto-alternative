<template>
    <ui5-checkbox
        :accessible-name="props.accessibleName"
        :accessible-name-ref="props.accessibleNameRef"
        :checked="props.checked"
        :disabled="props.disabled"
        :indeterminate="props.indeterminate"
        :name="props.name"
        :readonly="props.readonly"
        :required="props.required"
        :text="props.text"
        :value-state="props.valueState"
        :wrapping-type="props.wrappingType"
    >
        <slot />
    </ui5-checkbox>
</template>

<script setup>

import '@ui5/webcomponents/dist/CheckBox';
import { defineProps } from 'vue';

const props = defineProps({
    accessibleName: String,
    accessibleNameRef: String,
    checked: {
        type: Boolean,
        default: undefined,
    },
    disabled: {
        type: Boolean,
        default: undefined,
    },
    indeterminate: {
        type: Boolean,
        default: undefined,
    },
    name: String,
    readonly: {
        type: Boolean,
        default: undefined,
    },
    required: {
        type: Boolean,
        default: undefined,
    },
    text: String,
    valueState: {
        type: String,
        default: 'None',
        validator(value) {
            return [
                'Warning',
                'Error',
                'None',
                'Success',
                'Information',
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
