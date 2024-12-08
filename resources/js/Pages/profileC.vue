<template>
    name: {{ props.user.name }} family: {{ props.user.family }}

    <slot name="img" />
    <slot name="exp" />
</template>

<script setup>
let props = defineProps({
    user: Object,
});
</script>
