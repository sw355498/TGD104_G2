<template>
<div>
    <!-- <div class="chatbot_index" v-if="show" > -->
    <div class="chatbot_index" >
        <div class="chatTitle">
            <img src="../assets/img/icon/robot.png" />
            <div class="chatTitle_text">
                <p>專屬機器人</p>
                <p>詐知就好</p>
            </div>
            <i class="fa-solid fa-xmark" @click="$emit('close')"></i>
        </div>
        <div class="chatWindow" ref="messagesDiv">
            <!-- 一開始就有的文字 -->
            <div class="chatWindow_message_default">
                <div class="chatbot_message_default">
                    <p>你好！</p>
                </div>
                <div class="chatbot_message_default">
                    <p>這些資訊我想你會需要！</p>
                </div>
                <div class="chatbot_news_container">
                    <!-- 接最新消息資料庫5筆 -->
                    <ul v-for="news in news" :key="news">
                        <li class="chatbot_news_item" >
                            <p>{{ news.NEWS_TITLE }}</p>
                            <span style="display: block; font-size: 14px;">2023-03-20</span>
                            <span>{{ news.NEWS_CATEGORY}}</span>
                        </li>
                    </ul>
                    <!-- <a class="chatbot_news_item" href="">
                        <span>新聞快訊</span>
                        <p>故意輸入錯誤密碼3次可救回自己的錢?-這是網路謠言，請勿相信</p>
                        <span style="display: block; font-size: 14px;">2023-03-20</span>
                        <span>警政署</span>
                    </a>
                    <a class="chatbot_news_item" href="">
                        <p>假冒銀行信用貸款簡訊</p>
                        <span style="display: block;font-size: 14px;">2023-03-20</span>
                        <span>警政署</span>
                    </a>
                    <a class="chatbot_news_item" href="">
                        <p>請注意近期詐騙集團假冒「民宿、旅店、露營區」客服解除分期付款詐騙</p>
                        <span style="display: block;font-size: 14px;">2023-03-20</span>
                        <span>警政署</span>
                    </a>
                    <a class="chatbot_news_item" href="">
                        <p>假冒銀行信用貸款簡訊</p>
                        <span style="display: block;font-size: 14px;">2023-03-20</span>
                        <span>警政署</span>
                    </a> -->
                </div>
            </div>
            <div class="chatWindow_message" v-for="(message, index) in messages" :key="index">
                <div v-if="message.isBot" class="bot_message">
                    <!-- <p v-html="message.text"></p> -->
                    <p>{{ message.text }}</p>
                </div>
                <div v-if="!message.isBot" class="user_message">
                    <p>{{ message.text }}</p>
                </div>
                <div v-if="message.isOther">
                    <ul class="chat-buttons">
                        <li class="chat-button" @click="sendMessage('防範詐騙教學')">防範詐騙教學</li>
                        <li class="chat-button" @click="sendMessage('回報可疑網站')">回報可疑網站</li>
                        <li class="chat-button" @click="sendMessage('詐騙FAQ')">詐騙FAQ</li><br>
                        <li class="chat-button" @click="sendMessage('相關資訊連結')">相關資訊連結</li>
                        <li class="chat-button" @click="sendMessage('討論專區')">討論專區</li>
                        <li class="chat-button" @click="sendMessage('DEMO體驗')">DEMO體驗</li>
                    </ul>
                </div>
                <div class="eachSection" v-if="message.text === '防範詐騙教學'">
                    <span class="eachSection-title">{{message.text}}</span>
                    <p class="eachSection-p">介紹六大主題：假投資詐騙、假網購詐騙、解除分期詐騙、假冒機構詐騙、交友愛情詐騙、人頭帳戶詐騙。</p>
                </div>
                <div class="eachSection" v-if="message.text === '回報可疑網站'">
                    <span class="eachSection-title">{{message.text}}</span>
                    <p class="eachSection-p">可填寫表單通報可疑網站，本站將由專人協助判斷是否為詐騙網站。<br>亦可查詢已通報的詐騙網站。</p>
                </div>
                <div class="eachSection" v-if="message.text === '詐騙FAQ'">
                    <span class="eachSection-title">{{message.text}}</span>
                    <p class="eachSection-p">介紹常見詐騙問題與解答：詐騙事件警察有何相關應處作為？接獲疑似詐騙電話應如何處置？如何防止詐騙？...等</p>
                </div>
                <div class="eachSection" v-if="message.text === '相關資訊連結'">
                    <span class="eachSection-title">{{message.text}}</span>
                    <p class="eachSection-p">介紹政府及民間相關反詐騙連結：165 全民防詐騙網、台灣事實查核中心、證交所、金管會、台哥大反詐戰警、趨勢科技防詐達人。</p>
                </div>
                <div class="eachSection" v-if="message.text === '討論專區'">
                    <span class="eachSection-title">{{message.text}}</span>
                    <p class="eachSection-p">可分享遭遇詐騙的經驗，並且探討如何避免詐騙、如何應對詐騙。互相提供建議和協助，提醒大家警惕詐騙，更加警覺詐騙行為，提高自我防範能力，避免自己和家人遭受詐騙的損失。</p>
                </div>
                <div class="eachSection" v-if="message.text === 'DEMO體驗'">
                    <span class="eachSection-title">{{message.text}}</span>
                    <p class="eachSection-p">透過體驗四種互動更了解詐騙手法：購物詐騙、詐騙知識測驗、電話詐騙、愛情交友詐騙。</p>
                </div>
                <!-- <router-link  :to="message.link"></router-link> -->
            </div>
        </div>
        <!-- 使用者輸入 -->
        <div class="chatInput">
            <input 
                type="text" class="message-input" 
                v-model="inputValue" @keyup.enter="sendMessage" 
                placeholder="請輸入訊息...">
            <button 
                type="submit" class="message-submit"  
                @click="sendMessage"
                :disabled="inputValue==``"
            >➤
            </button>
        </div>
    </div>
    <div class="clost-bg" @click="$emit('close')"></div>
