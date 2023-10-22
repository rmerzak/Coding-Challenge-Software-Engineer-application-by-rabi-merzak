<template>
  <div class="h-screen w-screen">
    <div class="flex h-full">
      <Sidebar :showSideBar="showSideBar" />
      <div class="w-full h-full">
        <Header :toggleSideBar="toggleSideBar" />
        <div class="border rounded-md h-full p-[10px]">
          <router-view></router-view>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import Header from "./Header.vue";
import Sidebar from "./SideBar.vue";

export default {
  name: "dashboard-app",
  data() {
    return {
      showSideBar: true,
    };
  },
  methods: {
    toggleSideBar() {
      this.showSideBar = !this.showSideBar;
    },
  },
  components: {
    Header,
    Sidebar,
  },
};
</script>
<style>
.router-link-exact-active {
  @apply bg-gray-200 text-gray-800;
}
</style>
