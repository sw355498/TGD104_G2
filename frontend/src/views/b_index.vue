<template>
    <Teleport to="body">
        <modal :show="showModal" @close="showModal = false">
        <template #header>
            <h4>{{ btnName }}</h4>
        </template>
        <template #body>
            <form class="pb-3" @submit="handleSubmit" id="addDataForm">
                <div v-if="leftNavTag === 'user' || leftNavTag === 'staff'">     
                    <div class="mb-3">                    
                        <label for="account">
                            帳號<span class="text-danger">*<small>必填</small></span>
                        </label>
                        <div class="d-none text-danger" id="accountErrorText"></div>
                        <input
                            v-model="account"
                            type="text"
                            id="account"
                            @focus="removeError('account')"
                            required
                        />
                    </div>           
                    <div class="mb-3">                   
                        <label for="password">
                            密碼<span class="text-danger">*<small>必填</small></span>
                        </label>
                        <div class="text-danger" id="passwordErrorText"></div>
                        <input
                            v-model="password"
                            type="password"
                            id="password"
                            @focus="removeError('password')"
                            required
                        />
                    </div>
                    <div class="mb-3">                  
                        <label for="nickname"> 顯示名稱 </label>
                        <input
                            v-model="nickname"
                            type="text"
                            style="margin-bottom: 20px"
                            id="nickname"
                        />
                    </div>
                </div>
                <div v-if="leftNavTag === 'news' || leftNavTag === 'FraudKnowledge'">
                    <div class="mb-3">
                        <label for="newTitle" class="form-label">
                            標題<span class="text-danger">*<small>必填</small></span>
                        </label>
                        <div class="d-none text-danger" id="newTitleErrorText"></div>
                        <input
                            v-model="newTitle"
                            type="text"
                            class="form-control" 
                            id="newTitle"
                            @focus="removeError('newTitle')"
                        />
                    </div>
                    <div class="mb-3" v-if="leftNavTag === 'news'">
                        <label for="discuss_title" class="form-label">
                            分類
                        </label>
                        <select
                            v-model="newsTag"
                            id="inputState"
                            class="form-select text-center"
                        >
                            <option value="1">金融詐騙</option>
                            <option value="2">網站詐騙</option>
                            <option value="3">交友詐騙</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="discuss_title" class="form-label">
                            圖片上傳
                        </label>
                        <div class="d-none text-danger" id="upload_imgErrorText"></div>
                        <label class="file_btn">
                            <input 
                                id="upload_img" 
                                class="d-none" 
                                type="file" 
                                @change="fileChange"
                            />
                            <i class="fa-solid fa-image fa-fw"></i>上傳圖片<span>{{ ImgName }}</span>
                        </label>
                    </div>
                    <div class="mb-3">
                        <label for="newContent" class="form-label">
                            內容<span class="text-danger">*<small>必填</small></span>
                        </label>
                        <div class="d-none text-danger" id="newContentErrorText"></div>
                        <textarea
                            v-model="newContent"
                            class="form-control" 
                            id="newContent" 
                            @focus="removeError('newContent')"
                            rows="5">
                        </textarea>
                    </div>
                    <div class="mb-3" v-if="leftNavTag === 'FraudKnowledge'">
                        <label for="newAnswer" class="form-label">
                            解答<span class="text-danger">*<small>必填</small></span>
                        </label>
                        <div class="d-none text-danger" id="newAnswerErrorText"></div>
                        <textarea
                            v-model="newAnswer"
                            class="form-control" 
                            id="newAnswer" 
                            @focus="removeError('newAnswer')"
                            rows="5">
                        </textarea>
                    </div>
                    <div class="mb-3" v-if="leftNavTag === 'FraudKnowledge'">
                        <label for="newExplain" class="form-label">
                            解釋<span class="text-danger">*<small>必填</small></span>
                        </label>
                        <div class="d-none text-danger" id="newExplainErrorText"></div>
                        <textarea
                            v-model="newExplain"
                            class="form-control" 
                            id="newExplain"
                            @focus="removeError('newExplain')"
                            rows="5">
                        </textarea>
                    </div>
                </div>

                <button class="medium_button submitBtn">送出</button>
            </form>
        </template>
        </modal>
    </Teleport>
    <div class="d-flex">
        <LeftNav @response="leftNavTag = $event" />
        <div class="b_content">
        <h2 class="h1_component">{{ h2Title }}</h2>
        <div class="d-flex justify-content-end align-items-center my-2">
            <button
            v-if="addbutton"
            class="medium_button b_add_btn me-2"
            @click="showModal = true"
            >
            {{ btnName }}
            </button>
            <select
            v-if="leftNavTag === 'reply'"
            v-model="replySelect"
            id="inputState"
            class="form-select w-25 me-2 text-center"
            >
                <option value="1">文章的檢舉</option>
                <option value="2">留言的檢舉</option>
                <option value="3">回覆的檢舉</option>
            </select>
            <div class="position-relative">
            <i
                class="fa-sharp fa-solid fa-magnifying-glass fa-fw position-absolute top-50 end-0"
            ></i>
            <input type="text" />
            </div>
        </div>
        <div id="jsGrid"></div>
        </div>
    </div>
