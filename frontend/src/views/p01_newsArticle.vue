<template>
  <div>
    <!-- navgation -->
    <frontNavbar />

    <div class="p01_newsArticle container">
      <div class="col-md-8 mx-auto">
        <div class="p01_newsArticle_title text-center">
          <div class="fs-6 text-opacity-50">
            {{ news.NEWS_CATEGORY }} | {{ news.CREATE_DATE }}
          </div>
          <h2 class="lh-base">
            {{ news.NEWS_TITLE }}
          </h2>
        </div>

        <div class="p01_news_titleCollect d-flex justify-content-end mt-2">
          <a data-href="" data-layout="button_count"
            ><i class="fa-brands fa-facebook"></i
          ></a>
          <a><i class="fa-brands fa-line"></i></a> |
          <a><i class="fa-solid fa-bookmark"></i>收藏</a>
        </div>
        <hr class="border border-2" />
        <div class="article_img col-lg-11 mx-auto mt-4">
          <img src="../assets/img/p01_news/pic02.jpg" alt="" />
        </div>
        <div class="col-lg-11 mx-auto mt-4">
          <p class="lh-lg">
            {{ news.NEWS_CONTENT }}<br /><br />如有疑問請撥打 165
            反詐騙專線或銀行客服查證相關資訊是否屬實。
          </p>
        </div>
        <div class="d-flex mx-auto mt-5 justify-content-center">
          <router-link to="/p01"
            ><button class="btn btn-outline-light">
              　回上一頁　
            </button></router-link
          >
        </div>
      </div>
    </div>
    <!-- footer -->
    <frontFooter />
  </div>
</template>

<style lang="scss" scoped>
</style>

<script>
import frontNavbar from "@/components/f_nav.vue";
import frontFooter from "@/components/f_footer.vue";
import axios from "axios";

export default {
  components: {
    frontNavbar,
    frontFooter,
  },
  data() {
    return {
      news: [],
    };
  },
  mounted() {
    // 從router獲取參數id
    const id = this.$route.params.id;

    axios
      .get(`http://localhost/TGD104_G2/frontend/src/api/getNews.php`)
      .then((response) => {
        // 從回傳的 response 中找到對應的新聞資料並賦值到 data 中的 news 物件
        const data = response.data;
        for (let i = 0; i < data.length; i++) {
          if (data[i].ID == id) {
            this.news = data[i];
            break;
          }
        }
      })
      .catch((error) => {
        console.error(error);
      });
  },
};
</script>