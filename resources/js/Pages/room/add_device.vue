<template>
    <Head title="Create new Room" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Add Device to Room
            </h2>
        </template>

        <div
            class="flex flex-col w-5/6 mx-auto my-16 border border-gray-500 rounded-lg"
        >
            <div
                class="flex flex-row justify-between items-center w-full min-h-min bg-[#21252908] border-b-2"
            >
                <p class="px-4 m-2 text-xl">اضافه کردن وسیله</p>
            </div>
            <div class="flex flex-col justify-between">
                <div class="flex flex-col">
                    <label
                        class="block mb-2 text-lg font-medium text-gray-900 dark:text-white"
                    >
                        نام وسیله
                    </label>

                    <select
                        class="block w-[20%] p-4 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        v-model="form.device_id"
                    >
                        <option
                            v-for="(device, index) in devices"
                            :key="index"
                            :value="device.id"
                        >
                            {{ device.name }}
                        </option>
                    </select>
                    <p v-if="$page.props.errors.device_id" class="text-red-600">
                        {{ $page.props.errors.device_id }}
                    </p>

                    <div class="mb-5 py-2 px-2 w-full">
                        <label
                            class="block mb-2 text-lg font-medium text-gray-900 dark:text-white"
                        >
                            تعداد
                        </label>
                        <input
                            v-model="form.number"
                            type="number"
                            class="block w-50 p-4 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        />
                        <p
                            v-if="$page.props.errors.number"
                            class="text-red-600"
                        >
                            {{ $page.props.errors.number }}
                        </p>
                    </div>
                </div>
                <div class="flex flex-row justify-between p-2 w-full">
                    <div>
                        <p v-if="$page.props.crud.errors" class="text-red-600">
                            {{ $page.props.crud.errors }}
                        </p>
                    </div>
                </div>

                <div
                    class="flex flex-row justify-between items-center w-full min-h-min bg-[#21252908] border-b-2 mt-5"
                >
                    <button
                        @click="submit"
                        type="button"
                        as="button"
                        class="h-9 px-4 m-2 text-lg duration-150 rounded focus:shadow-outline bg-white hover:bg-blue-600 text-blue-600 hover:text-white border border-blue-600 hover:border-transparent"
                    >
                        اضافه کردن وسیله
                    </button>
                    <Link
                        :href="route('room_index')"
                        type="button"
                        as="button"
                        class="h-9 px-4 m-2 text-lg duration-150 rounded focus:shadow-outline bg-[#ffc107] hover:bg-[#ffe607] text-black border border-[#ffc107] hover:border-transparent"
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

const props = defineProps({
    devices: Object,
    id: Number,
});
const form = useForm({
    number: "",
    device_id: "",
    room_id: props.id,
});

function submit() {
    form.post(route("device_room_store"));
}
</script>

<style></style>
