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
                            v-model="account"
                            type="email"
                            class="form-control-plaintext"
                            id="account"
                            required
                            readonly
                        />
                    </div>
                    <div class="mb-3">                  
                        <label for="nickname"> 顯示名稱 </label>
                        <input
                            v-model="nickname"
                            type="text"
                            class="form-control-plaintext"
                            style="margin-bottom: 20px"
                            id="nickname"
                            readonly
                        />
                    </div>
                    <div class="mb-3">                  
                        <label for="mobile"> 電話 </label>
                        <input
                            v-model="mobile"
                            type="tel"
                            class="form-control-plaintext"
                            style="margin-bottom: 20px"
                            id="mobile"
                            readonly
                        />
                    </div>
                    <div class="mb-3">                  
                        <label for="birth"> 生日 </label>
                        <input
                            v-model="birth"
                            type="date"
                            class="form-control-plaintext"
                            style="margin-bottom: 20px"
                            id="birth"
                            readonly
                        />
                    </div>
                    <div class="mb-3">                  
                        <label for="user_createTime"> 建立日期 </label>
                        <input
                            v-model="user_createTime"
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
                            v-model="userStatus"
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
                            v-model="loginType"
                            type="text"
                            class="form-control-plaintext"
                            style="margin-bottom: 20px"
                            id="loginType"
                            readonly
                        />
                    </div> 
                </div>
                <div v-else-if="whichTable === 'DISCUSS'">     
                    <div class="mb-3">                    
                        <label for="d_title">
                            文章標題
                        </label>
                        <input
                            v-model="d_title"
                            type="text"
                            id="d_title"
                            class="form-control-plaintext"
                            required
                            readonly
                        />
                    </div>
                    <div class="mb-3">                  
                        <label for="d_tag"> 分類 </label>
                        <input
                            v-model="d_tag"
                            type="text"
                            style="margin-bottom: 20px"
                            id="d_tag"
                            class="form-control-plaintext"
                            readonly
                        />
                    </div>
                    <div class="mb-3">                  
                        <label for="d_author"> 作者 </label>
                        <input
                            v-model="d_author"
                            type="text"
                            style="margin-bottom: 20px"
                            id="d_author"
                            class="form-control-plaintext"
                            readonly
                        />
                    </div>
                    <div class="mb-3">                  
                        <label for="d_content"> 文章內容 </label>
                        <textarea
                            v-model="d_content"
                            class="form-control-plaintext"
                            style="margin-bottom: 20px; resize:none;"
                            id="d_content"
                            readonly
                        />
                    </div>
                    <div class="mb-3">                  
                        <label for="d_createTime"> 建立日期 </label>
                        <input
                            v-model="d_createTime"
                            type="date"
                            class="form-control-plaintext"
                            style="margin-bottom: 20px"
                            id="d_createTime"
                            readonly
                        />
                    </div>
                    <div class="mb-3">                  
                        <label for="d_Status"> 文章狀態 </label>
                        <input
                            v-model="d_Status"
                            type="text"
                            class="form-control-plaintext"
                            style="margin-bottom: 20px"
                            id="d_Status"
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
                            v-model="ur_title"
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
                            v-model="ur_url"
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
                        <input
                            v-model="ur_Status"
                            type="text"
                            class="form-control-plaintext"
                            style="margin-bottom: 20px"
                            id="ur_Status"
                            readonly
                        />
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
                            v-model="report_account"
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
                        <label for="report_Status"> 審核狀況 </label>
                        <input
                            v-model="report_Status"
                            type="text"
                            class="form-control-plaintext"
                            style="margin-bottom: 20px"
                            id="report_Status"
                            readonly
                        />
                    </div> 
                </div>
                <div v-else-if="whichTable === 'NEWS'">     
                    <div class="mb-3">                    
                        <label for="news_title">
                            標題
                        </label>
                        <input
                            v-model="news_title"
                            type="text"
                            class="form-control-plaintext"
                            id="news_title"
                            required
                            readonly
                        />
                    </div>
                    <div class="mb-3">                  
                        <label for="news_tag"> 分類 </label>
                        <input
                            v-model="news_tag"
                            type="text"
                            class="form-control-plaintext"
                            style="margin-bottom: 20px"
                            id="news_tag"
                            readonly
                        />
                    </div>                    <div class="w-100">
                        <img :src="newsImage" class="img-fluid" alt="">
                    </div>
                    <div class="mb-3">                  
                        <label for="news_content"> 消息內容 </label>
                        <textarea
                            v-model="news_content"
                            class="form-control-plaintext"
                            style="margin-bottom: 20px; resize:none;"
                            id="news_content"
                            readonly
                        />
                    </div>
                    <div class="mb-3">                  
                        <label for="news_createTime"> 建立日期 </label>
                        <input
                            v-model="news_createTime"
                            type="date"
                            class="form-control-plaintext"
                            style="margin-bottom: 20px"
                            id="news_createTime"
                            readonly
                        />
                    </div>
                </div>
                <div v-else-if="whichTable === 'GAME'">     
                    <div class="mb-3">                    
                        <label for="game_question">
                            題目
                        </label>
                        <input
                            v-model="game_question"
                            type="text"
                            class="form-control-plaintext"
                            id="game_question"
                            required
                            readonly
                        />
                    </div>
                    <div class="w-100">
                        <img :src="gameImage" class="img-fluid" alt="">
                    </div>
                    <div class="mb-3">               
                        <label for="game_option"> 選項 </label>
                        <textarea
                            v-model="game_option"
                            class="form-control-plaintext"
                            style="margin-bottom: 20px; resize:none;"
                            id="game_option"
                            readonly
                        />
                    </div>
                    <div class="mb-3">                    
                        <label for="game_answer">
                            答案
                        </label>
                        <input
                            v-model="game_answer"
                            type="text"
                            class="form-control-plaintext"
                            id="game_answer"
                            required
                            readonly
                        />
                    </div>
                    <div class="mb-3">                  
                        <label for="game_description"> 解釋 </label>
                        <textarea
                            v-model="game_description"
                            class="form-control-plaintext"
                            style="margin-bottom: 20px; resize:none;"
                            id="game_description"
                            readonly
                        />
                    </div>
                </div>
                <div class="text-end">
                    <button class="medium_button" @click="goback">返回後台</button>
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

