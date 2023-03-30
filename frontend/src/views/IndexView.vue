<template>
  <div class="body_index_block">
    <navbar />
    <!--Top Dynamic-->
    <section>
      <!-- Banner -->
      <h2>prevent</h2>
      <div id="banner_index_dynamicText">
        <p>不明網站</p>
        <p>購物要當心</p>
      </div>
      <a
        class="h6_component big_button"
        href="../views/pages/p07_demoShopping.html"
        target="_parent"
        >DEMO體驗</a
      >

      <!-- BackTop Button -->
      <div class="backTop_index_btn">
        <i class="fa-solid fa-angles-left"></i>
      </div>

      <!-- 機器人 -->
      <div class="robot_index_btn"></div>
    </section>

    <!--Main Block -->
    <main>
      <!--Text Article -->
      <article class="article_index_block">
        <h1>不懂科技的你也可自保</h1>
        <ul>
          <li>
            <svg><use xlink:href="#mail_silent" /></svg>
            <p class="fontT26_index_article">
              不點擊不明簡訊或是 E-mail 裡的網址
            </p>
            <p class="paragraph fontP18_index_article">
              避免釣魚網站詐騙，要加強的不是計算機概論，也不用成為資安專家，而是掌握一個最基本的原則
              不管是熟人還是陌生人、不管是哪種方式傳來的訊息（簡訊、電子郵件、Line、FB、IG等），只要內容附上網址，而且點開後要求輸入帳號密碼或下載安裝程式，內心的警報器一定要大聲作響，告訴自己「這極有可能是釣魚簡訊！」
            </p>
          </li>
          <li>
            <svg><use xlink:href="#search" /></svg>
            <p class="fontT26_index_article">找尋正確管道且小心求證</p>
            <p class="paragraph fontP18_index_article">
              假使收到訊息不放心或很想知道真相，絕對不要貪圖方便而點擊訊息內的網址，應該另外打開官方APP，或是自己Google連線到官方網站。然後登入驗證。當然，登入以後就會發現根本沒有強迫重新驗證這回事
            </p>
          </li>
        </ul>
        <a class="big_button" href="./p02_teach.html">了解更多知識</a>
      </article>

      <!-- News -->
      <article class="news_index_block">
        <h1>最新消息</h1>
        <hr />
        <ul>
          <li class="card_index_block">
            <figure class="card_index_photo">
              <img src="../assets/img/index/newPic01.jpg" alt="" />
              <figcaption class="small_button">資安</figcaption>
            </figure>
            <div class="text-block">
              <p class="fontT26_index_article">
                健保署3員工利用職務查詢、洩漏情報人員個資長達13年，承保組科長涉嫌重大10萬交保
              </p>
              <p class="paragraph fontP14_index_article">
                避免釣魚網站詐騙，要加強的不是計算機概論，也不用成為資安專家，而是掌握一個最基本的原則
                不管是熟人還是陌生人、不管是哪種方式傳來的訊息（簡訊、電子郵件、Line、FB、IG等），只要內容附上網址，而且點開後要求輸入帳號密碼或下載安裝程式，內心的警報器一定要大聲作響，告訴自己「這極有可能是釣魚簡訊！」
              </p>
              <p class="fontDate_index_article">Jan 23, 2023</p>
            </div>
          </li>
          <li class="card_index_block">
            <figure class="card_index_photo">
              <img src="../assets/img/index/newPic02.jpg" alt="" />
              <figcaption class="small_button">駭客</figcaption>
            </figure>
            <div class="text-block">
              <p class="fontT26_index_article">
                從戶政到健保資料外洩案看我國個資保障，唐鳳部長理當不能以一句配合偵辦輕輕帶過
              </p>
              <p class="paragraph fontP14_index_article">
                我國對公務機關的個人資料、資通訊安全保護卻可能與一般民眾認知不盡相符。數位部身為主管機關，理當不能一句全力提供資安技術支援、配合偵辦即可輕輕帶過，唐鳳部長有權積極監督衛福部健保署及內政部將資通安全事件之通報、調查、處理。
              </p>
              <p class="fontDate_index_article">Jan 23, 2023</p>
            </div>
          </li>
          <li class="card_index_block">
            <figure class="card_index_photo">
              <img src="../assets/img/index/newPic03.jpg" alt="" />
              <figcaption class="small_button">網購詐騙</figcaption>
            </figure>
            <div class="text-block">
              <p class="fontT26_index_article">
                李貴敏《美魔女律師教你生活不犯錯》：網購收不到貨或收到假貨，只能自認倒楣嗎？
              </p>
              <p class="paragraph fontP14_index_article">
                一名大學畢業生，某天在特定網站上看到比市價便宜的智慧型手機及平板，就立即下單並轉帳付款，但遲遲未收到商品，其後上網查看，才發現該網站已不存在。就此，民眾享有什麼權利？網路販售業者又應該擔負什麼法律責任呢？
              </p>
              <p class="fontDate_index_article">Jan 23, 2023</p>
            </div>
          </li>
        </ul>
        <a class="big_button" href="../../views/pages/p01_news.html"
          >閱讀更多文章</a
        >
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
            <p class="fontT26_index_article">
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
            <p class="fontT26_index_article">
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
            <p class="fontT26_index_article">
              詐騙六千萬過程大公開<br />
              不希望再有人受騙
            </p>
            <p class="text_title">Youtuber 尼克&ASHLY 分享</p>
          </li>
        </ul>
        <a class="big_button" href="../views/pages/p02_teach.html">查看更多</a>
      </article>
    </main>
    <!--Main Block end -->
    <!-- 聊天機器人 -->
    <div>
      <indexChatbot />
    </div>
  </div>
</template>

<script>
// 要外掛聊天機器人
// @ is an alias to /src
import indexChatbot from "@/components/index_chatbot.vue";
import navbar from "@/components/f_nav.vue"; 

export default {
  components: {
    indexChatbot,
    navbar,
  },

  setup() {
    return {};
  },
};
</script>
