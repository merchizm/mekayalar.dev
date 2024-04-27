<script setup>
    defineProps(['poems']);
    import MasonryWall from '@yeger/vue-masonry-wall'
</script>

<template>
    <h1>Şiirlerim</h1>
    <p>Şiirleri sadece duygularımı ifade etmek için kullandığım bir gerçek, bu nedenle şairlere nazaran bir performans benden katiyen beklenmemeli ve öyle şiirleri okumalı.</p>
    <MasonryWall :items="poems" :ssr-columns="2" :column-width="500" :gap="16" class="container">
        <template #default="{ item, index }">
            <div class="poem">
                <h3 class="poem_head">{{ item.title }}</h3>
                <pre class="poem_context">{{ item.content }}</pre>
            </div>
        </template>
    </MasonryWall>
</template>

<style scoped lang="scss">
    h1{
        font-size: 1.7em;
        font-style: italic;
    }
    p{
        font-size: 1.3em;
        font-style: italic;
        color: var(--light-color);
    }
    .container{
        margin-top: 2em;
        display:flex;
        flex-direction: row;
        flex-wrap: wrap;
        padding: 10px 15px;
        background-color: var(--poem-container);
        border-radius: 10px;
        color: var(--color);
        .poem{
            display: flex;
            flex-direction: column;
            flex-grow: 1;
            padding: 14px 20px 20px;
            background-color: var(--background-color);
            border-radius: 10px;
            margin: 10px;
            user-select: none;

            .poem_head{
                font-size: 1.4em;
                margin-bottom: .8em;
                user-select: none;
            }
            .poem_context{
                font-family: 'Adamina', serif;
                font-size: 1.2em;
                user-select: none;
                font-style: italic;
            }
        }
    }
</style>
