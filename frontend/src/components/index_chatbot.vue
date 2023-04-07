<template>
<div>
    <!-- <div class="chatbot_index" v-if="show" > -->
    <div class="chatbot_index" >
        <div class="chatTitle">
            <img src="../assets/img/icon/robot.png" />
            <!-- <figure class="robot">
                <svg><use xlink:href="#robot" /></svg>
            </figure> -->
            <div class="chatTitle_text">
                <p>專屬機器人</p>
                <p>詐知就好</p>
            </div>
            <i class="fa-solid fa-xmark" @click="$emit('close')"></i>
        </div>
        <div class="chatWindow">
            <!-- 一開始就有的文字 -->
            <div class="chatWindow_message_default">
                <div class="chatbot_message_default">
                    <p>你好！</p>
                </div>
                <div class="chatbot_message_default">
                    <p>趕快來看看政府公告哪些最新消息吧！</p>
                </div>
                <div class="chatbot_news_container">
                    <a class="chatbot_news_item" href="">
                        <!-- <span>新聞快訊</span> -->
                        <p>故意輸入錯誤密碼3次可救回自己的錢?-這是網路謠言，請勿相信</p>
                        <span style="display: block; font-size: 14px;">2023-03-20</span>
                        <span>警政署</span>
                    </a>
                    <a class="chatbot_news_item" href="">
                        <!-- <span>最新消息</span> -->
                        <p>假冒銀行信用貸款簡訊</p>
                        <span style="display: block;font-size: 14px;">2023-03-20</span>
                        <span>警政署</span>
                    </a>
                    <a class="chatbot_news_item" href="">
                        <!-- <span>最新消息</span> -->
                        <p>請注意近期詐騙集團假冒「民宿、旅店、露營區」客服解除分期付款詐騙</p>
                        <span style="display: block;font-size: 14px;">2023-03-20</span>
                        <span>警政署</span>
                    </a>
                    <a class="chatbot_news_item" href="">
                        <p>假冒銀行信用貸款簡訊</p>
                        <span style="display: block;font-size: 14px;">2023-03-20</span>
                        <span>警政署</span>
                    </a>
                </div>
            </div>
            <div class="chatWindow_message" v-for="(message, index) in messages" :key="index">
                <div v-if="message.isBot" class="bot_message">
                    <p v-html="message.text"></p>
                    <!-- <p>{{ message.text }}</p> -->
                </div>
                <div v-else class="user_message">
                    <p>{{ message.text }}</p>
                </div>
            </div>
        </div>
        <div class="chatInput">
            <input type="text" class="message-input" v-model="inputValue" @keydown.enter="sendMessage" placeholder="請輸入訊息...">
            <button type="submit" class="message-submit"  @click="sendMessage">➤</button>
        </div>
    </div>
    <!-- <svg style="position:fixed;bottom: 5%; right: 1%;"><use xlink:href="#robot" @click="showComponent = true; listenClickEvent"/></svg> -->
    <div class="clost-bg" @click="$emit('close')"></div>

</div>
</template>


<script>
import { ref } from 'vue'
export default {
  name: 'Chat',
  setup() {
    // console.log(props.show);
    const messages = ref([]) // 存儲聊天記錄的數組
    const inputValue = ref('') // 存儲輸入框的值
    const goodbyeTimer = ref(null) // 存儲setTimeout返回的計時器ID
    function sendMessage() {
        // 取消計時器
        clearTimeout(goodbyeTimer.value)
        if (inputValue.value) {
            // 將用戶輸入的訊息加入到聊天記錄數組中
            messages.value.push({
                text: inputValue.value,
                isBot: false,
            })
            // 獲取聊天機器人的回覆
            const botMessage = getBotMessage(inputValue.value)
            // 將聊天機器人的回覆加入到聊天記錄數組中
            messages.value.push({
                text: botMessage,
                isBot: true,
            })
            // 清空輸入框
            inputValue.value = ''
        }
    }
    function getBotMessage(input) {
        // 根據用戶的輸入獲取聊天機器人的回覆
        let botMsg = ``;
        switch (input.toLowerCase()) {
            case 'hi':
            case 'hello':
            case '你好':
            botMsg = 'Hello there!';
            break;
            case '防範詐騙教學':
            botMsg =  `以下是防範詐騙教學的相關資訊<br>
                <a href="#" style="color:black">
                    點我看更多
                </a>
            `;
            break;
            case '回報可疑網站':
            botMsg = `以下是回報可疑網站的相關資訊<br>
                <a href="#" style="color:black">
                    點我看更多
                </a>
            `;
            break;
            case '詐騙FAQ':
            botMsg = `以下是詐騙FAQ的相關資訊<br>
                <a href="#" style="color:black">
                    點我看更多
                </a>
            `;
            break;
            case '政府資訊連結':
            botMsg = `以下是政府資訊連結的相關資訊<br>
                <a href="#" style="color:black">
                    點我看更多
                </a>
            `;
            break;
            case '討論專區':
            botMsg = `以下是討論專區的相關資訊<br>
                <a href="#" style="color:black">
                    點我看更多
                </a>
            `;
            break;
            default:
            botMsg = `我猜你應該想知道<br>
            1.防範詐騙教學<br>
            2.回報可疑網站<br>
            3.詐騙FAQ<br>
            4.政府相關資訊連結<br>
            5.討論專區<br>
            6.DEMO體驗<br>
            `;
        }
        // 啟動計時器，30秒後顯示再見的消息
        goodbyeTimer.value = setTimeout(() => {
            messages.value.push({
                text: `已經超過30秒沒有輸入文字囉，要不要看看下面的內容啊<br>
                1.防範詐騙教學<br>
                2.回報可疑網站<br>
                3.詐騙FAQ<br>
                4.政府相關資訊連結<br>
                5.討論專區<br>
                6.DEMO體驗<br>
            `,
                isBot: true,
            })
        }, 3000)
        return botMsg;
    }
    
    return {
      messages,
      inputValue,
      sendMessage,
    }
  },
}
</script>