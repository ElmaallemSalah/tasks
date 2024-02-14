<script setup>
import {
    ref,
    watch,
} from "vue";

import { initFlowbite } from "flowbite";
import debounce from "lodash/debounce";
import moment from "moment";
import Swal from "sweetalert2";
import { useToast } from "vue-toastification";

import DateMaxInput from "@/Components/DateMaxInput.vue";
import DateMinInput from "@/Components/DateMinInput.vue";
import DeleteBtn from "@/Components/DeleteBtn.vue";
import EditBtn from "@/Components/EditBtn.vue";
import Pagination from "@/Components/Pagination.vue";
import SearchInput from "@/Components/SearchInput.vue";
import SwalCom from "@/Components/Swal.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {
    Head,
    Link,
    router,
    useForm,
} from "@inertiajs/vue3";

import useDestroy from "../../Composables/UseDestroy";

const toast = useToast();

const props = defineProps({
    tasks: {
        type: Object,
        default: () => ({}),
    },
    search: {
        type: String,

    },
    date_min: {
        type: String,

    },
    date_max: {
        type: String,

    },
    perPage: {
        type: String,

    }
});
const form = useForm({});

function destroy(id) {
 useDestroy().destroy('task.destroy',id);
    //fire a swam if the task is deleted 
   



}
function tougleCompleted(id) {
    console.log(id);
    form.post(route("task.tougleCompleted", id), {
        preserveState: true,
        preserveScroll: true,
        onSuccess:()=>{
            toast.success("Task's status updates successfully!");
        }
    });
}

let date_min = ref(props.date_min);
let date_max = ref(props.date_max);
let search = ref(props.search);
const perPage = ref(props.perPage !== null ? props.perPage : '20');

watch([search, perPage, date_min, date_max], debounce(function ([searchVal, perPageVal, date_minVal, date_maxVal]) {
    const formattedDate_Min = date_minVal ? moment(date_minVal).format('YYYY-MM-DD') : null;
    const formattedDate_Max = date_maxVal ? moment(date_maxVal).format('YYYY-MM-DD') : null;

    router.get('/tasks', {
        perPage: perPageVal,
        search: searchVal,
        date_min: formattedDate_Min,
        date_max: formattedDate_Max,
    }, {
        preserveState: true, replace: true ,preserveScroll: true
    });
}, 650))
</script>

<template>
    <Head title="Dashboard" />
    <SwalCom v-if="$page?.props.flash?.status" :status="$page?.props.flash?.status"  />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">Tasks</h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">

                    <div class="overflow-x-auto shadow-md sm:rounded-lg">
                        <div class="m-6">
                            <div class="flex items-center justify-between">
                                <h3
                                    class="text-lg font-semibold text-left text-gray-900 bg-white rtl:text-right dark:text-white dark:bg-gray-800">
                                    All Tasks
                                </h3>
                                <div class="ml-auto">
                                    <Link :href="route('task.create')" type="button"
                                        class="text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 shadow-lg shadow-green-500/50 dark:shadow-lg dark:shadow-green-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                                    Add New
                                    </Link>
                                </div>
                            </div>
                        </div>


                        <SearchInput v-model="search" placeholder="Search Tasks by title & description" />

                        <!-- date select -->
                        <!-- date select -->
                        <div class="z-50 flex mb-2 justify-evenly">
                            <DateMinInput v-model="date_min" />
                            <DateMaxInput v-model="date_max" />
                        </div>



                        <!-- end date select -->




                        <table id="datatable"
                            class="w-full text-sm text-left text-gray-500 rtl:text-right dark:text-gray-400">



                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        ID
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Title
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        description
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Status
                                    </th>


                                    <th scope="col" class="px-6 py-3">
                                        Created At
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        <span class="sr-only">Edit</span>

                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(task, index) in tasks.data " :key="index"
                                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ task.id }}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ task.title }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ task.description }}
                                    </td>
                                    <td class="px-6 py-4">



                                        <label class="relative inline-flex items-center mb-5 cursor-pointer">
                                            <input @click="tougleCompleted(task.id)" type="checkbox" value=""
                                                class="sr-only peer" :checked="task.completed">
                                            <div
                                                class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:w-5 after:h-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                                            </div>
                                            <span :class="task.completed ? 'text-green-400' : 'text-yellow-400'"
                                                class="text-sm font-medium ms-3 dark:text-gray-300">{{
                                                    task.completed == true ? 'Completed' : 'Pending' }}</span>
                                        </label>
                                    </td>

                                    <td class="px-6 py-4">
                                        {{ moment(task.created_at).format('YYYY-MM-DD') }}
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <div class="flex">

                                            <EditBtn :href="route('task.edit', task.id)" />


                                            <DeleteBtn @click="destroy(task.id)" />


                                        </div>

                                    </td>
                                </tr>

                            </tbody>
                        </table>
                        <div class="flex justify-between m-2">
                            <div class="flex">

                              

                                <select v-if="tasks.data.length > 0" id="TasksSelect" v-model="perPage"
                                    class="h-10 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="20">20</option>
                                    <option value="100">100</option>
                                    <option value="200">200</option>
                                    <option value="500">500</option>
                                    <option value="ALL">ALL</option>
                                </select>
                            </div>
                            <div class="flex">
                                <pagination class="" :links="tasks.links" />
                            </div>
                        </div>




                    </div>





                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
