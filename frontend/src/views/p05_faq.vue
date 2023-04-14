<template>
  <div class="body_p05_faq_block">
    <!-- navgation -->
    <frontNavbar />
    <!--Main Block -->
    <h1>FAQ</h1>
    <main>
      <!-- <div> -->
      <div id="myElement" style="color: #ffffff">{{ content.value }}</div>
      <!-- <button @click="updateContent">Update Content</button> -->
      <!-- </div> -->
      <label for="search">
        <input type="text" id="search" placeholder="請輸入關鍵字" />
        <i class="fa-solid fa-magnifying-glass"></i>
      </label>
      <div class="question_p05_faq_block">
        <ul>
          <li v-for="item in faq.data" :key="item.ID">
            <div class="title_p05_faq_qusetion" @click="dropDown">
              {{ item.QUESTION }}
              <i class="fa-solid fa-angle-up"></i>
            </div>
            <div class="content_p05_faq_qusetion">
              <p>{{ item.ANSWER }}</p>
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
import TypeIt from "typeit";

// data存放
const faq = reactive({
  data: "",
});
const content = ref("");

// 取QA資料
onMounted(() => {
  axios
    .get("http://localhost/TGD104_G2/frontend/src/api/getFaq.php")
    .then((response) => {
      faq.data = response.data;
    })
    .catch((error) => console.log(error));
});
//QA content開闔
const dropDown = (e) => {
  e.target.parentNode.classList.toggle("open");
  if (e.target.parentNode.classList.contains("open")) {
    let instance = new TypeIt(e.target.nextElementSibling.querySelector("p"), {
      speed: 5,
      startDelay: 400,
      loop: false,
    }).go();
  }
};
</script>
<style scoped></style>