</template>
<script setup>
import { ref, watch, onMounted } from "vue";
import $ from "jquery";
import "jsgrid";
import LeftNav from "../components/b_leftNav.vue";
import Modal from "@/components/modal.vue";
import { API_URL } from "@/config";
import axios from "axios";
import Swal from "sweetalert2/dist/sweetalert2.js";

const leftNavTag = ref("user"); //側選單的變數
const h2Title = ref("會員管理"); //內容區塊的標題
const addbutton = ref(true); //內容區塊的按鈕顯示設定
const btnName = ref("新增會員"); //按鈕的名稱
const replySelect = ref('1'); //檢舉的下拉式選單

//Swal套件的變數
const swalTitle = ref("");
const sealSuccess = ref("success");

//jsgrid套件所需要的變數
const clients = ref([]); //後端撈取的data
const fields = ref([
    { name: "ID", css: "d-none" },
    { name: "帳號", type: "text", validate: "required" },
    { name: "暱稱", type: "text", width: 100, css: "d-none" },
    { name: "建立日期", type: "text", width: 80 },
    { name: "登入方式", type: "text", width: 60 },
    { name: "狀態", type: "text", width: 50 },
    { name: "操作", width: 150, itemTemplate: function (value, item) {
        // item是由JSGrid內部傳遞給itemTemplate函數的參數，代表著當前這個row的資料
        let $buttonContainer = $("<div>");

        let $blockade = $("<button>")
            .text(`封鎖`)
            .addClass("small_button mx-1")
            .attr("data-id", item["ID"])
            .on("click", operate);
        $buttonContainer.append($blockade);
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

        let $check = $("<button>")
            .text("查看")
            .addClass("small_button mx-1")
            .attr("data-id", item["ID"])
            .on("click", operate);
        $buttonContainer.append($check);

        // 判斷狀態為 "封鎖中" 時，將 $blockade 的文字改為 "解鎖"
        if (item["狀態"] === "封鎖") {
            $blockade.text("解封鎖");
        } else {
            $blockade.text("封鎖");
        }
        return $buttonContainer;
    }},
]); //jsgrid的欄位設定

//彈窗設定
const showModal = ref(false); //彈窗顯示設定

