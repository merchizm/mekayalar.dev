<script setup>
import AdminNavigation from "../../Components/AdminNavigation.vue";
defineProps(['user']);
</script>

<script>

</script>

<template>
    <AdminNavigation/>
    <h1>Hoş geldin, <span>{{ user.name }}</span> !</h1>
</template>

<style scoped lang="scss">
    h1{
        margin-top: 1em;
        color: var(--light-color);
        font-size: 2em;
        font-weight: 500;
    }
</style>
