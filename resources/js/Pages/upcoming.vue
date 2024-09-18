<script setup>
import { ref, onMounted } from 'vue';

const myVariable = ref(null);


// Set a timeout
onMounted(() => {
    myVariable.value = setTimeout(() => {
        $('h1').fadeIn('slow');
    }, 4000);
});

</script>

<template>
    <div class="holder w-[100vw] h-[100vh]">
        <div class="w-full h-full text-white flex flex-col items-center justify-center">
            <div class="text-white flex flex-col items-center justify-center p-[20px] rounded">
                <img class="w-[200px] mb-[30px]" src="/storage/System/Icons/logo-dark.png">
                <div class="h-[100px]">
                    <h1 class="text-[30px] mb-[20px] hidden">Welcome to Tips Moto</h1>
                    <h1 class="text-[20px] bg-orange-500 px-[10px] rounded hidden ">Where the Odds are in your favor</h1>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped lang="scss">
.holder {
    background-image: url("/storage/app/public/System/stadium.jpg") !important;
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
    overflow: hidden;

    & > div{
        background-color: rgba(0, 0, 0, 0.7);
    }
}
</style>
