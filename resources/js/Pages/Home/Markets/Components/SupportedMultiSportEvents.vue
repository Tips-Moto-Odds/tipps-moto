<script setup>
const supportedEvents = [
    {
        name: "Formula One",
        slug: "formulaOne",
        image: "/storage/System/content/MarketingImages/formular_one.avif", // Update to CDN or local path
    },
    {
        name: "Swimming",
        slug: "swimming",
        image: "/storage/System/content/MarketingImages/swimming.avif",
    },
    {
        name: "Track & Field",
        slug: "trackAndField",
        image: "/storage/System/content/MarketingImages/tracks_and_field.avif",
    },
    {
        name: "Cycling",
        slug: "cycling",
        image: "/storage/System/content/MarketingImages/cycling.avif",
    },
];
</script>

<template>
    <div class="container bg-black  rounded p-6 mb-4">
        <h2 class="text-2xl font-bold text-white mb-6">Choose a Sport</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            <Link as="div"
                  v-for="(event, idx) in supportedEvents"
                  :key="idx"
                  class="bg-white cursor-pointer rounded-xl overflow-hidden shadow-lg hover:shadow-xl transition"
                  :href="route('markets.'+event.slug)"
            >
                <img :src="event.image" alt="sport" class="w-full h-40 object-cover"/>
                <div class="bg-primary_orange text-white p-4 text-center font-semibold text-gray-800">
                    {{ event.name }}
                </div>
            </Link>
        </div>
    </div>
</template>