//彈窗設定
const showModal = ref(true); //彈窗顯示設定
const bigModal = ref(true); //彈窗寬度是否要為width 75%


//從localStorage撈取資料
const id = ref('')
const whichTable = ref('')
let savedData = JSON.parse(localStorage.getItem('bData'));
id.value = Number(savedData.id)
whichTable.value = savedData.whichTable

//input的變數
//user
const account =ref('')
const nickname =ref('')
const mobile =ref('')
const birth =ref('')
const user_createTime =ref('')
const userStatus =ref('')
const loginType =ref('')
//文章
const d_title =ref('')
const d_tag =ref('')
const d_author =ref('')
const d_content =ref('')
const d_createTime =ref('')
const d_Status =ref('')
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
//最新消息 ,,,
const news_title =ref('')
const news_tag =ref('')
const news_content =ref('')
const newsImage = ref('')
//防詐知識測驗
const news_createTime =ref('')
const game_question =ref('')
const game_option =ref('')
const game_answer =ref('')
const game_description =ref('')
const gameImage = ref('')
onMounted(async () => {
    //撈取資料庫的資料
    selectTable();
});


const goback = () => {
    router.push('/b_index');
    // localStorage.removeItem('bData');
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
            case 'DISCUSS':
                d_title.value =response.data[0].TITLE
                d_tag.value =response.data[0].CATEGORY
                d_author.value =response.data[0].ACCOUNT
                d_content.value =response.data[0].CONTENT
                d_createTime.value =response.data[0].CREATE_TIME
                d_Status.value =response.data[0].STATUS_NAME
            break;
            case 'URL':
                ur_user.value =response.data[0].ACCOUNT
                ur_title.value =response.data[0].TITLE
                ur_url.value =response.data[0].URL
                ur_date.value =response.data[0].DATE
                ur_Status.value =response.data[0].STATUS_NAME
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
            case 'NEWS':
                news_title.value =response.data[0].NEWS_TITLE
                news_tag.value =response.data[0].NEWS_CATEGORY
                news_content.value =response.data[0].NEWS_CONTENT
                news_createTime.value =response.data[0].CREATE_DATE
                newsImage.value = require('@/assets/img/p01_news/' + response.data[0].PIC)
            break;
            case 'GAME':
                game_question.value =response.data[0].QUESTION
                game_option.value =response.data[0].OPTION
                game_answer.value =response.data[0].ANSWER
                game_description.value =response.data[0].DESCRIPTION
                gameImage.value = require('@/assets/img/p07_demo/p07_demoGame/' + response.data[0].PIC)
            break;
        }
        return response.data.data;
    } catch (e) {
        if (e.response) {
            console.log(e.response.data.message);
        } else {
            console.log(e.message);
        }
    }
}
</script>
