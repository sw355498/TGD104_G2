<template>
    <Teleport to="body">
        <modal
            :show="showModal"
            :modelWidth="bigModal"
            @close="showModal = false,modelWidth= false"
        >
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
                            v-model.trim="account"
                            type="email"
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
                            v-model.trim="password"
                            type="password"
                            id="password"
                            @focus="removeError('password')"
                            required
                        />
                    </div>
                    <div class="mb-3">                  
                        <label for="nickname"> 顯示名稱 </label>
                        <input
                            v-model.trim="nickname"
                            type="text"
                            style="margin-bottom: 20px"
                            id="nickname"
                        />
                    </div>
                </div>
                <div v-if="leftNavTag === 'news'">
                    <div class="mb-3">
                        <label for="newsTitle" class="form-label">
                            標題<span class="text-danger">*<small>必填</small></span>
                        </label>
                        <div class="d-none text-danger" id="newsTitleErrorText"></div>
                        <input
                            v-model.trim="newsTitle"
                            type="text"
                            class="form-control" 
                            id="newsTitle"
                            @focus="removeError('newsTitle')"
                        />
                    </div>
                    <div class="mb-3" v-if="leftNavTag === 'news'">
                        <label for="discuss_title" class="form-label">
                            分類
                        </label>
                        <select
                            v-model="newsTag"
                            id="newsTag"
                            class="form-select text-center"
                        >
                            <option value="金融詐騙">金融詐騙</option>
                            <option value="網站詐騙">網站詐騙</option>
                            <option value="交友詐騙">交友詐騙</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="upload_img" class="form-label">
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
                        <label for="newsContent" class="form-label">
                            內容<span class="text-danger">*<small>必填</small></span>
                        </label>
                        <div class="d-none text-danger" id="newsContentErrorText"></div>
                        <textarea
                            v-model="newsContent"
                            class="form-control" 
                            id="newsContent" 
                            @focus="removeError('newsContent')"
                            rows="5">
                        </textarea>
                    </div>
                </div>
                <div v-if="leftNavTag === 'FraudKnowledge'">
                    <div class="mb-3">
                        <label for="gameTitle" class="form-label">
                            題目<span class="text-danger">*<small>必填</small></span>
                        </label>
                        <div class="d-none text-danger" id="gameTitleErrorText"></div>
                        <input
                            v-model.trim="gameTitle"
                            type="text"
                            class="form-control" 
                            id="gameTitle"
                            @focus="removeError('gameTitle')"
                            required
                        />
                    </div>
                    <div class="mb-3">
                        <label for="discuss_title" class="form-label">
                            圖片上傳<span class="text-danger">*<small>必填</small></span>
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
                        <label for="gameContent" class="form-label">
                            選項<span class="text-danger">*<small>必填</small></span>
                        </label>
                        <div class="d-none text-danger" id="gameContentErrorText"></div>
                        <textarea
                            v-model="gameContent"
                            class="form-control" 
                            id="gameContent" 
                            @focus="removeError('gameContent')"
                            rows="5"
                            required
                        >
                        </textarea>
                    </div>
                    <div class="mb-3" v-if="leftNavTag === 'FraudKnowledge'">
                        <label for="gameAnswer" class="form-label">
                            解答<span class="text-danger">*<small>必填</small></span>
                        </label>
                        <div class="d-none text-danger" id="gameAnswerErrorText"></div>
                        <textarea
                            v-model="gameAnswer"
                            class="form-control"
                            style="resize:none;"
                            id="gameAnswer" 
                            @focus="removeError('gameAnswer')"
                            rows="5"
                            required
                        >
                        </textarea>
                    </div>
                    <div class="mb-3" v-if="leftNavTag === 'FraudKnowledge'">
                        <label for="gameExplain" class="form-label">
                            解釋<span class="text-danger">*<small>必填</small></span>
                        </label>
                        <div class="d-none text-danger" id="gameExplainErrorText"></div>
                        <textarea
                            v-model="gameExplain"
                            class="form-control" 
                            style="resize:none;"
                            id="gameExplain"
                            @focus="removeError('gameExplain')"
                            rows="5"
                            required
                        >
                        </textarea>
                    </div>
                </div>
                <div v-if="leftNavTag === 'chatbot'">
                    <div class="form-check form-switch mb-3 d-flex align-items-center">
                        <input class="form-check-input mt-0 me-2" style="width: 15%;" type="checkbox" role="switch" id="isbtn" v-model="isbtn">
                        <label class="form-check-label" for="isbtn">是否為按鈕</label>
                    </div>
                    <div class="mb-3">
                        <label for="keyword" class="form-label">
                            關鍵字(keyword)<span class="text-danger">*<small>必填</small></span>
                        </label>
                        <div class="d-none text-danger" id="keywordErrorText"></div>
                        <input
                            v-model.trim="keyword"
                            type="text"
                            class="form-control" 
                            id="keyword"
                            @focus="removeError('keyword')"
                            required
                        />
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">
                            訊息(message)<span class="text-danger">*<small>必填</small></span>
                        </label>
                        <div class="d-none text-danger" id="messageErrorText"></div>
                        <input
                            v-model.trim="message"
                            type="text"
                            class="form-control" 
                            id="message"
                            @focus="removeError('message')"
                            required
                        />
                    </div>
                    <div class="mb-3">
                        <label for="chatbotContent" class="form-label">
                            內容
                        </label>
                        <textarea
                            v-model="chatbotContent"
                            class="form-control" 
                            id="chatbotContent" 
                            rows="5"
                        >
                        </textarea>
                    </div>
                    <div class="mb-3">
                        <label for="link" class="form-label">
                            連結(Link)
                        </label>
                        <input
                            v-model.trim="link"
                            type="text"
                            class="form-control" 
                            id="link"
                        />
                    </div>
                </div>
                <div class="text-end">
                    <button class="medium_button">送出</button>
                </div>
            </form>
        </template>
        </modal>
    </Teleport>
    <div class="d-flex">
        <LeftNav
            :userID = "userID"
            :userName = "userName" 
            :userLevel = "userLevel" 
            :userPic = "userPic"
            @response="leftNavTag = $event"
        />

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
                <input type="text" v-model.trim="searchText"/>
                </div>
            </div>
            <!-- ======== 外掛 jsGrid ========= -->
            <div v-if="!isJsgrid" class="text-center">
                <div id="load">
                    <div>G</div>
                    <div>N</div>
                    <div>I</div>
                    <div>D</div>
                    <div>A</div>
                    <div>O</div>
                    <div>L</div>
                </div>
                <svg width="360" height="360" style="">
                    <use xlink:href="#load" />
                </svg>
            </div>
            <div v-else id="jsGrid"></div>
        </div>
    </div>
