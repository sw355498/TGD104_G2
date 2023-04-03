<template>
  <div class="body_p05_faq_block">
    <!-- header  -->
    <!-- navgation -->
    <frontNavbar />
    <!--Main Block -->
    <h1>FAQ</h1>
    <main>
      <label for="search">
        <i class="fa-solid fa-magnifying-glass"></i>
        <input type="text" id="search" placeholder="請輸入關鍵字" />
      </label>
      <div class="question_p05_faq_block">
        <ul>
          <li v-for="item in faq" :key="item.id">
            <h4>
              {{ item.title }}
              <i class="fa-solid fa-minus"></i>
            </h4>
            <div>
              <div>
                {{ item.content }}
                <a :href="item.link1">連結1</a>
                <a :href="item.link2">連結2</a>
                <a :href="item.link3">檢舉表單</a>
                資料來源：內政部警政署165全民防騙網
              </div>
              <span></span>
            </div>
          </li>
          <li v-for="item in faq2" :key="item.id">
            <h4>
              {{ item.title }}
              <i class="fa-solid fa-plus"></i>
            </h4>
          </li>
        </ul>
      </div>
    </main>
    <!--Main Block end -->
    <!-- footer -->
    <frontFooter />
  </div>
</template>
<script>
import { ref } from "vue";
import frontNavbar from "@/components/f_nav.vue";
import frontFooter from "@/components/f_footer.vue";

export default {
  components: {
    frontNavbar,
    frontFooter,
  },
  setup() {
    const faq = ref([
      {
        id: "q01",
        title: "常見詐騙手法及防範方法",
        content: `若您發現個人姓名、頭像遭詐騙集團冒用時，該如何向Google公司即時反映?
                165反詐騙諮詢專線繪製步驟教學圖文，不論是【不當影片、頻道和其他內容】或【廣告】，都能於第一時間提出檢舉，除了利用軟體本身的檢舉機制外，請同步填具檢舉表單，避免更多民眾誤信受害!
                官方訊息`,
        link1:
          "https://support.google.com/google-ads/answer/7660847?hl=zh-Hant#",
        link2:
          "https://support.google.com/youtube/answer/2802027?hl=zh-Hant&ref_topic=9387085",
        link3:
          "https://support.google.com/ads/troubleshooter/4578507?visit_id=637916577336558079-1771547771&rd=1",
      },
      {
        id: "q02",
        title: "常見詐騙手法及防範方法",
        content: `若您發現個人姓名、頭像遭詐騙集團冒用時，該如何向Google公司即時反映?
                165反詐騙諮詢專線繪製步驟教學圖文，不論是【不當影片、頻道和其他內容】或【廣告】，都能於第一時間提出檢舉，除了利用軟體本身的檢舉機制外，請同步填具檢舉表單，避免更多民眾誤信受害!
                官方訊息`,
        link1:
          "https://support.google.com/google-ads/answer/7660847?hl=zh-Hant#",
        link2:
          "https://support.google.com/youtube/answer/2802027?hl=zh-Hant&ref_topic=9387085",
        link3:
          "https://support.google.com/ads/troubleshooter/4578507?visit_id=637916577336558079-1771547771&rd=1",
      },
    ]);

    const faq2 = ref([
      {
        id: "q03",
        title: "常見詐騙手法及防範方法",
      },
      {
        id: "q04",
        title: "常見詐騙手法及防範方法",
      },
      {
        id: "q05",
        title: "常見詐騙手法及防範方法",
      },
      {
        id: "q06",
        title: "常見詐騙手法及防範方法",
      },
      {
        id: "q07",
        title: "常見詐騙手法及防範方法",
      },
    ]);
    return {
      faq,
      faq2,
    };
  },
};
</script>
<style></style>