//資料庫USER所需要的變數
const account = ref("")         //帳號input
const password = ref("")        //密碼input
const nickname = ref("")        //暱稱input
const newTitle = ref("")        //標題input
const newsTag = ref("1")        //文章的分類
const newContent = ref("")      //內容textarea
const fileImage = ref("")       //圖片上傳
const fileName = ref("")
const newAnswer = ref("")       //解答textarea
const newExplain = ref("")      //解釋textarea
const accountTypeID = ref(1); //帳號的區分 1會員 2管理員 3主管(暫時只有會員與管理員)
const whereVariable = ref([1]); //select時所需要的參數
const updateTable = ref("USER"); //資料update 時所需要的資料表參數
const updateID = ref(); //資料update 時所需要的ID參數
const updateStatusID = ref(); //資料update 時所需要的參數(使用帳號狀態)
const selectTable = ref("select_user.php");
const ImgName = ref('')
//jsgrid套件的欄位設定

//監控子元件傳來的值
watch(leftNavTag, async (newTab) => {
  switch (newTab) {
    case "user":
        h2Title.value = "會員管理";
        addbutton.value = true;
        btnName.value = "新增會員";
        updateTable.value = "USER";
        accountTypeID.value = 1;
        selectTable.value = "select_user.php";
        whereVariable.value = [1];
        fields.value = [
            { name: "ID", css: "d-none" },
            { name: "帳號", type: "text", validate: "required" },
            { name: "暱稱", type: "text", width: 100, css: "d-none" },
            { name: "建立日期", type: "text", width: 80 },
            { name: "登入方式", type: "text", width: 60 },
            { name: "狀態", type: "text", width: 50 },
            { name: "操作", width: 150, itemTemplate: function (value, item) {
                // item是由JSGrid內部傳遞給itemTemplate函數的參數，代表著當前這個row的資料
                let $buttonContainer = $("<div>");

                let $blockade = $("<button>")
                .text(`封鎖`)
                .addClass("small_button mx-1")
                .attr("data-id", item["ID"])
                .on("click", operate);
                $buttonContainer.append($blockade);
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

                let $check = $("<button>")
                .text("查看")
                .addClass("small_button mx-1")
                .attr("data-id", item["ID"])
                .on("click", operate);
                $buttonContainer.append($check);

                // 判斷狀態為 "封鎖中" 時，將 $blockade 的文字改為 "解鎖"
                if (item["狀態"] === "封鎖") {
                    $blockade.text("解封鎖");
                } else {
                    $blockade.text("封鎖");
                }
                return $buttonContainer;
            }},
        ];
        break;
    case "discuss":
        h2Title.value = "討論版管理";
        addbutton.value = false;
        updateTable.value = "DISCUSS";
        selectTable.value = "select_discuss.php";
        whereVariable.value = [];
        fields.value = [
            { name: "ID", css: "d-none" },
            { name: "文章標題", type: "text" },
            { name: "文章分類", type: "text" },
            { name: "作者", type: "text", validate: "required" },
            { name: "建立日期", type: "text", width: 80 },
            { name: "狀態", type: "text", width: 50 },
            { name: "操作", width: 150, itemTemplate: function (value, item) {
                // item是由JSGrid內部傳遞給itemTemplate函數的參數，代表著當前這個row的資料
                let $buttonContainer = $("<div>");

                let $blockade = $("<button>")
                .text(`封鎖`)
                .addClass("small_button mx-1")
                .attr("data-id", item["ID"])
                .on("click", operate);
                $buttonContainer.append($blockade);

                let $delete = $("<button>")
                .text("刪除")
                .addClass("small_button mx-1")
                .attr("data-id", item["ID"])
                .on("click", operate);
                $buttonContainer.append($delete);

                let $check = $("<button>")
                .text("查看")
                .addClass("small_button mx-1")
                .attr("data-id", item["ID"])
                .on("click", operate);
                $buttonContainer.append($check);

                // 判斷狀態為 "封鎖中" 時，將 $blockade 的文字改為 "解鎖"
                if (item["狀態"] === "封鎖") {
                    $blockade.text("解封鎖");
                } else {
                    $blockade.text("封鎖");
                }
                return $buttonContainer;
            }},
        ];
        break;
    case "share":
        h2Title.value = "回報管理";
        addbutton.value = false;
        updateTable.value = "URL";
        selectTable.value = "select_url.php";
        whereVariable.value = [];
        fields.value = [
            { name: "ID", css: "d-none" },
            { name: "網站名稱", type: "text" },
            { name: "網址", type: "text" },
            { name: "回報人", type: "text" },
            { name: "回報日期", type: "text", width: 80 },
            { name: "回報狀態", type: "text"},
            { name: "操作", width: 100, itemTemplate: function (value, item) {
                let $buttonContainer = $("<div>");

                let $delete = $("<button>")
                .text("刪除")
                .addClass("small_button mx-1")
                .attr("data-id", item["ID"])
                .on("click", operate);
                $buttonContainer.append($delete);

                let $check = $("<button>")
                .text("審核")
                .addClass("small_button mx-1")
                .attr("data-id", item["ID"])
                .on("click", operate);
                $buttonContainer.append($check);
                return $buttonContainer;
            }},
        ];
        break;
    case "reply":
        h2Title.value = "文章檢舉管理";
        addbutton.value = false;
        updateTable.value = "REPLY_REPORT";
        selectTable.value = "select_report.php";
        whereVariable.value = 1;
        fields.value = [
            { name: "ID", css: "d-none" },
            { name: "檢舉對象", type: "text" },
            { name: "檢舉原因", type: "text" },
            { name: "檢舉人", type: "text" },
            { name: "檢舉日期", type: "text", width: 80 },
            { name: "審核狀況", type: "text"},
            { name: "操作", width: 80, itemTemplate: function (value, item) {
                let $buttonContainer = $("<div>");

                let $check = $("<button>")
                .text("審核")
                .addClass("small_button mx-1")
                .attr("data-id", item["ID"])
                .on("click", operate);
                $buttonContainer.append($check);
                return $buttonContainer;
            }},
        ];
      break;
    case "news":
        h2Title.value = "最新消息管理";
        addbutton.value = true;
        btnName.value = "新增消息";
        updateTable.value = "NEWS";
        selectTable.value = "select_news.php";
        whereVariable.value = [];
        fields.value = [
            { name: "ID", css: "d-none" },
            { name: "標題", type: "text" },
            { name: "分類", type: "text" },
            { name: "內容", type: "text" },
            { name: "建立日期", type: "text", width: 80 },
            { name: "操作", width: 80, itemTemplate: function (value, item) {
                let $buttonContainer = $("<div>");

                let $delete = $("<button>")
                .text("刪除")
                .addClass("small_button mx-1")
                .attr("data-id", item["ID"])
                .on("click", operate);
                $buttonContainer.append($delete);

                let $check = $("<button>")
                .text("查看")
                .addClass("small_button mx-1")
                .attr("data-id", item["ID"])
                .on("click", operate);
                $buttonContainer.append($check);
                return $buttonContainer;
            }},
        ];
      break;
    case "FraudKnowledge":
        h2Title.value = "詐騙知識測驗管理";
        addbutton.value = true;
        btnName.value = "新增題目";
        updateTable.value = "GAME";
        selectTable.value = "select_game.php";
        whereVariable.value = [];
        fields.value = [
            { name: "ID", css: "d-none" },
            { name: "問題", type: "text" },
            { name: "答案", type: "text" },
            { name: "操作", width: 80, itemTemplate: function (value, item) {
                // item是由JSGrid內部傳遞給itemTemplate函數的參數，代表著當前這個row的資料
                let $buttonContainer = $("<div>");

                let $delete = $("<button>")
                .text("刪除")
                .addClass("small_button mx-1")
                .attr("data-id", item["ID"])
                .on("click", operate);
                $buttonContainer.append($delete);

                let $check = $("<button>")
                .text("查看")
                .addClass("small_button mx-1")
                .attr("data-id", item["ID"])
                .on("click", operate);
                $buttonContainer.append($check);

                let $revise = $("<button>")
                .text("修改")
                .addClass("small_button mx-1")
                .attr("data-id", item["ID"])
                .on("click", operate);
                $buttonContainer.append($revise);

                return $buttonContainer;
            }},
        ];
        break;
    case "staff":
        h2Title.value = "後台帳號管理";
        addbutton.value = true;
        btnName.value = "新增管理員帳號";
        updateTable.value = "USER";
        accountTypeID.value = 2;
        selectTable.value = "select_user.php";
        whereVariable.value = [2, 3];
        fields.value = [
            { name: "ID", css: "d-none" },
            { name: "帳號", type: "text", validate: "required" },
            { name: "暱稱", type: "text", width: 100, css: "d-none" },
            { name: "建立日期", type: "text", width: 80 },
            { name: "登入方式", type: "text", width: 60 },
            { name: "狀態", type: "text", width: 50 },
            { name: "操作", width: 150, itemTemplate: function (value, item) {
                // item是由JSGrid內部傳遞給itemTemplate函數的參數，代表著當前這個row的資料
                let $buttonContainer = $("<div>");
                let $blockade = $("<button>")
                .text(`封鎖`)
                .addClass("small_button mx-1")
                .attr("data-id", item["ID"])
                .on("click", operate);
                $buttonContainer.append($blockade);

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

                let $check = $("<button>")
                .text("查看")
                .addClass("small_button mx-1")
                .attr("data-id", item["ID"])
                .on("click", operate);
                $buttonContainer.append($check);

               
                // 判斷狀態為 "封鎖中" 時，將 $blockade 的文字改為 "解鎖"
                if (item["狀態"] === "封鎖") {
                $blockade.text("解封鎖");
                } else {
                $blockade.text("封鎖");
                }
                return $buttonContainer;
            }},
        ];
        break;
  }
  clients.value = await selectUser();
  reloadJsGrid();
});

