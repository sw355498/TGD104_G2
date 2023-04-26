<template>
  <Loading v-if="showLoading" />
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
          <button class="medium_button" @click="showModal = false">
            確認設定好裝置
          </button>
        </template>
      </Modal>
    </Teleport>
    <!-- top select demoModel button -->
    <p07_demo_nav />

    <!-- main block -->
    <main class="position-relative">
      <!-- 音量區塊 -->
      <div class="audio_p07_demoPhone_phone d-inline-block">
        <!-- 音檔播放 -->
        <audio
          id="audioPlayer"
          v-if="phoneScreen[itemIndex].audio"
          autoplay
          :src="require(`@/assets/audio/${phoneScreen[itemIndex].audio}`)"
        ></audio>
        <span>可惡的詐騙集團對白話術</span>
        <div class="liarTalk" v-text="phoneScreen[itemIndex].liarTalk"></div>
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
            <div
              v-if="phoneScreen[itemIndex].audio"
              class="player_p07_demoPhone_audio"
            ></div>
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
            :name="item.no_change ? '' : 'slide-right'"
          >
            <img
              :src="
                require(`@/assets/img/p07_demo/p07_demoPhone/${item.photo}`)
              "
              alt="phoneScreenContent"
              v-if="idx == showImg && item.photo"
            />
            <!-- 後續補上的組件 -->
            <!-- <p07_demoPhoneAnswerPhone
              v-else-if="
                idx == showImg && item.components === `p07_demoPhoneAnswerPhone`
              "
            />
            <p07_demoPhoneBankInput
              v-else-if="
                idx == showImg && item.components === `p07_demoPhoneBankInput`
              "
            /> -->
          </transition>
        </div>
      </div>
    </main>
    <!--Main Block end -->
    <frontFooter />
  </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import Loading from "@/components/loading.vue";
import frontNavbar from "@/components/f_nav.vue";
import frontFooter from "@/components/f_footer.vue";
import p07_demo_nav from "@/components/p07_demo_nav.vue";
import Modal from "@/components/modal.vue";
// import p07_demoPhoneBankInput from "@/components/p07_demoPhoneBankInput.vue";
// import p07_demoPhoneAnswerPhone from "@/components/p07_demoPhoneAnswerPhone.vue";

//參數設定
const showLoading = ref(true); //loading判斷
const showModal = ref(true); //彈窗判斷
const itemIndex = ref(0); //資料顯示的順序
const showImg = ref(0); //資料顯示的順序

document.body.style.cssText = showModal.value
  ? "height:100vh;overflow-y:hidden;"
  : "";

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

