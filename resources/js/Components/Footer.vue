<script setup>
import {ref} from "vue";

let tatar_hovered = ref(false);
let turk_hovered = ref(false);
</script>

<template>
    <footer>
        <div class="copyright">
            © sitedeki içeriklerin tüm hakları saklıdır<br>
            2021 ═ {{ new Date().getFullYear() }}
            <svg
                xmlns:dc="http://purl.org/dc/elements/1.1/"
                xmlns:cc="http://creativecommons.org/ns#"
                xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
                xmlns:svg="http://www.w3.org/2000/svg"
                xmlns="http://www.w3.org/2000/svg"
                xmlns:sodipodi="http://sodipodi.sourceforge.net/DTD/sodipodi-0.dtd"
                xmlns:inkscape="http://www.inkscape.org/namespaces/inkscape"
                width="197.55556mm"
                height="197.55556mm"
                viewBox="0 0 700.00001 700"
                id="svg2"
                version="1.1"
                inkscape:version="0.91 r13725"
                sodipodi:docname="Star.svg">
                <defs
                    id="defs4" />
                <sodipodi:namedview
                    id="base"
                    pagecolor="#ffffff"
                    bordercolor="#666666"
                    borderopacity="1.0"
                    inkscape:pageopacity="0.0"
                    inkscape:pageshadow="2"
                    inkscape:zoom="0.95714285"
                    inkscape:cx="350"
                    inkscape:cy="350"
                    inkscape:document-units="px"
                    inkscape:current-layer="layer1"
                    showgrid="false"
                    fit-margin-top="0"
                    fit-margin-left="0"
                    fit-margin-right="0"
                    fit-margin-bottom="0"
                    inkscape:window-width="1600"
                    inkscape:window-height="837"
                    inkscape:window-x="-8"
                    inkscape:window-y="-8"
                    inkscape:window-maximized="1" />
                <metadata
                    id="metadata7">
                    <rdf:RDF>
                        <cc:Work
                            rdf:about="">
                            <dc:format>image/svg+xml</dc:format>
                            <dc:type
                                rdf:resource="http://purl.org/dc/dcmitype/StillImage" />
                            <dc:title></dc:title>
                        </cc:Work>
                    </rdf:RDF>
                </metadata>
                <g
                    inkscape:label="Layer 1"
                    inkscape:groupmode="layer"
                    id="layer1"
                    transform="translate(1252.3164,-304.67969)">
                    <path
                        style="opacity:1;fill-opacity:1;stroke:none;stroke-width:1;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:0"
                        d="m -902.3164,304.67969 -28.04007,302.41272 -115.18233,-95.63509 95.63512,115.1823 -302.41272,28.04007 302.41348,28.03931 -95.63588,115.1823 115.18233,-95.63433 28.04007,302.41273 28.03931,-302.41349 115.1823,95.63509 -95.63509,-115.1823 302.41348,-28.03931 -302.41272,-28.04007 95.63433,-115.1823 -115.1823,95.63586 -28.03931,-302.41349 z"
                        id="path4140"
                        inkscape:connector-curvature="0" />
                </g>
            </svg> Meriç
        </div>
        <div class="flags">
            <div class="flag">
                <img src="ataturk-32310.png"
                     alt="Halaskâr Başöğretmenimiz Mareşal Mustafa Kemal Atatürk"
                     :class="{ grayscale: !turk_hovered}"
                     v-on:mouseover="turk_hovered = true"
                     v-on:mouseleave="turk_hovered = false">
                <span>
                    Halaskâr<br>Mustafa Kemal Atatürk
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
            svg{
                width:14px;
                height:14px;
                display:inline-block;
                fill: var(--light-color);
            }
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
