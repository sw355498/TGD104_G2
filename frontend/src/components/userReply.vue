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
        .post(`${API_URL}/memberMessage.php`, { token: token })
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
          回應主題: collect.TITLE,
          回應內容: collect.CONTENT,
          id: collect.ID,
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

          {
            name: "狀態",
            type: "text",
            width: 10,
          },
          // {
          //   name: "日期",
          //   type: "text",
          //   width: 12,
          // },
          {
            name: "回應主題",
            type: "text",
            width: 50,
          },
          {
            name: "回應內容",
            type: "text",
            width: 20,
          },
          {
            name: "編輯/修改",
            width: 20,
            sorting: false,
            itemTemplate: function (value, items) {
              let $buttonContainer = $("<div>");

              // let $delete = $("<button>")
              //   .text("刪")
              //   .addClass("small_button mx-1")
              //   .on("click", (e) => {
              //     // 取得使用者的 token
              //     const token = localStorage.getItem("token");
              //     let data = { id: items.id, token: token }; // 假設需要刪除的資料的ID存儲在items.id屬性中

              //     axios
              //       .post(`${API_URL}deleteURL.php`, data)
              //       .then(function (response) {
              //         // 在成功刪除資料後，可以更新網頁介面，例如重新載入表格資料
              //         // alert("資料已成功刪除！");
              //         location.reload();
              //       })
              //       .catch(function (error) {
              //         alert("刪除資料時發生錯誤：" + error);
              //       });
              //   });
              // $buttonContainer.append($delete);

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