<template>
  <div>
      <!-- navgation -->
      <frontNavbar />
 
  <div class="p08_user">
    <div class="container">
      <div class="main-body">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="main-breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">首頁</a></li>
             <li class="breadcrumb-item">
              <router-link to="/p08_user">會員中心</router-link>
            </li> 
            <li class="breadcrumb-item active" aria-current="page">通知中心</li>
          </ol>
        </nav>
        <!-- /Breadcrumb -->

        <div class="row gutters-sm">
          <div class="col-md-4 mb-3">
            <div class="card order-1">
              <div class="card-body">
                <div class="d-flex flex-column align-items-center text-center">
                  <img
                    src="../assets/img/p08_user/user.jpg"
                    alt="Admin"
                    class="rounded-circle"
                    width="150"
                  />
                  <!-- <div class="file btn btn-lg btn-primary">
                    Change Photo
                    <input type="file" name="file" />
                  </div> -->
                  <div class="mt-3">
                    <h4 class="">Karen</h4>
                    <p class="text_title mb-1">LV.2</p>
                    <p class="text font-size-sm">防詐小尖兵</p>
                    <p class="text font-size-sm">加入時間:yyyy/mm</p>

                    <p class="text_title mb-1">狀態</p>
                    <p class="text font-size-sm">Email 驗證</p>
                    <p class="text font-size-sm">防詐小達人</p>

                  </div>
                </div>
              </div>
            </div>
           
          </div>
          <div class="col-md-8 order-2">
            <div class="card mb-3">
              <!-- 會員資訊 -->
              <div class="profile-head">
                <h4>Hello, Karen 歡迎回來</h4>
                <h6>karen@gmail.com</h6>
                <p class="proile-rating">EXP : <span>50/100</span></p>
                <div class="progress col-lg-5">
                  <div
                    class="progress-bar"
                    role="progressbar"
                    aria-label="Basic example"
                    style="width: 50%"
                    aria-valuenow="50"
                    aria-valuemin="0"
                    aria-valuemax="100"
                  ></div>
                </div>
              </div>
              <!-- 會員資訊end -->
              <!-- 會員活躍度 -->
              <div class="counter col-lg-6 align-self-end">
                <div class="row">
                  <div class="col-6 col-lg-3">
                    <div class="count-data text-center">
                      <h6 class="count h2" data-to="500" data-speed="500">
                        500
                      </h6>
                      <p class="m-0px font-w-600">收到讚數</p>
                    </div>
                  </div>
                  <div class="col-6 col-lg-3">
                    <div class="count-data text-center">
                      <h6 class="count h2" data-to="150" data-speed="150">
                        150
                      </h6>
                      <p class="m-0px font-w-600">收到回應</p>
                    </div>
                  </div>
                  <div class="col-6 col-lg-3">
                    <div class="count-data text-center">
                      <h6 class="count h2" data-to="850" data-speed="850">
                        850
                      </h6>
                      <p class="m-0px font-w-600">留言次數</p>
                    </div>
                  </div>
                  <div class="col-6 col-lg-3">
                    <div class="count-data text-center">
                      <h6 class="count h2" data-to="190" data-speed="190">
                        190
                      </h6>
                      <p class="m-0px font-w-600">可疑網站回報數</p>
                    </div>
                  </div>
                </div>
              </div>
              <!-- 會員活躍度end -->
            </div>

            <div class="row">
              <div class="col">
                <div class="card h-100">
                  <div class="card-body">

                    <!-- tab -->

   
                    <div id="jsGrid"></div>

                    <!-- PO文清單END -->
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
         <!-- footer -->
         <frontFooter />
  </div>
</template>

<script>
import frontNavbar from "@/components/f_nav.vue";
import frontFooter from "@/components/f_footer.vue";

export default {
  components: {
    frontNavbar,
    frontFooter,
  },
  mounted() {
    let id = 0,
      notify = 1;
    var memberPost = [
      {
        ID: `${id++}`,
        日期: "2023-03-19",
        通知內容: `${notify++}`,
      },
      {
        ID: `${id++}`,
        日期: "2023-03-19",
        通知內容: `${notify++}`,
      },
      {
        ID: `${id++}`,
        日期: "2023-03-19",
        通知內容: `${notify++}`,
      },
      {
        ID: `${id++}`,
        日期: "2023-03-19",
        通知內容: `${notify++}`,
      },
      {
        ID: `${id++}`,
        日期: "2023-03-19",
        通知內容: `${notify++}`,
      },
      {
        ID: `${id++}`,
        日期: "2023-03-19",
        通知內容: `${notify++}`,
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
          name: "日期",
          type: "text",
          width: 30,
        },
        {
          name: "通知內容",
          type: "text",
          width: 120,
        },


        {
          name: "編輯/修改",
          width: 40,
          itemTemplate: function () {
            let $buttonContainer = $("<div>");
            // Jquery 等同於 js中的 let buttonContainer = document.createElement("<div>")

            // let $blockade = $("<button>").html(`<i class="fa-solid fa-lock"></i>封鎖`).addClass("small_button mx-1").on("click", operate);
            // let $blockade = $("<button>")
            //   .text(`封鎖`)
            //   .addClass("small_button mx-1")
            //   .on("click", operate);
            // $buttonContainer.append($blockade);

            let $delete = $("<button>")
              .text("刪除")
              .addClass("small_button mx-1")
              .on("click", operate);
            $buttonContainer.append($delete);

            // let $revise = $("<button>")
            //   .text("修改")
            //   .addClass("small_button mx-1")
            //   .on("click", operate);
            // $buttonContainer.append($revise);

            let $check = $("<button>")
              .text("查看")
              .addClass("small_button mx-1")
              .on("click", operate);
            $buttonContainer.append($check);

            return $buttonContainer;
          },
        },
      ],
    });

    function operate() {
      let thisID = this.closest("tr").firstElementChild.innerHTML;
      switch (this.innerHTML) {
        // case "封鎖":
        //   alert(`封鎖帳號 ${thisID}`);
        //   break;
        case "刪除":
          alert(`刪除帳號 ${thisID}`);
          break;
        case "修改":
          alert(`修改帳號 ${thisID}`);
          break;
        // case "查看":
        //   alert(`查看帳號 ${thisID}`);
        //   break;
      }
    }
  },
};
</script>
