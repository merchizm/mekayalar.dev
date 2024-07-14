<script setup>
import {ref} from "vue";
import {useDark} from "@vueuse/core";
defineProps(['poem']);

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
    <div class="head">
        <h3 class="poem_head">{{ poem.title }}</h3>
        <applause-button :id="poem.id" type="poem" multiclap="true" :color="isDark ? '#fff' : '#222222'"/>
    </div>
    <span class="poem_details">{{ diffForHumans(poem.wrote_at) }} — {{ dateToString(poem.wrote_at) }}</span>
    <pre class="poem_context" >{{ poem.content }}</pre>

</template>

<style scoped lang="scss">
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
</style>
