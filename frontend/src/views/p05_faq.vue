<template>
  <div class="body_p05_faq_block">
    <!-- navgation -->
    <frontNavbar />
    <!--Main Block -->
    <h1>FAQ</h1>
    <main>
      <label for="search">
        <input type="text" id="search" placeholder="請輸入關鍵字" />
        <i class="fa-solid fa-magnifying-glass"></i>
      </label>
      <div class="question_p05_faq_block">
        <ul>
          <li v-for="item in faq" :key="item.id">
            <div class="title_p05_faq_qusetion">{{ item.title }}</div>
            <div class="content_p05_faq_qusetion">
              <p>{{ item.content }}</p>
              <span>{{ item.source }}</span>
            </div>
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
        source: "165反詐騙諮詢",
      },
      {
        id: "q02",
        title: "常見詐騙手法及防範方法",
        content: `若您發現個人姓名、頭像遭詐騙集團冒用時，該如何向Google公司即時反映?
                165反詐騙諮詢專線繪製步驟教學圖文，不論是【不當影片、頻道和其他內容】或【廣告】，都能於第一時間提出檢舉，除了利用軟體本身的檢舉機制外，請同步填具檢舉表單，避免更多民眾誤信受害!
                官方訊息`,
        source: "165反詐騙諮詢",
      },
    ]);

    return {
      faq,
    };
  },
};
</script>
<style></style>
