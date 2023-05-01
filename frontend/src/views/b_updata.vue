<template>
    <Teleport to="body">
        <modal
            :show="showModal"
            :modelWidth="bigModal"
            @close="showModal = false,modelWidth= true, goback()"
        >
        <template #header>
            <h4>單筆查詢</h4>
        </template>
        <template #body>
            <form class="pb-3 mx-5" @submit="handleSubmit" id="b_dataFrom">
                <div v-if="whichTable === 'USER' || whichTable === 'staff'">     
                    <div class="row mb-3">
                        <span class="col-2 text-end text-nowrap">帳號：</span>
                        <p class="col m-0" v-html="account"></p>
                    </div>
                    <div class="row mb-3">                  
                        <label class="col-2 text-end text-nowrap align-self-center" for="nickname"> 顯示名稱： </label>
                        <input
                            v-model.trim="nickname"
                            type="text"
                            class="col m-0"
                            id="nickname"
                        />
                    </div>
                    <div class="row mb-3">                  
                        <label class="col-2 text-end text-nowrap align-self-center" for="mobile"> 手機號碼： </label>
                        <input
                            v-model.trim="mobile"
                            type="tel"
                            class="col m-0"
                            id="mobile"
                            minlength="10"
                            maxlength="10"
                        />
                    </div>
                    <div class="row mb-3">                  
                        <label class="col-2 text-end text-nowrap align-self-center" for="birth"> 生日： </label>
                        <input
                            v-model.trim="birth"
                            type="date"
                            class="col m-0"
                            id="birth"
                        />
                    </div>
                    <div class="row mb-3">
                        <span class="col-2 text-end text-nowrap">建立日期：</span>
                        <p class="col m-0" v-html="user_createTime"></p>
                    </div>
                    <div class="row mb-3">
                        <span class="col-2 text-end text-nowrap">帳號狀態：</span>
                        <p class="col m-0" v-html="userStatus"></p>                 
                    </div> 
                    <div class="row mb-3"> 
                        <span class="col-2 text-end text-nowrap">登入方式：</span>
                        <p class="col m-0" v-html="loginType"></p>                    
                    </div> 
                </div>
                <div v-else-if="whichTable === 'URL'">     
                    <div class="row mb-3">
                        <span class="col-2 text-end text-nowrap">回報人：</span>
                        <p class="col m-0" v-html="ur_user"></p>
                    </div>
                    <div class="row mb-3">
                        <span class="col-2 text-end text-nowrap">網站名稱：</span>
                        <p class="col m-0" v-html="ur_title"></p>
                    </div>
                    <div class="row mb-3">
                        <span class="col-2 text-end text-nowrap">網址：</span>
                        <p class="col m-0" v-html="ur_url"></p>
                    </div>
                    <div class="row mb-3">
                        <span class="col-2 text-end text-nowrap">回報日期：</span>
                        <p class="col m-0" v-html="ur_date"></p>                
                    </div>
                    <div class="row mb-3">
                        <label class="col-2 text-end text-nowrap align-self-center" for="ur_Status"> 回報狀態： </label>
                        <select
                            v-model="review"
                            id="newsTag"
                            class="col form-select text-center"
                        >
                            <option value="1">待審核</option>
                            <option value="2">非詐騙網站</option>
                            <option value="3">詐騙網站</option>
                        </select>
                    </div> 

                </div>
                <div v-else-if="whichTable === 'REPLY_REPORT' || whichTable === 'DISCUSS_REPORT' || whichTable === 'MESSAGE_REPORT'">     
                    <div class="row mb-3">
                        <span class="col-2 text-end text-nowrap align-self-center">檢舉對象：</span>
                        <p class="col m-0" v-html="report_target"></p>
                    </div>
                    <div class="row mb-3">
                        <span class="col-2 text-end text-nowrap">檢舉原因：</span>
                        <p class="col m-0" v-html="report_eason"></p>
                    </div>
                    <div class="row mb-3">
                        <span class="col-2 text-end text-nowrap">檢舉人：</span>
                        <p class="col m-0" v-html="report_account"></p>
                    </div>
                    <div class="row mb-3">
                        <span class="col-2 text-end text-nowrap">檢舉日期：</span>
                        <p class="col m-0" v-html="report_time"></p>
                    </div>
                    <div class="row mb-3">                  
                        <label class="col-2 text-end text-nowrap align-self-center" for="newsTag"> 審核狀況 </label>
                        <select
                            v-model="review"
                            id="newsTag"
                            class="col form-select text-center align-self-center"
                        >
                            <option value="2">通過</option>
                            <option value="3">不通過</option>
                        </select>
                    </div> 
                </div>
                <div v-else-if="whichTable === 'GAME'">
                    <div class="row mb-3">
                        <label class="col-2 text-end text-nowrap align-self-center" for="game_question">
                            題目：
                        </label>
                        <input
                            v-model.trim="game_question"
                            type="text"
                            class="col form-control"
                            id="game_question"
                            required
                        />
                    </div>
                    <div class="row w-100 mb-3">
                        <span class="col-2 text-end text-nowrap">圖片：</span>
                        <div class="col">                       
                            <img :src="gameImage" class="img-fluid" alt="">
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="row mb-1">
                            <label class="col-2 text-end text-nowrap align-self-center" for="game_option"> 選項A： </label>
                            <input
                            v-model.trim="game_optionA"
                            type="text"
                            class="col form-control"
                            id="game_optionA"
                            required
                        />
                        </div>
                        <div class="row mb-1">
                            <label class="col-2 text-end text-nowrap align-self-center" for="game_option"> 選項B： </label>
                            <input
                            v-model.trim="game_optionB"
                            type="text"
                            class="col form-control"
                            id="game_optionB"
                            required
                        />
                        </div>
                        <div class="row mb-1">
                            <label class="col-2 text-end text-nowrap align-self-center" for="game_option"> 選項C： </label>
                            <input
                            v-model.trim="game_optionC"
                            type="text"
                            class="col form-control"
                            id="game_optionC"
                            required
                        />
                        </div>
                        <div class="row mb-1">
                            <label class="col-2 text-end text-nowrap align-self-center" for="game_option"> 選項D： </label>
                            <input
                            v-model.trim="game_optionD"
                            type="text"
                            class="col form-control"
                            id="game_optionD"
                            required
                        />
                        </div>
                    </div>
                    <div class="row mb-3">              
                        <label class="col-2 text-end text-nowrap align-self-center" for="game_answer">
                            答案：
                        </label>
                        <input
                            v-model.trim="game_answer"
                            type="text"
                            class="col form-control"
                            id="game_answer"
                            required
                        />
                    </div>
                    <div class="row mb-3">                  
                        <label class="col-2 text-end text-nowrap align-self-top" for="game_description"> 解釋： </label>
                        <textarea
                            v-model="game_description"
                            style="resize: none; height: 150px;"
                            class="col form-control"
                            id="game_description"
                            required
                        />
                    </div>
                </div>
                <div v-else-if="whichTable === 'chatbot'">     
                    <div class="form-check form-switch mb-3 d-flex align-items-center">
                        <input class="form-check-input mt-0 me-2" style="width: 15%;" type="checkbox" role="switch" id="isbtn" v-model="isbtn">
                        <label class="form-check-label" for="isbtn">是否為按鈕</label>
                    </div>
                    <div class="row mb-3">
                        <label class="col-3 text-end text-nowrap align-self-center" for="keyword" >
                            關鍵字(keyword)：<span class="text-danger">*<small>必填</small></span>
                        </label>
                        <input
                            v-model.trim="keyword"
                            type="text"
                            class="col form-control" 
                            id="keyword"
                            required
                        />
                    </div>
                    <div class="row mb-3">
                        <label class="col-3 text-end text-nowrap align-self-center"  for="message">
                            訊息(message)：<span class="text-danger">*<small>必填</small></span>
                        </label>
                        <input
                            v-model.trim="message"
                            type="text"
                            class="col form-control"
                            id="message"
                            required
                        />
                    </div>
                    <div class="row mb-3">
                        <label for="chatbotContent" class="col-3 text-end text-nowrap align-self-top">
                            內容：<span class="text-danger">*<small>必填</small></span>
                        </label>
                        <textarea
                            v-model="chatbotContent"
                            style="resize: none; height: 150px;"
                            class="col form-control"
                            id="chatbotContent" 
                            rows="10"
                        >
                        </textarea>
                    </div>
                    <div class="row mb-3">
                        <label for="link" class="col-3 text-end text-nowrap align-self-center">
                            連結(Link)：
                        </label>
                        <div class="d-none text-danger" id="linkErrorText"></div>
                        <input
                            v-model.trim="link"
                            type="text"
                            class="col form-control" 
                            id="link"
                        />
                    </div>
                </div>
                <div class="text-end">         
                    <button class="medium_button me-3" @click="goback">返回後台</button>
                    <button class="medium_button">送出</button>
                </div>
            </form>
        </template>
        </modal>
    </Teleport>
