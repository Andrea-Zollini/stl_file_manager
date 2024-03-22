<script setup>
import AdminAuthenticatedLayout from "@/Layouts/AdminAuthenticatedLayout.vue";
import { Head, useForm } from "@inertiajs/vue3";
import { onMounted } from "vue";

const props = defineProps({
    orders: {
        type: Object,
    },
});

onMounted(() => {
    console.log(props.orders);
});
</script>

<template>
    <Head title="Admin Dashboard" />

    <AdminAuthenticatedLayout>
        <div class="md:container md:mx-auto p-7">
            <ul class="border-2 rounded shadow unstyled">
                <li
                    class="flex min-h-[120px]"
                    v-for="order in props.orders.data"
                >
                    <div class="flex items-center justify-center w-1/3">
                        {{ order.user[0].name }}
                        {{ order.user[0].last_name }}
                    </div>
                    <div class="flex items-center justify-center w-1/3">
                        {{ order.id }}
                    </div>
                    <div class="flex items-center justify-center w-1/3">
                        <a class="text-blue-700" :href="order.file_url">
                            {{ order.stl_file_path }}
                        </a>
                    </div>
                </li>
            </ul>
        </div>
    </AdminAuthenticatedLayout>
</template>
