<script setup>
import {Link} from '@inertiajs/vue3';
</script>

<template>
    <div class="navigation-container">
        <Link class="link" href="posts">Gönderi Yönetimi</Link>
        <Link class="link" href="categories">Kategori Yönetimi</Link>
        <Link class="link" href="poems">Şiir Yönetimi</Link>
        <Link class="link" href="/auth/logout">Çıkış Yap</Link>
    </div>
</template>

<style scoped lang="scss">
    .navigation-container{
        display:flex;
        flex-direction:row;
        gap:12px;
        justify-content: space-around;
        .link{
            flex: 1;
            text-decoration: none;
            display: flex;
            border-radius: 6px;
            background-color: var(--button-hover);
            color: var(--color);
            padding: 0.3em 1em;
            cursor: pointer;
            &:hover{
                background-color: var(--button);
            }
        }
    }
</style>
