<script setup>

</script>

<template>
    <div class="navigation-container">
        <a href="posts">Gönderi Yönetimi</a>
        <a href="categories">Kategori Yönetimi</a>
        <a href="poems">Şiir Yönetimi</a>
        <a href="media">Medya Yönetimi</a>
        <a href="spotify">Spotify Ayarları</a>
        <a href="github">Github Ayarları</a>
        <a href="raindrop">Raindrop Ayarları</a>
        <a href="../auth/logout">Çıkış Yap</a>
    </div>
</template>

<style scoped lang="scss">
    .navigation-container{
        display:flex;
        flex-direction:row;
        gap:12px;
        justify-content: space-around;
        a{
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
