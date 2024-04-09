<script setup>
import { ref, reactive, onMounted, onUnmounted } from 'vue';

let mouseX = 0;
let mouseY = 0;
const byeArray =  [
    'körişirbiz',
    'görüşürüz',
    'αντιο',
    'ნახვამდის',
    'довиждане',
    'увидимся',
    'хayr',
    'көрүшкөнчө',
    'кездескенше',
    'találkozunk',
    '또 봐요',
    'tschüss',
    'goodbye',
    'doei',
    'au revoir',
    'şalom',
    'vale',
    'namaste',
    'さようなら',
    'vemo-nos',
    'slán',
    'hüvasti'
];
const state = reactive({
    showScreenSaver: false,
});
const currentText = ref(byeArray[0]);

let lastText = currentText.value;
let intervalId = null;

function getRandomElement(array, excludeElement) {
    let randElement = excludeElement;
    while (randElement === excludeElement) {
        const randIndex = Math.floor(Math.random() * array.length);
        randElement = array[randIndex];
    }
    return randElement;
}

function updateText() {
    currentText.value = getRandomElement(byeArray, lastText);
    lastText = currentText.value;
}

function throttleFunction(func, delay) {
    let timerId = null;
    return () => {
        if (timerId) {
            return;
        }
        timerId = setTimeout(() => {
            func();
            timerId = null;
        }, delay);
    };
}

const mouseLeave =  throttleFunction(function () {
    state.showScreenSaver = state.showScreenSaver === false;
    clearInterval(intervalId);
    intervalId = setInterval(updateText, 1500);
    state.showScreenSaver = true;
}, 400);

const mouseMove = (e) => {
    mouseX = e.clientX;
    mouseY = e.clientY;
    state.showScreenSaver = false;
};


onMounted(() => {
    document.body.addEventListener('mousemove', mouseMove);
    document.addEventListener('mouseleave', mouseLeave);
});

onUnmounted(() => {
    document.body.removeEventListener('mousemove', mouseMove);
    document.removeEventListener('mouseleave', mouseLeave);
    clearInterval(intervalId);
})
</script>

<template>
    <div v-if="state.showScreenSaver">
        <span>{{ currentText }}</span>
        <span class="bottom">Mesajınızı bekliyorum</span>
        <a href="mailto:merich@duck.com" class="bottom">merich@duck.com</a>
    </div>
</template>

<style lang="scss" scoped>
div {
    position: fixed;
    top: 0;
    left: 0;
    bottom: 0;
    right: 0;
    color: white;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    z-index: 100;
    background-color: var(--background-color);

    span:first-of-type {
        color: var(--color);
        font-size: 14vmin !important;
        font-weight: 500 !important;
        letter-spacing: 2px !important;
    }

%bottom {
    position: absolute;
    bottom: 4vmin !important;
    margin: 5px !important;
}

    span:last-of-type {
        @extend %bottom;
        bottom: 6vmin !important;
        color: var(--color) !important;
    }

    a {
        @extend %bottom;
        color: var(--light-color) !important;
        font-weight: 500 !important;
        text-decoration: none;
    }
}
</style>
