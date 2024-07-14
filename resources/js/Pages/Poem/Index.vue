<script setup>
    import {ref} from "vue";
    import {useDark} from "@vueuse/core";
    import {Link} from "@inertiajs/vue3";
    defineProps(['poems']);

    const isDark = useDark({
        selector: "body"
    });
</script>

<script>
    function diffForHumans(date){
        const formatter = new Intl.RelativeTimeFormat('tr', {
            numeric: 'auto',
            style: 'long',
            localeMatcher: 'best fit'
        });
        return formatter.format(Math.round((Date.parse(date) - new Date()) / 86400000), 'day');
    }

    function dateToString(date){
        return new Date(Date.parse(date)).toLocaleDateString("tr", {
            weekday: "short",
            year: "numeric",
            month: "2-digit",
            day: "numeric"
        })
    }
</script>

<template>
    <h1>Şiirlerim</h1>
    <p>Şiirleri sadece duygularımı ifade etmek için kullandığım bir gerçek, bu nedenle şairlere nazaran bir performans benden katiyen beklenmemeli ve öyle şiirleri okumalı.</p>
    <div class="container">
        <div v-for="(poem, index) in poems" :key="index" class="poem" :class="{ expanded: expandedIndex === index }">
            <Link :href="'/poems/' + poem.slug" class="link">
                <div class="head">
                    <h3 class="poem_head">{{ poem.title }}</h3>
                    <applause-button :id="poem.id" type="poem" multiclap="true" :color="isDark ? '#fff' : '#222222'"/>
                </div>
            </Link>
        </div>
    </div>
</template>

<style scoped lang="scss">
    .link{
        text-decoration: none;
        color: var(--color);
    }
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
        flex-direction: column;
        flex-wrap: wrap;
        padding: 10px 15px;
        background-color: var(--poem-container);
        border-radius: 10px;
        color: var(--color);
        position: relative;
        .poem{
            overflow: hidden;
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
            padding: 14px 20px 20px;
            background-color: var(--background-color);
            border-radius: 10px;
            margin: 10px;
            user-select: none;

            .head{
                display:flex;
                justify-content: space-between;

                .poem_head{
                    cursor: pointer;
                    font-size: 1.4em;
                    margin-bottom: .8em;
                    user-select: none;
                }
            }
            .poem_context{
                font-family: 'Adamina', serif;
                font-size: 1.2em;
                user-select: none;
                font-style: italic;
            }

            .poem_details{
                font-size: 1em;
                margin-bottom: 1em;
                color: var(--light-color);
            }
        }
    }
</style>