</template>
<script setup>
import { ref, onMounted} from "vue";
import Modal from "@/components/modal.vue";
import router from "@/router";
import { API_URL } from "@/config";
import axios from "axios";
import Swal from "sweetalert2/dist/sweetalert2.js";

//彈窗設定
const showModal = ref(true); //彈窗顯示設定
const bigModal = ref(true); //彈窗寬度是否要為width 75%

//從localStorage撈取資料
const id = ref('')
const whichTable = ref('')
let savedData = JSON.parse(localStorage.getItem('upData'));
id.value = Number(savedData.id)
whichTable.value = savedData.whichTable

//審核用的變數
const review= ref("1")

//input的變數
//user
const account =ref('')
const nickname =ref('')
const mobile =ref('')
const birth =ref('')
const user_createTime =ref('')
const userStatus =ref('')
const loginType =ref('')

//回報
const ur_user =ref('')
const ur_title =ref('')
const ur_url =ref('')
const ur_date =ref('')
const ur_Status =ref('')

//檢舉
const report_target =ref('')
const report_reason =ref('')
const report_account =ref('')
const report_time =ref('')
const report_Status =ref('')

//防詐知識測驗
const game_question =ref('')
const game_option =ref('')
const game_optionA =ref('')
const game_optionB =ref('')
const game_optionC =ref('')
const game_optionD =ref('')
const game_answer =ref('')
const game_description =ref('')
const gameImage = ref('')
onMounted(async () => {
    //撈取資料庫的資料
    selectTable();
});

