<template>
    <div class="fixed-shell-bar">
        <ui5-bar design="Header">
            <div slot="startContent">
                <slot name="start">
                    <TopBarStartContents />
                </slot>
            </div>

            <slot name="center">
                <DigitalClock />
            </slot>

            <div slot="endContent">
                <slot name="end">
                    <TopBarEndContents />
                </slot>
            </div>
        </ui5-bar>
    </div>
</template>

<script setup>

import TopBarEndContents from './TopBarEndContents.vue';
import TopBarStartContents from './TopBarStartContents.vue';
import DigitalClock from './DigitalClock.vue';

</script>
