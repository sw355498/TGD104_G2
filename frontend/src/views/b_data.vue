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
                    <div class="row mb-3">
                        <span class="col-2 text-end">帳號：</span>
                        <p class="col m-0" v-html="account"></p>
                    </div>
                    <div class="row mb-3">
                        <span class="col-2 text-end">顯示名稱：</span>
                        <p class="col m-0" v-html="nickname"></p>
                    </div>
                    <div class="row mb-3">  
                        <span class="col-2 text-end">電話：</span>
                        <p class="col m-0" v-html="mobile"></p>
                    </div>
                    <div class="row mb-3">
                        <span class="col-2 text-end">生日：</span>
                        <p class="col m-0" v-html="birth"></p>
                    </div>
                    <div class="row mb-3">
                        <span class="col-2 text-end">建立日期：</span>
                        <p class="col m-0" v-html="user_createTime"></p>
                    </div>
                    <div class="row mb-3"> 
                        <span class="col-2 text-end">帳號狀態：</span>
                        <p class="col m-0" v-html="userStatus"></p>
                    </div> 
                    <div class="row mb-3">
                        <span class="col-2 text-end">登入方式：</span>
                        <p class="col m-0" v-html="loginType"></p>
                    </div> 
                </div>
                <div v-else-if="whichTable === 'DISCUSS'">     
                    <div class="row mb-3">
                        <span class="col-2 text-end">文章標題：</span>
                        <p class="col m-0" v-html="d_title"></p>
                    </div>
                    <div class="row mb-3">
                        <span class="col-2 text-end">分類：</span>
                        <p class="col m-0" v-html="d_tag"></p>
                    </div>
                    <div class="row mb-3">
                        <span class="col-2 text-end">作者：</span>
                        <p class="col m-0" v-html="d_author"></p>
                    </div>
                    <div class="row mb-3">   
                        <span class="col-2 text-end">文章內容：</span>
                        <p class="col m-0" v-html="d_content"></p>
                    </div>
                    <div class="row mb-3">
                        <span class="col-2 text-end">建立日期 ：</span>
                        <p class="col m-0" v-html="d_createTime"></p>
                    </div>
                    <div class="row mb-3">
                        <span class="col-2 text-end">文章狀態 ：</span>
                        <p class="col m-0" v-html="d_Status"></p>
                    </div> 
                </div>
                <div v-else-if="whichTable === 'URL'">     
                    <div class="row mb-3">
                        <span class="col-2 text-end">回報人 ：</span>
                        <p class="col m-0" v-html="ur_user"></p>
                    </div>
                    <div class="row mb-3">
                        <span class="col-2 text-end">網站名稱 ：</span>
                        <p class="col m-0" v-html="ur_title"></p>
                    </div>
                    <div class="row mb-3">
                        <span class="col-2 text-end">網址 ：</span>
                        <p class="col m-0" v-html="ur_url"></p>
                    </div>
                    <div class="row mb-3">
                        <span class="col-2 text-end">回報日期 ：</span>
                        <p class="col m-0" v-html="ur_date"></p>
                    </div>
                    <div class="row mb-3">
                        <span class="col-2 text-end">回報狀態 ：</span>
                        <p class="col m-0" v-html="ur_Status"></p>
                    </div> 
                </div>
                <div v-else-if="whichTable === 'REPLY_REPORT' || whichTable === 'DISCUSS_REPORT' || whichTable === 'MESSAGE_REPORT'">     
                    <div class="row mb-3">
                        <span class="col-2 text-end">檢舉對象 ：</span>
                        <p class="col m-0" v-html="report_target"></p>
                    </div>
                    <div class="row mb-3">
                        <span class="col-2 text-end">檢舉原因 ：</span>
                        <p class="col m-0" v-html="report_eason"></p>
                    </div>
                    <div class="row mb-3">
                        <span class="col-2 text-end">檢舉人 ：</span>
                        <p class="col m-0" v-html="report_account"></p>
                    </div>
                    <div class="row mb-3">
                        <span class="col-2 text-end">檢舉日期 ：</span>
                        <p class="col m-0" v-html="report_time"></p>
                    </div>
                    <div class="row mb-3">
                        <span class="col-2 text-end">審核狀況 ：</span>
                        <p class="col m-0" v-html="report_Status"></p>
                    </div> 
                </div>
                <div v-else-if="whichTable === 'NEWS'">     
                    <div class="row mb-3">
                        <span class="col-2 text-end">標題 ：</span>
                        <p class="col m-0" v-html="news_title"></p>
                    </div>
                    <div class="row mb-3">
                        <span class="col-2 text-end">分類 ：</span>
                        <p class="col m-0" v-html="news_tag"></p>
                    </div>                    
                    <div class="row mb-3">
                        <span class="col-2 text-end">圖片 ：</span>
                        <div class="col">
                            <img :src="newsImage" class="img-fluid" :alt="newsImageAlt">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <span class="col-2 text-end">消息內容 ：</span>
                        <p class="col m-0" v-html="news_content"></p>
                    </div>
                    <div class="row mb-3">
                        <span class="col-2 text-end">建立日期 ：</span>
                        <p class="col m-0" v-html="news_createTime"></p>
                    </div>
                </div>
                <div v-else-if="whichTable === 'GAME'">     
                    <div class="row mb-3">
                        <span class="col-2 text-end">題目 ：</span>
                        <p class="col m-0" v-html="game_question"></p>
                    </div>
                    <div class="row mb-3">
                        <span class="col-2 text-end">圖片 ：</span>
                        <div class="col">
                            <img :src="gameImage" class="img-fluid" :alt="gameImageAlt">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <span class="col-2 text-end">選項 ：</span>
                        <p class="col m-0" v-html="game_option"></p>
                    </div>
                    <div class="row mb-3">
                        <span class="col-2 text-end">答案 ：</span>
                        <p class="col m-0" v-html="game_answer"></p>
                    </div>
                    <div class="row mb-3">
                        <span class="col-2 text-end">解釋 ：</span>
                        <p class="col m-0" v-html="game_description"></p>
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
const newsImageAlt = ref('')
//防詐知識測驗
const news_createTime =ref('')
const game_question =ref('')
const game_option =ref('')
const game_answer =ref('')
const game_description =ref('')
const gameImage = ref('')
const gameImageAlt = ref('')
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
                newsImageAlt.vlaue = response.data[0].NEWS_PIC
                try {
                    newsImage.value = require('@/assets/img/p01_news/' + response.data[0].NEWS_PIC)
                } catch (e) {
                    newsImage.value = `https://tibamef2e.com/tgd104/g2/img/${response.data[0].NEWS_PIC}`;
                }
            break;
            case 'GAME':
                game_question.value =response.data[0].QUESTION
                game_option.value =response.data[0].OPTION
                game_answer.value =response.data[0].ANSWER
                game_description.value =response.data[0].DESCRIPTION
                gameImageAlt.value = response.data[0].PIC
                try {
                    gameImage.value = require('@/assets/img/p07_demo/p07_demoGame/' + response.data[0].PIC)
                } catch (e) {
                    gameImage.value = `https://tibamef2e.com/tgd104/g2/img/${response.data[0].PIC}`;
                }
                // gameImage.value = require('@/assets/img/p07_demo/p07_demoGame/' + response.data[0].PIC)
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
