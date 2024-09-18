<script setup>
import links from "@/AppData/link.js";
import {Link} from "@inertiajs/vue3";

const emit = defineEmits(["menu-close", "menu-open"])

$(document).ready(function () {
    $('#hamburger').on('click', function () {
        $(this).toggleClass('active');
        if (($(this).attr('class')).split(' ').some(str => str.includes("active")))
            emit('menu-close')
        else
            emit('menu-open')
    });
});

</script>

<template>
    <nav class="h-[80px] flex items-center justify-center bg-gray-900                ">
        <div class="w-9/12 px-[20px] overflow-hidden">
            <img class="h-[60px]" src="/storage/System/Icons/logo-dark.png" alt="logo">
        </div>
        <div class="w-3/12 h-[60px] flex items-center justify-center md:hidden">
            <div class="h-[40px] w-[60px]">
                <svg id="hamburger" class="Header__toggle svg" viewbox="0 0 60 40" data-status=false>
                    <g stroke="#ababab" stroke-width="4" stroke-linecap="round" stroke-linejoin="round">
                        <path id="top-line" d="M10,10 L50,10 Z"></path>
                        <path id="middle-line" d="M10,20 L50,20 Z"></path>
                        <path id="bottom-line" d="M10,30 L50,30 Z"></path>
                    </g>
                </svg>
            </div>
        </div>
        <div class="p-[20px] hidden items-center md:flex">
            <ul class="flex gap-x-[20px] text-white mx-[30px]">
                <Link v-for="link in links" :href="link.link" class="px-[10px] py-[3px] rounded-sm"
                      :class="{'active': $page.url === link.link}">{{ link.title }}
                </Link>
            </ul>
            <div class="w-[80px]">
                <Link :as="'img'" href="/sign-in" class="h-[32px] cursor-pointer"
                      src="/storage/System/Icons/user-icon.png" alt="logo"></Link>
            </div>
        </div>
    </nav>
</template>

<style scoped lang="scss">
div {
    ul {
        a:hover {
            @apply bg-gray-500;
        }
    }
}

a.active {
    @apply bg-orange-500
}

nav {
    position: sticky;
    top:      0px;
    z-index:  10000;
}

body {
    height:          100vh;
    display:         flex;
    align-items:     center;
    justify-content: center;
    overflow:        hidden;
    flex-direction:  column;
    text-align:      center;
    color:           #FFFFFF;
    font-size:       1.2rem;
    font-family:     Futura, Trebuchet MS, Arial, sans-serif;
}

svg {
    width: 80px;
}

#top-line,
#bottom-line,
#middle-line {
    transform-box:    fill-box;
    transform-origin: center;
}

/* Add animation styles based on 'active' class */
svg.active #top-line {
    animation: down-rotate 0.6s ease-out both;
}

svg.active #bottom-line {
    animation: up-rotate 0.6s ease-out both;
}

svg.active #middle-line {
    animation: hide 0.6s ease-out forwards;
}


@keyframes up-rotate {
    0% {
        animation-timing-function: cubic-bezier(0.16, -0.88, 0.97, 0.53);
        transform:                 translateY(0px);
    }
    30% {
        transform-origin:          center;
        animation-timing-function: cubic-bezier(0.34, 1.56, 0.64, 1);
        transform:                 translateY(-10px);
    }
    100% {
        transform-origin: center;
        transform:        translateY(-10px) rotate(45deg) scale(0.9);
    }
}

@keyframes down-rotate {
    0% {
        animation-timing-function: cubic-bezier(0.16, -0.88, 0.97, 0.53);
        transform:                 translateY(0px);
    }
    30% {
        transform-origin:          center;
        animation-timing-function: cubic-bezier(0.34, 1.56, 0.64, 1);
        transform:                 translateY(10px);
    }
    100% {
        transform-origin: center;
        transform:        translateY(10px) rotate(-45deg) scale(0.9);
    }
}

@keyframes hide {
    29% {
        opacity: 1;
    }
    30% {
        opacity: 0;
    }
    100% {
        opacity: 0;
    }
}


</style>
