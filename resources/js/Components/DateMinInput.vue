<template>
   
        <div class="flex flex-col items-start">
                <label for="date_min" class="mb-1">Start Date:</label>
                <VueDatePicker format="yyyy-MM-dd" v-model="date_min" id="date_min"></VueDatePicker>
        </div>
    

</template>

<script setup>
const date_min  = defineModel();
</script>

