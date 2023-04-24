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
            ><i
              class="fa-brands fa-facebook"
              @click="
                openShareWindow(
                  'https://www.facebook.com/sharer.php?u=' + current_url
                )
              "
            ></i
          ></a>
          <a
            ><i
              class="fa-brands fa-line"
              @click="
                openShareWindow(
                  'https://social-plugins.line.me/lineit/share?url=' +
                    current_url
                )
              "
            ></i
          ></a>
          |
          <a v-if="!isFavorite" @click="addToFavorites"
            ><i class="fa-solid fa-bookmark"></i>收藏</a
          >
          <a v-else @click="removeFavorites" class="newsCollected"
            ><i class="fa-solid fa-bookmark"></i>已收藏</a
          >
        </div>
        <hr class="border border-2" />
        <div class="article_img col-lg-11 mx-auto mt-4">
          <img
            :src="
              news.NEWS_PIC
                ? require('@/assets/img/p01_news/' + news.NEWS_PIC)
                : require('@/assets/img/p01_news/no_image.jpg')
            "
            alt=""
          />
        </div>
        <div class="col-lg-11 mx-auto mt-4 text-break">
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
// import Modal from "@/components/userLogin.vue";

export default {
  components: {
    frontNavbar,
    frontFooter,
    // Modal,
  },
  data() {
    return {
      news: [],
      current_url: null,
      isFavorite: false,
      isModalVisible: false,
    };
  },
  mounted() {
    // 從router獲取參數id
    this.current_url = window.location; //jeff大神建議的
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
        // 在這裡檢查是否已經收藏
        this.checkNewsFavorite();
      })
      .catch((error) => {
        console.error(error);
      });
  },
  methods: {
    // 分享
    openShareWindow(link) {
      window.open(link, "mywindow", "width=700, height=400");
    },
    showModal() {
      this.isModalVisible = true;
    },
    // 收藏
    addToFavorites() {
      // 取得目前新聞的 ID
      const newsId = this.news.ID;

      // 取得使用者的 token
      const token = localStorage.getItem("token");
      if (!token) {
        // 如果沒有 token，表示使用者尚未登入，顯示登入彈窗
        this.showModal();
        // alert("請先登入會員")
        return;
      }

      // 呼叫 API 儲存收藏資料
      axios
        .post(`${API_URL}newsAddFavorite.php`, {
          news_id: newsId,
          token: token,
        })
        .then((response) => {
          // 收藏成功，提示訊息
          // alert("已加入收藏！");
          this.isFavorite = true;
        })
        .catch((error) => {
          // 收藏失敗，顯示錯誤訊息
          console.error(error);
          alert("收藏失敗，請稍後再試！");
          this.isFavorite = false;
        });
    },
    // 取消收藏
    removeFavorites() {
      // 取得目前新聞的 ID
      const newsId = this.news.ID;

      // 取得使用者的 token
      const token = localStorage.getItem("token");
      if (!token) {
        // 如果沒有 token，表示使用者尚未登入，顯示登入彈窗
        alert("請先登入才能取消收藏新聞！");
        return;
      }

      // 呼叫 API 刪除收藏資料
      axios
        .post(`${API_URL}newsRemoveFavorite.php`, {
          news_id: newsId,
          token: token,
        })
        .then((response) => {
          // 取消收藏成功，提示訊息
          // alert("已取消收藏！");
          this.isFavorite = false;
        })
        .catch((error) => {
          // 取消收藏失敗，顯示錯誤訊息
          console.error(error);
          alert("取消收藏失敗，請稍後再試！");
          this.isFavorite = true;
        });
    },
    // 查
    checkNewsFavorite() {
      const newsId = this.news.ID;
      const token = localStorage.getItem("token");
      if (token) {
        // 如果使用者已登入，呼叫 API 檢查是否已收藏
        axios
          .post(`${API_URL}newsCheckFavorite.php`, {
            news_id: newsId,
            token: token,
          })
          .then((response) => {
            console.log(response.data);
            console.log(response.data.is_favorite);
            if (response.data.success && response.data.is_favorite) {
              this.isFavorite = true;
            } else {
              this.isFavorite = false;
            }
          })
          .catch((error) => {
            console.error(error);
          });
      }
    },
  },
  created() {
    // this.checkNewsFavorite();
  },
};
</script>