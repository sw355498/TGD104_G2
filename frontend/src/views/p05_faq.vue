<template>
  <Loading v-if="showLoading" />
  <div class="body_p05_faq_block">
    <!-- navgation -->
    <frontNavbar />
    <!--Main Block -->
    <h1>FAQ</h1>
    <main>
      <label for="search">
        <input
          type="text"
          id="search"
          placeholder="請輸入關鍵字"
          v-model.trim="search"
          @keyup="filterList"
        />
        <i class="fa-solid fa-magnifying-glass" v-show="showSearch"></i>
      </label>
      <div class="question_p05_faq_block">
        <ul>
          <li v-for="item in faq.data" :key="item.ID" v-if="faq.data.length">
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
          <p v-else v-text="msg"></p>
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
import Loading from "@/components/loading.vue";
import frontNavbar from "@/components/f_nav.vue";
import frontFooter from "@/components/f_footer.vue";
import { API_URL } from "@/config";
import axios from "axios";
import TypeIt from "typeit";

//loading判斷
const showLoading = ref(true);

// data存放
const faq = reactive({
  data: "",
});
const allfaq = reactive({
  data: "",
});

// 取QA資料
onMounted(() => {
  showLoading.value = false;
  axios
    .get(`${API_URL}getFaq.php`)
    .then((response) => {
      console.log(response.data);
      faq.data = response.data;
      allfaq.data = response.data;
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
const search = ref("");
const showSearch = ref(true);
const msg = ref("查無資料，請重新查詢");
//顯示隱藏放大鏡
document.getElementById("search").change = () => {
  showSearch = !showSearch;
};

const filterList = (searchWord) => {
  searchWord = search.value;
  let newSearch = [];
  if (!!searchWord) {
    allfaq.data.filter((item) => {
      if (item.QUESTION.match(searchWord)) {
        newSearch.push(item);
      }
      return newSearch;
    });
    faq.data = newSearch;
  } else {
    faq.data = allfaq.data;
  }
};
</script>
<style scoped></style>
