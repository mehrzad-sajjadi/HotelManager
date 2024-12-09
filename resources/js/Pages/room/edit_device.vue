<template>
    <Head title="Create new Room" />
    <AuthenticatedLayout>
        <template #header>
            <h2
                class="font-semibold text-xl text-gray-800 dark:text-gray-100 leading-tight"
            >
                Edit Device in Room
            </h2>
        </template>

        <div
            class="w-5/6 mx-auto my-16 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 shadow-sm"
        >
            <!-- Header داخل فرم -->
            <div
                class="flex flex-row justify-between items-center w-full min-h-min bg-gray-50 dark:bg-gray-700 border-b-2 border-gray-200 dark:border-gray-600 rounded-t-lg p-4"
            >
                <p
                    class="text-lg font-semibold text-gray-800 dark:text-gray-100"
                >
                    ویرایش وسیله اتاق
                </p>
            </div>

            <!-- محتوای اصلی فرم -->
            <div class="p-8 flex flex-col space-y-6">
                <div>
                    <label
                        class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-200"
                    >
                        نام وسیله
                    </label>
                    <select
                        class="block w-full max-w-xs rounded-md border border-gray-300 bg-white dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
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
                    <p
                        v-if="$page.props.errors.device_id"
                        class="text-red-600 dark:text-red-400 text-sm mt-1"
                    >
                        {{ $page.props.errors.device_id }}
                    </p>
                </div>

                <div>
                    <label
                        class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-200"
                    >
                        تعداد
                    </label>
                    <input
                        v-model="form.number"
                        type="number"
                        class="block w-full max-w-xs rounded-md border border-gray-300 bg-white dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                    />
                    <p
                        v-if="$page.props.errors.number"
                        class="text-red-600 dark:text-red-400 text-sm mt-1"
                    >
                        {{ $page.props.errors.number }}
                    </p>
                </div>

                <div>
                    <p
                        v-if="$page.props.crud.errors"
                        class="text-red-600 dark:text-red-400"
                    >
                        {{ $page.props.crud.errors }}
                    </p>
                </div>

                <div class="flex justify-between space-x-4 rtl:space-x-reverse">
                    <button
                        @click="update"
                        type="button"
                        class="h-8 px-4 min-w-10 m-2 flex items-center text-sm duration-150 rounded-lg bg-white dark:bg-gray-700 border border-blue-600 text-blue-600 hover:bg-blue-600 hover:text-white dark:hover:bg-blue-600 dark:hover:text-white transition-colors"
                    >
                        ویرایش وسیله
                    </button>
                    <Link
                        :href="route('room_index')"
                        type="button"
                        class="h-8 px-4 min-w-10 m-2 flex items-center text-sm duration-150 rounded-lg bg-[#ffc107] hover:bg-[#ffe607] text-black border border-[#ffc107] hover:border-transparent dark:text-gray-900 dark:border-yellow-500 dark:bg-yellow-500 dark:hover:bg-yellow-400 dark:hover:border-transparent transition-colors"
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
    room_devices: Object,
});
const form = useForm({
    number: props.room_devices.number,
    device_id: props.room_devices.device_id,
    room_id: props.room_devices.room_id,
});

function update() {
    form.put(route("device.room.update"));
}
</script>

<style></style>
