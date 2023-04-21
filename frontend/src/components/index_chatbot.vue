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
                    <div v-for="item in news" :key="item">
                        <router-link :to="'/p01/p01_newsArticle/' + item.ID">
                        <div class="chatbot_news_item" >
                            <p>{{ item.NEWS_TITLE }}</p>
                            <span style="display: block; font-size: 14px;">{{ new Date(item.CREATE_DATE).toLocaleDateString()}}</span>
                            <span>{{ item.NEWS_CATEGORY}}</span>
                        </div>
                        </router-link>
                    </div>
                </div>
            </div>
            <div class="chatWindow_message" v-for="(message, index) in messages" :key="index">
                <div v-if="message.isBot" class="bot_message">
                    <p>{{ message.text }}</p>
                </div>
                <div v-if="!message.isBot" class="user_message">
                    <p>{{ message.text }}</p>
                </div>
                <div v-if="message.isOther">
                    <ul class="chat-buttons" >
                        <!-- <li class="chat-button" 
                            v-for="item in robotAnswerArry" :key="item.id" 
                            @click="sendMessage('{{item.keyword}}')"
                        >{{item.keyword}}
                        </li> -->
                        <li class="chat-button" @click="sendMessage('防範詐騙教學')">防範詐騙教學</li>
                        <li class="chat-button" @click="sendMessage('回報可疑網站')">回報可疑網站</li>
                        <li class="chat-button" @click="sendMessage('詐騙FAQ')">詐騙FAQ</li><br>
                        <li class="chat-button" @click="sendMessage('相關資訊連結')">相關資訊連結</li>
                        <li class="chat-button" @click="sendMessage('討論專區')">討論專區</li>
                        <li class="chat-button" @click="sendMessage('DEMO體驗')">DEMO體驗</li>
                    </ul>
                </div>
                <router-link :to="'/p02'">
                    <div class="eachSection" v-if="message.text === '防範詐騙教學'">
                        <span class="eachSection-title">{{message.text}}</span>
                        <p class="eachSection-p">介紹六大主題：假投資詐騙、假網購詐騙、解除分期詐騙、假冒機構詐騙、交友愛情詐騙、人頭帳戶詐騙。</p>
                        <span class="eachSection-more">點我看更多</span>
                    </div>
                </router-link>
                <router-link :to="'/reportUrl'">
                    <div class="eachSection" v-if="message.text === '回報可疑網站'">
                        <span class="eachSection-title">{{message.text}}</span>
                        <p class="eachSection-p">可填寫表單通報可疑網站，本站將由專人協助判斷是否為詐騙網站。<br>亦可查詢已通報的詐騙網站。</p>
                        <span class="eachSection-more">點我看更多</span>
                    </div>
                </router-link>
                <router-link :to="'/p05/'">
                    <div class="eachSection" v-if="message.text === '詐騙FAQ'">
                        <span class="eachSection-title">{{message.text}}</span>
                        <p class="eachSection-p">介紹常見詐騙問題與解答：詐騙事件警察有何相關應處作為？接獲疑似詐騙電話應如何處置？如何防止詐騙？...等</p>
                        <span class="eachSection-more">點我看更多</span>
                    </div>
                </router-link>
                <router-link :to="'/p04/'">
                    <div class="eachSection" v-if="message.text === '相關資訊連結'">
                        <span class="eachSection-title">{{message.text}}</span>
                        <p class="eachSection-p">介紹政府及民間相關反詐騙連結：165 全民防詐騙網、台灣事實查核中心、證交所、金管會、台哥大反詐戰警、趨勢科技防詐達人。</p>
                        <span class="eachSection-more">點我看更多</span>
                    </div>
                </router-link>
                <router-link :to="'/discuss/'">
                    <div class="eachSection" v-if="message.text === '討論專區'">
                        <span class="eachSection-title">{{message.text}}</span>
                        <p class="eachSection-p">可分享遭遇詐騙的經驗，或探討如何避免詐騙、如何應對詐騙。互相提供建議和協助，提醒大家警惕詐騙，提高自我防範能力，避免遭受詐騙的損失。</p>
                        <span class="eachSection-more">點我看更多</span>
                    </div>
                </router-link>
                <div class="eachSection-demo" v-if="message.text === 'DEMO體驗'">
                    <router-link :to="'/p07demoShopping/'">
                        <div class="eachSection-demo-item" >
                            <span class="eachSection-demo-item-title">購物詐騙</span>
                            <p class="eachSection-demo-item-p">模擬詐騙購物網站形式</p>
                            <span class="eachSection-demo-item-more">點我體驗</span>
                        </div>
                    </router-link>
                    <router-link :to="'/p07demoGame/'">
                        <div class="eachSection-demo-item">
                            <span class="eachSection-demo-item-title">詐騙知識測驗</span>
                            <p class="eachSection-demo-item-p">測驗遊戲考驗你的防詐知識</p>
                            <span class="eachSection-demo-item-more">點我體驗</span>
                        </div>
                    </router-link>
                    <router-link :to="'/p07demoPhone/'">
                        <div class="eachSection-demo-item">
                            <span class="eachSection-demo-item-title">電話詐騙</span>
                            <p class="eachSection-demo-item-p">語音電話模擬金融詐騙</p>
                            <span class="eachSection-demo-item-more">點我體驗</span>
                        </div>
                    </router-link>
                    <router-link :to="'/p07demoLine/'">
                        <div class="eachSection-demo-item">
                            <span class="eachSection-demo-item-title">愛情交友詐騙</span>
                            <p class="eachSection-demo-item-p">LINE 交友軟體模擬詐騙對話</p>
                            <span class="eachSection-demo-item-more">點我體驗</span>
                        </div>
                    </router-link>
                </div>
            </div>
        </div>
        <!-- 使用者輸入 -->
        <div class="chatInput">
            <input 
                type="text" class="message-input" 
                v-model="inputValue" @keyup.enter="sendMessage(null)" 
                placeholder="請輸入訊息...">
            <button 
                type="submit" class="message-submit"  
                @click="sendMessage(null)"
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
        console.log('hi');
        // 取消計時器
        clearTimeout(goodbyeTimer.value);
        if (inputValue.value !=='') {
            // 將用戶輸入的訊息加入到聊天記錄陣列中
            messages.value.push({
                text: inputValue.value,
                isBot: false,
            })
            console.log('mid');
            // 獲取聊天機器人的回覆
            let botMessage = getBotMessage(inputValue.value)
            // 將聊天機器人的回覆加入到聊天記錄陣列中
            messages.value.push({
                text: botMessage,
                isBot: true,
                isOther: true,
            })
            console.log('123');
        } else if (e){
            // 將點擊元素的文字內容加入到聊天記錄陣列中
            messages.value.push({
                text: e,
                isBot: false,
            });
            console.log(e);
            let botMessage = getBotMessage(e)
            // 將聊天機器人的回覆加入到聊天記錄陣列中
            messages.value.push({
                text:botMessage,
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
    const robotAnswerArry = [
    {
        id: 1,
        keyword: '你好',
        message: '你好',
        link: ''
    },
    {
        id: 2,
        keyword: '防範詐騙教學',
        message: '以上是防範詐騙教學',
        content: '',
        link: '/p02'
    },
    {
        id: 3,
        keyword: '回報可疑網站',
        message: '以上是回報可疑網站的相關資訊',
        link: '/reportUrl'
    },
    {
        id: 4,
        keyword: '詐騙FAQ',
        message: '以上是詐騙FAQ的相關資訊',
        link: '/p04'
    },
    {
        id: 5,
        keyword: '相關資訊連結',
        message: '以上是反詐騙相關資訊的連結',
        content: '',
        link: '/p05'
    },
    {
        id: 6,
        keyword: '討論專區',
        message: '以上是討論專區的相關資訊',
        link: '/discuss'
    },
    {
        id: 7,
        keyword: 'DEMO體驗',
        message: '以上是DEMO體驗的相關資訊',
        link: ''
    },
    {
        id: 8,
        keyword: 'other',
        message: '你好，可以點選以下分類或輸入關鍵字獲取更多資訊哦！',
        link: ''
    }
    ];

    const robotAnswer = {
        '你好':{
            message:'你好',
        },
        '防範詐騙教學':{
            message:'還想知道什麼嗎',
        },
        '回報可疑網站':{
            message:'以下是回報可疑網站的相關資訊',
        },
        '詐騙FAQ':{
            message:'以下是詐騙FAQ的相關資訊',
        },
        '相關資訊連結':{
            message:'以下是相關資訊的連結',
        },
        '討論專區':{
            message:'以下是討論專區的相關資訊',
        },
        'DEMO體驗':{
            message:'以下是DEMO體驗的相關資訊',
        },
        'other':{
            message:'你好，可以點選以下分類或輸入關鍵字獲取更多資訊哦！',
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
        if (input_trim) {
            for (const obj of robotAnswerArry) {
            if (obj.keyword === input_trim) {
                botMsg = obj.message;
                break;
            }
            }
        }
        if (botMsg === '') {
            for (const obj of robotAnswerArry) {
            if (obj.keyword === 'other') {
                botMsg = obj.message;
                break;
            }
            }
        }
        // hasOwnProperty有在陣列裡面返回一個布林值
        // if ( input_trim && robotAnswer.hasOwnProperty(input_trim)) {
        //     botMsg = robotAnswer[input_trim].message
        // }else{
        //     botMsg = robotAnswer.other.message;
        // }
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