// 監聽檢舉頁面的下拉式選單
watch(replySelect, async (newValue) => {
    switch (newValue) {
        case "1":
            whereVariable.value = 1;
            h2Title.value = "文章檢舉管理";
        break
        case "2":
            whereVariable.value = 2;
            h2Title.value = "留言檢舉管理";
        break
        case "3":
            whereVariable.value = 3;
            h2Title.value = "回覆檢舉管理";
        break
    }
    clients.value = await selectUser();
    reloadJsGrid();
})


onMounted(async () => {
    //撈取資料庫的資料
    clients.value = await selectUser();

    /* 
        因為 jsGrid 模組是動態載入的，
        所以必須使用 await import('jsgrid') 來等待 Promise resolved，
        這樣就可以在後續的程式碼中直接使用載入的模組了
    */
    const jsgrid = await import("jsgrid");
    reloadJsGrid();

    //clients的資料如有更動，重新呼叫jsgrid套件更新渲染的資料
    watch(clients, () => {
        reloadJsGrid();
    });
});

//jsgrid套件
const reloadJsGrid = () => {
    $("#jsGrid").jsGrid({
        width: "100%",
        inserting: false, //添加
        editing: false, //編輯
        sorting: true, //排序
        /*分頁設定*/
        paging: true,
        pagerContainer: null, //jQueryElement或DomNode指定呈現一個分頁欄，為null時在表格底部。
        pageIndex: 1, //當前頁面數
        pageSize: 8, //頁面的數據量
        pageButtonCount: 5, //最大數量的頁面按鈕
        pagerFormat: "{first} {pages} {last} &nbsp;&nbsp; {pageIndex} of {pageCount}", //占位符來指定分頁欄格式
        //pageNextText: "Next",   //下一頁
        //pagePrevText: "Prev",   //上一頁
        pageFirstText: "首頁", //首頁
        pageLastText: "最後一頁", //尾頁
        pageNavigatorNextText: "...", //最大數量頁面按鈕超出時右邊顯示
        pageNavigatorPrevText: "...", //最大數量頁面按鈕超出時右邊顯示
        data: clients.value,
        fields: fields.value,
    });
};

