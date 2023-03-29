<template>
  <div>
    <div class="p01_news">
      <div class="banner_frame">
        <div class="banner_title h1">最新消息
          <div class="banner_title_en">NEWS</div>
        </div>
      </div>

      <div class="tab_p01_newsChoose">
        <div class="tab_p01_news_category">
          <select name="" id="">
            所有文章
          </select>
          <div class="wide_tab">
            <a href="#" :class="{ currentTab: isActive }">所有文章</a>　|　<a
              href="#"
              >網站詐騙</a
            >　|　<a href="#" >交友詐騙</a>　|　<a href="#">金融詐騙</a>
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
          <a href="#"
            ><div class="newsImg">
              <img :src="value.image" />
            </div>

            <div class="newsContent">
              <div class="p01_news_title">
                <div class="p01_news_titleText h5">{{ value.name }}</div>
                <div class="p01_news_titleCollect">
                  <a data-href="" data-layout="button_count"
                    ><i class="fa-brands fa-facebook"></i
                  ></a>
                  <a><i class="fa-brands fa-line"></i></a> |
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

<!-- <div>
  <paging :current-page="currentPage" :total="120" :total-pages="11" @pagechanged="onPageChange"> </paging>
</div> -->
      
<nav aria-label="Page navigation example">
  <ul class="pagination justify-content-center">
    <li class="page-item">
      <a class="page-link pagination-dark" href="#" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
      </a>
    </li>
    <li class="page-item"><a class="page-link  pagination-dark" href="#">1</a></li>
    <li class="page-item"><a class="page-link  pagination-dark" href="#">2</a></li>
    <li class="page-item"><a class="page-link  pagination-dark" href="#">3</a></li>
    <li class="page-item">
      <a class="page-link pagination-dark" href="#" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
      </a>
    </li>
  </ul>
</nav>


    </div>
  </div>
</template>

 <script>
// import paging from '../components/paging.vue';
export default {
  // components: { paging },
  
  data() {
    let id = 0,
      news = 85;
    return {
      isActive: true,
      object: [
        {
          ID: `${id++}`,
          name: "NEWS TITLE",
          image: require("../assets/img/p01_news/pic05.jpg"),
          category: "類別",
          url: "https://tw.yahoo.com/",
          content:
            "NEWS CONTENTNEWS CONTENTNEWS CONTENTNEWS CONTENTNEWS CONTENTNEWS CONTENTNEWS CONTENTNEWS CONTENTNEWS CONTENTNEWS CONTENT",
          date: "newDate",
          fblink: "https://tw.yahoo.com/",
          
        },
        {
          ID: `${id++}`,
          name: "NEWS TITLE2",
          image: require("../assets/img/p01_news/pic05.jpg"),
          category: "類別",
          url: "https://tw.yahoo.com/",
          content:
            "NEWS CONTENTNEWS CONTENTNEWS CONTENTNEWS CONTENTNEWS CONTENTNEWS CONTENTNEWS CONTENTNEWS CONTENTNEWS CONTENTNEWS CONTENT",
          date: "newDate",
          fblink: "https://tw.yahoo.com/",
          
        },
        {
          ID: `${id++}`,
          name: "NEWS TITLE3",
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