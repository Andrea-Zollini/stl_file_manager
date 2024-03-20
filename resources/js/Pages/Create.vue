<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";

const submit = () => {
    console.log("test");
};
</script>

<template>
    <Head title="Ordina" />

    <AuthenticatedLayout>
        <!-- <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Ordina
            </h2>
        </template> -->

        <div class="flex items-center justify-center w-1/3 calc-height">
            <form @submit.prevent="submit">
                <div class="px-5 py-2">
                    <label for="name" class="block pb-2">Nome</label>
                    <input
                        type="text"
                        class="border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                    />
                </div>
                <div class="px-5 py-2">
                    <label for="last_name" class="block pb-2">Cognome</label>
                    <input
                        type="text"
                        class="border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                    />
                </div>
                <div class="px-5 py-2">
                    <label for="email" class="block pb-2">Email</label>
                    <input
                        type="email"
                        class="border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                    />
                </div>
                <div class="px-5 py-2">
                    <label for="phone_number" class="block pb-2"
                        >Numero di telefono</label
                    >
                    <input
                        type="text"
                        class="border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                    />
                </div>
                <div class="px-5 py-2">
                    <label for="file" class="block pb-2">File</label>
                    <input type="file" accept=".stl" />
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
