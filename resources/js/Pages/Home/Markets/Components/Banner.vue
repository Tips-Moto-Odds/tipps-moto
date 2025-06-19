<script setup>
</script>

<template>
    <section>
        <div id="carouselExampleIndicators" class="carousel slide container p-0 rounded overflow-hidden mb-4 bg-black"
             data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="d-block w-100 h-[500px]">
                        <img src="/storage/System/content/banners/soccer-stadium-full-people.jpg" alt="">
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="d-block w-100 h-[500px]">
                        <img src="/storage/System/content/banners/automobile-racing-sports-competition.jpg" alt="">
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="d-block w-100 h-[500px]">
                        <img
                            src="/storage/System/content/banners/portrait-athlete-competing-olympic-games-tournament.jpg"
                            alt="">
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </section>
</template>

<style lang="scss" scoped>

.carousel-item {
    img {
        object-fit: cover;
        height: 100%
    }
}

</style>
