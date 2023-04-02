<template>
  <div class="body_p07_demoPhone_block">
    <!-- header  -->
    <frontNavbar />
    <!-- top select demoModel button -->
    <p07_demo_nav />

    <!-- main block -->
    <main>
      <div class="demoPhone_p07_demoPhone_block">
        <!-- 教學機器人 -->
        <div class="robot_p07_demoPhone_phone">
          <!-- 機器人svg -->
          <div class="talk-bubble tri-right round right-in">
            <div class="talktext">
              <p class="">準備開始進入惡意的詐騙集團來電話體驗</p>
              <button class="small_button">我已準備好</button>
            </div>
          </div>
          <svg><use xlink:href="#robot" /></svg>
          <!-- 機器人 talk bubble -->
        </div>
        <!-- 電話顯示區 -->
        <div class="phoneLayout_p07_demoPhone_phone">
          <img
            src="../assets/img/p07_demo/p07_demoPhone/p07_demoPhone_iPhoneSilver.png"
            alt=""
          />
          <img
            src="../assets/img/p07_demo/p07_demoPhone/p07_demoPhone_widgets.png"
            alt=""
          />
        </div>
        <!-- 音量調整區 -->
        <div class="volume_p07_demoPhone_phone">
          <!-- 音量按鈕 svg -->
          <svg><use xlink:href="#volume" /></svg>
          <!-- 喇叭svg -->
          <svg><use xlink:href="#speaker" /></svg>
        </div>
      </div>
    </main>
    <!--Main Block end -->
    <frontFooter />
  </div>
</template>

<script>
import { ref } from "vue";
import frontNavbar from "@/components/f_nav.vue";
import frontFooter from "@/components/f_footer.vue";
import p07_demo_nav from "@/components/p07_demo_nav.vue";

export default {
  name: "phshingPhone",
  components: {
    p07_demo_nav,
    frontNavbar,
    frontFooter,
  },
};
</script>

<style></style>
