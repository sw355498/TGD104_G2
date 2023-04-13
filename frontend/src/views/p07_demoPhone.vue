<template>
  <div class="body_p07_demoPhone_block">
    <!-- header  -->
    <frontNavbar />
    <!-- 提醒環境設定popup -->
    <Teleport to="body">
      <Modal :show="showModal" @close="showModal = false">
        <template #header>
          <div></div>
        </template>
        <template #body>
          <div v-html="setupTips"></div>
        </template>
        <template #footer>
          <button class="medium_button">確認設定好裝置</button>
        </template>
      </Modal>
    </Teleport>
    <!-- top select demoModel button -->
    <p07_demo_nav />

    <!-- main block -->
    <main>
      <!-- 音量區塊 -->
      <div class="volume_p07_demoPhone_phone d-inline-block">
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
      <div class="robot_p07_demoPhone_phone d-inline-block">
        <!-- 機器人 talk bubble -->
        <div class="talk-bubble">
          <div class="talktext">
            <p>
              ＢＢＱ啦！！ 真的就被惡意的詐騙集團詐騙錢了！
              請注意對方還會再次要你輸入一次說要將錢匯回來千萬！千萬！千萬記得「不要再次上當」
            </p>
            <button class="small_button">我已準備好</button>
          </div>
        </div>
        <!-- 機器人svg -->
        <svg class="">
          <use xlink:href="#robot" />
        </svg>
      </div>
    </main>
    <!--Main Block end -->
    <frontFooter />
  </div>
</template>

<script setup>
import { ref } from "vue";
import frontNavbar from "@/components/f_nav.vue";
import frontFooter from "@/components/f_footer.vue";
import p07_demo_nav from "@/components/p07_demo_nav.vue";
import Modal from "@/components/modal.vue";

const showModal = ref(true);
const setupTips = ref(`
  歡迎來到手機詐騙體驗；</br>
  以下皆為體驗過程，</br>
  不含有任何私人訊息及個資，</br>
  還請放心；</br>
  請開始前準備好您的耳機或音響，</br>
  因過程中會搭配語音播放，</br>
  請調整好您的裝置音量避免聲音造成您的困擾，</br>
  感謝您的配合。
`);
</script>

<style></style>
