<template>
  <div>
    <div id="jsGrid"></div>
  </div>
</template>
<script>
// 抓會員資料用套件
import axios from "axios";
import { API_URL, reactive } from "@/config";

export default {
  data() {
    return {
      newsCollect: [],
      $router: this.$router,
    };
  },
  mounted() {
    const token = localStorage.getItem("token");
    if (token) {
      axios
        .post(`${API_URL}/memberCollect.php`, { token: token })
        .then((response) => {
          this.newsCollect = response.data;
          console.log(this.newsCollect, "news_colect");
          this.renderGrid();
        })
        .catch((error) => {
          console.log(error);
        });
    }
  },
  methods: {
    renderGrid() {
      const vm = this;
      const memberCollect = this.newsCollect.map((collect) => {
        return {
          日期: collect.CREATE_TIME,
          收藏主題: collect.NEWS_TITLE,
          // 狀態:collect.NEWS_STATUS,
          id: collect.NEWS_ID,
        };
      });

      $("#jsGrid").jsGrid({
        width: "100%",

        inserting: false,
        editing: false,
        sorting: true,

        paging: true,
        pageIndex: 1,
        pageSize: 10,
        pageButtonCount: 2,
        pagerFormat:
          "{first} {pages} {last} &nbsp;&nbsp; {pageIndex} of {pageCount}",
        pageFirstText: "首頁",
        pageLastText: "最後一頁",
        pageNavigatorNextText: "...",
        pageNavigatorPrevText: "...",

        data: memberCollect,
        fields: [
          // {
          //   name: "狀態",
          //   type: "text",
          //   width: 50,
          // },
          {
            name: "日期",
            type: "text",
            width: 18,
          },
          {
            name: "收藏主題",
            type: "text",
            width: 60,
          },
          {
            name: "編輯/修改",
            width: 22,
            sorting: false,
            itemTemplate: function (value, item) {
              let $buttonContainer = $("<div>");

              const $check = $("<a>")
                .text("查")
                .addClass("small_button mx-1")
                .attr("href", `/news/newsArticle/${item.id}`)
                .on("click", (e) => {
                  e.preventDefault();
                  vm.$router.push(`/news/newsArticle/${item.id}`);
                });
              $buttonContainer.append($check);

              return $buttonContainer;
            },
          },
        ],
      });
    },
  },
};
</script>