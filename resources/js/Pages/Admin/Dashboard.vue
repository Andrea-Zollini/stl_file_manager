<script setup>
import AdminAuthenticatedLayout from "@/Layouts/AdminAuthenticatedLayout.vue";
import { Head, useForm } from "@inertiajs/vue3";
import { onMounted } from "vue";

const props = defineProps({
    orders: {
        type: Object,
    },
});

const formatDate = (str) => {
    return str.split("T")[0].replace("-", "/").replace("-", "/");
};

onMounted(() => {
    console.log(props.orders);
});
</script>

<template>
    <Head title="Admin Dashboard" />

    <AdminAuthenticatedLayout>
        <div
            v-if="props.orders.length"
            class="flex items-center justify-center calc-height"
        >
            <div
                class="rounded shadow md:container md:mx-auto"
                style="border: 3px solid lightgray"
            >
                <div class="flex mt-5 mb-5">
                    <div
                        class="flex items-center justify-center w-1/3 font-bold"
                    >
                        Utente
                    </div>
                    <div
                        class="flex items-center justify-center w-1/3 font-bold"
                    >
                        Id Ordine
                    </div>
                    <div
                        class="flex items-center justify-center w-1/3 font-bold"
                    >
                        Data Ordine
                    </div>
                    <div
                        class="flex items-center justify-center w-1/3 font-bold"
                    >
                        File STL
                    </div>
                </div>
                <ul class="unstyled">
                    <li
                        class="flex min-h-[100px] hover:bg-gray-200 transition-all ease-in-out duration-200"
                        v-for="order in props.orders.data"
                        style="border-top: 3px solid lightgray"
                    >
                        <div class="flex items-center justify-center w-1/3">
                            {{ order.user[0].name }}
                            {{ order.user[0].last_name }}
                        </div>
                        <div class="flex items-center justify-center w-1/3">
                            {{ order.id }}
                        </div>
                        <div class="flex items-center justify-center w-1/3">
                            {{ formatDate(order.created_at) }}
                        </div>
                        <div class="flex items-center justify-center w-1/3">
                            <a class="text-blue-700" :href="order.file_url">
                                {{ order.stl_file_path }}
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </AdminAuthenticatedLayout>
</template>

<style scoped>
.calc-height {
    min-height: calc(100vh - 65px);
}
</style>
