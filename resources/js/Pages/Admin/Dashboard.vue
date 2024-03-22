<script setup>
import AdminAuthenticatedLayout from "@/Layouts/AdminAuthenticatedLayout.vue";
import { Head, useForm } from "@inertiajs/vue3";
import { onMounted } from "vue";

const props = defineProps({
    orders: Array,
});

onMounted(() => {
    console.log(props.orders);
});
</script>

<template>
    <Head title="Admin Dashboard" />

    <AdminAuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Admin Dashboard
            </h2>
        </template>

        <ul class="p-5">
            <li v-for="order in props.orders">
                <a :href="order.file_url">{{ order.stl_file_path }}</a>
            </li>
        </ul>
    </AdminAuthenticatedLayout>
</template>
