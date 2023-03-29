<template>
<div>
    <div class="chatbot_index" v-if="showComponent">
        <div class="chatTitle">
            <figure class="robot">
                <!-- <img src="../assets/img/icon/robot.png" /> -->
                <svg><use xlink:href="#robot" /></svg>
            </figure>
            <div class="chatTitle_text">
                <p>專屬機器人</p>
                <p>詐知就好</p>
            </div>
            <i class="fa-solid fa-xmark"></i>
        </div>
        <div class="chatWindow">
            <!-- 一開始就有的文字 -->
            <div class="chatWindow_message_default">
                <div class="chat__bot-message_default">
                    <span>你好!</span>
                    <span>這些資訊我想你會需要</span>
                </div>
                <div class="chat__bot-news">

                </div>
            </div>
            <div class="chatWindow_message" v-for="(message, index) in messages" :key="index">
                <div v-if="message.isBot" class="chat__bot-message">
                    <p>{{ message.text }}</p>
                </div>
                <div v-else class="chat__user-message">
                    <p>{{ message.text }}</p>
                </div>
            </div>
        </div>
        <div class="chatInput">
            <input type="text" class="message-input" v-model="inputValue" @keydown.enter="sendMessage" placeholder="請輸入訊息...">
            <button type="submit" class="message-submit chat__send-button"  @click="sendMessage">➤</button>
        </div>
    </div>
    <svg style="position:fixed;bottom: 5%; right: 1%;"><use xlink:href="#robot" @click="showComponent = true; listenClickEvent"/></svg>
    <div class="clost-bg" v-if="showComponent" @click="closeComponent"></div>

</div>
</template>

<script>
import { ref, reactive } from 'vue'

export default {
  name: 'Chat',
  setup() {
    const messages = ref([]) // 存儲聊天記錄的數組
    const inputValue = ref('') // 存儲輸入框的值
    const botMessages = reactive({
      // 聊天機器人的回覆
      hello: '你好，有什麼問題嗎？',
      name: '我叫 ChatBot。',
      weather: '今天天氣很好。',
      default: '抱歉，我不明白你的問題。',
    })

    function sendMessage() {
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
        let botMsg = '';
        switch (input.toLowerCase()) {
            case 'hi':
            case 'hello':
            case '你好':
            botMsg = 'Hello there!';
            break;
            case '防範詐騙教學':
            botMsg = '防範詐騙教學!';
            break;
            case '回報可疑網站':
            botMsg = '回報可疑網站!';
            break;
            case '詐騙FAQ':
            botMsg = 'M詐騙FAQ';
            break;
            case '政府資訊連結':
            botMsg = 'G政府資訊連結!';
            break;
            case '討論專區':
            botMsg = '討論專區';
            break;
            default:
            botMsg = 'Sorry, I did not understand what you said.';
        }
        return botMsg;
        }
    // 點擊才出現
    const showComponent = ref(false);
    let clickListener;

    function listenClickEvent() {
      clickListener = () => {
        showComponent.value = false;
        document.removeEventListener("click", clickListener);
      };
      document.addEventListener("click", clickListener);
    }

    function closeComponent() {
      if (showComponent.value) {
        showComponent.value = false;
        document.removeEventListener("click", clickListener);
      }
    }

    return {
      showComponent,
      listenClickEvent,
      closeComponent,
      messages,
      inputValue,
      sendMessage,
    }
  },
}
</script>
<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped lang="scss">

.clost-bg{
//   position: absolute;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background:rgba(0,0,0,0.5);
}
.chatbot_index {
    position: fixed;
    top: 50%;
    right: 20%;
    transform: translate(20%, -50%);
    max-width: 700px;
    width: 100%;
    height: 600px;
    z-index: 2;
    overflow: hidden;
    background: #EBEBEB;
    border-radius: 20px;
    display: flex;
    justify-content: space-between;
    flex-direction: column;
    box-shadow: 0px 0px 5px black;
    // 上面 chatTitle
    .chatTitle {
        flex: 0 1 45px;
        z-index: 2;
        background: white;
        text-align: left;
        display: flex;
        // height: 90px;
        .robot svg {
            width: 100%;
            // width: 90px;
            // height: 90px;
            object-fit: cover;
        }
        .chatTitle_text{
            margin: 20px 0;
            p{
            font-size: 20px;
            font-weight: 500;
            margin: 10px;
            color: black;
            }
            p:last-child {
                font-size: 18px;
                font-weight: 300;
                letter-spacing: 1px;
            }
        }
        .fa-xmark{
            position: absolute;
            right: 20px;
            top: 20px;
            width: 50px;
            height: 50px;
        }
    }
    // ============ 對話 ============
    .chatWindow {
        flex: 1 1 auto;
        color: rgba(255, 255, 255, 0.5);
        // overflow: hidden;
        overflow-y: scroll;
        // position: relative;
        width: 100%;
        .chatWindow_message_default{
            margin: 10px 10px 0;
            border-radius: 10px;
            color: #033159;
            display: flow-root;
            .chat__bot-message_default span{
                outline: 1px solid red;
                background-color: white;
                padding: 10px;
                border-radius: 5px;
                max-width: 40%;
                width: auto;
                word-break: break-word;
                color: #333;
                // float: left;
            }
        }
        .chatWindow_message{
            margin: 0 10px;
            border-radius: 10px;
            // color: $sec_color;
            color: #033159;
            display: flow-root;
            .chat__bot-message p,
            .chat__user-message p {
                padding: 10px;
                border-radius: 5px;
                max-width: 80%;
                word-break: break-word;
            }
            .chat__bot-message p {
                background-color: white;
                color: #333;
                float: left;
            }
            .chat__user-message p {
                // background: $sec_color;
                background-color: #033159;
                color: white;
                float: right;

            }
        }
    }
    // ============ 使用者輸入的地方 ============
    .chatInput {
        flex: 0 1 40px;
        // width: 100%;
        background: white;
        display: flex;
        align-items: center;
        justify-content: space-between;
        .message-input {
            background: none;
            border: none;
            outline: none !important;
            resize: none;
            color: rgba(0, 0, 0, 0.7);
            padding-left: 20px;
            width: 100%;
            font-size: 16px;
            height: 100%;
        }
        .message-submit {
            color: #fff;
            border: none;
            background-color: #0fb2f2;
            // background-color: $four_color;
            font-size: 16px;
            padding: 6px 10px;
            margin: 10px;
            border-radius: 10px;
            outline: none !important;
            &:hover{
                // background: $sec_color;
                background: #033159;
                cursor: pointer;
            }
        }
    }
}

</style> 
