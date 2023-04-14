<template>
  <div>
    <!-- navgation -->
    <frontNavbar />

    <div class="p01_news">
      <div class="banner_frame">
        <div class="banner_background"></div>
        <div class="banner_title h1">
          最新消息
          <div class="banner_title_en">NEWS</div>
        </div>
      </div>

      <div class="tab_p01_newsChoose">
        <div class="tab_p01_news_category">
          <!-- <select name="" id="" class="form-select form-select-md">
            <option selected>所有文章</option>
            <option value="">網站詐騙</option>
            <option value="">交友詐騙</option>
            <option value="">金融詐騙</option>
          </select> -->

          <div class="wide_tab">
            <div class="newsTab">
              <a
                href="#"
                @click.prevent="selectCategory(null)"
                :class="{ currentTab: selectedCategory === null }"
                >所有文章</a
              >
            </div>
            <!-- 分類項目根據資料庫 -->
            <div class="newsTab" v-for="category in categories" :key="category">
              <a
                :class="{ currentTab: categorySelected[category] }"
                href="#"
                @click.prevent="selectCategory(category)"
                >{{ category }}</a
              >
            </div>
            <!-- <a href="#" :class="{ currentTab: isActive }">所有文章</a>　|　<a
              href="#"
              >網站詐騙</a
            >　|　<a href="#">交友詐騙</a>　|　<a href="#">金融詐騙</a> -->
          </div>
        </div>

        <div class="position-relative input_p01_news_searchBar">
          <i
            class="fa-sharp fa-solid fa-magnifying-glass fa-fw position-absolute top-50 end-0 translate-middle"
          ></i>
          <input
            v-model.trim="searchKeyword"
            @keyup="doQuery()"
            placeholder="請輸入標題或內文關鍵字"
          />
        </div>
      </div>
      <!-- 列表 -->
      <ul class="ul_p01_newsPost">
        <!-- <img src="@/assets/img/p01_news/pic01.jpg" alt=""> -->
        <li
          v-for="value in filteredItems.slice(pageStart, pageEnd)"
          class="li_p01_newsPost"
          :key="value.ID"
        >
          <router-link :to="'/p01/p01_newsArticle/' + value.ID">
            <div class="newsImg">
              <img :src="value.NEWS_PIC" />
            </div>

            <div class="newsContent">
              <div class="p01_news_title">
                <div class="p01_news_titleText h5">{{ value.NEWS_TITLE }}</div>
                <div class="p01_news_titleCollect">
                  <a data-href="" data-layout="button_count"
                    ><i class="fa-brands fa-facebook"></i
                  ></a>
                  <a><i class="fa-brands fa-line"></i></a> |
                  <a><i class="fa-solid fa-bookmark"></i>收藏</a>
                </div>
              </div>
              <div class="read">
                <div class="tag_p01_news_postDescription">
                  <div class="tag_p01_news_postCategory">
                    {{ value.NEWS_CATEGORY }}
                  </div>
                  <div class="tag_p01_news_postDate">
                    {{ value.CREATE_DATE }}
                  </div>
                </div>
                <div class="p01_news_article paragraph">
                  {{ value.NEWS_CONTENT }}
                </div>
              </div>
            </div>
          </router-link>
        </li>
      </ul>

      <!-- 分頁bar -->
      <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
          <li class="page-item" @click.prevent="setPage(currentPage - 1)">
            <a class="page-link pagination-dark" href="#" aria-label="Previous">
              <span aria-hidden="true">&laquo;</span>
            </a>
          </li>
          <li
            class="page-item"
            :class="{ active: currentPage === n }"
            v-for="(n, index) in totalPage"
            :key="index"
            @click.prevent="setPage(n)"
          >
            <a class="page-link pagination-dark" href="#">{{ n }}</a>
          </li>

          <li class="page-item" @click.prevent="setPage(currentPage + 1)">
            <a class="page-link pagination-dark" href="#" aria-label="Next">
              <span aria-hidden="true">&raquo;</span>
            </a>
          </li>
        </ul>
      </nav>
    </div>
    <!-- footer -->
    <frontFooter />
  </div>
