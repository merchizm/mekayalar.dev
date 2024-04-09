<script setup>
import { Head } from '@inertiajs/vue3'
import Navigation from "../Components/Navigation.vue";
import Container from "../Components/Container.vue";
import ScreenSaver from "../Components/ScreenSaver.vue";
</script>

<template>
    <Head>
        <meta head-key="description" name="description" content="Sakarya'da yaşıyorum. Alaylı bir geliştiriciyim. Bahçeyle ilgilenmeyi, kahve içmeyi ve felsefi kitaplar okumayı seviyorum. Bir şeyler üretmekten aşırı haz duyuyorum, bu yüzden yazılım geliştirme ile ilgileniyorum." />
    </Head>

    <div class="wrapper">
        <Navigation/>
        <Container>
            <slot />
        </Container>
    </div>
    <!--<ScreenSaver />-->
</template>