//聊天機器人管理
const isbtn = ref(false);
const keyword = ref('');
const message = ref('');
const chatbotContent = ref('');
const link = ref('');

const goback = () => {
    router.push('/b_index');
    // localStorage.removeItem('upData');
}

//資料庫查詢
async function selectTable() {
    try {
        const response = await axios.post(`${API_URL}b_data_select.php`, {
            whichTable: whichTable.value,
            whichID: id.value
        });
        switch(whichTable.value){
            case 'USER':
            case 'staff':
                account.value = response.data[0].ACCOUNT
                nickname.value = response.data[0].NICKNAME
                mobile.value = response.data[0].MOBILE
                birth.value = response.data[0].BIRTH
                user_createTime.value = response.data[0].CREATE_TIME
                userStatus.value = response.data[0].USER_STATUS_NAME
                loginType.value = response.data[0].LOGIN_TYPE
            break;
            case 'URL':
                ur_user.value =response.data[0].ACCOUNT || '未登記'
                ur_title.value =response.data[0].TITLE
                ur_url.value =response.data[0].URL
                ur_date.value =response.data[0].DATE
                ur_Status.value =response.data[0].STATUS_NAME
                review.value = response.data[0].URL_STATUS
            break;
            case 'REPLY_REPORT':
            case 'DISCUSS_REPORT':
            case 'MESSAGE_REPORT':
                report_target.value =response.data[0].TARGET
                report_reason.value =response.data[0].REASON
                report_account.value =response.data[0].ACCOUNT
                report_time.value =response.data[0].TIME
                report_Status.value =response.data[0].STATUS_NAME
            break;
            case 'GAME':
                game_question.value =response.data[0].QUESTION
                game_option.value =response.data[0].OPTION.split('，')
                game_optionA.value = game_option.value[0]
                game_optionB.value = game_option.value[1]
                game_optionC.value = game_option.value[2]
                game_optionD.value = game_option.value[3]
                game_answer.value =response.data[0].ANSWER
                game_description.value =response.data[0].DESCRIPTION
                try {
                    gameImage.value = require('@/assets/img/p07_demo/p07_demoGame/' + response.data[0].PIC)
                } catch (e) {
                    gameImage.value = `https://tibamef2e.com/tgd104/g2/img/${response.data[0].PIC}`;
                }
                // gameImage.value = require('@/assets/img/p07_demo/p07_demoGame/' + response.data[0].PIC)
            break;

            case 'chatbot':
                if(response.data[0].BTN === 0){
                    isbtn.value = false
                } else {
                    isbtn.value = true
                }
                keyword.value = response.data[0].KEYWORD
                message.value = response.data[0].MESSAGE
                chatbotContent.value = response.data[0].CONTENT
                link.value = response.data[0].LINK
            break;
        }
    } catch (e) {
        if (e.response) {
            console.log(e.response.data.message);
        } else {
            console.log(e.message);
        }
    }
}
//資料更改
async function handleSubmit(e) {
    e.preventDefault();
    try {
        const response = await axios.post(`${API_URL}b_data_insert.php`, {
                whichTable: whichTable.value,
                whichID: id.value,
                nickname: nickname.value,
                mobile: Number(mobile.value),
                birth: birth.value,
                review: Number(review.value),
                isbtn: isbtn.value,
                keyword: keyword.value,
                message: message.value,
                link: link.value,
                chatbotContent: chatbotContent.value
        });

        if (response.data === "更新資料成功") {
            showModal.value = false
            Swal.fire({
                title: '資料更新成功',
                icon: 'success',
                confirmButtonText: "確認",
            }).then((result) => {
                if (result.value) {
                    showModal.value = true
                }
            });
            //撈取資料庫的資料
            selectTable();
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
</script>
