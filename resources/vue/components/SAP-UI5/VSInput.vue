<template>
    <ui5-input
        :accessible-name="props.accessibleName"
        :accessible-name-ref="props.accessibleNameRef"
        :disabled="props.disabled"
        :maxlength="props.maxlength"
        :name="props.name"
        :no-typeahead="props.noTypeahead"
        :placeholder="props.placeholder"
        :preview-item="props.previewItem"
        :readonly="props.readonly"
        :required="props.required"
        :show-clear-icon="props.showClearIcon"
        :show-suggestions="props.showSuggestions"
        :type="props.type"
        :value="props.value"
        :value-state="props.valueState"
    >
        <slot />

        <div
            v-if="$slots.icon"
            slot="icon"
        >
            <slot name="icon" />
        </div>

        <div
            v-if="$slots.valueStateMessage"
            slot="valueStateMessage"
        >
            <slot name="valueStateMessage" />
        </div>
    </ui5-input>
</template>

<script setup>

import '@ui5/webcomponents/dist/Input';
import { defineProps } from 'vue';
import ValueState from '@ui5/webcomponents-base/dist/types/ValueState';
import InputType from '@ui5/webcomponents/dist/types/InputType';

const props = defineProps({
    accessibleName: String,
    accessibleNameRef: String,
    disabled: {
        type: Boolean,
        default: undefined,
    },
    maxlength: Number,
    name: String,
    noTypeahead: String,
    placeholder: String,
    previewItem: String,
    readonly: {
        type: Boolean,
        default: undefined,
    },
    required: {
        type: Boolean,
        default: undefined,
    },
    showClearIcon: {
        type: Boolean,
        default: undefined,
    },
    showSuggestions: {
        type: Boolean,
        default: undefined,
    },
    type: {
        type: String,
        default: InputType.Text,
        validator(value) {
            return [
                InputType.Text,
                InputType.Email,
                InputType.Number,
                InputType.Password,
                InputType.Tel,
                InputType.URL,
            ].includes(value);
        },
    },
    value: String,
    valueState: {
        type: String,
        default: ValueState.None,
        validator(value) {
            return [
                ValueState.None,
                ValueState.Error,
                ValueState.Warning,
                ValueState.Success,
                ValueState.Information,
            ].includes(value);
        },
    },
});

</script>
