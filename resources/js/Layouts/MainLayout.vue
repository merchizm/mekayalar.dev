<script setup>
import { Head } from '@inertiajs/vue3'
import Navigation from "../Components/Navigation.vue";
import Container from "../Components/Container.vue";
import ScreenSaver from "../Components/ScreenSaver.vue";
import Footer from "../Components/Footer.vue";
</script>

<template>
    <Head>
        <meta head-key="description" name="description" content="Sakarya'da yaşıyorum. Alaylı bir geliştiriciyim. Bahçeyle ilgilenmeyi, kahve içmeyi ve felsefi kitaplar okumayı seviyorum. Bir şeyler üretmekten aşırı haz duyuyorum, bu yüzden yazılım geliştirme ile ilgileniyorum." />
    </Head>

    <div class="page-container">
        <div class="wrapper">
            <Navigation/>
            <Container>
                <slot />
            </Container>
        </div>
        <!--<ScreenSaver />-->
        <Footer/>
    </div>
</template>

<style scoped lang="scss">
    .wrapper{
        display: flex;
        flex-direction: row;
        gap:6vw;
        padding: 0 100px 10rem;
    }

    @media screen and (max-width: 900px) {
        .wrapper{
            padding: 0 10px;
        }
    }

    .page-container{
        position: relative;
        min-height: 100vh;
    }
</style>
