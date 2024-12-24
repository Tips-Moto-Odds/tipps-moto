<script setup>
import { ref } from 'vue';

// Dynamic array of carousel items
const carouselItems = ref([
    { src: '/storage/System/content/SportpesaJackpots/sportpesa-mega-jackpot-13.png', alt: 'First slide' },
    { src: '/storage/System/content/SportpesaJackpots/sportpesa-mega-jackpot-14.png', alt: 'Second slide' },
    { src: '/storage/System/content/SportpesaJackpots/sportpesa-mega-jackpot-15.png', alt: 'Third slide' }
]);

</script>

<template>
    <div id="jackpots" class="carousel slide" data-ride="carousel" data-interval="5000">
        <ol class="carousel-indicators p-0 m-0">
            <li v-for="(item, index) in carouselItems" :key="index" :data-target="'#jackpots'" :data-slide-to="index" :class="{ active: index === 0 }"></li>
        </ol>
        <div class="carousel-inner overflow-hidden">
            <div v-for="(item, index) in carouselItems" :key="index" :class="['carousel-item', { active: index === 0 }]">
                <img class="d-block w-full h-full object-cover" :src="item.src" :alt="item.alt">
            </div>
        </div>
        <a class="carousel-control-prev" href="#jackpots" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#jackpots" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</template>
