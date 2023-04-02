<template>
  <footer>
    <div class="front_footer">
      <div class="menuLink_index_footer">
        <router-link
          v-for="item in footer"
          :to="{ path: item.router }"
          :key="item.id"
        >
          | {{ item.name }}
        </router-link>
      </div>
      <div v-for="item in datas" :key="item.id" v-html="item.content"></div>
    </div>
  </footer>
</template>

<script>
import { reactive } from "vue";

export default {
  name: "footer",
  setup() {
    const datas = reactive([
      {
        id: `footer_text1`,
        content: `<p>本網站為緯育TibaMe前端設計工程師班第82期第二組學員專題成果作品</p>`,
      },
      {
        id: `footer_text2`,
        content: `<p>本平台僅供學習、展示之用</p>`,
      },
      {
        id: `footer_text3`,
        content: `<a href='https://docs.google.com/spreadsheets/d/1CTuwR6_xM6vvEPejp_E_YkuzqPjiO0KfkDCJpJb4p7o/edit?usp=sharing'>參考資料</a>`,
      },
    ]);
    const footer = reactive([
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
        router: "/p06",
        name: "討論專區",
      },
      {
        id: "p07",
        router: "/p07demoShopping",
        name: "DEMO體驗",
      },
      {
        id: "p08",
        router: "/p08_user",
        name: "會員登入",
      },
      {
        id: "p09",
        router: "/p09_team",
        name: "團隊介紹 |",
      },
    ]);
    return {
      footer,
      datas,
    };
  },
};
</script>