const phoneScreen = ref([
  {
    photo: `p07_demoPhone_widgets.png`,
    talkBubble: `準備開始進入惡意的詐騙集團來電話體驗`,
    buttonWord: `我已準備好`,
    no_change: false,
    liarTalk: `請注意聲音音量`,
  },

  {
    // components: `p07_demoPhoneAnswerPhone`,
    photo: `p07_demoPhone_bankAccountPage00.png`,
    talkBubble: `有來電囉！請接起電話`,
    buttonWord: `接聽來電`,
    no_change: false,
    audio: `callin01.mp3`,
    liarTalk: `準備開始接聽來電`,
  },

  {
    photo: `p07_demoPhone_bankAccountPage01.png`,
    no_change: true,
    audio: `callin02_1.mp3`,
    liarTalk: `黃小姐您好，不好意思，這裡是蝦咪電商平台，您是不是在今年一月的時候購買了Switch Ring Con金額$1890的商品對吧，不好意思因為我們平台有受到駭客入侵，我們剛剛發現您的帳戶似乎有被盜刷一筆金額一萬多，我們想要跟您確認，您應該沒有做這個消費的動作，如果你確定沒有的話，那我們會通報銀行去將這個刷卡動作做取消`,
    talkBubble: `請注意惡意的詐騙集團電商專員跟您確認是否有被盜刷信用卡`,
    buttonWord: `確認沒有做刷卡動作`,
  },
  {
    photo: `p07_demoPhone_bankAccountPage01.png`,
    no_change: false,
    audio: `callin02_2.mp3`,
    liarTalk: `好的，那這裡我會幫您做通知刷卡銀行做取消，等下您可能也會接到刷卡銀行的電話會跟您確定說這筆卡真的被盜刷，你跟他說這是盜刷即可，那銀行跟我們這邊會幫您處理把這個款項給刪除`,
    talkBubble: `請注意惡意的詐騙集團電商專員跟您確認是否有被盜刷信用卡`,
    buttonWord: `好的謝謝(聽下一通銀行專員A電話)`,
  },

  {
    photo: `p07_demoPhone_bankAccountPage01_1.png`,
    no_change: true,
    audio: `callin03_1.mp3`,
    liarTalk: `黃小姐您好，這裡是華南商業銀行電話客服專員，敝姓王，不好意思，剛剛這裡有收到蝦咪電商的通知，說您的信用卡有被盜刷的狀況，那基於隱私安全這裡需再次跟您確認是不是沒有做這筆消費`,
    talkBubble: `請注意惡意的詐騙集團現在在換取您對他的信任,讓您不會懷疑他的談話內容真偽性`,
    buttonWord: `是的沒錯`,
  },
  {
    photo: `p07_demoPhone_bankAccountPage01_1.png`,
    no_change: true,
    audio: `callin03_2.mp3`,
    liarTalk: `好的已跟您確認，那黃小姐不好意思，因您在開戶的時候都有簽定所謂的保密協定，銀行後台是保密度很高的，所以須跟您核對一下您的身份，那這裡確認您是本行的客戶，需請您跟我們簡單核對說一下您的開戶銀行存摺前四碼`,
    talkBubble: `請注意惡意的詐騙集團現在在換取您對他的信任,讓您不會懷疑他的談話內容真偽性`,
    buttonWord: `說出前四碼`,
  },
  {
    photo: `p07_demoPhone_bankAccountPage01_1.png`,
    no_change: true,
    audio: `callin03_3.mp3`,
    liarTalk: `好的，已跟您確認資料，跟黃小姐您核對一下（一邊打字聲）您是不是在我們南京復興分行做開戶的，地址是台北市中山區南京東路三段219號`,
    talkBubble: `請注意惡意的詐騙集團現在在換取您對他的信任,讓您不會懷疑他的談話內容真偽性`,
    buttonWord: `是的沒錯`,
  },
  {
    photo: `p07_demoPhone_bankAccountPage01_1.png`,
    no_change: true,
    audio: `callin03_4.mp3`,
    liarTalk: `好的，這裡再簡單跟您做個double check，請問您是否有在其他的銀行做開戶(當下回答有)，這裡我們ㄧ樣簡單跟您做個核對的動作，請問您的另一家銀行帳戶前四碼是二零二三，跟您核對一下黃小姐您是不是在中國信託銀行的民生分行開戶的？地址是台北市中山區民生東路三段，好的已跟您確認完成，真的很抱歉造成您的困擾(開始套悲情牌跟您抱歉說是電商平台的疏忽造成這麼晚才通知您真的很抱歉)，因電商平台盜刷問題讓您做這麼多確認，非常謝謝您的配合`,
    talkBubble: `請注意惡意的詐騙集團現在在換取您對他的信任,讓您不會懷疑他的談話內容真偽性(已相信對方都是站在你這邊不疑有他)`,
    buttonWord: `了解請問結束了嗎？可以幫我退刷？`,
  },
  {
    photo: `p07_demoPhone_bankAccountPage01_1.png`,
    no_change: false,
    audio: `callin03_5.mp3`,
    liarTalk: `黃小姐真的不好意思，因為銀行的這個隱私法規真的很嚴格，沒有您的授權，我們是沒有辦法幫您做這個帳單的取消所以接下來必須請我們值班經理來跟您談，因為值班經理他的權限比較大，那他會再跟您核對一些資料後那再確認我們就會幫您做這個盜刷去取消的一個動作`,
    talkBubble: `請注意惡意的詐騙集團現在在換取您對他的信任,讓您不會懷疑他的談話內容真偽性`,
    buttonWord: `聽下一通銀行專員B電話`,
  },
  {
    photo: `p07_demoPhone_bankAccountPage01_2.png`,
    no_change: false,
    audio: `callin03_6.mp3`,
    talkBubble: `請注意惡意的詐騙集團現在已經換取您的信任，跟您說需要請您開啟授權驗證才能更正取消盜刷狀況，開始假裝跟您核對的銀行帳戶資料`,
    buttonWord: `打開網銀解鎖並進入帳戶頁面`,
    liarTalk: `黃小姐您好，我是今日值班客服經理週滑滑，那這裡剛剛王專員已跟您核對完成資料，因為您的這個隱私設定關係我們必須跟您取得一個線上授權，我才可以幫您做這個取消，請您幫忙打開您的華南銀行的網路銀行並開啟登入`,
  },
  {
    photo: `p07_demoPhone_bankAccountPage02.png`, //切換網銀畫面
    no_change: true,
    audio: `callin03_7.mp3`,
    liarTalk: `然後請您開啟後進入帳戶畫面，那您可以看到您目前的存款，因金管會規定較嚴格必須先跟您核對身份為本人，那這裡簡單跟您核對一下您的目前存款數字即可，不用精確的數字大概就好，只是要做身份確認（回答金額後，對方假裝正確核對，會假裝說沒錯核對沒問題），再跟您做個第二次確認您目前的華南銀行帳戶數目大概是？`,
    talkBubble: `惡意的詐騙集團會請您輸入她的帳戶說是驗證，並故意跟您核對資料開始套您的帳戶有多少錢`,
    buttonWord: `說出大約帳戶數字`,
  },
  {
    // components: `p07_demoPhoneBankInput`,
    photo: `p07_demoPhone_bankAccountPage04.png`,
    no_change: false,
    audio: `callin03_8.mp3`,
    liarTalk: `對的，沒問題我們後台也是顯示這樣金額的數據，那黃小姐我們需要您的一個授權動作，這裡需要請您幫忙點開轉帳的網銀，請您分行那欄位幫我選擇008 那您看到選擇008應該是華南銀行對吧，請您放心我們這裡是銀行客服我們絕對不會讓您真的轉賬出來去扣您的銀行帳戶 您大可放心，接下來您在下方欄位輸入您的身分證後9碼，您不用跟我說這是您的隱私，直接輸入您的身分證後九碼，做這個授權取消的驗證，下個欄位請您輸入7，請放心沒事，並不會因為這操作鎖您的帳戶，這是我們銀行後台公認的去解鎖的動作，還請您別擔心`,
    talkBubble: `不知不覺在信任的狀態下依照惡意的詐騙集團指示輸入您的身分證，其實是故意博取信任讓你不會懷疑他是要轉帳`,
    buttonWord: `確認輸入帳號及帳戶完成`,
  },
  {
    photo: `p07_demoPhone_bankAccountPage05.png`,
    no_change: false,
    audio: `callin04_1.mp3`,
    liarTalk: `黃小姐那您得這個畫面目前應該是轉帳失敗沒有錯吧（轉帳失敗）`,
    talkBubble: `惡意的詐騙集團故意用第一次驗證錯誤告訴您是正常取得您的信任`,
    buttonWord: `是的沒錯`,
  },
  {
    // components: `p07_demoPhoneBankInput`,
    photo: `p07_demoPhone_bankAccountPage06.png`,
    no_change: false,
    audio: `callin04_2.mp3`,
    liarTalk: `那因為您的這個操作讓我們的授權已經開啟，恭喜你這邊已經幫你把這個盜刷的金額取消掉了，接下來我要請您幫我關閉這個授權（接下來才是真正騙轉帳動作），這樣您剛輸入的個人隱私身分證字號那些才不會被盜用
    請黃小姐您再次幫忙進入轉帳頁面，然後一樣轉帳代號那個欄位輸入008華南銀行，下個欄位請您輸入000123456789(真實匯款帳號)，這裡我們跟您保證不會將您的金額轉出更不會讓您的帳戶受到影響，但不好意思，因為您現在帳號是處於一個比較危險狀況，我們有義務請您做這個動作去關閉您的隱私授權設定，因剛剛您已經授權給我們，我們已經幫您完成取消您被盜刷的金額了，所以您現在的帳號是處於一個公開狀態必須要請您去做這個動作去關閉您的授權，不然可能我們無法保證您後續個資可能被其他管理人員使用，好的感謝黃小姐，確認輸入完成後，接下來請您幫忙下個欄位輸入49987（已經取得信任）`,
    talkBubble: `這次惡意的詐騙集團會在最後一次給您真正的帳戶讓您掉入陷阱，抓住你想趕快結束對話的心理要你最後一次輸入就完成退刷直接輸入正確帳號匯款`,
    buttonWord: `不疑有他的依照對方指示輸入帳戶及金額`,
  },
  {
    photo: `p07_demoPhone_bankAccountPage07.png`,
    id: `bankAccountPage05`,
    no_change: false,
    liarTalk: `恭喜您上當啦`,
    talkBubble: `糟糕！！真的就被惡意的詐騙集團詐騙錢了！請注意對方還會再次要你輸入帳號測試說要將錢匯回來千萬！千萬！千萬記得「不要再次上當」`,
    buttonWord: `重新體驗`,
  },
]);

//下一張圖片
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

//顯示下一則動態
const next = () => {
  itemIndex.value >= phoneScreen.value.length - 1
    ? (itemIndex.value = 0)
    : itemIndex.value++;
  setShowImg();
};

onMounted(() => {
  showLoading.value = false;
});
</script>

<style></style>
