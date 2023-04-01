<template>
  <div class="body_p07_demoLine">

    <!-- demo 體驗的 nav -->
    <p07_demo_nav />
    <section class="main_p07_demoLine">

      <!-- line 背景 -->
      <div class="line_p07_demoLine">

        <!-- line 聊天區 -->
        <div class="line_p07_demoLine_chatContainer">

          <!-- line 聊天框框 -->
          <div class="line_p07_demoLine_chatMessage">
            <img src="../assets/img/p07_demo/p07_demoLine/a_user_pic.png">
            <div class="line_p07_demoLine_chatMessages">
              <p class="line_p07_demoLine_chatMessagesName">Matthew Wu</p>
              <div class="line_p07_demoLine_chatMessagesContent">
                <p class="line_p07_demoLine_chatMessagesContents">抱歉~打擾您一下</p>
              </div>
            </div>
            <span class="line_p07_demoLine_chatMessageTimestamp"></span>
          </div>
        </div>
        <!-- <img src="../assets/img/p07_demo/p07_demoLine/linebg.png" alt="Line"> -->
      </div>
      <!-- 筆 -->
      <div class="applepencil_p07_demoLine">
        <img src="../assets/img/p07_demo/p07_demoLine/a_user_pic.png" alt="applepencil">
      </div>
    </section>
  </div>
</template>


<script>
import p07_demo_nav from "@/components/p07_demo_nav.vue";
export default {
    components: {
    p07_demo_nav
    }
}
</script>