<template>
  <div class="body_index_block">
    <!-- navgation -->
    <frontNavbar />
    <!--Top Dynamic-->
    <section>
      <!-- banner動態 -->
      <banner />

      <!-- 固定按鈕 -->
      <div class="fixed_index_btn">
        <!-- BackTop Button -->
        <div>
          <backTopBtn />
        </div>
        <!-- 機器人 -->
        <svg class="robot">
          <use xlink:href="#robot" @click="showComponent = true" width="110" />
        </svg>
        <div class="clost-bg" v-if="show" @click="$emit('ddd')"></div>
      </div>
    </section>
    <div class="banner_index_partial">
      <div
        class="circle-container"
        v-for="index in 50"
        :key="index"
        v-html="partial"
      ></div>
    </div>
    <!--Main Block -->
    <main>
      <!--Text Article -->
      <article class="article_index_block">
        <h1>不懂科技的你也可自保</h1>
        <ul>
          <li>
            <svg><use xlink:href="#mail_silent" /></svg>
            <p class="title_index_article">
              不點擊不明簡訊或是 E-mail 裡的網址
            </p>
            <p class="paragraph fontP18_index_article">
              避免釣魚網站詐騙，要加強的不是計算機概論，也不用成為資安專家，而是掌握一個最基本的原則
              不管是熟人還是陌生人、不管是哪種方式傳來的訊息（簡訊、電子郵件、Line、FB、IG等），只要內容附上網址，而且點開後要求輸入帳號密碼或下載安裝程式，內心的警報器一定要大聲作響，告訴自己「這極有可能是釣魚簡訊！」
            </p>
          </li>
          <li>
            <svg><use xlink:href="#search" /></svg>
            <p class="title_index_article">找尋正確管道且小心求證</p>
            <p class="paragraph fontP18_index_article">
              假使收到訊息不放心或很想知道真相，絕對不要貪圖方便而點擊訊息內的網址，應該另外打開官方APP，或是自己Google連線到官方網站。然後登入驗證。當然，登入以後就會發現根本沒有強迫重新驗證這回事
            </p>
          </li>
        </ul>
        <router-link to="/teach" class="big_button">了解更多知識</router-link>
      </article>

      <!-- News -->
      <article class="news_index_block">
        <h1>最新消息</h1>
        <hr />
        <ul>
          <li v-for="item in news" :key="item" class="card_index_block">
            <router-link :to="'/news/newsArticle/' + item.ID">
              <figure class="card_index_photo">
                <img
                  :src="
                    item.NEWS_PIC
                      ? require(`@/assets/img/p01_news/${item.NEWS_PIC}`)
                      : require(`@/assets/img/index/newPic02.jpg`)
                  "
                  :alt="item.NEWS_CATEGORY"
                />
                <figcaption class="small_button">
                  {{ item.NEWS_CATEGORY }}
                </figcaption>
              </figure>
              <div class="text-block">
                <p class="title_index_article">
                  {{ item.NEWS_TITLE }}
                </p>
                <p class="paragraph_index_article">
                  {{ item.NEWS_CONTENT }}
                </p>
                <p class="date_index_article">
                  {{ new Date(item.CREATE_DATE).toLocaleDateString() }}
                </p>
              </div>
            </router-link>
          </li>
        </ul>

        <router-link to="/teach" class="big_button">閱讀更多文章</router-link>
      </article>

      <!-- YouTube -->
      <article class="youtube_index_block">
        <h1>Youtuber經驗談</h1>
        <hr />
        <ul>
          <li class="card_index_block">
            <div class="vedioYT_index_block">
              <iframe
                src="https://www.youtube.com/embed/PAr1F5keUGw"
                frameborder="0"
              ></iframe>
            </div>
            <p class="title_index_article">
              我遇到了臉書購物詐騙，<br />
              Facebook加油好嗎？
            </p>
            <p class="text_title">Youtuber 科技旅人毛巾Vincent 分享</p>
          </li>
          <li class="card_index_block">
            <div class="vedioYT_index_block">
              <iframe
                src="https://www.youtube.com/embed/StFKlH6pCrk"
                frameborder="0"
              ></iframe>
            </div>
            <p class="title_index_article">
              又韭了一波!<br />
              加密貨幣錢包被釣魚網站騙走<br />
              辛酸畫面流出
            </p>
            <p class="text_title">Youtuber 啾啾鞋 分享</p>
          </li>
          <li class="card_index_block">
            <div class="vedioYT_index_block">
              <iframe
                src="https://www.youtube.com/embed/UWFGV6lnO38"
                frameborder="0"
              ></iframe>
            </div>
            <p class="title_index_article">
              詐騙六千萬過程大公開<br />
              不希望再有人受騙
            </p>
            <p class="text_title">Youtuber 尼克&ASHLY 分享</p>
          </li>
        </ul>
        <router-link to="/teach" class="big_button">查看更多</router-link>
      </article>
    </main>
    <!--Main Block end -->
    <div>
      <indexChatbot
        :show="showComponent"
        @close="showComponent = false"
        v-if="showComponent"
      />
    </div>
    <!-- footer -->
    <frontFooter />
  </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import axios from "axios";
import { API_URL } from "@/config";
import indexChatbot from "@/components/index_chatbot.vue";
import frontNavbar from "@/components/f_nav.vue";
import frontFooter from "@/components/f_footer.vue";
import backTopBtn from "@/components/backTopBtn.vue";
import banner from "@/components/banner.vue";

const showComponent = ref(false);
const partial = ref(`<div class="circle"></div>`);

// 抓最新消息
const news = ref([]);
async function allData() {
  try {
    const response = await axios.get(`${API_URL}getNews.php`);
    const news = response.data.slice(0, 3);
    console.log(news);
    return news;
  } catch (error) {
    // 提交失敗的處理
    console.error("failed", error);
  }
}
onMounted(async () => {
  //撈取資料庫的資料
  news.value = await allData();
  console.log(news.value);
});
</script>

<style lang="scss" scoped>
svg.robot {
  width: 110px;
  height: 90px;
  @media (max-width: 420px) {
    height: 55px;
    padding-left: 5px;
  }
}

footer {
  height: 600px;
  background-image: url(../assets/img/index/footer.png);
  background-position: center;
}
</style>
