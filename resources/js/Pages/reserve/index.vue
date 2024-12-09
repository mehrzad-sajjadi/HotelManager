<template>
    <Head title="Reserve" />
    <AuthenticatedLayout>
        <template #header>
            <div class="flex w-[100%] flex-row justify-between items-center">
                <h2
                    class="font-semibold text-xl text-gray-800 leading-tight dark:text-white"
                >
                    Reserve
                </h2>
            </div>
        </template>
        <div
            class="flex flex-col w-5/6 mx-auto my-16 bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-700 rounded-xl shadow-lg"
        >
            <div
                class="flex flex-row justify-between items-center w-full min-h-[50px] bg-gradient-to-r from-blue-100 via-blue-200 to-blue-300 dark:from-gray-800 dark:via-gray-700 dark:to-gray-600 px-4 py-2 rounded-t-xl border-b-2 dark:border-gray-700"
            >
                <p class="text-xl font-bold text-gray-800 dark:text-white">
                    رزرو اتاق
                </p>
                <div class="flex gap-2">
                    <Link
                        :href="route('dashboard')"
                        as="button"
                        type="button"
                        class="h-8 px-4 text-sm font-medium text-black dark:text-gray-900 bg-yellow-300 border border-yellow-400 rounded-full hover:bg-yellow-400 focus:ring-2 focus:ring-yellow-500 transition"
                    >
                        رزروهای شما
                    </Link>

                    <Link
                        :href="route('room_index')"
                        as="button"
                        type="button"
                        class="h-8 px-4 text-sm font-medium text-white bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 rounded-full shadow hover:shadow-lg focus:ring-2 focus:ring-blue-500 transition"
                    >
                        لیست اتاق‌ها
                    </Link>
                </div>
            </div>

            <div class="p-4">
                <label
                    class="block my-2 text-lg font-medium text-gray-800 dark:text-gray-300"
                >
                    اتاق
                </label>
                <select
                    v-model="form.room_id"
                    class="block w-3/4 md:w-1/2 p-2 text-gray-800 bg-gray-100 dark:bg-gray-800 dark:text-gray-300 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
                    <option
                        v-for="(room, index) in rooms"
                        :key="index"
                        :value="room.id"
                        class="rounded-lg"
                    >
                        شماره: {{ room.number }} طبقه: {{ room.floor }}
                    </option>
                </select>
                <p v-if="$page.props.errors.room_id" class="text-red-500 mt-2">
                    {{ $page.props.errors.room_id }}
                </p>
                <div class="flex flex-wrap gap-0">
                    <div class="w-[50%] px-2">
                        <label
                            class="block my-2 text-lg font-medium text-gray-800 dark:text-gray-300"
                        >
                            تاریخ شروع رزرو
                        </label>
                        <date-picker
                            :min="$page.props.right_time"
                            v-model="form.start"
                        ></date-picker>
                        <p
                            v-if="$page.props.errors.start"
                            class="text-red-500 mt-2"
                        >
                            {{ $page.props.errors.start }}
                        </p>
                    </div>

                    <div class="w-[50%] px-2">
                        <label
                            class="block my-2 text-lg font-medium text-gray-800 dark:text-gray-300"
                        >
                            تاریخ پایان رزرو
                        </label>
                        <date-picker
                            v-model="form.end"
                            :min="$page.props.right_time"
                            class="block w-full"
                        ></date-picker>
                        <p
                            v-if="$page.props.errors.end"
                            class="text-red-500 mt-2"
                        >
                            {{ $page.props.errors.end }}
                        </p>
                    </div>
                </div>
            </div>

            <div
                class="flex flex-row justify-between items-center w-full bg-gray-100 dark:bg-gray-800 px-4 py-2 border-t-2 dark:border-gray-700"
            >
                <button
                    @click="submit"
                    class="h-10 px-6 text-lg font-semibold text-white bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 rounded-full shadow hover:shadow-lg focus:ring-2 focus:ring-blue-500 transition"
                    type="button"
                >
                    رزرو اتاق
                </button>
            </div>
        </div>
        <p
            class="text-center text-xl text-green-600 dark:text-green-400 mt-5"
            v-if="$page.props.crud.success"
        >
            {{ $page.props.crud.success }}
        </p>
        <p
            class="text-center text-xl text-red-600 mt-5"
            v-if="$page.props.errors"
        >
            <span v-for="(error, index) in errors" :key="index">
                <span
                    v-if="
                        error ==
                        'Unfortunately, this room has already been booked for this date range !'
                    "
                >
                    {{ error }}
                </span>
            </span>
        </p>
    </AuthenticatedLayout>
</template>

<script setup>
import { Head, useForm, Link, usePage } from "@inertiajs/vue3";
import Dashboard from "@/Pages/Dashboard.vue";
import Vue3PersianDatetimePicker from "vue3-persian-datetime-picker";
import DatePicker from "vue3-persian-datetime-picker";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

const props = defineProps({
    rooms: Object,
    user_id: Number,
    right_time: String,
    errors: Object,
});
const form = useForm({
    user_id: props.user_id,
    room_id: "",
    start: "",
    end: "",
});
function submit() {
    form.post(route("reserve_store"), {
        preserveState: true,
        onSuccess: () => form.reset(),
    });
}
</script>

<style></style>
