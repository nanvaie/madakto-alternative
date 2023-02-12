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
import TitleLevel from '@ui5/webcomponents/dist/types/TitleLevel';
import WrappingType from '@ui5/webcomponents/dist/types/WrappingType';

const props = defineProps({
    level: {
        type: String,
        default: TitleLevel.H2,
        validator(value) {
            return [
                TitleLevel.H1,
                TitleLevel.H2,
                TitleLevel.H3,
                TitleLevel.H4,
                TitleLevel.H5,
                TitleLevel.H6,
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
