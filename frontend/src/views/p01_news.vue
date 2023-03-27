<template>
  <div>
    <div class="p01_news">
      <div class="banner_frame">
        <div class="banner_title h1">最新消息</div>
      </div>

      <div class="tab_p01_newsChoose">
        <div class="tab_p01_news_category">
          <select name="" id="">
            所有文章
          </select>
          <div class="wide_tab">
            <a href="#" :class="{ current: isActive }">所有文章</a>　|　<a
              href="#"
              >網站詐騙</a
            >　|　<a href="#">交友詐騙</a>　|　<a href="#">金融詐騙</a>
          </div>
        </div>
        <div class="input_p01_news_searchBar">
          <input type="text" placeholder="搜尋文章" />
          <div class="icon">
            <i class="fa-solid fa-magnifying-glass"></i>
          </div>
        </div>
      </div>

      <ul class="ul_p01_newsPost">
        <li v-for="value in object" class="li_p01_newsPost">
          <a href="#"  ><div class="newsImg">
              <img :src="value.image" />
            </div>

            <div class="newsContent">
              <div class="p01_news_title">
                <div class="p01_news_titleText h5">{{ value.name }}</div>
                <div class="p01_news_titleCollect">
                  <a data-href="" data-layout="button_count"
                    ><i class="fa-brands fa-facebook"></i
                  ></a>
                  <a><i class="fa-brands fa-line"></i></a>  |  
                  <a><i class="fa-solid fa-bookmark"></i>收藏</a>
                </div>
              </div>
              <div class="tag_p01_news_postDescription">
                <div class="tag_p01_news_postCategory">
                  {{ value.category }}
                </div>
                <div class="tag_p01_news_postDate">{{ value.date }}</div>
              </div>
              <div class="p01_news_article paragraph">{{ value.content }}</div>
            </div>
          </a>
        </li>

        <li v-for="value in object" class="li_p01_newsPost">
          <a href="#"  ><div class="newsImg">
              <img :src="value.image" />
            </div>

            <div class="newsContent">
              <div class="p01_news_title">
                <div class="p01_news_titleText h5">{{ value.name }}</div>
                <div class="p01_news_titleCollect">
                  <a data-href="" data-layout="button_count"
                    ><i class="fa-brands fa-facebook"></i
                  ></a>
                  <a><i class="fa-brands fa-line"></i></a>  |  
                  <a><i class="fa-solid fa-bookmark"></i>收藏</a>
                </div>
              </div>
              <div class="tag_p01_news_postDescription">
                <div class="tag_p01_news_postCategory">
                  {{ value.category }}
                </div>
                <div class="tag_p01_news_postDate">{{ value.date }}</div>
              </div>
              <div class="p01_news_article paragraph">{{ value.content }}</div>
            </div>
          </a>
        </li>
      </ul>
    </div>
  </div>
</template>

 <script>
export default {
  data() {
    let id = 0,
      news = 85;
    return {
      isActive: true,
      object: [
        {
          id: `${id++}`,
          name: "NEWS TITLE",
          image: require("../assets/img/p01_news/pic05.jpg"),
          category: "類別",
          url: "https://tw.yahoo.com/",
          content:
            "NEWS CONTENTNEWS CONTENTNEWS CONTENTNEWS CONTENTNEWS CONTENTNEWS CONTENTNEWS CONTENTNEWS CONTENTNEWS CONTENTNEWS CONTENT",
          date: "newDate",
          fblink: "https://tw.yahoo.com/",
        },
      ],
    };
  },
  methods: {},
};
</script>

 <style lang="scss" scoped>
// @import url("../assets/Sass/style.scss");
</style>