</template>
<script setup>
import { ref, watch, onMounted, computed } from "vue";
import $ from "jquery";
import "jsgrid";
import LeftNav from "../components/b_leftNav.vue";
import Modal from "@/components/modal.vue";
import { API_URL } from "@/config";
import axios from "axios";
import Swal from "sweetalert2/dist/sweetalert2.js";
import router from "@/router";
import Loading from "@/components/loading.vue";

const leftNavTag = ref("user"); //側選單的變數
const h2Title = ref("會員管理"); //內容區塊的標題
const addbutton = ref(true); //內容區塊的按鈕顯示設定
const btnName = ref("新增會員"); //按鈕的名稱
const replySelect = ref('1'); //檢舉的下拉式選單
const upData = ref({})
const bData = ref({})

//目前登入的帳號資訊
const currentStaff = JSON.parse(sessionStorage.getItem('staff'));
const loginID =  ref(currentStaff.id)
const loginAccount =  ref(currentStaff.account)
const loginNickname =  ref(currentStaff.nickname)
const loginPic =  ref(currentStaff.pic)
const loginTypeId =  ref(currentStaff.account_type_id)


// 父元件傳值給子元件
// const userLevel = computed(() => {
//   if(accountTypeId.value === 3){
//     return true;
//   } else {
//     return false;
//   }
// });
//簡寫成三元
const userID = computed( () => loginID.value);
const userLevel = computed(() => loginTypeId.value === 3 ? true : false);
const userName = computed(() => loginNickname.value ? loginNickname.value : loginAccount.value)
const userPic = computed(() => loginPic.value ? loginPic.value : 'user.jpg')

