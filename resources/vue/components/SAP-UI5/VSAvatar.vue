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
import AvatarColorScheme from '@ui5/webcomponents/src/types/AvatarColorScheme';
import AvatarShape from "@ui5/webcomponents/src/types/AvatarShape";
import AvatarSize from "@ui5/webcomponents/src/types/AvatarSize";

const props = defineProps({
    accessibleName: String,
    colorScheme: {
        type: String,
        default: AvatarColorScheme.Accent6,
        validator(value) {
            return [
                AvatarColorScheme.Accent1,
                AvatarColorScheme.Accent2,
                AvatarColorScheme.Accent3,
                AvatarColorScheme.Accent4,
                AvatarColorScheme.Accent5,
                AvatarColorScheme.Accent6,
                AvatarColorScheme.Accent7,
                AvatarColorScheme.Accent8,
                AvatarColorScheme.Accent9,
                AvatarColorScheme.Accent10,
                AvatarColorScheme.Placeholder,
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
        default: AvatarShape.Circle,
        validator(value) {
            return [
                AvatarShape.Square,
                AvatarShape.Circle,
            ].includes(value);
        },
    },
    size: {
        type: String,
        default: AvatarSize.S,
        validator(value) {
            return [
                AvatarSize.XS,
                AvatarSize.S,
                AvatarSize.M,
                AvatarSize.L,
                AvatarSize.XL,
            ].includes(value);
        },
    },
});

</script>