</div>
</template>


<script setup>
import axios from 'axios';
import { API_URL } from '@/config' // 統一 api 路徑變數
import { ref , nextTick, onMounted} from 'vue'
    const messages = ref([]) // 存儲聊天記錄的陣列
    const inputValue = ref('') // 存儲使用者輸入框的值
    const goodbyeTimer = ref(null) // 存儲setTimeout返回的計時器ID
    const messagesDiv = ref(null) // 取得聊天對話框 為了下滑到對話位置
    async function sendMessage(e) {
        // 取消計時器
        clearTimeout(goodbyeTimer.value);
        if (inputValue.value !=='') {
            // 將用戶輸入的訊息加入到聊天記錄陣列中
            messages.value.push({
                text: inputValue.value,
                isBot: false,
            })
            // 獲取聊天機器人的回覆
            let botMessage = getBotMessage(inputValue.value)
            if (botMessage == `other`) {
                console.log(botMessage);
                messages.value.push({
                    text: '你好，請點選以下分類獲取更多資訊哦！',
                    isBot: true,
                    isOther: true,
                })
            }else{
                // 將聊天機器人的回覆加入到聊天記錄陣列中
                messages.value.push({
                    text: botMessage,
                    isBot: true,
                })
            }
        } else if (e){
            // 將點擊元素的文字內容加入到聊天記錄陣列中
            messages.value.push({
                text: e,
                isBot: false,
            });
            // 將聊天機器人的回覆加入到聊天記錄陣列中
            messages.value.push({
                text: '還想知道什麼嗎，請點選以下分類獲取更多資訊哦！',
                isBot: true,
                isOther: true,
            })
        }
        // 清空輸入框
        inputValue.value = ''
        // 下滑視窗
        await nextTick();
        messagesDiv.value.scrollTop = messagesDiv.value.scrollHeight;
    }
    //機器人回復關鍵字
    const robotAnswer = {
        '你好':{
            message:'你好',
        },
        '防範詐騙教學':{
            message:'還想知道什麼嗎',
            link:'/p02'
        },
        '回報可疑網站':{
            message:'以下是回報可疑網站的相關資訊',
            link:'/reportUrl'
        },
        '詐騙FAQ':{
            message:'以下是詐騙FAQ的相關資訊',
            link:'/p04'
        },
        '相關資訊連結':{
            message:'以下是相關資訊的連結',
            link:'/p05'
        },
        '討論專區':{
            message:'以下是討論專區的相關資訊',
            link:'/p06'
        },
        'DEMO體驗':{
            message:'以下是DEMO體驗的相關資訊',
            link:'/p07'
        },
        'other':{
            message:'other',
        }
    }
    function getBotMessage(input) {
        // 確認 input 是字串，如果不是就轉換成字串
        if (typeof input !== 'string') {
            input = String(input);
        }
        // 根據用戶的輸入獲取聊天機器人的回覆
        let botMsg = ``;
        const input_trim = input.trim();
        console.log(input_trim);
        // hasOwnProperty有在陣列裡面返回一個布林值
        if ( input_trim && robotAnswer.hasOwnProperty(input_trim)) {
            botMsg = robotAnswer[input_trim].message
        }else{
            botMsg = robotAnswer.other.message;
        }
        // 啟動計時器，1分鐘後顯示再見的消息
        goodbyeTimer.value = setTimeout(async() => {
            messages.value.push({
                text: `閒置超過1分鐘囉，感謝使用！期待下次再見~`,
                isBot: true,
            })
            // 下滑視窗
            await nextTick();
            messagesDiv.value.scrollTop = messagesDiv.value.scrollHeight;
        }, 60000)
        return botMsg;
    }
    // 抓最新消息
    const news = ref([]);
    async function allData(){
        try { 
            const response = await axios.get(`${API_URL}getNews.php`);
            const news = response.data.slice(0, 5);
            console.log(news);
            return news
        } catch (error) {
            // 提交失敗的處理
            console.error('failed', error)
        }
    }
    onMounted(
        async () => {
        //撈取資料庫的資料
        news.value = await allData();
        console.log(news.value);
        }
    );
</script>