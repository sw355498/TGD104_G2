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
          :src="
            require(`@/assets/img/p07_demo/p07_demoPhone/${phoneScreen[itemIndex]}`)
          "
          alt=""
        />
      </div>
      <!-- 教學機器人 -->
      <div class="robot_p07_demoPhone_phone d-inline-block">
        <!-- 機器人 talk bubble -->
        <div class="talk-bubble">
          <div class="talktext">
            <p v-text="talkBubble[itemIndex]"></p>
            <button
              class="small_button"
              v-show="itemIndex <= phoneScreen.length"
              @click="next"
            >
              {{ buttonWord[itemIndex] }}
            </button>
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

const itemIndex = ref(0);
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

const phoneScreen = ref([
  `p07_demoPhone_widgets.png`,
  `p07_demoPhone_bankAccountPage00.png`,
  `p07_demoPhone_bankAccountPage01.png`,
  `p07_demoPhone_bankAccountPage02.jpg`,
  `p07_demoPhone_bankAccountPage03.jpg`,
  `p07_demoPhone_bankAccountPage04.jpg`,
  `p07_demoPhone_bankAccountPage05.jpg`,
]);
const talkBubble = ref([
  `準備開始進入惡意的詐騙集團來電話體驗`,
  `有來電囉！請接起電話`,
  `請注意惡意的詐騙集團騙您操作`,
  `惡意的詐騙集團會請您輸入她的帳戶說是驗證`,
  `惡意的詐騙集團故意用第一次驗證錯誤告訴您是正常取得您的信任，接著會在是第二次或第三次`,
  `這次惡意的詐騙集團會在最後一次給您真正的帳戶讓您掉入陷阱直接輸入正確帳號匯款`,
  `ＢＢＱ啦！！真的就被惡意的詐騙集團詐騙錢了！請注意對方還會再次要你輸入帳號測試說要將錢匯回來千萬！千萬！千萬記得「不要再次上當」`,
]);
const buttonWord = ref([
  `我已準備好`,
  `接聽來電`,
  `切換手機桌面`,
  `確認輸入帳戶`,
  `再次輸入帳戶`,
  `再次點選`,
  `重新體驗`,
]);

const next = () => {
  console.log(itemIndex.value);
  itemIndex.value++;
  // if (this.index === this.phoneScreen.length) {
  //   this.index = 0;
  // }
};
</script>

<style></style>
