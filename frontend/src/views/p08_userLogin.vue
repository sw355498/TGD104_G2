<template>
  <div>
    <button type="button" @click="showModal">登入/註冊會員</button>

    <Modal v-show="isModalVisible" @close="closeModal" />

    <!-- 已登入狀態 -->
    <div class="dropdown">
      <a
        class="btn btn-secondary dropdown-toggle"
        href="#"
        role="button"
        data-bs-toggle="dropdown"
        aria-expanded="false"
      >
        會員
      </a>

      <ul class="dropdown-menu dropdown-menu-dark">
        <li><router-link to="/p08_userNotify" class="dropdown-item">
        <i class="fa-solid fa-bell"></i> 通知<span class="nofity_count">2</span></router-link></li>
        <li><router-link to="/p08_user" class="dropdown-item">我的主頁</router-link></li>
        <li><router-link to="/p08_userEdit" class="dropdown-item">編輯會員資料</router-link></li>
        <li><router-link to="/p08_userEditPwd" class="dropdown-item">修改密碼</router-link></li>
        <li><a class="dropdown-item" href="#">登出</a></li>
      </ul>
    </div>
  </div>
</template>

<script>
import Modal from "@/components/userLogin.vue";

export default {
  name: "App",
  components: {
    Modal,
  },
  data() {
    return {
      isModalVisible: false,
    };
  },
  methods: {
    showModal() {
      this.isModalVisible = true;
    },
    closeModal() {
      this.isModalVisible = false;
  },
}};
</script>

<style scoped>
</style>

