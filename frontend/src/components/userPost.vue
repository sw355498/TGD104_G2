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
      memberURL: [],
      $router: this.$router,
    };
  },
  mounted() {
    const token = localStorage.getItem("token");
    if (token) {
      axios
        .post(`${API_URL}/memberPost.php`, { token: token })
        .then((response) => {
          this.memberURL = response.data;
          console.log(this.memberURL, "URL_report");
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
      const memberURL = this.memberURL.map((collect) => {
        return {
          狀態: collect.STATUS_NAME,
          日期: collect.CREATE_TIME,
          主題: collect.TITLE,
          id: collect.ID,
          讚數: collect.likes_count,
          回應: collect.reply_count,
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

        data: memberURL,
        fields: [
          // {
          //   name: "讚數",
          //   type: "text",
          //   width: 5,
          // },
          {
            name: "回應",
            type: "text",
            width: 5,
          },
          {
            name: "狀態",
            type: "text",
            width: 10,
          },
          {
            name: "日期",
            type: "text",
            width: 10,
          },
          {
            name: "主題",
            type: "text",
            width: 40,
          },
          {
            name: "編輯/修改",
            width: 30,
            sorting: false,
            itemTemplate: function (value, items) {
              let $buttonContainer = $("<div>");
                let $delete = $("<button>")
                .text("刪")
                .addClass("small_button mx-1")
                .on("click", (e) => {
                  // 取得使用者的 token
                  const token = localStorage.getItem("token");
                  let data = { id: items.id, token: token }; // 假設需要刪除的資料的ID存儲在items.id屬性中

                  axios
                    .post(`${API_URL}memberDeletePost.php`, data)
                    .then(function (response) {
                      // 在成功刪除資料後，可以更新網頁介面，例如重新載入表格資料
                      // alert("資料已成功刪除！");
                      console.log(response);
                      location.reload();
                    })
                    .catch(function (error) {
                      alert("刪除資料時發生錯誤：" + error);
                    });
                });
              $buttonContainer.append($delete);

              const $check = $("<a>")
                .text("查")
                .addClass("small_button mx-1")
                .attr("href", `/discuss/discuss_content/${items.id}`)
                .on("click", (e) => {
                  e.preventDefault();
                  vm.$router.push(`/discuss/discuss_content/${items.id}`);
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