<template>
    <ui5-shellbar
        :accessibility-roles="props.accessibilityRoles"
        :accessibility-texts="props.accessibilityTexts"
        :copilot-dom-ref="props.copilotDomRef"
        :logo-dom-ref="props.logoDomRef"
        :notifications-count="props.notificationsCount"
        :notifications-dom-ref="props.notificationsDomRef"
        :overflow-dom-ref="props.overflowDomRef"
        :primary-title="props.primaryTitle"
        :product-switch-dom-ref="props.productSwitchDomRef"
        :profile-dom-ref="props.profileDomRef"
        :secondary-title="props.secondaryTitle"
        :show-co-pilot="props.showCoPilot"
        :show-notifications="props.showNotifications"
        :show-product-switch="props.showProductSwitch"
    >
        <slot />

        <div
            v-if="$slots.logo"
            slot="logo"
        >
            <slot name="logo" />
        </div>

        <div
            v-if="$slots.menuItems"
            slot="menuItems"
        >
            <slot name="menuItems" />
        </div>

        <div
            v-if="$slots.profile"
            slot="profile"
        >
            <slot name="profile" />
        </div>

        <div
            v-if="$slots.searchField"
            slot="searchField"
        >
            <slot name="searchField" />
        </div>

        <div
            v-if="$slots.startButton"
            slot="startButton"
        >
            <slot name="startButton" />
        </div>
    </ui5-shellbar>
</template>

<script setup>

import '@ui5/webcomponents-fiori/dist/ShellBar';
import '@ui5/webcomponents-fiori/dist/ShellBarItem';
import { defineProps } from 'vue';

const props = defineProps({
    accessibilityRoles: Object,
    accessibilityTexts: Object,
    copilotDomRef: HTMLElement,
    logoDomRef: HTMLElement,
    notificationsCount: String,
    notificationsDomRef: HTMLElement,
    overflowDomRef: HTMLElement,
    primaryTitle: String,
    productSwitchDomRef: HTMLElement,
    profileDomRef: HTMLElement,
    secondaryTitle: String,
    showCoPilot: {
        type: Boolean,
        default: undefined,
    },
    showNotifications: {
        type: Boolean,
        default: undefined,
    },
    showProductSwitch: {
        type: Boolean,
        default: undefined,
    },
    shellBarItems: Object,
});

</script>
