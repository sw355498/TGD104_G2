<template>
  <nav v-if="$route.path === '/'">
    <router-link to="/index">首頁</router-link> |
    <router-link to="/b_index">後台管理</router-link> ｜
  </nav>
  <router-view></router-view>
</template>

<style lang="scss"></style>