// jsGrid內的自製按鈕事件
function operate(e) {
    updateID.value = Number(e.target.dataset.id);
    switch (this.innerHTML) {
            case "封鎖":
                updateStatusID.value = 2; // 2為我們預設的帳號封鎖代碼
                swalTitle.value = "封鎖成功";
                sealSuccess.value = "success";
                blockadeUser();
                break;
            case "解封鎖":
                updateStatusID.value = 1; // 1為我們預設的帳號正常代碼
                swalTitle.value = "解鎖成功";
                sealSuccess.value = "success";
                blockadeUser();
                break;
            case "刪除":
                updateStatusID.value = 3; // 3為我們預設的帳號正常代碼
                swalTitle.value = "已刪除";
                sealSuccess.value = "warning";
                blockadeUser();
                break;
            case "修改":
            case "審核":
                alert(`修改帳號 ${updateID.value}`);
                break;
            case "查看":
                alert(`查看帳號 ${updateID.value}`);
                break;
        }
}

function fileChange(e){
    fileImage.value = e.target.files[0]
    ImgName.value = `：${fileImage.value.name}`
    removeError("upload_img");
}

//表單送出事件
const handleSubmit = async (e) => {
    e.preventDefault();
    if(leftNavTag.value === 'user' || leftNavTag.value === 'staff'){
        try {
            const response = await axios.post(`${API_URL}add_user.php`, {
                account: account.value,
                password: password.value,
                nickname: nickname.value,
                accountTypeID: accountTypeID.value,
            });
            if (response.data === "帳號註冊成功") {
                // 清除表單
                account.value = "";
                password.value = "";
                nickname.value = "";
                
                // 清除可能存在的error
                removeError("account");
                removeError("password");
                // 關閉彈窗
                showModal.value = false;
                Swal.fire({
                    title: "新增成功",
                    // text: '歡迎加入詐知就好！',
                    icon: "success",
                    confirmButtonText: "確認",
                });
    
                // 將Client資料更新
                clients.value = await selectUser();
                // 重新渲染 jsGrid
                reloadJsGrid();
            } else if (response.data === "此帳號已被註冊") {
                addError("account", "此帳號已被註冊");
            } else if (response.data === "帳號與密碼尚未輸入") {
                addError("account", "帳號尚未輸入");
                addError("password", "密碼尚未輸入");
            } else if (response.data === "帳號尚未輸入") {
                addError("account", "帳號尚未輸入");
            } else if (response.data === "密碼尚未輸入") {
                addError("password", "密碼尚未輸入");
            } else {
                console.log(response.data);
            }
        } catch (e) {
            if (e.response) {
                console.log(e.response.data.message);
            } else {
                console.log(e.message);
            }
        }
    }
    if(leftNavTag.value === 'FraudKnowledge'){
        const formData = new FormData();
        // formData.append('newTitle', newTitle.value);
        // formData.append('newContent', newContent.value);
        // formData.append('newAnswer', newAnswer.value);
        // formData.append('newExplain', newExplain.value);
        formData.append('newImage', fileImage.value);
        formData.append('where', '資料夾位置')
        try {
            const response = await axios.post(`${API_URL}add_game.php`, formData, {
                headers: {
                'Content-Type': 'multipart/form-data'
                }
            });
            if (response.data === "題目新增成功") {
                // 清除表單
                account.value = "";
                password.value = "";
                nickname.value = "";
                
                // 清除可能存在的error
                removeError("newTitle");
                removeError("newContent");
                removeError("newAnswer");
                removeError("newExplain");
                // 關閉彈窗
                showModal.value = false;
                Swal.fire({
                    title: "新增成功",
                    icon: "success",
                    confirmButtonText: "確認",
                });
    
                // 將Client資料更新
                clients.value = await selectUser();
                // 重新渲染 jsGrid
                reloadJsGrid();
            } else if(response.data === '只允許上傳 JPG 或 PNG 格式的圖片檔案'){
                addError("upload_img", "只允許上傳 JPG 或 PNG 格式的圖片檔案");
            } else if(response.data === '欄位都未輸入'){
                console.log('123')
                addError("newTitle", "題目尚未輸入");
                addError("newContent", "選項未輸入");
                addError("newAnswer", "解答尚未輸入");
                addError("newExplain", "解答尚未輸入");
            } else if(response.data === '題目尚未輸入'){
                addError("newTitle", "題目尚未輸入");
            } else if(response.data === '選項未輸入'){
                addError("newTitle", "選項未輸入");
            } else if(response.data === '解答尚未輸入'){
                addError("newAnswer", "解答尚未輸入");
            } else if(response.data === '解釋尚未輸入'){
                addError("newAnswer", "解釋尚未輸入");
            }
            console.log(response.data);
        } catch (e) {
            if (e.response) {
                console.log(e.response.data.message);
            } else {
                console.log(e.message);
            }
        }
    }
};