</template>

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
      isActive: true,
      datas: [], //初始資料
      selectedCategory: null,
      perpage: 10, //一頁的資料數
      currentPage: 1,
      filteredData: [], //分類後的資料
      categorySelected: {}, // 每個分類是否被選中的狀態
      searchKeyword: "", //搜尋預設空字串
      // object: [
      //   {
      //     ID: `${id++}`,
      //     name: "假冒銀行信用貸款簡訊",
      //     image: require("../assets/img/p01_news/pic01.jpg"),
      //     category: "金融詐騙",
      //     url: "https://tw.yahoo.com/",
      //     content:
      //       "近日詐騙集團假冒銀行寄送信用貸款簡訊簡訊會用『免徵連保』、『免照會』、『快速撥款』等字眼，要求加Line進行貸款案件申請。之後該假冒人員會先透露部份個資等話術騙取您的信任，再誆稱授信審核已通過核貸，尚須繳交財力證明金、律師公證函費用等種種名目費用，要求民眾『先匯款或轉帳』才符合撥貸條件。165提醒您1.銀行人員不會透過私加Line 好友方式進行審核流程2.銀行人員不會在撥款前額外要求民眾做任何匯款或轉帳等行為如有疑問請撥打 165 反詐騙專線或銀行客服查證相關資訊是否屬實。",
      //     date: "2023/1/5",
      //     fblink: "https://tw.yahoo.com/",
      //   },

      // ],
    };
  },
  mounted() {
    axios
      .get(`${API_URL}getNews.php`)
      .then((response) => {
        this.datas = response.data;
        // this.currentPage = 1; // 初始化當前頁數
        // console.log(response.data);
        // 限制內文字數
        this.$nextTick(() => {
          var len = 120;
          $(".p01_news_article").each(function (i) {
            if ($(this).text().length > len) {
              $(this).attr("title", $(this).text());
              var text =
                $(this)
                  .text()
                  .substring(0, len - 1) + "...";
              $(this).text(text);
            }
          });
        });
      })
      .catch((error) => {
        // console.error(error);
      });
  },
  computed: {
    categories() {
      return Array.from(
        new Set(this.datas.map((item) => item.NEWS_CATEGORY))
      ).filter((category) => category); // 資料庫的分類內容只回傳非空值
    },
    // filteredItems() {
    //   if (this.selectedCategory) {
    //     return this.datas.filter(
    //       (item) => item.NEWS_CATEGORY === this.selectedCategory
    //     );
    //   }
    //   return this.datas;
    // },
    filteredItems() {
      let filtered = this.datas;
      if (this.selectedCategory) {
        filtered = filtered.filter(
          (item) => item.NEWS_CATEGORY === this.selectedCategory
        );
      }
      if (this.searchKeyword) {
        filtered = filtered.filter(
          (item) =>
            item.NEWS_TITLE.includes(this.searchKeyword) ||
            item.NEWS_CONTENT.includes(this.searchKeyword)
        );
      }
      return filtered;
    },

    // 分頁計算
    totalPage() {
      return Math.ceil(this.filteredData.length / this.perpage);
      //Math.ceil()取最小整數
    },
    pageStart() {
      return (this.currentPage - 1) * this.perpage;
      //取得該頁第一個值的index
    },
    pageEnd() {
      return this.currentPage * this.perpage;
      //取得該頁最後一個值的index
    },
  },

  methods: {
    selectCategory(category) {
      this.selectedCategory = category;
      this.currentPage = 1; // 重新設定當前頁數
      this.categorySelected = {}; // 每次選擇分類時重置分類的選擇狀態

      if (category === null) {
        this.categorySelected.all = true;
      } else {
        this.categorySelected[category] = true;
      }
    },
    // 搜尋文章
    doQuery() {
      this.filteredItems = this.datas.filter((item) => {
        return item.NEWS_TITLE.includes(this.searchKeyword);
      });
    },

    // 分頁
    setPage(page) {
      if (page <= 0 || page > this.totalPage) {
        return;
      }
      this.currentPage = page;
      if (!this.selectedCategory) {
        this.selectedCategory = null;
      }
    },
  },
  watch: {
    filteredItems() {
      this.filteredData = [...this.filteredItems];
    },
    selectedCategory() {
      this.filteredData = [...this.filteredItems];
    },
  },
};
</script>

 <style lang="scss" scoped>
</style>