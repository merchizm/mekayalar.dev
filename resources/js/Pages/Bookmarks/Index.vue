<script setup>
import BookmarkCard from "../../Components/BookmarkCard.vue";

defineProps(['bookmarks']);
</script>

<template>
    <div v-for="value in [...Object.entries(this.bookmarks).sort((a, b) => parseInt(b) - parseInt(a))]" class="day_container">
        <h2>
            {{new Date(value[0]).toLocaleDateString('tr-TR', {
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        })}}
        </h2>
        <div id="day">
            <BookmarkCard v-for="bookmark in value[1]"
                :title="bookmark.title"
                :link="bookmark.link"
                :domain="bookmark.domain"
                :created="bookmark.created"
            />
        </div>
    </div>
</template>

<style scoped lang="scss">
.day_container{
    h2 {
        font-size: 1.2em;
        color: var(--color);
        filter: brightness(70%);
        font-weight: normal;
        margin-bottom: .60em;
    }
    margin-top: 1em;
    margin-bottom: 1em;
}
</style>
