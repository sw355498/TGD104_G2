<template>
  <div class="body_p07_demoLine">
    <!-- navgation -->
    <frontNavbar />

    <!-- demo 體驗的 nav -->
    <p07_demo_nav />
    <section class="main_p07_demoLine">

      <!-- line 背景 -->
      <div class="line_p07_demoLine">

        
        <!-- 遮罩 -->
        <div class="line_p07_demoLine_chatCover">
          <img class="userClicked" src="../assets/img/p07_demo/p07_demoLine/a_user.jpg">
          <img class="userClicked" src="../assets/img/p07_demo/p07_demoLine/b-user_clicked.jpg">
        </div>

        <!-- line 聊天區 -->
        <div class="line_p07_demoLine_chatContainer">
          <p07_demoLineRoleA />
        </div>

                
        <!-- 筆 -->
        <div class="applepencil_p07_demoLine">
          <img src="../assets/img/p07_demo/p07_demoLine/ApplePencil.png" alt="applepencil">
        </div>

      </div>
    </section>
      <!-- footer -->
      <frontFooter />
  </div>
</template>


<script>
import p07_demoLineRoleA from '@/components/p07_demoLineRoleA.vue'
import p07_demo_nav from "@/components/p07_demo_nav.vue"
import frontNavbar from "@/components/f_nav.vue"
import frontFooter from "@/components/f_footer.vue"

export default {
  components: {
    p07_demo_nav,
    frontNavbar,
    frontFooter,
    p07_demoLineRoleA
  }
}

</script>

<style scoped></style>