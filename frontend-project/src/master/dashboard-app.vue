<template>
  <div class="h-screen w-screen">
    <div class="flex h-full">
      <!-- Sidebar -->
      <transition name="fade" mode="out-in">
        <div class=" w-[400px] h-full  text-white transition" v-show="showSideBar">
          <div class="h-[50px] bg-gray-900 flex items-center">
            <div class="font-bold text-xl px-[20px]">Coding challenge</div>
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
      </transition>
      <!-- Main -->
      <div class="w-full h-full ">
        <!-- header -->
        <div class="h-[50px] bg-gray-100 flex items-center shadow-sm px-[20px] w-full py-[10px] z-10 border-b">
          <div class="cursor-pointer w-[30px]" @click="toggleSideBar">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class=" w-[25px] h-[25px]">
              <path d="M0 96C0 78.3 14.3 64 32 64H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32z" />
            </svg>
          </div>
          <div class="w-[calc(100%-30px)] flex">
            <div class="w-[calc(100%-200px)] flex justify-center ">
            </div>
            <div class="w-[200px] ">
              <div class="flex items-center justify-start space-x-4" @click="toggleDrop">
                <img class="w-10 h-10 rounded-full border-2 border-gray-50" src="https://youcan.shop/images/brand_images/Logo-YouCan-4.png" alt="">
                <div class="font-semibold dark:text-white text-left">
                  <div>Youcan</div>
                  <div class="text-xs text-gray-500 dark:text-gray-400">Admin</div>
                </div>
              </div>
              <div v-show="showDropDown" class="absolute right-[10px] z-10 mt-2 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
                <div class="py-1 text-left" role="none">
                  <a href="#" class="text-gray-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="menu-item-0">Account settings</a>
                  <a href="#" class="text-gray-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="menu-item-1">Support</a>
                  <a href="#" class="text-gray-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="menu-item-2">License</a>
                  <form method="POST" action="#" role="none">
                    <button type="submit" class="text-gray-700 block w-full px-4 py-2 text-left text-sm" role="menuitem" tabindex="-1" id="menu-item-3">Sign out</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="bg-gray-50  h-[calc(100%-50px)] p-[20px]">
          <div class="border rounded-md h-full p-[20px]">
            <router-view></router-view>
          </div>
        </div>
        <!-- Main body -->
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'dashboard-app',
  data() {
    return {
      showSideBar: true,
      showDropDown: false
    }
  },
  created() {
  },
  methods: {
    closeIfClickedOutside() {
      this.showDropDown = false
    },
    toggleSideBar() {
      this.showSideBar = !this.showSideBar
    },
    toggleDrop() {
      this.showDropDown = !this.showDropDown
    }
  }

}
</script>

<style>
.router-link-exact-active {
  @apply bg-gray-200 text-gray-800
}
</style>