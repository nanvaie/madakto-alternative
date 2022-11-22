<template>
    <ui5-side-navigation
        :collapsed="props.collapsed"
        :items="props.items"
    >
        <slot />

        <ui5-side-navigation-item
            v-for="_item of props.items"
            :slot="_item.fixed === true ? 'fixedItems' : undefined"
            :expanded="_item.expanded"
            :icon="_item.icon"
            :selected="_item.selected"
            :text="_item.text"
            :whole-item-toggleable="_item.wholeItemToggleable"
        >
            <template v-if="_item.subItems !== undefined">
                <ui5-side-navigation-sub-item
                    v-for="_subItem of _item.subItems"
                    :icon="_subItem.icon"
                    :selected="_subItem.selected"
                    :text="_subItem.text"
                />
            </template>
        </ui5-side-navigation-item>
    </ui5-side-navigation>
</template>

<script setup>

import '@ui5/webcomponents-fiori/dist/SideNavigation';
import '@ui5/webcomponents-fiori/dist/SideNavigationItem';
import '@ui5/webcomponents-fiori/dist/SideNavigationSubItem';
import { defineProps } from 'vue';

const props = defineProps({
    collapsed: {
        type: Boolean,
        default: undefined,
    },
    items: Object,
});

</script>
