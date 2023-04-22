<template>
  <div>
    <div id="jsGrid"></div>
  </div>
</template>
<script>
export default {
  mounted() {
    let id = 0,
      post = 1,
      reply = 0,
      thumb = 0;
    var memberPost = [
      {
        ID: `${id++}`,
        回應: `${reply++}`,
        讚數: `${thumb++}`,
        日期: "2023-03-19",
        主題: `${post++}`,
        登入方式: "會員註冊",
        狀態: "正常",
      },
      {
        ID: `${id++}`,
        回應: `${reply++}`,
        讚數: `${thumb++}`,
        日期: "2023-03-19",
        主題: `${post++}`,
        登入方式: "會員註冊",
        狀態: "正常",
      },
      {
        ID: `${id++}`,
        回應: `${reply++}`,
        讚數: `${thumb++}`,
        日期: "2023-03-19",
        主題: `${post++}`,
        登入方式: "會員註冊",
        狀態: "正常",
      },
      {
        ID: `${id++}`,
        回應: `${reply++}`,
        讚數: `${thumb++}`,
        日期: "2023-03-19",
        主題: `${post++}`,
        登入方式: "會員註冊",
        狀態: "草稿",
      },
      {
        ID: `${id++}`,
        回應: `${reply++}`,
        讚數: `${thumb++}`,
        日期: "2023-03-19",
        主題: `${post++}`,
        登入方式: "會員註冊",
        狀態: "檢舉下架",
      },
      {
        ID: `${id++}`,
        回應: `${reply++}`,
        讚數: `${thumb++}`,
        日期: "2023-03-19",
        主題: `${post++}`,
        登入方式: "會員註冊",
        狀態: "檢舉下架",
      },
      {
        ID: `${id++}`,
        回應: `${reply++}`,
        讚數: `${thumb++}`,
        日期: "2023-03-19",
        主題: `${post++}`,
        登入方式: "會員註冊",
        狀態: "檢舉下架",
      },
      {
        ID: `${id++}`,
        回應: `${reply++}`,
        讚數: `${thumb++}`,
        日期: "2023-03-19",
        主題: `${post++}`,
        登入方式: "會員註冊",
        狀態: "檢舉下架",
      },
      {
        ID: `${id++}`,
        回應: `${reply++}`,
        讚數: `${thumb++}`,
        日期: "2023-03-19",
        主題: `${post++}`,
        登入方式: "會員註冊",
        狀態: "檢舉下架",
      },
      {
        ID: `${id++}`,
        回應: `${reply++}`,
        讚數: `${thumb++}`,
        日期: "2023-03-19",
        主題: `${post++}`,
        登入方式: "會員註冊",
        狀態: "檢舉下架",
      },
      {
        ID: `${id++}`,
        回應: `${reply++}`,
        讚數: `${thumb++}`,
        日期: "2023-03-19",
        主題: `${post++}`,
        登入方式: "會員註冊",
        狀態: "檢舉下架",
      },
      {
        ID: `${id++}`,
        回應: `${reply++}`,
        讚數: `${thumb++}`,
        日期: "2023-03-19",
        主題: `${post++}`,
        登入方式: "會員註冊",
        狀態: "檢舉下架",
      },
      {
        ID: `${id++}`,
        回應: `${reply++}`,
        讚數: `${thumb++}`,
        日期: "2023-03-19",
        主題: `${post++}`,
        登入方式: "會員註冊",
        狀態: "檢舉下架",
      },
    ];

    $("#jsGrid").jsGrid({
      width: "100%",

      inserting: false, //添加
      editing: false, //編輯
      sorting: true, //排序

      /*分頁設定*/
      paging: true,
      pagerContainer: null, //jQueryElement或DomNode指定呈現一個分頁欄，為null時在表格底部。
      pageIndex: 1, //當前頁面數
      pageSize: 10, //頁面的數據量
      pageButtonCount: 2, //最大數量的頁面按鈕
      pagerFormat:
        "{first} {pages} {last} &nbsp;&nbsp; {pageIndex} of {pageCount}", //占位符來指定分頁欄格式
      //pageNextText: "Next",   //下一頁
      //pagePrevText: "Prev",   //上一頁
      pageFirstText: "首頁", //首頁
      pageLastText: "最後一頁", //尾頁
      pageNavigatorNextText: "...", //最大數量頁面按鈕超出時右邊顯示
      pageNavigatorPrevText: "...", //最大數量頁面按鈕超出時右邊顯示

      data: memberPost,
      fields: [
        {
          name: "ID",
          css: "d-none",
          validate: "required",
        },

        {
          name: "回應",
          type: "text",
          width: 40,
        },
        {
          name: "讚數",
          type: "text",
          width: 40,
        },
        {
          name: "狀態",
          type: "text",
          width: 50,
        },
        {
          name: "日期",
          type: "text",
          width: 60,
        },
        {
          name: "主題",
          type: "text",
          width: 180,
        },

        {
          name: "編輯/修改",
          width: 80,
          itemTemplate: function (value, item) {
            let $buttonContainer = $("<div>");
            // Jquery 等同於 js中的 let buttonContainer = document.createElement("<div>")

            let $delete = $("<button>")
              .text("刪除")
              .addClass("small_button mx-1")
              .attr("data-id", item["ID"])
              .on("click", operate);
            $buttonContainer.append($delete);
            let $revise = $("<button>")
              .text("修改")
              .addClass("small_button mx-1")
              .attr("data-id", item["ID"])
              .on("click", operate);
            $buttonContainer.append($revise);


            return $buttonContainer;
          },
        },
      ],
    });

    function operate() {
      let thisID = this.closest("tr").firstElementChild.innerHTML;
      switch (this.innerHTML) {
        case "封鎖":
          alert(`封鎖帳號 ${thisID}`);
          break;
        case "刪除":
          alert(`刪除帳號 ${thisID}`);
          break;
        case "修改":
          alert(`修改帳號 ${thisID}`);
          break;
        case "查看":
          alert(`查看帳號 ${thisID}`);
          break;
      }
    }
  },
};
</script>