//Swal套件的變數
const swalTitle = ref("");
const sealSuccess = ref("success");

//jsgrid套件所需要的變數
const isJsgrid = ref(false);    //資料撈取時所顯示的
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
const bigModal = ref(false); //彈窗寬度是否要為width 75%

//資料庫USER所需要的變數
const searchText = ref("")      //search的input
const account = ref("")         //帳號input
const password = ref("")        //密碼input
const nickname = ref("")        //暱稱input
const newsTitle = ref("")        //最新消息標題input
const newsTag = ref("金融詐騙")        //文章的分類
const newsContent = ref("")      //內容textarea
const fileImage = ref("")       //圖片上傳
const gameTitle = ref("")        //防詐騙知識題目input
const gameContent = ref("")      //內容textarea
const gameAnswer = ref("")       //解答textarea
const gameExplain = ref("")      //解釋textarea
const accountTypeID = ref(1);   //帳號的區分 1會員 2管理員 3主管(暫時只有會員與管理員)

const isbtn = ref(false);
const keyword = ref('');
const message = ref('');
const chatbotContent = ref('');
const link = ref('');

const whichTable = ref("USER"); //資料update 時所需要的資料表參數
const updateID = ref(); //資料update 時所需要的ID參數
const updateStatusID = ref(); //資料update 時所需要的參數(使用帳號狀態)
const selectPHP = ref("b_select_user.php"); //select哪個資料表
const ImgName = ref('') //上傳圖片的名字
//jsgrid套件的欄位設定

