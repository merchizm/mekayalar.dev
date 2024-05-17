<script setup>
    import {ref} from "vue";
    import {useDark} from "@vueuse/core";
    defineProps(['poems']);

    const isDark = useDark({
        selector: "body"
    });

    const expandedIndex = ref(-1);

    function expandPoem(index) {
        expandedIndex.value = expandedIndex.value === index ? -1 : index;
    }
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
            <div class="head">
                <h3 class="poem_head" @click="expandPoem(index)">{{ poem.title }}</h3>
                <applause-button :id="poem.id" type="poem" multiclap="true" :color="isDark ? '#fff' : '#222222'"/>
            </div>
            <span v-if="expandedIndex === index" class="poem_details">{{ diffForHumans(poem.wrote_at) }} — {{ dateToString(poem.wrote_at) }}</span>
            <pre class="poem_context" v-if="expandedIndex === index">{{ poem.content }}</pre>


        </div>
    </div>
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

            &.expanded {
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                z-index: 10;
                border: none;
                overflow: auto; /* Allows scrolling within the expanded post */
                padding: 20px; /* more padding for expanded view */
                transition: all 0.5s ease; /* Slightly slower transition for expansion */
            }
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
