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
                <!-- <template v-if="message.error_text">
                    <div>我猜你應該想知道<br>
                        <ul class="chat-buttons">
                            <li class="chat-button" @click="sendMessage('Z;7DADAD')">防範詐騙教學</li>
                            <li class="chat-button">回報可疑網站</li>
                            <li class="chat-button">詐騙FAQ</li><br>
                            <li class="chat-button">政府相關連結</li>
                            <li class="chat-button">討論專區</li>
                            <li class="chat-button">DEMO體驗</li>
                        </ul>
                    </div>
                </template> -->


                <!-- <div>{{message.message }}</div> -->
                <!-- <div>{{message.message }}</div> -->
                <!-- <router-link  :to="message.link"></router-link> -->
                
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
import { ref , nextTick} from 'vue'
export default {
  name: 'Chat',
  setup() {
    // console.log(props.show);
    const messages = ref([]) // 存儲聊天記錄的陣列
    const inputValue = ref('') // 存儲使用者輸入框的值
    const goodbyeTimer = ref(null) // 存儲setTimeout返回的計時器ID
    const messagesDiv = ref(null) // 取得聊天對話框 為了下滑到對話位置
    async function sendMessage() {
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
            // 將聊天機器人的回覆加入到聊天記錄陣列中
            messages.value.push({
                text: botMessage,
                isBot: true,
            })
            // 清空輸入框
            inputValue.value = ''
            // 下滑視窗
            await nextTick();
            messagesDiv.value.scrollTop = messagesDiv.value.scrollHeight;
        }
    }

    // const robotAnswes =[
    //     {
    //         message:'hi',
    //         keyword:'h1'
    //     },
    //     {
    //         message:'防範詐騙教學',
    //         keyword:'防範詐騙教學'
    //     },
    // ]

    // robotAnswer.h1.message
    // robotAnswer['h1'].message


    // if(robotAnswer.hasOwnproperty(input.toLowerCase().trim())){

    // }
    const robotAnswer = {
        
        'hi':{
            message:'hi',
        },
        '防範詐騙教學':{
            message:'以下是防範詐騙教學的相關資訊',
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
        '政府資訊連結':{
            message:'以下是政府資訊連結的相關資訊',
            link:'/p05'
        },
        '討論專區':{
            message:'以下是討論專區的相關資訊',
            link:'/p06'
        },
        'Demo體驗':{
            message:'以下是討論專區的相關資訊',
            link:'/p07'
        },
        'other':{
            messages: '我猜你應該想知道',
        },
    }
    function getBotMessage(input) {
        // 根據用戶的輸入獲取聊天機器人的回覆
        let botMsg = ``;
        console.log(robotAnswer)
        const input_lowercase = input.trim() 
        console.log(input_lowercase);
        if ( input_lowercase && robotAnswer.hasOwnProperty(input_lowercase)) {
            botMsg = robotAnswer[input_lowercase].message
        }else{
            botMsg = `robotAnswer.message`
        }
        // 去掉空白、轉小寫
        // switch (input.toLowerCase().trim()) {
        //     case 'hi':
        //     case 'hello':
        //     case '你好':
        //     botMsg = '你好！我是詐知就好專屬機器人';
        //     break;
        //     case '防範詐騙教學':
        //     botMsg =  `以下是防範詐騙教學的相關資訊<br>
        //         <a href="#" style="color:black">
        //             點我看更多
        //         </a>
        //     `;
        //     break;
        //     case '回報可疑網站':
        //     botMsg = `以下是回報可疑網站的相關資訊<br>
        //     `;
        //     break;
        //     case '詐騙FAQ':
        //     botMsg = `以下是詐騙FAQ的相關資訊<br>
        //     `;
        //     break;
        //     case '政府資訊連結':
        //     botMsg = `以下是政府資訊連結的相關資訊<br>
        //     `;
        //     break;
        //     case '討論專區':
        //     botMsg = `以下是討論專區的相關資訊<br>
        //     `;
        //     break;
        //     default:
        //     botMsg = `我猜你應該想知道<br>
        //     <ul class="chat-buttons">
        //         <li class="chat-button">防範詐騙教學</li>
        //         <li class="chat-button">回報可疑網站</li>
        //         <li class="chat-button">詐騙FAQ</li><br>
        //         <li class="chat-button">政府相關連結</li>
        //         <li class="chat-button">討論專區</li>
        //         <li class="chat-button">DEMO體驗</li>
        //     </ul>
        //     `;
        // //     const all = document.querySelectorAll('.chat-button')
        // // for (let index = 0; index < all.length; index++) {
        // //     const element = all[index];
        // //     const text = element.innerText
        // //     element.addEventListener('click',()=>{
        // //         text

        // //     })
            
        // // }
        // }
        // 啟動計時器，30秒後顯示再見的消息
        goodbyeTimer.value = setTimeout(async() => {
            messages.value.push({
                text: `感謝使用哦！<br>期待下次再見~
            `,
                isBot: true,
            })
            // 下滑視窗
            await nextTick();
            messagesDiv.value.scrollTop = messagesDiv.value.scrollHeight;
        }, 60000)
        return botMsg;
    }
    
    return {
      messages,
      inputValue,
      sendMessage,
      messagesDiv,
    }
  },
}
</script>