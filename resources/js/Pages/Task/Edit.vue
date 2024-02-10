<script setup>
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {
    Head,
    useForm,
} from "@inertiajs/vue3";

const props = defineProps({
    task: {
        type: Object,
        default: () => ({}),
    },
});

const form = useForm({
        id: props.task.id,
    title: props.task.title,
    description: props.task.description,
  
   
});

const submit = () => {
        console.log(form.id);
    form.post(route("task.update",form.id));
};
</script>

<template>
    <Head title="Dashboard" />
   

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">Edit Task</h2>
        </template>

        <div class="py-12">
    
      
        <div class="mx-auto max-w-7xl">
            
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                
                <div class="p-6 bg-white border-b border-gray-200">
                    
                    <form @submit.prevent="submit">
                        <div class="mt-2">
                            <InputLabel for="title" value="Title" />

                            <TextInput id="title" type="text" class="block w-full mt-1" v-model="form.title" required
                                autofocus />

                            <InputError class="mt-2" :message="form.errors.title" />
                        </div>
                        <div class="mt-2">
                            <InputLabel for="description" value="Description" />

                            <TextInput id="description" type="text" class="block w-full mt-1" v-model="form.description"
                                required autofocus />

                            <InputError class="mt-2" :message="form.errors.description" />
                        </div>
                    
                  

                        <PrimaryButton class="mt-2" type="submit" :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing">
                            Create
                        </PrimaryButton>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </AuthenticatedLayout>
</template>
