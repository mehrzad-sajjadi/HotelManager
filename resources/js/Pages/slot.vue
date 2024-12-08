<template>
    <div>
        <profileC :user="user">
            <template #img>
                <img src="../../../public/storage/pics/response.png" alt="" />
            </template>
            <template #exp>
                <p>{{ user.exp }}</p>
            </template>
        </profileC>
    </div>
</template>

<script setup>
import profileC from "./profileC.vue";

let user = {
    name: "ALI",
    family: "ALIAN",
    img: "../../../public/storage/pics/response.png",
    exp: "aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaabbbbbbbbbbbbbbbbbbbbbbbbbbccccccccccccccccccccccddddddddddddddddddddddd",
};
</script>
