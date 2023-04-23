<template>
  <div class="body_p05_faq_block">
    <!-- navgation -->
    <frontNavbar />
    <!--Main Block -->
    <h1>FAQ</h1>
    <main>
      <label for="search">
        <input
          type="search"
          id="search"
          placeholder="請輸入關鍵字"
          v-model.lazy.trim="search"
        />
        <i class="fa-solid fa-magnifying-glass"></i>
      </label>
      <div class="question_p05_faq_block">
        <ul>
          <li v-for="item in faq.data" :key="item.ID">
            <div class="title_p05_faq_qusetion" @click="dropDown">
              {{ item.QUESTION }}
              <i class="fa-solid fa-angle-up" @click.stop></i>
            </div>
            <div class="content_p05_faq_qusetion">
              <p>
                {{ item.ANSWER }} <br />
                <span>【資料來源：{{ item.SOURCE }}】</span>
              </p>
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
import { reactive, onMounted } from "vue";
import frontNavbar from "@/components/f_nav.vue";
import frontFooter from "@/components/f_footer.vue";
import { API_URL } from "@/config";
import axios from "axios";
import TypeIt from "typeit";

// data存放
const faq = reactive({
  data: "",
});

// 取QA資料
onMounted(() => {
  axios
    .get(`${API_URL}getFaq.php`)
    .then((response) => {
      console.log(response.data);
      faq.data = response.data;
    })
    .catch((error) => console.log(error));
});
//QA content開闔
const dropDown = (e) => {
  e.target.parentNode.classList.toggle("open");
  if (e.target.parentNode.classList.contains("open")) {
    let instance = new TypeIt(e.target.nextElementSibling.querySelector("p"), {
      speed: 20,
      startDelay: 400,
      loop: false,
    }).go();
  }
};

//Search Bar
const filteredList = () => {
  return faq.data.value.filter((post) => {
    return post.title.toLowerCase().includes(this.search.toLowerCase());
  });
};
</script>
<style scoped></style>
