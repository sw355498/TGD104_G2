<template>
  <div class="body_p07_demoPhone_block">
    <!-- header  -->
    <frontNavbar />
    <!-- top select demoModel button -->
    <p07_demo_nav />

    <!-- main block -->
    <main>
      <div class="container">
        <div class="row position-relative justify-content-center">
          <!-- 音量區塊 -->
          <div
            class="volume_p07_demoPhone_phone position-absolute col-12 d-flex"
          >
            <!-- 音量按鈕 svg -->
            <svg><use xlink:href="#volume" /></svg>
            <!-- 喇叭svg -->
            <svg><use xlink:href="#speaker" /></svg>
          </div>
          <!-- 電話顯示區 -->
          <div class="phoneLayout_p07_demoPhone_phone position-relative">
            <img
              class="position-absolute"
              src="../assets/img/p07_demo/p07_demoPhone/p07_demoPhone_iPhoneSilver.png"
              alt=""
            />
            <img
              class="position-absolute"
              src="../assets/img/p07_demo/p07_demoPhone/p07_demoPhone_widgets.png"
              alt=""
            />
          </div>
          <!-- 教學機器人 -->
          <div
            class="robot_p07_demoPhone_phone position-absolute col-lg-5 col-12"
          >
            <!-- 機器人svg -->
            <div class="talkbox">
              <div class="talk-bubble tri-right round right-in">
                <!-- 機器人 talk bubble -->
                <div class="talktext">
                  <p>
                    ＢＢＱ啦！！ 真的就被惡意的詐騙集團詐騙錢了！
                    請注意對方還會再次要你輸入一次說要將錢匯回來千萬！千萬！千萬記得「不要再次上當」
                  </p>
                  <button class="small_button">我已準備好</button>
                </div>
              </div>
            </div>
            <svg class="position-absolute">
              <use xlink:href="#robot" />
            </svg>
          </div>
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
