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
  <section class="menu-section w-[300px] text-white h-full flex flex-col overflow-auto text-sm  border-r-gray-500">
    <div class="flex justify-between h-[100px]">
      <div class="logo w-[90%] lg:w-full flex p-[10px] items-center justify-center">
        <img alt="image" class=" h-[80px]" src="/storage/System/Icons/logo-dark.png">
      </div>
    </div>

    <section class="h-[calc(100%_-_170px)]">
      <div v-for="nav in routes" class="px-[15px] mb-[5px]">
        <p class="mb-[10px]">{{ nav.name }}</p>
        <ul class="m-0 px-3">
          <template v-for="link in nav.links" :key="link.name">
            <Link :class="{'active': activeLink(link)}" as="li" :href="link.link" class="menu-button">
              <img :src="link.icon" alt="menu-icon" class="inline w-[18px] h-[18px] mr-[10px]"/>
              <p class="inline p-0">{{ link.name }}</p>
            </Link>
          </template>
        </ul>
        <hr>
      </div>
    </section>
    <div class="px-[10px]">
      <Link :href="route('dashboard.profile.ManagerProfile')" class="flex gap-3 hover:bg-gray-600 text-decoration-none bg-gray-700 p-[10px] cursor-pointer rounded-sm">
        <div><i class="bi bi-person-circle text-white text-[40px]"></i></div>
        <div class="overflow-hidden text-white">
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
    @apply p-[5px] rounded text-white flex items-center  mb-[5px] cursor-pointer;

    &:hover {
      @apply bg-gray-700;
    }

  }

  h2 {
    @apply mb-[10px]
  }

  hr {
    @apply my-[5px] border-gray-300;
  }
}
</style>
