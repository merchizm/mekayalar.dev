<script setup>
import NavigationButtons from "./NavigationButtons.vue";
import {useStorage} from "@vueuse/core";
import {ref, provide} from "vue";

const currentFontSize = useStorage('current_font_size', '');
const fontSizes = ['12px', '14px', '', '18px', '20px', '22px', '23px'];
const fontSizeModified = ref(false);
const containerRef = ref(null);


function decrease_font() {
    if (containerRef.value && fontSizes[fontSizes.indexOf(containerRef.value.style.fontSize) - 1] !== undefined) {
        containerRef.value.style.fontSize = fontSizes[fontSizes.indexOf(containerRef.value.style.fontSize) - 1];
        currentFontSize.value = containerRef.value.style.fontSize;
        fontSizeModified.value = true;
    }
}

function increase_font() {
    if (containerRef.value && fontSizes[fontSizes.indexOf(containerRef.value.style.fontSize) + 1] !== undefined) {
        containerRef.value.style.fontSize = fontSizes[fontSizes.indexOf(containerRef.value.style.fontSize) + 1];
        currentFontSize.value = containerRef.value.style.fontSize;
        fontSizeModified.value = true;
    }
}

function normalize_font() {
    if (containerRef.value) {
        containerRef.value.style.fontSize = fontSizes[2];
        currentFontSize.value = '';
        fontSizeModified.value = false;
    }
}

provide('font_adjustment', {
    normalize_font,
    increase_font,
    decrease_font,
    fontSizeModified
})
</script>


<template>
    <main>
        <NavigationButtons />
        <hr />
        <div ref="containerRef">
            <slot />
        </div>
    </main>
</template>


<style lang="scss" scoped>
    main {
        margin-top: 25px;
        margin-left: 15px;
        width: 55vw;

        hr {
            border: 0;
            margin: 0;
            height: 1px;
            width: 100%;
            border-top: 2px solid var(--divider);
            border-radius: 10px;
        }

        div {
            margin-top: 30px;
            font-size: 16px;
        }
    }

    @media screen and (max-width: 900px) {
        main {
            margin-top: 5px;
            margin-left: 3px;
            width: 95vw;
        }
    }
</style>
