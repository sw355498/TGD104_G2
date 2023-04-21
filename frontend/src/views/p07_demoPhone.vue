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
    <main class="position-relative">
      <!-- 音量區塊 -->
      <div class="volume_p07_demoPhone_phone d-inline-block">
        <!-- 音量按鈕 svg -->
        <svg
          width="144"
          height="54"
          viewBox="0 0 144 54"
          fill="none"
          xmlns="http://www.w3.org/2000/svg"
        >
          <path
            fill-rule="evenodd"
            clip-rule="evenodd"
            d="M0 0L29 10.875V54H0V0ZM32 54V12L58 21.75V54H32ZM61 54H87V32.625L61 22.875V54ZM116 54H90V33.75L116 43.5V54ZM119 54H144L119 44.625V54Z"
            fill="#D9D9D9"
          />
        </svg>
        <!-- 喇叭svg -->
        <svg
          width="70"
          height="70"
          viewBox="0 0 70 70"
          fill="none"
          xmlns="http://www.w3.org/2000/svg"
        >
          <path
            fill-rule="evenodd"
            clip-rule="evenodd"
            d="M49.0501 47.0613L35.5834 57.1568C31.7378 60.0396 26.25 57.297 26.25 52.4922L26.25 17.5081C26.25 12.7034 31.7378 9.9607 35.5834 12.8436L49.0501 22.939C49.3963 23.1985 49.8172 23.3388 50.2498 23.3388H58.3334C61.555 23.3388 64.1667 25.9493 64.1667 29.1695V40.8309C64.1667 44.051 61.555 46.6615 58.3334 46.6615H50.2498C49.8172 46.6615 49.3963 46.8018 49.0501 47.0613ZM19.2523 51.4356C20.4363 51.6759 21.5909 50.911 21.8312 49.727C22.0716 48.543 21.3066 47.3884 20.1226 47.148C14.4655 45.9997 10.2083 40.9947 10.2083 35.0002C10.2083 29.0058 14.4655 24.0007 20.1226 22.8524C21.3066 22.612 22.0716 21.4574 21.8312 20.2734C21.5909 19.0895 20.4363 18.3245 19.2523 18.5648C11.5963 20.1189 5.83328 26.8841 5.83328 35.0002C5.83328 43.1163 11.5963 49.8815 19.2523 51.4356ZM18.5921 41.9467C19.6379 42.5516 20.976 42.1942 21.581 41.1485C22.1859 40.1027 21.8285 38.7646 20.7828 38.1596C19.6873 37.526 18.9583 36.3469 18.9583 35.0002C18.9583 33.6535 19.6873 32.4745 20.7828 31.8408C21.8285 31.2359 22.1859 29.8977 21.581 28.8519C20.976 27.8062 19.6379 27.4488 18.5921 28.0538C16.2004 29.4373 14.5833 32.0286 14.5833 35.0002C14.5833 37.9718 16.2004 40.5631 18.5921 41.9467Z"
            fill="#D6EEFF"
          />
        </svg>
      </div>
      <!-- 教學機器人 -->
      <div class="robot_p07_demoPhone_phone d-inline-block">
        <!-- 機器人 talk bubble -->
        <div class="talk-bubble">
          <div class="talktext">
            <p v-text="phoneScreen[itemIndex].talkBubble"></p>
            <button
              class="small_button"
              v-show="itemIndex <= phoneScreen.length - 1"
              @click="next"
            >
              {{ phoneScreen[itemIndex].buttonWord }}
            </button>
          </div>
        </div>
        <!-- 機器人svg -->
        <svg class="">
          <use xlink:href="#robot" />
        </svg>
      </div>
      <!-- 電話顯示區 -->
      <div class="phoneLayout_p07_demoPhone_phone">
        <div class="imgBox position-relative">
          <img
            src="../assets/img/p07_demo/p07_demoPhone/p07_demoPhone_iPhoneSilver.png"
            alt=""
          />
          <transition
            v-for="(item, idx) of phoneScreen"
            :key="item.id"
            name="slide-right"
          >
            <img
              :src="
                require(`@/assets/img/p07_demo/p07_demoPhone/${item.photo}`)
              "
              alt="phoneScreenContent"
              v-if="idx == showImg && item.photo"
            />
            <p07_demoPhoneAnswerPhone
              v-else-if="
                idx == showImg && item.components === `p07_demoPhoneAnswerPhone`
              "
            />
            <p07_demoPhoneBankInput
              v-else-if="
                idx == showImg && item.components === `p07_demoPhoneBankInput`
              "
            />
          </transition>
        </div>
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
import p07_demoPhoneBankInput from "@/components/p07_demoPhoneBankInput.vue";
import p07_demoPhoneAnswerPhone from "@/components/p07_demoPhoneAnswerPhone.vue";

//參數設定
const showModal = ref(true);
const itemIndex = ref(0);
const showImg = ref(0);

/**
 * 個欄位資料
 **/
//彈窗提示內容
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

//螢幕畫面
const phoneScreen = ref([
  {
    photo: `p07_demoPhone_widgets.png`,
    id: `widgets`,
    talkBubble: `準備開始進入惡意的詐騙集團來電話體驗`,
    buttonWord: `我已準備好`,
  },
  {
    components: `p07_demoPhoneAnswerPhone`,
    id: `AnswerPhone`,
    talkBubble: `有來電囉！請接起電話`,
    buttonWord: `接聽來電`,
  },
  {
    photo: `p07_demoPhone_bankAccountPage01.png`,
    id: `bankAccountPage01`,
    talkBubble: `請注意惡意的詐騙集團騙您操作`,
    buttonWord: `切換網路銀行畫面`,
  },
  {
    components: `p07_demoPhoneBankInput`,
    id: `BankInput`,
    talkBubble: `惡意的詐騙集團會請您輸入她的帳戶說是驗證`,
    buttonWord: `確認輸入帳戶`,
  },
  {
    photo: `p07_demoPhone_bankAccountPage03.png`,
    id: `bankAccountPage03`,
    talkBubble: `惡意的詐騙集團故意用第一次驗證錯誤告訴您是正常取得您的信任，接著會在是第二次或第三次`,
    buttonWord: `再次輸入帳戶`,
  },
  {
    components: `p07_demoPhoneBankInput`,
    id: `BankInput`,
    talkBubble: `這次惡意的詐騙集團會在最後一次給您真正的帳戶讓您掉入陷阱直接輸入正確帳號匯款`,
    buttonWord: `再次點選`,
  },
  {
    photo: `p07_demoPhone_bankAccountPage05.png`,
    id: `bankAccountPage05`,
    talkBubble: `ＢＢＱ啦！！真的就被惡意的詐騙集團詐騙錢了！請注意對方還會再次要你輸入帳號測試說要將錢匯回來千萬！千萬！千萬記得「不要再次上當」`,
    buttonWord: `重新體驗`,
  },
]);

//顯示下一則內容function
const next = () => {
  itemIndex.value >= phoneScreen.value.length - 1
    ? (itemIndex.value = 0)
    : itemIndex.value++;
  setShowImg();
};
const setShowImg = (changeIdx = 1) => {
  switch (true) {
    case changeIdx === 1 && showImg.value === phoneScreen.value.length - 1:
      showImg.value = 0;
      break;
    case changeIdx === -1 && showImg.value === 0:
      showImg.value = phoneScreen.value.length - 1;
      break;
    default:
      showImg.value = showImg.value + changeIdx;
      break;
  }
};
</script>

<style></style>
