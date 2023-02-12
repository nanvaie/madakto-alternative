<template>
    <ui5-link
        :accessibility-attributes="props.accessibilityAttributes"
        :accessible-name="props.accessibleName"
        :accessible-name-ref="props.accessibleNameRef"
        :accessible-role="props.accessibleRole"
        :design="props.design"
        :disabled="props.disabled"
        :href="props.href"
        :target="props.target"
        :wrapping-type="props.wrappingType"
    >
        <slot />
    </ui5-link>
</template>

<script setup>

import "@ui5/webcomponents/dist/Link";
import LinkDesign from "@ui5/webcomponents/dist/types/LinkDesign";
import WrappingType from "@ui5/webcomponents/dist/types/WrappingType";

const props = defineProps({
    accessibilityAttributes: Object,
    accessibleName: String,
    accessibleNameRef: String,
    accessibleRole: {
        type: String,
        default: 'link',
        validator(value) {
            return [
                'link',
                'button',
            ].includes(value);
        },
    },
    design: {
        type: String,
        default: LinkDesign.Default,
        validator(value) {
            return [
                LinkDesign.Default,
                LinkDesign.Subtle,
                LinkDesign.Emphasized,
            ].includes(value);
        },
    },
    disabled: {
        type: Boolean,
        default: undefined,
    },
    href: String,
    target: {
        type: String,
        default: undefined,
        validator(value) {
            return [
                '_self',
                '_top',
                '_blank',
                '_parent',
                '_search',
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
    }
});

</script>
