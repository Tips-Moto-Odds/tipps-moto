<script setup>
import {get_routes} from "@/AppData/Modules.js";
import {usePage} from "@inertiajs/vue3";

const page = usePage();

const routes = get_routes(page.props.account_type)
const current_route = window.location.href

function closeMenu() {
  let elem = $("#dashboard-menu")

  elem.css({
    left: "-100%",
    width: "100%"
  })
}

// $page.url.includes(link.active)

const activeLink = (link) => {
  if (link.supported?.length > 0) {
    return link.supported.includes(route().current())
  }
}

</script>

<template>
  <section class="menu-section w-[300px] text-white h-full flex flex-col overflow-auto text-sm border-r border-r-gray-500">
    <div class="flex justify-between h-[100px]">
      <div class="logo w-[90%] lg:w-full flex p-[10px] items-center justify-center">
        <img alt="image" class=" h-[80px]" src="/storage/System/Icons/logo-dark.png">
      </div>
      <button class=" lg:hidden flex p-[10px] items-center justify-center h-full w-[50px] mr-[3px]" type="button"
              @click="closeMenu">
        <svg class="bi bi-x-lg" fill="currentColor" height="35" viewBox="0 0 16 16" width="35"
             xmlns="http://www.w3.org/2000/svg">
          <path
              d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z"/>
        </svg>
      </button>
    </div>

    <section class="h-[calc(100%_-_200px)]">
      <div v-for="nav in routes" class="px-[15px] mb-[5px]">
        <h2>{{ nav.name }}</h2>
        <ul>
          <template v-for="link in nav.links" :key="link.name">
            <Link :class="{'active': activeLink(link)}" :href="link.link" class="menu-button">
              <img :src="link.icon" alt="menu-icon" class="inline w-[24px] h-[24px]"/>
              <p class="inline">{{ link.name }}</p>
            </Link>
          </template>
        </ul>
        <hr style="border-color: #505050">
      </div>
    </section>
    <div class="px-[20px]">
      <hr>
      <Link :href="route('ManagersProfile')" class="flex gap-3 hover:bg-orange-400 p-[10px] cursor-pointer rounded-sm">
        <div>
          <i class="bi bi-person-circle text-[40px]"></i>
        </div>
        <div class="overflow-hidden">
          <p>{{$page.props.auth.user.name}}</p>
          <p class="text-sm text-xs">{{$page.props.auth.user.email}}</p>
        </div>
      </Link>
    </div>
  </section>
</template>

<style lang="scss" scoped>
.menu-section {
  .active {
    @apply bg-orange-400 text-white;
  }

  .menu-button {
    transition: all ease 150ms;
    @apply rounded py-[6px] px-[8px] text-white  flex gap-2 items-center  mb-[5px];

    &:hover {
      @apply bg-orange-500;
    }

  }

  h2 {
    @apply mb-[10px]
  }

  hr {
    @apply my-[10px];
  }
}
</style>
