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
          <li
            v-for="item in faq.data"
            :class="{ open: boolean }"
            :data-target="bar"
            :key="item.ID"
          >
            <div class="title_p05_faq_qusetion" @click="dropDown">
              {{ item.QUESTION }}
              <i class="fa-solid fa-angle-up"></i>
            </div>
            <div class="content_p05_faq_qusetion">
              <p>{{ item.ANSWER }}</p>
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

<script setup>
import { ref, reactive, onMounted } from "vue";
import frontNavbar from "@/components/f_nav.vue";
import frontFooter from "@/components/f_footer.vue";
import axios from "axios";

// data存放
const faq = reactive({
  data: "",
});
// QA開闔
const boolean = ref(false);
const toggleClass = document.querySelectorAll("[data-toggle-class]");

onMounted(() => {
  axios
    .get("http://localhost/TGD104_G2/frontend/src/api/getFaq.php")
    // .get(`${this.$apiUrl}getFaq.php`)
    .then((response) => {
      faq.data = response.data;
    })
    .catch((error) => console.log(error));
});

// QA content開闔
const dropDown = () => {
  boolean.value = !boolean.value;
};
</script>
<style scoped></style>
