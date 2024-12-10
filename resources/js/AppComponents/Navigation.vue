<template>
  <div class="w-[90%] flex justify-content-between align-items-sm-center mb-[20px] px-[20px] mx-auto rounded mt-[20px] bg-gray-300 h-[70px]">
    <div class="bg-gray-500 text-white px-[10px] py-[3px] rounded">Logo</div>
    <ul class=" flex gap-xl-2 m-0">
      <Link class="bg-gray-500 text-white self-center  px-[10px] rounded" href="/" as="li">Home</Link>
      <Link class="bg-gray-500 text-white self-center  px-[10px] rounded" href="/tips" as="li">Tips</Link>
      <Link class="bg-gray-500 text-white self-center  px-[10px] rounded" href="/contact" as="li">Contact</Link>
      <Link class="bg-gray-500 text-white align-items-sm-center  px-[10px] rounded" href="/public" as="li">
        <i class="bi bi-person-circle text-[30px]"></i>
      </Link>
    </ul>
  </div>
</template>
<script>
export default {
  name: 'Navigation'
}
</script>
