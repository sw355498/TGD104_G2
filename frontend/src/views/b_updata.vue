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
            <form class="pb-3" @submit="handleSubmit" id="b_dataFrom">
                <div v-if="whichTable === 'USER' || whichTable === 'staff'">     
                    <div class="mb-3">                    
                        <label for="account">
                            帳號
                        </label>
                        <input
                            v-model.trim="account"
                            class="form-control-plaintext"
                            type="email"
                            id="account"
                            required
                            readonly
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
                    <div class="mb-3">                  
                        <label for="mobile"> 電話 </label>
                        <input
                            v-model.trim="mobile"
                            type="tel"
                            style="margin-bottom: 20px"
                            id="mobile"
                        />
                    </div>
                    <div class="mb-3">                  
                        <label for="birth"> 生日 </label>
                        <input
                            v-model.trim="birth"
                            type="date"
                            style="margin-bottom: 20px"
                            id="birth"
                        />
                    </div>
                    <div class="mb-3">                  
                        <label for="user_createTime"> 建立日期 </label>
                        <input
                            v-model.trim="user_createTime"
                            type="date"
                            class="form-control-plaintext"
                            style="margin-bottom: 20px"
                            id="user_createTime"
                            readonly
                        />
                    </div>
                    <div class="mb-3">                  
                        <label for="userStatus"> 帳號狀態 </label>
                        <input
                            v-model.trim="userStatus"
                            type="text"
                            class="form-control-plaintext"
                            style="margin-bottom: 20px"
                            id="userStatus"
                            readonly
                        />
                    </div> 
                    <div class="mb-3">                  
                        <label for="loginType"> 登入方式 </label>
                        <input
                            v-model.trim="loginType"
                            type="text"
                            class="form-control-plaintext"
                            style="margin-bottom: 20px"
                            id="loginType"
                            readonly
                        />
                    </div> 
                </div>
                <div v-else-if="whichTable === 'URL'">     
                    <div class="mb-3">                    
                        <label for="ur_user">
                            回報人
                        </label>
                        <input
                            v-model="ur_user"
                            type="text"
                            class="form-control-plaintext"
                            id="ur_user"
                            required
                            readonly
                        />
                    </div>
                    <div class="mb-3">                  
                        <label for="ur_title"> 網站名稱 </label>
                        <input
                            v-model.trim="ur_title"
                            type="text"
                            class="form-control-plaintext"
                            style="margin-bottom: 20px"
                            id="ur_title"
                            readonly
                        />
                    </div>
                    <div class="mb-3">                  
                        <label for="ur_url"> 網址 </label>
                        <input
                            v-model.trim="ur_url"
                            type="text"
                            class="form-control-plaintext"
                            style="margin-bottom: 20px"
                            id="ur_url"
                            readonly
                        />
                    </div>
                    <div class="mb-3">                  
                        <label for="ur_date"> 回報日期 </label>
                        <input
                            v-model="ur_date"
                            type="date"
                            class="form-control-plaintext"
                            style="margin-bottom: 20px"
                            id="ur_date"
                            readonly
                        />
                    </div>
                    <div class="mb-3">                  
                        <label for="ur_Status"> 回報狀態 </label>
                        <!-- <input
                            v-model="ur_Status"
                            type="text"
                            class="form-control-plaintext"
                            style="margin-bottom: 20px"
                            id="ur_Status"
                            readonly
                        /> -->
                        <select
                            v-model="review"
                            id="newsTag"
                            class="form-select text-center"
                        >
                            <option value="1">未審核</option>
                            <option value="2">非詐騙網站</option>
                            <option value="3">詐騙網站</option>
                        </select>
                    </div> 

                </div>
                <div v-else-if="whichTable === 'REPLY_REPORT' || whichTable === 'DISCUSS_REPORT' || whichTable === 'MESSAGE_REPORT'">     
                    <div class="mb-3">                    
                        <label for="report_target">
                            檢舉對象
                        </label>
                        <textarea
                            v-model="report_target"
                            class="form-control-plaintext"
                            style="margin-bottom: 20px; resize:none;"
                            id="report_target"
                            readonly
                        />
                    </div>
                    <div class="mb-3">                  
                        <label for=""> 檢舉原因 </label>
                        <textarea
                            v-model="report_eason"
                            class="form-control-plaintext"
                            style="margin-bottom: 20px; resize:none;"
                            id="report_reason"
                            readonly
                        />
                    </div>
                    <div class="mb-3">                  
                        <label for="report_account"> 檢舉人 </label>
                        <input
                            v-model.trim="report_account"
                            type="text"
                            class="form-control-plaintext"
                            style="margin-bottom: 20px"
                            id="report_account"
                            readonly
                        />
                    </div>
                    <div class="mb-3">                  
                        <label for="report_time"> 檢舉日期 </label>
                        <input
                            v-model="report_time"
                            type="date"
                            class="form-control-plaintext"
                            style="margin-bottom: 20px"
                            id="report_time"
                            readonly
                        />
                    </div>
                    <div class="mb-3">                  
                        <label for="newsTag"> 審核狀況 </label>
                        <select
                            v-model="review"
                            id="newsTag"
                            class="form-select text-center"
                        >
                            <option value="2">通過</option>
                            <option value="3">不通過</option>
                        </select>
                    </div> 
                </div>
                <div v-else-if="whichTable === 'GAME'">     
                    <div class="mb-3">                    
                        <label for="game_question">
                            題目
                        </label>
                        <input
                            v-model.trim="game_question"
                            type="text"
                            class="form-control"
                            id="game_question"
                            required
                        />
                    </div>
                    <div class="w-100">
                        <img :src="gameImage" class="img-fluid" alt="">
                    </div>
                    <div class="mb-3">               
                        <label for="game_option"> 選項 </label>
                        <textarea
                            v-model="game_option"
                            class="form-control"
                            style="margin-bottom: 20px; resize:none;"
                            id="game_option"
                            required
                        />
                    </div>
                    <div class="mb-3">                    
                        <label for="game_answer">
                            答案
                        </label>
                        <input
                            v-model.trim="game_answer"
                            type="text"
                            class="form-control"
                            id="game_answer"
                            required
                        />
                    </div>
                    <div class="mb-3">                  
                        <label for="game_description"> 解釋 </label>
                        <textarea
                            v-model="game_description"
                            class="form-control"
                            style="margin-bottom: 20px; resize:none;"
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
                            required
                        />
                    </div>
                    <div class="mb-3">
                        <label for="chatbotContent" class="form-label">
                            內容<span class="text-danger">*<small>必填</small></span>
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
                        <div class="d-none text-danger" id="linkErrorText"></div>
                        <input
                            v-model.trim="link"
                            type="text"
                            class="form-control" 
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
const review= ref(1)

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
                ur_user.value =response.data[0].ACCOUNT
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
                game_option.value =response.data[0].OPTION
                game_answer.value =response.data[0].ANSWER
                game_description.value =response.data[0].DESCRIPTION
                gameImage.value = require('@/assets/img/p07_demo/p07_demoGame/' + response.data[0].PIC)
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
