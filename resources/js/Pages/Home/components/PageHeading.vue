<script setup>
const props = defineProps(['title'])
</script>
<template>
    <div class="w-full h-full relative">
        <p class="text-white absolute bottom-[30px] h-[40px] z-10 pt-[13px] px-[10px] !font-light text-[20px]">
            {{props.title}}
        </p>
        <div class="w-[180px] absolute bottom-[20px] trapezium flex items-center  px-[10px]">
        </div>
        <div class="absolute left-[180px] bottom-[20px] rhombus flex items-center ">
        </div>
        <div class="absolute left-[202px] bottom-[20px] rhombus rhombus2 flex items-center ">
        </div>
    </div>
</template>
<style scoped lang="scss">
.trapezium {
    //border-left: 50px solid transparent; /* Adjust left slope */
    border-right:  20px solid transparent; /* Adjust right slope */
    border-bottom: 40px solid #E07914; /* Adjust height and color */
}

.rhombus {
    width:            15px !important; /* Adjust width as needed */
    height:           40px; /* Adjust height as needed */
    background-color: #E07914; /* Adjust color as needed */
    transform:        skewX(25deg); /* Skew the element to the left */
}

.rhombus2 {
    width:            10px !important;
    background-color: white !important; /* Adjust color as needed */
    transform:        skewX(25deg); /* Skew the element to the left */
}


</style>
