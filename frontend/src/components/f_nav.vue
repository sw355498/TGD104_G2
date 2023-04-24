<template>
  <header>
    <nav class="menu_index_nav">
      <router-link to="/index" class="logo_index_nav">
        <svg><use xlink:href="#Logo" /></svg>
      </router-link>
      <!-- nav menus -->
      <div class="wrap_index_nav">
      <!-- 會員註冊 -->
      <div v-if="!hasToken">
        <a
          type="button"
          @click="showModal"
          class="d-flex flex-row text-white align-items-center"
        >
        <div class="h6_component big_button member_index_nav "><i class="fa-solid fa-user"></i></div>
        <span class="mx-2">註冊/登入</span>

      </a>
      </div>
      <Modal v-show="isModalVisible" @close="closeModal" />
      <!-- 會員註冊結束 -->

      <!-- 會員登入 -->
      <div v-if="hasToken">
        <a
          href="#"
          role="button"
          data-bs-toggle="dropdown"
          aria-expanded="false"
          class="dropdown d-flex flex-row text-white align-items-center"
        >
        <div class="h6_component big_button member_index_nav "><i class="fa-solid fa-user"></i></div>
        <div>
        <span v-if="name !== undefined && name !== ''" class="mx-2">{{ name }}</span>
        <span v-else class="mx-2">會員您好</span>
      </div>
        </a>
         <!-- Member button-->

        <ul class="dropdown-menu dropdown-menu-dark">
          <!-- <li>
            <router-link to="/userNotify" class="dropdown-item">
              <i class="fa-solid fa-bell"></i> 通知<span class="nofity_count"
                >2</span
              ></router-link
            >
          </li> -->
          <li>
            <router-link to="/user" class="dropdown-item"
              >我的主頁</router-link
            >
          </li>
          <li>
            <router-link to="/userEdit" class="dropdown-item"
              >編輯會員資料</router-link
            >
          </li>
          <li>
            <router-link to="/userEditPwd" class="dropdown-item"
              >修改密碼</router-link
            >
          </li>
          <li @click="logout"><a class="dropdown-item">登出</a></li>
        </ul>
        </div>
      <!-- 會員登入結束 -->
        <!-- hamburger content menus -->
        <ul class="links_index_nav" :class="{ active: isActive }">
          <li v-for="navItem in nav" :key="navItem.id">
            <router-link
              :to="{ path: navItem.router }"
              class="h6_component"
              v-if="navItem.router"
            >
              {{ navItem.title }}
            </router-link>
            <ul
              v-if="navItem.secMenu"
              class="h6_component"
              @click.self="nav2Click"
            >
              {{
                navItem.title
              }}
              <i class="fa-solid fa-caret-up"></i>
              <li v-for="navItem2 in navItem.secMenu" v-show="isOpen">
                <router-link :to="{ path: navItem2.router }"
                  >{{ navItem2.title }}
                </router-link>
              </li>
            </ul>
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

<script setup>
import { ref, reactive, onUnmounted } from "vue";
import Modal from "@/components/userLogin.vue";
// 抓會員資料
import axios from "axios";
import { API_URL} from "@/config";
const token = localStorage.getItem('token');
const hasToken = ref(!!token);

const name = ref('');
if (token) {
  axios
    .get(`${API_URL}/member_getData.php?token=${token}`)
    .then((response) => {
      
      name.value = response.data.member[0].NICKNAME;
      hasToken.value = true;
    })
    .catch((error) => {
      console.log(error);
    });
}
/**
 * navgation menu data & function
 */

//選單資料
const nav = reactive([
  {
    id: "p01",
    router: "/news",
    title: "最新消息",
  },
  {
    id: "p02",
    router: "/teach",
    title: "防範詐騙教學",
  },
  {
    id: "p03",
    router: "/reportUrl",
    title: "回報可疑網站",
  },
  {
    id: "p04",
    router: "/gov",
    title: "相關資訊連結",
  },
  {
    id: "p05",
    router: "/faq",
    title: "詐騙FAQ",
  },
  {
    id: "p06",
    router: "/discuss",
    title: "討論專區",
  },
  {
    id: "p07",
    title: "Demo體驗",
    secMenu: [
      {
        id: "p07demoShopping",
        router: "/demoShopping",
        title: "購物詐騙",
      },
      {
        id: "p07demoGame",
        router: "/demoGame",
        title: "詐騙知識測驗",
      },
      {
        id: "p07demoPhone",
        router: "/demoPhone",
        title: "電話詐騙",
      },
      {
        id: "p07demoLine",
        router: "/demoLine",
        title: "愛情交友詐騙",
      },
    ],
  },
  // {
  //   id: "p08",
  //   router: "/user",
  //   title: "會員中心",
  // },
  {
    id: "p09",
    router: "/team",
    title: "團隊介紹",
  },
]);

//主選單開關
const isActive = ref(false);
const bodyTag = document.body;
// bodyTag.style.cssText = "";
//開啟漢堡選單時背景固定
const navClick = () => {
  //切換狀態active狀態
  isActive.value = !isActive.value;
  //判斷背景不可滑動
  bodyTag.style.cssText = isActive.value
    ? "height:100vh;overflow-y:hidden;"
    : "";
};

//子選單開關
const isOpen = ref(false); //fa-minus
const nav2Click = (e) => {
  isOpen.value = !isOpen.value;
  e.target.children[0].style.transform = isOpen.value ? "rotate(180deg)" : "";
  // console.log(e.target.children[0]);
};

/**
 * Login data & function
 */

// 註冊按鈕
const isModalVisible = ref(false);

const showModal = () => {
  isModalVisible.value = true;
  document.body.classList.add("modal-open");
};
const closeModal = () => {
  isModalVisible.value = false;
  document.body.classList.remove("modal-open");
};
const logout = () => {
  localStorage.removeItem("token");
  localStorage.removeItem("tokenExpireTime");
  window.location.reload();
};

onUnmounted(() => {
  //跳頁時解除背景固定
  bodyTag.style.cssText = "";
});
</script>
