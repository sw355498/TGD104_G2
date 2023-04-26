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
    const apiCall1 = axios.post(`${API_URL}/memberCollect.php`, { token: token });
    const apiCall2 = axios.post(`${API_URL}/memberCollectDiscuss.php`, { token: token });
    Promise.all([apiCall1, apiCall2])
      .then((responses) => {
        this.newsCollect = responses[0].data;
        console.log(this.newsCollect, "news_colect");

        this.newsCollectDiscuss = responses[1].data;
        console.log(this.newsCollectDiscuss, "discuss_colect");

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
          type: 'news' // 加上一個 type 屬性，值為 'news'
        };
      });
      const memberCollectit = this.newsCollectDiscuss.map((collect) => {
        return {
          日期: collect.CREATE_TIME,
          收藏主題: collect.DISCUSS_TITLE,
          // 狀態:collect.NEWS_STATUS,
          id: collect.DISCUSS_ID,
          type: 'discuss' // 加上一個 type 屬性，值為 'discuss'
        };
      });
       // 定義一個連結方法，根據不同的 type 連結到不同的頁面
    const linkTo = (item) => {
      if (item.type === 'news') {
        vm.$router.push(`/news/newsArticle/${item.id}`);
      } else if (item.type === 'discuss') {
        vm.$router.push(`/discuss/discuss_content/${item.id}`);
      }
    }
// 將兩個資料合併
const allData = [...memberCollect, ...memberCollectit];



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

        data: allData,
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
              .attr("href", `javascript:void(0)`)
              .on("click", (e) => {
                e.preventDefault();
                linkTo(item); // 改成呼叫 linkTo 方法
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