//資料庫資料修改
async function blockadeUser() {
    try {
        const response = await axios.post(`${API_URL}blockade_user.php`, {
            updateTable: updateTable.value,
            updateStatusID: updateStatusID.value,
            updateID: updateID.value,
        });

        if (response.data === "資料更新成功") {
            // 將Client資料更新
            clients.value = await selectUser();
            // 重新渲染 jsGrid
            reloadJsGrid();
            Swal.fire({
                title: swalTitle.value,
                icon: sealSuccess.value,
                confirmButtonText: "確認",
        });
        } else {
            console.log(response.data);
        }
    } catch (e) {
        if (e.response) {
            console.log(e.response.data.message);
        } else {
            console.log(e.message);
        }
    }
}

//資料庫查詢
async function selectUser() {
    try {
        const response = await axios.post(`${API_URL}${selectTable.value}`, {
            whereVariable: whereVariable.value,
        });
        return response.data.data;
    } catch (e) {
        if (e.response) {
            console.log(e.response.data.message);
        } else {
            console.log(e.message);
        }
    }
}

//input的focus事件
// const handleFocus = (theInputID) => {
//     removeError(theInputID);
// };

// 新增錯誤訊息
const addError = (InputID, ErrorText) => {
    let theInputDOM = document.querySelector(`#${InputID}`);
    let theErrorText = document.querySelector(`#${InputID}ErrorText`);
    theInputDOM.classList.add("error");
    theErrorText.classList.remove("d-none");
    theErrorText.innerText = ErrorText;
};

//刪除錯誤訊息
const removeError = (InputID) => {
    let theInputDOM = document.querySelector(`#${InputID}`);
    if (theInputDOM.classList.contains("error")) {
        let theErrorText = document.querySelector(`#${InputID}ErrorText`);
        theInputDOM.classList.remove("error");
        theErrorText.classList.add("d-none");
    }
};
</script>

<style lang="scss">
.fa-sharp {
    transform: translate(-50%, -50%);
}
#jsGrid {
    .jsgrid-header-sortable::before {
        top: 10px;
        left: 0px;
    }
    .jsgrid-nodata-row{
        color: #fff;
    }
}
.submitBtn {
    float: right;
    &::after {
        content: "";
        display: block;
        clear: both;
    }
}
.error {
    outline: 3px solid red;
}
.file_btn {
    width: 100%;
    height: 38px;
    font-size: 1rem;
    padding: 0.375rem 0.75rem;
    background: #033159;
    color: #ffffff;
    border: 1px solid #033159;
    box-shadow: 0px 0px 10px rgba(255, 255, 255, 0.25);
    border-radius: 4px;
    line-height: 150%;
    cursor: pointer;
    text-align: center;
    white-space: nowrap;
    line-height: 1.5;
}
</style>
