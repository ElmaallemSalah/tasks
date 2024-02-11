<template>
        <div v-if="links.length > 3">
            <div class="flex flex-wrap ">
                <template v-for="(link, key) in links" :key="key">
                    <div
                        v-if="link.url === null"
                        class="px-4 py-3 mb-1 mr-1 text-sm leading-4 text-gray-400 border rounded"
                        v-html="link.label"
                    />
    
                    <Link preserve-state preserve-scroll
                        v-else
                        class="px-4 py-3 mb-1 mr-1 text-sm leading-4 border rounded hover:bg-white focus:border-primary focus:text-primary"
                        :class="{ 'bg-blue-700 text-white': link.active }"
                        :href="link.url"
                        v-html="link.label"
                    />
                </template>
            </div>
        </div>
    </template>
    
    <script>
import { defineComponent } from "vue";

import { Link } from "@inertiajs/vue3";

export default defineComponent({
        components: {
            Link,
        },
        props: {
            links: Array,
        },
    });
    
</script>