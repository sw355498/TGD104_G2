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
        <div class="line_p07_demoLine_chatCover"></div>

        <!-- line 聊天區 -->
        <div class="line_p07_demoLine_chatContainer">
               
          <!-- 聊天框框 (左) -->
          <div class="line_p07_demoLine_chatMessageLeft">

            <!-- 聊天框的大頭貼 -->            
            <img src="../assets/img/p07_demo/p07_demoLine/a_user_pic.png">
            
            <!-- 對話內容 (由程式產生對話的位置)-->
            <div class="line_p07_demoLine_chatMessagesContentLeft">
              <!-- 對話文字 -->
              <p class="line_p07_demoLine_chatMessagesText">早安，親愛的，昨晚睡得還好嗎？</p>
              <!-- 時間 -->
              <span class="line_p07_demoLine_chatMessageTimestamp">上午 11:12</span>
            </div>


            <div class="line_p07_demoLine_chatMessagesContentLeft">
              <p class="line_p07_demoLine_chatMessagesText">想你了，想一直和妳在一起~</p>
              <span class="line_p07_demoLine_chatMessageTimestamp">上午 11:13</span>
            </div>
            <div class="line_p07_demoLine_chatMessagesContentLeft">
              <p class="line_p07_demoLine_chatMessagesText">今天上班一直都在想妳都沒辦法專心</p>
              <span class="line_p07_demoLine_chatMessageTimestamp">上午 11:14</span>
            </div>
            







          </div>

          <!-- 聊天框框 (右) -->
          <div class="line_p07_demoLine_chatMessageRight">
            <span class="line_p07_demoLine_chatMessageTimestamp">上午 11:17</span>
            <p class="line_p07_demoLine_chatMessagesText">我也是</p>
          </div>


          <!-- 聊天框框 (左) -->
          <div class="line_p07_demoLine_chatMessageLeft">

            <!-- 聊天框的大頭貼 -->            
            <img src="../assets/img/p07_demo/p07_demoLine/a_user_pic.png">
            
            <!-- 對話內容 (由程式產生對話的位置)-->
            <div class="line_p07_demoLine_chatMessagesContentLeft">
              <!-- 對話文字 -->
              <p class="line_p07_demoLine_chatMessagesText">我最近想了很多，真的很想和你一起有一個家，我們一起努力好嗎？</p>
              <!-- 時間 -->
              <span class="line_p07_demoLine_chatMessageTimestamp">上午 11:18</span>
            </div>


            <div class="line_p07_demoLine_chatMessagesContentLeft">
              <p class="line_p07_demoLine_chatMessagesText">我同事介紹一個穩賺不賠的理財課程，你可以陪我一起上嗎？</p>
              <span class="line_p07_demoLine_chatMessageTimestamp">上午 11:19</span>
            </div>
            <div class="line_p07_demoLine_chatMessagesContentLeft">
              <p class="line_p07_demoLine_chatMessagesText">還有呀為了我們未來的幸福著想，要不要一起投資虛擬貨幣？妳覺得呢？</p>
              <span class="line_p07_demoLine_chatMessageTimestamp">上午 11:20</span>
            </div>
            







          </div>

          
          
          <!-- Demo 按鈕 -->
          <button class="line_p07_demoLine_chatMessageButton">嗯.....讓我想一下好嗎</button>

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
import p07_demo_nav from "@/components/p07_demo_nav.vue";

import frontNavbar from "@/components/f_nav.vue";
import frontFooter from "@/components/f_footer.vue";

export default {
  components: {
    p07_demo_nav,
    frontNavbar,
    frontFooter,
  }
}
</script>

<style scoped></style>