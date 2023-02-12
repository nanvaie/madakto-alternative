<template>
    <a
        :class="'fd-link ' + design"
        :aria-disabled="props.disabled"
    >
        <span class="fd-link__content"><slot /></span>
    </a>
</template>

<script setup>

import LinkDesign from '../../../js/enums/LinkDesign';

const props = defineProps({
    design: {
        type: String,
        default: LinkDesign.DEFAULT,
        validator(value) {
            return [
                LinkDesign.DEFAULT,
                LinkDesign.EMPHASIZED,
                LinkDesign.SUBTLE,
            ].includes(value);
        },
    },
    disabled: {
        type: Boolean,
        default: false,
    },
    inverted: {
        type: Boolean,
        default: false,
    },
});

let design;
switch (props.design) {
    case LinkDesign.EMPHASIZED:
        design = 'fd-link--emphasized';
        break;
    case LinkDesign.SUBTLE:
        design = 'fd-link--subtle';
        break;
    case LinkDesign.DEFAULT:
    default:
        design = '';
}

</script>
