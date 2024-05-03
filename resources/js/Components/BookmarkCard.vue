<script setup>
defineProps({
    title: String,
    link: String,
    domain: String,
    created: Number
})
</script>

<template>
    <div class="bookmark-card">
        <p><a :href="link" target="_blank" rel="noreferrer">{{title}}</a></p>
        <span><b>{{domain}}</b> </span>
    </div>
</template>

<style scoped lang="scss">
.bookmark-card{
    padding-bottom: 10px;
    padding-top: 10px;
    p {
        a {
            color: var(--color);
            text-decoration: none;
            &:hover {
                color: var(--light-color);
                filter: brightness(70%);
            }
            &:visited {
                color: var(--color);
                filter: brightness(70%);
            }
        }
        padding-top: 0.2em;
        padding-bottom: 0.1em;
        font-size: 1.3em;
    }
    span {
        font-size: 1em;
        color: var(--color);
        filter: brightness(95%);
    }
}
</style>
