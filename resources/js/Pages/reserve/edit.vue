<template>
    <Head title="Reserve" />
    <div
        class="flex flex-col w-5/6 mx-auto my-16 border border-gray-500 rounded-lg"
    >
        <div
            class="flex flex-row justify-between items-center w-full min-h-min bg-[#21252908] border-b-2"
        >
            <p class="px-4 m-2 text-xl">رزرو اتاق</p>
            <div>
                <Link
                    :href="route('dashboard')"
                    as="button"
                    type="button"
                    class="h-8 px-4 m-2 text-sm text-black duration-150 rounded-lg bg-[#FFFF00] border-red-600 border hover:border-black"
                >
                    رزروهای شما
                </Link>

                <Link
                    :href="route('room_index')"
                    as="button"
                    type="button"
                    class="h-8 px-4 m-2 text-sm text-white duration-150 rounded-lg bg-[#0800ff] border-[#0800ff] border hover:border-black"
                >
                    لیست اتاقها
                </Link>
            </div>
        </div>

        <label
            class="block my-2 text-lg font-medium text-gray-900 dark:text-white"
        >
            اتاق
        </label>

        <select v-model="form.room_id" class="rounded-lg">
            <option
                class="rounded-lg w-3"
                v-for="(room, index) in rooms"
                :key="index"
                :value="room.id"
            >
                شماره :
                {{ room.number }}
                طبقه :
                {{ room.floor }}
            </option>
        </select>
        <p v-if="$page.props.errors.room_id" class="text-red-600">
            {{ $page.props.errors.room_id }}
        </p>

        <label
            class="block mb-2 my-2 text-lg font-medium text-gray-900 dark:text-white"
        >
            تاریخ شروع رزرو
        </label>
        <date-picker
            :min="$page.props.start_time"
            v-model="form.start"
        ></date-picker>
        <p v-if="$page.props.errors.start" class="text-red-600">
            {{ $page.props.errors.start }}
        </p>

        <label
            class="block mb-2 text-lg my-2 font-medium text-gray-900 dark:text-white"
        >
            تاریخ پایان رزرو
        </label>

        <date-picker
            v-model="form.end"
            :min="$page.props.start_time"
        ></date-picker>
        <p v-if="$page.props.errors.end" class="text-red-600">
            {{ $page.props.errors.end }}
        </p>

        <div
            class="flex flex-row justify-between items-center w-full min-h-min bg-[#21252908] border-b-2 mt-5"
        >
            <button
                @click="submit"
                class="h-9 px-4 m-2 text-lg duration-150 rounded focus:shadow-outline bg-white hover:bg-blue-600 text-blue-600 hover:text-white border border-blue-600 hover:border-transparent"
                as="button"
                type="button"
            >
                رزرو اتاق
            </button>
        </div>
    </div>
    <p
        class="flex flex-row justify-center text-xl text-center pt-5"
        v-if="$page.props.crud.success"
    >
        {{ $page.props.crud.success }}
    </p>
    <p></p>
    <p
        class="flex flex-row justify-center text-xl text-center pt-5 text-red-600"
        v-if="$page.props.errors"
    >
        <span v-for="(error, index) in errors" :key="index">{{ error }}</span>
    </p>
</template>

<script setup>
import { Head, useForm, Link, usePage } from "@inertiajs/vue3";
import Dashboard from "@/Pages/Dashboard.vue";
import Vue3PersianDatetimePicker from "vue3-persian-datetime-picker";
import DatePicker from "vue3-persian-datetime-picker";

const props = defineProps({
    rooms: Object,
    user_id: Number,
    start_time: String,
    errors: Object,
    reserve: Object,
});
console.log(props.errors);
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
