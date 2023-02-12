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
import ValueState from '@ui5/webcomponents-base/dist/types/ValueState';
import WrappingType from '@ui5/webcomponents/dist/types/WrappingType';

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
        default: ValueState.None,
        validator(value) {
            return [
                ValueState.Warning,
                ValueState.Error,
                ValueState.None,
                ValueState.Success,
                ValueState.Information,
            ].includes(value);
        },
    },
    wrappingType: {
        type: String,
        default: WrappingType.None,
        validator(value) {
            return [
                WrappingType.None,
                WrappingType.Normal,
            ].includes(value);
        },
    },
});

</script>
