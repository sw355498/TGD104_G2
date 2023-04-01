<script setup>
import { RouterLink, RouterView } from 'vue-router'
</script>

<template>
  <nav>
    <RouterLink to="/index">首頁</RouterLink> |
    <RouterLink to="/p01">p01最新</RouterLink> |
    <RouterLink to="/p02">p02教學</RouterLink> |
    <RouterLink to="/reportUrl">p03回報可疑網站</RouterLink> |
    <RouterLink to="/p04">p04_gov</RouterLink> |
    <RouterLink to="/p05">p05_faq</RouterLink> |
    <RouterLink to="/p06">p06_discuss</RouterLink> |
    <RouterLink to="/p07demoShopping">p07_demoShopping</RouterLink> |
    <RouterLink to="/p07demoGame">p07_demoGame</RouterLink> |
    <RouterLink to="/p07demoGamep01">p07_demoGame_p01</RouterLink> |
    <RouterLink to="/p07demoLine">p07_demoLine</RouterLink> |
    <RouterLink to="/p07demoPhone">p07_demoPhone</RouterLink> |
    <RouterLink to="/p08_user">p08_user</RouterLink> |
    <RouterLink to="/p08_userLogin">p08_userLogin</RouterLink> |
    <RouterLink to="/p09_team">p09_team</RouterLink> |
    <RouterLink to="/b_user">會員管理</RouterLink> ｜
  </nav>
  <RouterView/>
</template>