//監控子元件傳來的值
watch(leftNavTag, async (newTab) => {
  switch (newTab) {
    case "user":
        bigModal.value = false
        h2Title.value = "會員管理";
        addbutton.value = true;
        btnName.value = "新增會員";
        whichTable.value = "USER";
        accountTypeID.value = 1;
        selectPHP.value = "b_select_user.php";
        account.value = ""
        password.value = ""
        searchText.value = ""
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
        bigModal.value = true
        h2Title.value = "討論版管理";
        addbutton.value = false;
        whichTable.value = "DISCUSS";
        selectPHP.value = "b_select_discuss.php";
        searchText.value = ""
        fields.value = [
            { name: "ID", css: "d-none" },
            { name: "文章標題", type: "text" },
            { name: "文章分類", type: "text" },
            { name: "作者", type: "text", validate: "required" },
            { name: "建立日期", type: "text", width: 80 },
            { name: "狀態", type: "text", width: 80 },
            { name: "操作", width: 180, itemTemplate: function (value, item) {
                // item是由JSGrid內部傳遞給itemTemplate函數的參數，代表著當前這個row的資料
                let $buttonContainer = $("<div>");

                let $report = $("<button>")
                .text("檢舉下架")
                .addClass("small_button mx-1")
                .attr("data-id", item["ID"])
                .on("click", operate);
                $buttonContainer.append($report);
                
                let $delete = $("<button>")
                .text("文章刪除")
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

                // 判斷狀態為 "封鎖中" 時，將 $report 的文字改為 "解鎖"
                if (item["狀態"] === "檢舉下架") {
                    $report.text("恢復上架");
                } else {
                    $report.text("檢舉下架");
                }
                return $buttonContainer;
            }},
        ];
        break;
    case "share":
        bigModal.value = false
        h2Title.value = "回報可疑網站管理";
        addbutton.value = false;
        whichTable.value = "URL";
        selectPHP.value = "b_select_url.php";
        searchText.value = ""
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
        bigModal.value = false
        h2Title.value = "文章檢舉管理";
        addbutton.value = false;
        whichTable.value = "REPLY_REPORT";
        selectPHP.value = "b_select_report.php";
        searchText.value = ""
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
        bigModal.value = true
        h2Title.value = "最新消息管理";
        addbutton.value = true;
        btnName.value = "新增消息";
        whichTable.value = "NEWS";
        selectPHP.value = "b_select_news.php";
        searchText.value = ""
        fileImage.value = ""       //圖片上傳
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
    case "chatbot":
        bigModal.value = true
        h2Title.value = "機器人管理";
        addbutton.value = true;
        btnName.value = "新增回答";
        whichTable.value = "chatbot";
        selectPHP.value = "b_select_chatbot.php";
        searchText.value = ""   
        fields.value = [
            { name: "ID", css: "d-none" },
            { name: "按鈕", type: "text" ,width:40},
            { name: "關鍵字", type: "text" },
            { name: "回答", type: "text" },
            { name: "內容", type: "text" },
            { name: "操作", width: 80, itemTemplate: function (value, item) {
                // item是由JSGrid內部傳遞給itemTemplate函數的參數，代表著當前這個row的資料
                let $buttonContainer = $("<div>");

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
            }},
        ];
        break;
    case "FraudKnowledge":
        bigModal.value = true
        h2Title.value = "詐騙知識測驗管理";
        addbutton.value = true;
        btnName.value = "新增題目";
        whichTable.value = "GAME";
        selectPHP.value = "b_select_game.php";
        searchText.value = ""
        fileImage.value = ""     
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
        bigModal.value = false
        h2Title.value = "後台帳號管理";
        addbutton.value = true;
        btnName.value = "新增管理員帳號";
        whichTable.value = "staff";
        accountTypeID.value = 2;
        selectPHP.value = "b_select_user.php";
        searchText.value = ""
        account.value = ""
        password.value = ""
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
  clients.value = await selectTable();
  reloadJsGrid();
});

// 監聽檢舉頁面的下拉式選單
watch(replySelect, async (newValue) => {
    switch (newValue) {
        case "1":
            whichTable.value = "DISCUSS_REPORT";
            h2Title.value = "文章檢舉管理";
            searchText.value = ""
        break
        case "2":
            whichTable.value = "MESSAGE_REPORT";
            h2Title.value = "留言檢舉管理";
            searchText.value = ""
        break
        case "3":
            whichTable.value = "REPLY_REPORT";
            h2Title.value = "回覆檢舉管理";
            searchText.value = ""
        break
    }
    clients.value = await selectTable();
    reloadJsGrid();
})

// 監聽search的input
watch(searchText, async (newValue) => {    
    clients.value = await search();

    // 重新渲染 jsGrid
    reloadJsGrid();
})

onMounted(async () => {
    //撈取資料庫的資料
    clients.value = await selectTable();

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
            case "恢復上架":
            case "解封鎖":
                updateStatusID.value = 1; // 1為我們預設的帳號正常代碼
                swalTitle.value = `${this.innerHTML}成功`;
                sealSuccess.value = "success";
                blockadeUser();
                break;
            case "刪除":
            case "檢舉下架":
                updateStatusID.value = 3;
                swalTitle.value = `已${this.innerHTML}`;
                sealSuccess.value = "warning";
                blockadeUser();
                break;
                case "刪除":
            case "文章刪除":
                updateStatusID.value = 4; // 3為我們預設的帳號正常代碼
                swalTitle.value = "已刪除";
                sealSuccess.value = "warning";
                blockadeUser();
                break;
            case "修改":
            case  "審核":
                //先將localStorage內的upData清除
                localStorage.removeItem('upData');
                upData.value = {
                    id: updateID.value,
                    whichTable: whichTable.value
                }
                //將當前物件更新至LocalStorage
                localStorage.setItem('upData', JSON.stringify(upData.value))
                router.push('/b_updata')
                break;
            case "查看":
                 //先將localStorage內的upData清除
                localStorage.removeItem('bData');
                bData.value = {
                    id: updateID.value,
                    whichTable: whichTable.value
                }
                //將當前物件更新至LocalStorage
                localStorage.setItem('bData', JSON.stringify(bData.value))
                router.push('/b_data')
            break;
        }
}

// 圖片上傳
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
                clients.value = await selectTable();
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
    if(leftNavTag.value === 'news'){
        const formData = new FormData();
        formData.append('newsTitle', newsTitle.value);
        formData.append('newsTag', newsTag.value);      
        formData.append('newsContent', newsContent.value);
        formData.append('newImage', fileImage.value);
        try {
            const response = await axios.post(`${API_URL}add_news.php`, formData, {
                headers: {
                'Content-Type': 'multipart/form-data'
                }
            });

            const strError = response.data.trimEnd();
            const arrError = strError.split(',')

            if (arrError.includes('最新消息新增成功')) {
                // 清除表單
                newsTitle.value = "";
                newsTag.value = "1";
                newsContent.value = "";
                
                //清除 file的input
                fileImage.value = "";
                ImgName.value = ""

                // 清除可能存在的error
                removeError("newsTitle");
                removeError("newsContent");
                // 關閉彈窗
                showModal.value = false;
                Swal.fire({
                    title: "新增成功",
                    icon: "success",
                    confirmButtonText: "確認",
                });
    
                // 將Client資料更新
                clients.value = await selectTable();
                // 重新渲染 jsGrid
                reloadJsGrid();
            } else if(response.data === '只允許上傳 jpg 或 phg 或 gif 格式的圖片檔案'){
                addError("upload_img", "只允許上傳 jpg 或 phg 或 gif 格式的圖片檔案");
            } else if(response.data === '檔案大小不得超過1MB'){
                addError("upload_img", "檔案大小不得超過1MB");
            } else {

                if(arrError.includes('標題尚未輸入')){
                    addError("newsTitle", "標題尚未輸入");
                }
                if(arrError.includes('內容未輸入')){
                    addError("newsContent", "內容未輸入");
                }
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
        formData.append('gameTitle', gameTitle.value);
        formData.append('gameContent', gameContent.value);
        formData.append('gameAnswer', gameAnswer.value);
        formData.append('gameExplain', gameExplain.value);
        formData.append('newImage', fileImage.value);
        try {
            const response = await axios.post(`${API_URL}add_game.php`, formData, {
                headers: {
                'Content-Type': 'multipart/form-data'
                }
            });
            const strError = response.data.trimEnd();
            const arrError = strError.split(',')

            if (arrError.includes('題目新增成功')) {
                // 清除表單
                gameTitle.value = "";
                gameContent.value = "";
                gameAnswer.value = "";
                gameExplain.value = "";
                //清除 file的input
                fileImage.value = "";
                ImgName.value = ""
                
                // 清除可能存在的error
                removeError("gameTitle");
                removeError("gameContent");
                removeError("gameAnswer");
                removeError("gameExplain");
                // 關閉彈窗
                showModal.value = false;
                Swal.fire({
                    title: "新增成功",
                    icon: "success",
                    confirmButtonText: "確認",
                });
    
                // 將Client資料更新
                clients.value = await selectTable();
                // 重新渲染 jsGrid
                reloadJsGrid();
            } else if(response.data === '只允許上傳 jpg 或 phg 或 gif 格式的圖片檔案'){
                addError("upload_img", "只允許上傳 jpg 或 phg 或 gif 格式的圖片檔案");
            } else if(response.data === '檔案大小不得超過1MB'){
                addError("upload_img", "檔案大小不得超過1MB");
            } else {
                if(arrError.includes('題目尚未輸入')){
                    addError("gameTitle", "題目尚未輸入");
                }
                if(arrError.includes('選項未輸入')){
                    addError("gameContent", "選項內容未輸入");
                }
                if(arrError.includes('解答尚未輸入')){
                    addError("gameAnswer", "解答尚未輸入");
                }
                if(arrError.includes('解釋尚未輸入')){
                    addError("gameExplain", "解釋尚未輸入");
                }
            }
        } catch (e) {
            if (e.response) {
                console.log(e.response.data.message);
            } else {
                console.log(e.message);
            }
        }
    }
    if(leftNavTag.value === 'chatbot'){
        try {
            const response = await axios.post(`${API_URL}add_chatbot.php`, {
                isbtn: isbtn.value,
                keyword: keyword.value,
                message: message.value,
                link: link.value,
                chatbotContent: chatbotContent.value

            });
            const arrError = response.data.split(',')

            if (arrError.includes('新增成功')) {
                // 清除表單
                isbtn.value = false;
                keyword.value = "";
                message.value = "";
                link.value = "";
                chatbotContent.value = "";

                
                // 清除可能存在的error
                removeError("keyword");
                removeError("message");
                // 關閉彈窗
                showModal.value = false;
                Swal.fire({
                    title: "新增成功",
                    icon: "success",
                    confirmButtonText: "確認",
                });
    
                // 將Client資料更新
                clients.value = await selectTable();
                // 重新渲染 jsGrid
                reloadJsGrid();
            } else {
                if(arrError.includes('關鍵字尚未輸入')){
                    addError("keyword", "關鍵字尚未輸入");
                }
                if(arrError.includes('訊息尚未輸入')){
                    addError("message", "訊息尚未輸入");
                }
            }
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
        const response = await axios.post(`${API_URL}b_blockade.php`, {
            whichTable: whichTable.value,
            updateStatusID: updateStatusID.value,
            updateID: updateID.value,

        });

        if (response.data === "資料更新成功") {
            // 將Client資料更新
            clients.value = await selectTable();
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
async function selectTable() {
    try {
        isJsgrid.value= false;
        const response = await axios.post(`${API_URL}${selectPHP.value}`, {
            whichTable: whichTable.value
        });
        if(leftNavTag.value === 'share'){
            for(let n = 0; n < response.data.data.length; n++){
                if(response.data.data[n].回報人 === null){
                    response.data.data[n].回報人 = '-';
                }
            }
        }
        if (leftNavTag.value === 'chatbot') {
            for(let n = 0; n < response.data.data.length; n++){
                if(response.data.data[n].按鈕 == 0){
                    response.data.data[n].按鈕 = '否';
                } else {
                    response.data.data[n].按鈕 = '是';
                }
                if(!response.data.data[n].內容){
                    response.data.data[n].內容 = '-';
                }
            }
        }
        isJsgrid.value= true;
        return response.data.data;
    } catch (e) {
        if (e.response) {
            console.log(e.response.data.message);
        } else {
            console.log(e.message);
        }
    }
}

// search功能
async function search(){
    try {
        isJsgrid.value= false;
        const response = await axios.post(`${API_URL}b_search.php`, {
            whichTable: whichTable.value,
            search : searchText.value
        });
        isJsgrid.value= true;
        return response.data.data;

    } catch (e) {
        if (e.response) {
            console.log(e.response.data.message);
        } else {
            console.log(e.message);
        }
    }
}

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

const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/
    // 驗證表單url不等於空、email正確格式才可以送出
    const isFormValid = computed(() => {
        if (token !=='') {
            return (
            url.value !== '' 
        )
        }else{
            return (
                url.value !== '' &&
                emailRegex.test(email.value)
            )
        }
    })
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
#load {
font-size: 36px;
  position:absolute;
  width:600px;
  height:36px;
  left:calc(50% + 150px);
  top:50%;
  margin-left:-300px;
  overflow:visible;
  user-select:none;
  cursor:default;

  div{
    position:absolute;
    width:20px;
    height:36px;
    opacity:0;
    font-family:Helvetica, Arial, sans-serif;
    animation:move 2s linear infinite;
    transform:rotate(180deg);
    color:#35C4F0;

    &:nth-child(2){
        animation-delay:0.2s;
    }
    &:nth-child(3){
        animation-delay:0.4s;
    }
    &:nth-child(4){
        animation-delay:0.6s;
    }
    &:nth-child(5){
        animation-delay:0.8s;
    }
    &:nth-child(6){
        animation-delay:1s;
    }
    &:nth-child(7){
        animation-delay:1.2s;
    }
  }
}

@keyframes move {
  0% {
    left:0;
    opacity:0;
  }
	35% {
		left: 41%; 
		transform:rotate(0deg);
		opacity:1;
	}
	65% {
		left:59%; 
		transform:rotate(0deg); 
		opacity:1;
	}
	100% {
		left:100%; 
		transform:rotate(-180deg);
		opacity:0;
	}
}
</style>
