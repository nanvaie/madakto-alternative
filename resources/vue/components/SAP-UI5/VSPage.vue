<template>
    <ui5-page>
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
    </ui5-page>
</template>

<script setup>

import '@ui5/webcomponents-fiori/dist/Page';
import PageBackgroundDesign from '@ui5/webcomponents-fiori/dist/types/PageBackgroundDesign';

const props = defineProps({
    backgroundDesign: {
        type: String,
        default: PageBackgroundDesign.Solid,
        validator(value) {
            return [
                PageBackgroundDesign.Solid,
                PageBackgroundDesign.Transparent,
                PageBackgroundDesign.List,
            ].includes(value);
        },
    },
    disableScrolling: {
        type: Boolean,
        default: undefined,
    },
    floatingFooter: {
        type: Boolean,
        default: undefined,
    },
    hideFooter: {
        type: Boolean,
        default: undefined,
    },
});

</script>
