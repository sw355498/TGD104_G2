<template>
  <header>
    <!-- Navgation Bar -->
    <nav class="menu_index_nav">
      <div class="logo_index_nav">
        <span
          ><a href="#"><img src="../assets/img/Logo.png" /></a
        ></span>
      </div>
      <!-- Member Button Block -->
      <div class="wrap_index_nav">
        <a
          class="h6_component big_button member_index_nav"
          href="../views/pages/p08_user.html"
          target="_parent"
          ><i class="fa-solid fa-user"></i>
        </a>

        <ul class="links_index_nav">
          <li v-for="menu in menus">
            <a
              class="h6_component"
              href="../views/pages/p01_news.html"
              target="_parent"
              >{{ menu. }}最新消息</a
            >
          </li>
          <li>
            <a
              class="h6_component"
              href="../views/pages/p02_teach.html"
              target="_parent"
              >防範詐騙教學</a
            >
          </li>
          <li>
            <a
              class="h6_component"
              href="../views/pages/p03_reportURL.html"
              target="_parent"
              >回報可疑網站</a
            >
          </li>
          <li>
            <a
              class="h6_component"
              href="../views/pages/p04_gov.html"
              target="_parent"
              >政府資訊連結</a
            >
          </li>
          <li>
            <a
              class="h6_component"
              href="../views/pages/p05_faq.html"
              target="_parent"
              >詐騙FAQ</a
            >
          </li>
          <li>
            <a
              class="h6_component"
              href="../views/pages/p06_discuss.html"
              target="_parent"
              >討論專區</a
            >
          </li>
          <li>
            <a
              class="h6_component"
              href="../views/pages//p09_team.html"
              target="_parent"
              >團隊介紹</a
            >
          </li>
        </ul>
        <div class="hamburger">
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
        </div>
      </div>
    </nav>
    <!-- <hr /> -->
    <!-- Navgation Bar end-->
  </header>
</template>
<script>
export default {
  data() {
    return {
      menulink: [
        "最新消息",
        "防範詐騙教學",
        "回報可疑網站",
        "政府資訊連結",
        "討論專區",
        "詐騙FAQ",
        "團隊介紹",
      ],
      menubtn: ["DEMO體驗", "會員登入/註冊"],
    };
  },
};
</script>
<style></style>
