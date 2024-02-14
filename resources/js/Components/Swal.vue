<template></template>

<script setup>
import {
    onMounted,
    onUpdated,
} from "vue";

import { useToast } from "vue-toastification";

const toast = useToast();

const props = defineProps({
    status: {
        type: Object,
        default: {}
    },
});

function showToast() {
    toast(props.status.text,{
       
     
        type: props.status.type
    });
}

onMounted(() => {
    if (props.status) {
        showToast();
    }
});

onUpdated(() => {
    if (props.status) {
        showToast();
    }
});
</script>
