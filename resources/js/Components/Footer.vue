<script setup>
import {ref} from "vue";

let tatar_hovered = ref(true);
let turk_hovered = ref(true);
</script>

<template>
    <footer>
        <div class="copyright">
            © sitedeki içeriklerin tüm hakları saklıdır<br>
            2021 ═ {{ new Date().getFullYear() }}
        </div>
        <div class="flags">
            <div class="flag">
                <img src="ataturk-32310.png"
                     alt="Halaskâr Başöğretmenimiz Mareşal Mustafa Kemal Atatürk"
                     :class="{ grayscale: !turk_hovered}"
                     v-on:mouseover="turk_hovered = true"
                     v-on:mouseleave="turk_hovered = false">
                <span>
                    Halaskâr Başöğretmen Mareşal<br>Mustafa Kemal Atatürk
                </span>
            </div>
            <div class="flag">
                <img src="turkiye_coat_of_army_fan_made.png"
                     alt="Türkiye Coat Of Army (Unofficial)"
                     :class="{ grayscale: !turk_hovered}"
                     v-on:mouseover="turk_hovered = true"
                     v-on:mouseleave="turk_hovered = false">
                <span>
                    Türkiye<br>Cumhurİyetİ
                </span>
            </div>
            <div class="flag">
                <img src="tatarstan_coat_of_army.png"
                     alt="Tatarstan Coat Of Army"
                     :class="{ grayscale: !tatar_hovered }"
                     v-on:mouseover="tatar_hovered = true"
                     v-on:mouseleave="tatar_hovered = false">
                <span>
                    Tatarstan<br>Respublİkasy
                </span>
            </div>
        </div>
    </footer>
</template>

<style scoped lang="scss">
    footer{
        position: absolute;
        bottom: 0;
        width: 100%;
        height: 2.5rem;
        display:flex;
        flex-direction:row;
        justify-content: space-between;
        align-items:center;
        padding: 0.4em 100px 4rem;

        .copyright{
            font-size: 0.9rem;
            text-transform: uppercase;
            font-family: 'Akshar', sans-serif;
            color: var(--light-color);
        }

        .flags{
            font-size: .9rem;
            text-transform: uppercase;
            font-family: 'Akshar', sans-serif;
            color: var(--light-color);
            display: inline-flex;
            flex-direction: row;
            gap:20px;
            .flag{
                display: inline-flex;
                flex-direction: row;
                align-items: center;
                gap:10px;
            }
            img.grayscale {
                filter: grayscale(96%);
                transition: filter 0.5s ease;
            }

            img {
                transition: filter 0.5s ease;
                width: 50px;
                height:50px;
            }
        }
    }
</style>
