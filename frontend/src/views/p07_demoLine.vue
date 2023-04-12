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
          <component :is="currentRole"></component>
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
import { ref, onMounted } from 'vue'
import p07_demoLineRoleA from '@/components/p07_demoLineRoleA.vue'
import p07_demoLineRoleB from '@/components/p07_demoLineRoleB.vue'
import p07_demo_nav from "@/components/p07_demo_nav.vue"
import frontNavbar from "@/components/f_nav.vue"
import frontFooter from "@/components/f_footer.vue"

export default {
  components: {
    p07_demo_nav,
    frontNavbar,
    frontFooter,
    p07_demoLineRoleA,
    p07_demoLineRoleB
  },
  setup() {
    const currentRole = ref('p07_demoLineRoleA')
    const switchRoleA = () => {
      if(currentRole.value === 'p07_demoLineRoleB'){
        currentRole.value = 'p07_demoLineRoleA'
      }
    }
    const switchRoleB = () => {
      if(currentRole.value === 'p07_demoLineRoleA'){
        currentRole.value = 'p07_demoLineRoleB'
      }
    }
    onMounted(() => {
      
    })
    return{
      currentRole,
      switchRoleA,
      switchRoleB
    }
  },
}

</script>

<style scoped></style>