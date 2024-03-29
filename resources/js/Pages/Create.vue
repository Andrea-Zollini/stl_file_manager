<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm, Link } from "@inertiajs/vue3";
import RenderArea from "../Components/Partials/RenderArea.vue";
import { onMounted, ref, watch } from "vue";

const props = defineProps({
    user: Object,
});

const isUploaded = ref(false);
const selectedFile = ref(null);
const emit = defineEmits();

const form = useForm({
    order_name: props.user.name,
    order_last_name: props.user.last_name,
    order_email: props.user.email,
    order_phone_number: props.user.phone_number,
    stl_file: null,
});

const handleFileUpload = (e) => {
    e.preventDefault;
    form.stl_file = e.target.files[0];
    selectedFile.value = e.target.files[0];
};

watch(selectedFile, (newValue, oldValue) => {
    if (newValue != oldValue) {
        emit("file-selected", newValue);
    }
});

const submit = () => {
    form.post(route("ordina.upload"), {
        onFinish: () =>
            form.reset(
                "order_email",
                "order_last_name",
                "order_name",
                "order_phone_number",
                "stl_file"
            ),
        onSuccess: () => {
            isUploaded.value = true;
        },
    });
};

// onMounted(() => {
//     console.log(props);
// });
</script>

<template>
    <Head title="Ordina" />

    <AuthenticatedLayout>
        <!-- <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Ordina
            </h2>
        </template> -->

        <div class="flex" v-if="!isUploaded">
            <div class="flex items-center justify-center w-1/3 calc-height">
                <form @submit.prevent="submit">
                    <div class="px-5 py-2">
                        <label for="name" class="block pb-2">Nome</label>
                        <input
                            id="name"
                            type="text"
                            v-model="form.order_name"
                            class="border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        />
                    </div>
                    <div class="px-5 py-2">
                        <label for="last_name" class="block pb-2"
                            >Cognome</label
                        >
                        <input
                            id="last_name"
                            type="text"
                            v-model="form.order_last_name"
                            class="border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        />
                    </div>
                    <div class="px-5 py-2">
                        <label for="email" class="block pb-2">Email</label>
                        <input
                            id="email"
                            type="email"
                            v-model="form.order_email"
                            class="border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        />
                    </div>
                    <div class="px-5 py-2">
                        <label for="phone_number" class="block pb-2"
                            >Numero di telefono</label
                        >
                        <input
                            id="phone_number"
                            type="text"
                            v-model="form.order_phone_number"
                            class="border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        />
                    </div>
                    <div class="px-5 py-2">
                        <label for="file" class="block pb-2">File</label>
                        <input
                            type="file"
                            accept=".stl"
                            @change="handleFileUpload"
                        />
                    </div>

                    <div class="px-5 py-2 mt-3">
                        <button
                            type="submit"
                            class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-gray-800 border border-transparent rounded-md hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                        >
                            Invia
                        </button>
                    </div>
                </form>
            </div>

            <div
                class="flex items-center justify-center w-2/3 overflow-hidden calc-height"
            >
                <RenderArea :file="selectedFile" />
            </div>
        </div>

        <div
            v-if="isUploaded"
            class="flex flex-col items-center justify-center calc-height"
        >
            <div
                class="relative px-4 py-3 text-green-700 bg-green-100 border border-green-400 rounded"
                role="alert"
                style="max-width: 50%"
            >
                <p class="block sm:inline">File caricato con successo.</p>
            </div>
            <div class="mt-5">
                <Link class="hover:underline" :href="route('ordina')"
                    >Crea un nuovo ordine</Link
                >
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>
.calc-height {
    min-height: calc(100vh - 65px);
}
input[type="file"]::file-selector-button {
    border: none;
    padding: 0.2em 0.4em;
    border-radius: 0.2em;
    background-color: #dddddd;
    padding: 0.8rem;
    transition: 0.3s;
    cursor: pointer;
}

input[type="file"]::file-selector-button:hover {
    background-color: #cfcfcf;
}
</style>
