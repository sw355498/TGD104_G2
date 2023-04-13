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
          <img @click="switchRoleA" class="userClicked" src="../assets/img/p07_demo/p07_demoLine/a_user.jpg">
          <img @click="switchRoleB" class="userClicked" src="../assets/img/p07_demo/p07_demoLine/b-user_clicked.jpg">
        </div>

        <!-- line 聊天區 -->
        <div class="line_p07_demoLine_chatContainer">
          <component :is="currentRole" style="color: #00092E; margin-top: 60px; margin-bottom: 0px;">&lt--- 請選擇男網友或女網友</component>
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


<script setup>
  import { ref } from 'vue'
  import p07_demoLineRoleA from '@/components/p07_demoLineRoleA.vue'
  import p07_demoLineRoleB from '@/components/p07_demoLineRoleB.vue'
  import p07_demo_nav from "@/components/p07_demo_nav.vue"
  import frontNavbar from "@/components/f_nav.vue"
  import frontFooter from "@/components/f_footer.vue"

  const currentRole = ref('h2')
  const switchRoleA = () => {
    currentRole.value = p07_demoLineRoleA
  }
  const switchRoleB = () => {
    currentRole.value = p07_demoLineRoleB
  }

</script>

<style scoped></style>