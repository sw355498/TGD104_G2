<template>
  <header>
    <nav class="menu_index_nav">
      <div class="logo_index_nav">
        <span>
          <router-link to="/index">
            <svg><use xlink:href="#Logo" /></svg>
          </router-link>
        </span>
      </div>
      <!-- nav menus -->
      <div class="wrap_index_nav">
        <!-- Member button-->
        <router-link
          to="/p08_user"
          class="h6_component big_button member_index_nav"
        >
          <i class="fa-solid fa-user"></i>
        </router-link>
        <!-- hamburger content menus -->
        <ul class="links_index_nav" :class="{ active: isActive }">
          <li v-for="navItem in nav" :key="navItem.id">
            <router-link
              :to="{ path: navItem.router }"
              class="h6_component"
              target="_parent"
            >
              {{ navItem.name }}
            </router-link>
          </li>
        </ul>
        <!-- hamburger icon -->
        <div class="hamburger" @click="navClick">
          <svg
            class="ham hamRotate ham4"
            viewBox="0 0 100 100"
            width="50"
            onclick="this.classList.toggle('active')"
          >
            <path
              class="line top"
              d="m 70,33 h -40 c 0,0 -8.5,-0.149796 -8.5,8.5 0,8.649796 8.5,8.5 8.5,8.5 h 20 v -20"
            />
            <path class="line middle" d="m 70,50 h -40" />
            <path
              class="line bottom"
              d="m 30,67 h 40 c 0,0 8.5,0.149796 8.5,-8.5 0,-8.649796 -8.5,-8.5 -8.5,-8.5 h -20 v 20"
            />
          </svg>
          <!-- <svg><use xlink:href="#navham" /></svg> -->
        </div>
      </div>
    </nav>
  </header>
</template>

<script>
import { ref, reactive } from "vue";

export default {
  name: "navbar",
  setup() {
    //nav資料
    const nav = reactive([
      {
        id: "p01",
        router: "/p01",
        name: "最新消息",
      },
      {
        id: "p02",
        router: "/p02",
        name: "防範詐騙教學",
      },
      {
        id: "p03",
        router: "/reportUrl",
        name: "回報可疑網站",
      },
      {
        id: "p04",
        router: "/p04",
        name: "政府資訊連結",
      },
      {
        id: "p05",
        router: "/p05",
        name: "詐騙FAQ",
      },
      {
        id: "p06",
        router: "/discuss",
        name: "討論專區",
      },
      {
        id: "p09",
        router: "/p09_team",
        name: "團隊介紹",
      },
    ]);

    //判斷開啟ul
    const isActive = ref(false);
    const bodyTag = document.body;
    bodyTag.style.cssText = "";
    // const
    const navClick = () => {
      //切換狀態active狀態
      isActive.value = !isActive.value;
      //判斷背景不可滑動
      bodyTag.style.cssText = isActive.value
        ? "height:100vh;overflow-y:hidden;"
        : "";
    };

    return {
      isActive,
      nav,
      navClick,
    };
  },
};
</script>
