
<template>
        <div class=" w-[400px] h-full  text-white transition" v-show="showSideBar">
          <div class="h-[50px] bg-gray-900 flex items-center">
            <div class="font-bold text-xl px-[20px]">Coding Challenge</div>
          </div>
          <div class="bg-gray-800 h-[calc(100%-50px)] px-[20px] py-[20px]">
            <div class="flex flex-col justify-between h-full">
              <div class="flex flex-col space-y-[10px]">
                <router-link to="/product" class="inline-flex relative items-center py-[10px] px-[10px] w-full text-sm font-medium rounded-md border-gray-200 hover:bg-gray-200 hover:text-gray-800  transition duration-400 ease-in-out">
                  <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 w-[25px] h-[25px] fill-current" fill="currentColor" height="1.4rem" viewBox="0 0 576 512">
                    <path d="M547.6 103.8L490.3 13.1C485.2 5 476.1 0 466.4 0H109.6C99.9 0 90.8 5 85.7 13.1L28.3 103.8c-29.6 46.8-3.4 111.9 51.9 119.4c4 .5 8.1 .8 12.1 .8c26.1 0 49.3-11.4 65.2-29c15.9 17.6 39.1 29 65.2 29c26.1 0 49.3-11.4 65.2-29c15.9 17.6 39.1 29 65.2 29c26.2 0 49.3-11.4 65.2-29c16 17.6 39.1 29 65.2 29c4.1 0 8.1-.3 12.1-.8c55.5-7.4 81.8-72.5 52.1-119.4zM499.7 254.9l-.1 0c-5.3 .7-10.7 1.1-16.2 1.1c-12.4 0-24.3-1.9-35.4-5.3V384H128V250.6c-11.2 3.5-23.2 5.4-35.6 5.4c-5.5 0-11-.4-16.3-1.1l-.1 0c-4.1-.6-8.1-1.3-12-2.3V384v64c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V384 252.6c-4 1-8 1.8-12.3 2.3z"/></svg>
                  Product
                </router-link>
                <router-link to="/category" class="inline-flex relative items-center py-[10px] px-[10px] w-full text-sm font-medium rounded-md border-gray-200 hover:bg-gray-300  hover:text-gray-800 transition duration-400 ease-in-out">
                  <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 w-[25px] h-[25px] fill-current" fill="currentColor" height="1.4rem" viewBox="0 0 512 512">
                    <path d="M315.4 15.5C309.7 5.9 299.2 0 288 0s-21.7 5.9-27.4 15.5l-96 160c-5.9 9.9-6.1 22.2-.4 32.2s16.3 16.2 27.8 16.2H384c11.5 0 22.2-6.2 27.8-16.2s5.5-22.3-.4-32.2l-96-160zM288 312V456c0 22.1 17.9 40 40 40H472c22.1 0 40-17.9 40-40V312c0-22.1-17.9-40-40-40H328c-22.1 0-40 17.9-40 40zM128 512a128 128 0 1 0 0-256 128 128 0 1 0 0 256z"/></svg>
                  Category
                </router-link>
              </div>
            </div>
          </div>
        </div>
  </template>
  <script>
export default {
  props: {
    showSideBar: Boolean,
  },
}
</script>
  <style scoped>
  </style>