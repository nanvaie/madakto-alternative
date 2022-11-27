<template>
    <div class="fixed-shell-bar">
        <ui5-bar design="Header">
            <div slot="startContent">
                <slot name="start">
                    <TopBarStartOptions />
                </slot>
            </div>

            <slot name="center">
                <DigitalClock />
            </slot>

            <div slot="endContent">
                <slot name="end">
                    <TopBarEndOptions />
                </slot>
            </div>
        </ui5-bar>
    </div>
</template>

<script setup>

import TopBarEndOptions from './TopBarEndOptions.vue';
import TopBarStartOptions from './TopBarStartOptions.vue';
import DigitalClock from './DigitalClock.vue';

</script>
