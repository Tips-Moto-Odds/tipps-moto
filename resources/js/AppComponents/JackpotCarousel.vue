<script setup>
import {ref, onMounted} from 'vue';
import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap/dist/js/bootstrap.bundle.min';

// Dynamic array of carousel items
const carouselItems = ref([
    {title: 'Sport Pesa Mega Jackpot', amount: 'Ksh 100,000,000',img:'/storage/System/content/logos/sportpesa.webp'},
    {title: 'Mozzat Daily Jackpot', amount: 'Ksh 20,000,000',img:'/storage/System/content/logos/mozzart.jpg'},
    {title: 'Odi bet Jackpot', amount: 'Ksh 15,000,000',img:'/storage/System/content/logos/odi.avif'},
]);

onMounted(() => {
    // Initialize the carousel
    const carousel = new bootstrap.Carousel(document.getElementById('jackpots'), {
        interval: 5000,
        ride: 'carousel'
    });
});
</script>

<template>
    <div id="jackpots" class="carousel slide h-100" data-bs-ride="carousel" data-bs-interval="5000">
        <ol class="carousel-indicators p-0 m-0">
            <li v-for="(item, index) in carouselItems" :key="index" :data-bs-target="'#jackpots'" :data-bs-slide-to="index" :class="{ active: index === 0 }"></li>
        </ol>
        <div class="carousel-inner overflow-hidden h-100 ">
            <div v-for="(item, index) in carouselItems" :key="index" :class="['carousel-item flex flex-column ', { active: index === 0 }]">
                <div class="w-100 justify-content-center align-items-center flex mb-[10px]">
                    <div class="h-[70px] bg-white">
                        <img class="h-[70px]" :src="item.img">
                    </div>
                </div>
                <h3 class="text-center text-white">{{ item.title }}</h3>
                <h2 class="text-center jackpot-amount">{{ item.amount }}</h2>
            </div>
        </div>
        <a class="carousel-control-prev" href="#jackpots" role="button" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#jackpots" role="button" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</template>

<style lang="scss" scoped>
.jackpot-amount {
    font-size: 48px; /* Make the text large */
    color: gold; /* Set the text color to gold */
    font-weight: bold; /* Make the text bold */
    text-shadow: 0 0 10px rgba(255, 215, 0, 0.7), /* Add a glow effect */
    0 0 20px rgba(255, 215, 0, 0.7),
    0 0 30px rgba(255, 215, 0, 0.7);
}
</style>
