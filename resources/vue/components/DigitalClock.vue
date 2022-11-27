<template>
    <div id="current-time">
        <VSLabel>
            {{ currentTime.toLocaleDateString('fa-IR') }} -
            {{ currentTime.toLocaleTimeString('fa-IR', {hour12: false, hour: "2-digit", minute: "2-digit"}) }}
        </VSLabel>
    </div>
</template>

<script setup>

import { ref, onBeforeUnmount } from 'vue';
import VSLabel from './SAP-UI5/VSLabel.vue';

const useCurrentTime = () => {
    const currentTime = ref(new Date());
    const updateCurrentTime = () => {
        currentTime.value = new Date();
    };

    const updateTimeInterval = setInterval(updateCurrentTime, 1000);

    onBeforeUnmount(() => {
        clearInterval(updateTimeInterval);
    });

    return {
        currentTime,
    };
};

const { currentTime } = useCurrentTime();

</script>
