<template>
    <div
        class="h-screen w-[300px] flex flex-col text-white text-center bg-gray-500 z-10"
    >
        <div
            :active="route().current('dashboard')"
            :class="[
                'text-center flex justify-center items-center w-full h-[50px]',
                route().current('dashboard')
                    ? 'font-bold text-gray-900 bg-gray-500'
                    : 'bg-gray-900 text-white',
            ]"
        >
            <Link :href="route('dashboard')"> Dashboard </Link>
        </div>

        <div
            :class="[
                'text-center flex justify-center items-center w-full h-[50px] text-white',
                route().current('room_index') ||
                route().current('room_edit') ||
                route().current('room_show') ||
                route().current('room_create') ||
                route().current('device_room_create')
                    ? 'font-bold text-gray-900 bg-gray-500'
                    : 'bg-gray-900 text-white',
            ]"
        >
            <NavLink
                :href="route('room_index')"
                :active="
                    route().current('room_index') ||
                    route().current('room_edit') ||
                    route().current('room_show') ||
                    route().current('room_create') ||
                    route().current('device_room_create')
                "
            >
                Room
            </NavLink>
        </div>
        <div
            :class="[
                'text-center flex justify-center items-center w-full h-[50px] text-white',
                route().current('device_index') ||
                route().current('device_edit') ||
                route().current('device_create')
                    ? 'font-bold text-gray-900 bg-gray-500'
                    : 'bg-gray-900 text-white',
            ]"
        >
            <NavLink
                :href="route('device_index')"
                :active="
                    route().current('device_index') ||
                    route().current('device_edit') ||
                    route().current('device_create')
                "
            >
                Device
            </NavLink>
        </div>
        <div
            :class="[
                'text-center flex justify-center items-center w-full h-[50px] text-white',
                route().current('reserve_index') ||
                route().current('reserve.edit')
                    ? 'font-bold text-gray-900 bg-gray-500'
                    : 'bg-gray-900 text-white',
            ]"
        >
            <NavLink
                :href="route('reserve_index')"
                :active="
                    route().current('reserve_index') ||
                    route().current('reserve.edit')
                "
            >
                Reserve
            </NavLink>
        </div>
    </div>
</template>

<script setup>
// import PrimeVue from "primevue/config";
import { Link } from "@inertiajs/vue3";
import NavLink from "@/Components/NavLink.vue";

const props = defineProps({
    menu: Object,
});
</script>
