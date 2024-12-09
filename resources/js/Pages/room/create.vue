<template>
    <Head title="Create new Room" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Create Room
            </h2>
        </template>

        <div
            class="w-5/6 mx-auto my-16 border border-gray-300 rounded-lg bg-white shadow-sm dark:bg-gray-800 dark:border-gray-600"
        >
            <div
                class="flex flex-row items-center w-full min-h-min bg-gray-50 border-b-2 border-gray-200 rounded-t-lg p-4 dark:bg-gray-700 dark:border-gray-600"
            >
                <p
                    class="text-lg font-semibold text-gray-800 dark:text-gray-100"
                >
                    ایجاد اتاق جدید
                </p>
            </div>

            <div class="p-8">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-8">
                    <!-- شماره اتاق -->
                    <div class="flex flex-col">
                        <label
                            class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-200"
                        >
                            شماره اتاق
                        </label>
                        <input
                            v-model="form.number"
                            type="text"
                            class="block w-full max-w-xs rounded-md border-gray-300 bg-white dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                            autofocus
                        />
                        <p
                            v-if="$page.props.errors.number"
                            class="text-red-600 dark:text-red-400 text-sm mt-1"
                        >
                            {{ $page.props.errors.number }}
                        </p>
                    </div>

                    <!-- طبقه -->
                    <div class="flex flex-col">
                        <label
                            class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-200"
                        >
                            طبقه
                        </label>
                        <input
                            v-model="form.floor"
                            type="text"
                            class="block w-full max-w-xs rounded-md border-gray-300 bg-white dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                        />
                        <p
                            v-if="$page.props.errors.floor"
                            class="text-red-600 dark:text-red-400 text-sm mt-1"
                        >
                            {{ $page.props.errors.floor }}
                        </p>
                    </div>

                    <!-- هزینه هر شب اقامت -->
                    <div class="flex flex-col">
                        <label
                            class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-200"
                        >
                            هزینه هر شب اقامت
                        </label>
                        <input
                            v-model="form.price"
                            type="text"
                            class="block w-full max-w-xs rounded-md border-gray-300 bg-white dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                        />
                        <p
                            v-if="$page.props.errors.price"
                            class="text-red-600 dark:text-red-400 text-sm mt-1"
                        >
                            {{ $page.props.errors.price }}
                        </p>
                    </div>

                    <!-- تصویر -->
                    <div class="flex flex-col">
                        <label
                            class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-200"
                        >
                            تصویر
                        </label>
                        <input
                            @change="fixImage"
                            name="picture"
                            type="file"
                            accept="image/*"
                            class="block py-5 w-full max-w-xs cursor-pointer rounded-md border-gray-300 bg-gray-100 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                        />
                        <p
                            v-if="$page.props.errors.picture"
                            class="text-red-600 dark:text-red-400 text-sm mt-1"
                        >
                            {{ $page.props.errors.picture }}
                        </p>
                        <div v-if="previewImageUrl" class="mt-4">
                            <img
                                :src="previewImageUrl"
                                alt="Selected Image"
                                class="max-w-xs rounded-md shadow-sm border border-gray-300 dark:border-gray-600"
                            />
                        </div>
                    </div>
                </div>

                <div class="mb-4">
                    <p
                        v-if="$page.props.crud.errors"
                        class="text-red-600 dark:text-red-400"
                    >
                        {{ $page.props.crud.errors }}
                    </p>
                </div>

                <div class="flex justify-between space-x-4 rtl:space-x-reverse">
                    <button
                        @click="submit"
                        class="h-8 px-4 m-2 text-sm duration-150 rounded bg-white border border-blue-600 text-blue-600 hover:bg-blue-600 hover:text-white dark:bg-gray-700 dark:border-blue-500 dark:text-blue-400 dark:hover:bg-blue-600 dark:hover:text-white transition-colors"
                    >
                        ایجاد اتاق
                    </button>
                    <Link
                        :href="route('room_index')"
                        as="button"
                        type="submit"
                        class="h-8 px-4 m-2 text-sm duration-150 rounded bg-[#ffc107] hover:bg-[#ffe607] text-black border border-[#ffc107] hover:border-transparent dark:bg-yellow-500 dark:hover:bg-yellow-400 dark:text-gray-900 dark:border-yellow-500 dark:hover:border-transparent transition-colors"
                    >
                        انصراف
                    </Link>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
<script setup>
import { Head, useForm, Link, usePage } from "@inertiajs/vue3";
import Dashboard from "@/Pages/Dashboard.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { ref } from "vue";

const previewImageUrl = ref(null);
const form = useForm({
    number: "",
    floor: "",
    price: "",
    picture: null,
});

function fixImage(event) {
    const file = event.target.files[0];
    form.picture = file;
    if (file) {
        previewImageUrl.value = URL.createObjectURL(file);
    } else {
        previewImageUrl.value = null;
    }
}
function submit() {
    form.post(route("room_store"), {
        forceFormData: true,
    });
}
</script>

<style></style>
