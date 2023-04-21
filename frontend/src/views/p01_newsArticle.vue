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
            ><i class="fa-brands fa-facebook" @click="openShareWindow('https://www.facebook.com/sharer.php?u='+current_url);"></i
          ></a>
          <a><i class="fa-brands fa-line" @click="openShareWindow('https://social-plugins.line.me/lineit/share?url='+current_url);"></i></a> |
          <a v-if="!isFavorite" @click="addToFavorites"><i class="fa-solid fa-bookmark"></i>收藏</a>
      <a v-else><i class="fa-solid fa-bookmark active"></i>已收藏</a>
        </div>
        <hr class="border border-2" />
        <div class="article_img col-lg-11 mx-auto mt-4">
          <img :src="news.NEWS_PIC ? require('@/assets/img/p01_news/' + news.NEWS_PIC) :  require('@/assets/img/p01_news/no_image.jpg')" alt="" />
        </div>
        <div class="col-lg-11 mx-auto mt-4">
          <p class="lh-lg">
            {{ news.NEWS_CONTENT }}<br /><br />如有疑問請撥打 165
            反詐騙專線或銀行客服查證相關資訊是否屬實。
          </p>
        </div>
        <div class="d-flex mx-auto mt-5 justify-content-center">
          <router-link to="/news"
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
import { API_URL, reactive } from "@/config";

export default {
  components: {
    frontNavbar,
    frontFooter,
  },
  data() {
    return {
      news: [],
      current_url:null
    };
  },
  mounted() {
    // 從router獲取參數id
    this.current_url= window.location//jeff大神建議的
    const id = this.$route.params.id;

    axios
      .get(`${API_URL}getNews.php`)
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
  methods:{
  // 分享
  openShareWindow(link) {
    window.open(link, 'mywindow', 'width=700, height=400');
  },
  // 收藏
  addToFavorites() {
    // 取得目前新聞的 ID
    const newsId = this.news.ID;

    // 取得使用者的 JWT token
    const token = localStorage.getItem('token');
    if (!token) {
      // 如果沒有 token，表示使用者尚未登入，顯示登入彈窗
      alert('請先登入才能收藏新聞！');
      return;
    }

    // 呼叫 API 儲存收藏資料
    axios.post(`${API_URL}addFavoriteNews.php`, { news_id: newsId, token: token })
      .then(response => {
        // 收藏成功，提示訊息
        alert('已加入收藏！');

      })
      .catch(error => {
        // 收藏失敗，顯示錯誤訊息
        console.error(error);
        alert('收藏失敗，請稍後再試！');
        
      });
  },
  }
};
</script>