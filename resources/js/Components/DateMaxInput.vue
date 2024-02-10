<template>
   
        <div class="flex flex-col items-start">
                <label for="date_max" class="mb-1">Start Date:</label>
                <VueDatePicker format="yyyy-MM-dd" v-model="date_max" id="date_max"></VueDatePicker>
        </div>
    

</template>

<script setup>
const date_max  = defineModel();
</script>

