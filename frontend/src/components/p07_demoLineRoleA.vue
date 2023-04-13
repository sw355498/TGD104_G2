<template>

    <!-- 聊天框框 (左1) -->
    <div class="line_p07_demoLine_chatMessageLeft">
    <!-- 聊天框的大頭貼 -->            
    <img src="../assets/img/p07_demo/p07_demoLine/a_user_pic.png">
    <!-- 對話內容 (由程式產生對話的位置)-->
    <div class="line_p07_demoLine_chatMessagesContentLeft" v-for="contents in chatMessageLeft_1">
        <!-- 對話文字 -->
        <p class="line_p07_demoLine_chatMessagesText">{{ contents.content }}</p>
        <!-- 時間 -->
        <span class="line_p07_demoLine_chatMessageTimestamp">{{ contents.timestamp }}</span>
    </div>
    </div>

    <!-- 聊天框框 (右1) -->
    <div class="line_p07_demoLine_chatMessageRight" style="display: none;">
    <span class="line_p07_demoLine_chatMessageTimestamp">{{ chatMessageRight_1.timestamp }}</span>
    <p class="line_p07_demoLine_chatMessagesText"> {{ chatMessageRight_1.content }}</p>
    </div>


    <!-- 聊天框框 (左2) -->
    <div class="line_p07_demoLine_chatMessageLeft" style="display: none;">      
    <img src="../assets/img/p07_demo/p07_demoLine/a_user_pic.png">
    <div class="line_p07_demoLine_chatMessagesContentLeft" v-for="contents in chatMessageLift_2">
        <p class="line_p07_demoLine_chatMessagesText">{{ contents.content }}</p>
        <span class="line_p07_demoLine_chatMessageTimestamp">{{ contents.timestamp }}</span>
    </div>
    </div>

    <!-- 聊天框框(右2) -->
    <div class="line_p07_demoLine_chatMessageRight" style="display: none;">
    <span class="line_p07_demoLine_chatMessageTimestamp">{{ chatMessageRight_2.timestamp }}</span>
    <p class="line_p07_demoLine_chatMessagesText"> {{ chatMessageRight_2.content }}</p>
    </div>

    <!-- 聊天框框 (左3) -->
    <div class="line_p07_demoLine_chatMessageLeft" style="display: none;">      
    <img src="../assets/img/p07_demo/p07_demoLine/a_user_pic.png">
    <div class="line_p07_demoLine_chatMessagesContentLeft" v-for="contents in chatMessageLeft_3">
        <p class="line_p07_demoLine_chatMessagesText">{{ contents.content }}</p>
        <span class="line_p07_demoLine_chatMessageTimestamp">{{ contents.timestamp }}</span>
    </div>
    </div>

    <!-- 聊天框框(右3) -->
    <div class="line_p07_demoLine_chatMessageRight" v-for="contents in chatMessageRight_3" style="display: none;">
    <span class="line_p07_demoLine_chatMessageTimestamp">{{ contents.timestamp }}</span>
    <p class="line_p07_demoLine_chatMessagesText"> {{ contents.content }}</p>
    </div>

    <!-- 聊天框框 (左4) -->
    <div class="line_p07_demoLine_chatMessageLeft" style="display: none;">      
    <img src="../assets/img/p07_demo/p07_demoLine/a_user_pic.png">
    <div class="line_p07_demoLine_chatMessagesContentLeft" v-for="contents in chatMessageLeft_4">
        <p class="line_p07_demoLine_chatMessagesText">{{ contents.content }}</p>
        <span class="line_p07_demoLine_chatMessageTimestamp">{{ contents.timestamp }}</span>
    </div>
    </div>

    <!-- 聊天框框(右4) -->
    <div class="line_p07_demoLine_chatMessageRight" style="display: none;">
    <span class="line_p07_demoLine_chatMessageTimestamp">{{ chatMessageRight_4.timestamp }}</span>
    <p class="line_p07_demoLine_chatMessagesText"> {{ chatMessageRight_4.content }}</p>
    </div>


    <!-- Demo 按鈕 -->
    <button class="line_p07_demoLine_chatMessageButton">{{ chatMessageRight_1.content }}</button>
    <button class="line_p07_demoLine_chatMessageButton" style="display: none;">{{ chatMessageRight_2.content }}</button>
    <button class="line_p07_demoLine_chatMessageButton" style="display: none;">{{ chatMessageRight_3[0].content }}</button>
    <button class="line_p07_demoLine_chatMessageButton" style="display: none;">{{ chatMessageRight_4.content }}</button>

</template>

<script>
import { ref, onMounted } from 'vue'

export default {
    setup() {
    // 左側第一組對話
    const chatMessageLeft_1 = ref([
      {
        content: '早安，親愛的，昨晚睡得還好嗎？',
        timestamp: '上午 11:12'
      },
      {
        content: '想你了，想一直和妳在一起～',
        timestamp: '上午 11:13'
      },
      {
        content: '今天上班一直都在想妳都沒辦法專心',
        timestamp: '上午 11:14'
      }
    ])

    // 右側第一組回覆
    const chatMessageRight_1 = ref(
      {
        content: '我也是',
        timestamp: '上午 11:17'
      }
    )

    // 左側第二組對話
    const chatMessageLift_2 = ref([
      {
        content: '我最近想了很多，真的很想和你一起有一個家，我們一起努力好嗎？',
        timestamp: '上午 11:18'
      },
      {
        content: '我同事介紹一個穩賺不賠的理財課程，你可以陪我一起上嗎？',
        timestamp: '上午 11:19'
      },
      {
        content: '還有呀為了我們未來的幸福著想，要不要一起投資虛擬貨幣？妳覺得呢？',
        timestamp: '上午 11:20'
      },
    ])

    // 右側第二組回覆
    const chatMessageRight_2 = ref(
      {
        content: '嗯......再讓我想一下好嗎？',
        timestamp: '上午 11:24'
      }
    )

    // 左側第三組對話
    const chatMessageLeft_3 = ref([
      {
        content: '怎麼了?不能陪我一起嗎...',
        timestamp: '上午 11:25'
      },
      {
        content: '我是真的很想跟你一起長久發展',
        timestamp: '上午 11:25'
      }
    ])

    // 右側第三組回覆
    const chatMessageRight_3 = ref([
      {
        content: '可是我現在沒有多餘的錢',
        timestamp: '上午 11:30'
      },
      {
        content: '讓我想想再回你',
        timestamp: '上午 11:31'
      }
    ])

    // 左側第四組對話
    const chatMessageLeft_4 = ref([
      {
        content: '好～我會等妳的',
        timestamp: '上午 11:32'
      },
      {
        content: '這是我的興趣也希望妳能陪我',
        timestamp: '上午 11:35'
      }
    ])

    // 右側第四組回覆
    const chatMessageRight_4 = ref(
      {
        content: '嗯..我知道...',
        timestamp: '上午 11:38'
      }
    )

    let chatMessageLeft = ref()
    let chatMessageRight = ref()
    let demoBtn = ref()
    let chatMessagesContentLeft = ref()

    // 抓取 HTML DOM
    onMounted(() => {
      // Demo 按鈕
      demoBtn = document.querySelectorAll('.line_p07_demoLine_chatMessageButton')
      
      // 左對話框
      chatMessageLeft = document.querySelectorAll('.line_p07_demoLine_chatMessageLeft')
      chatMessagesContentLeft = document.querySelectorAll('.line_p07_demoLine_chatMessagesContentLeft')
      
      // 右對話框
      chatMessageRight = document.querySelectorAll('.line_p07_demoLine_chatMessageRight')
      
      // 開始撰寫程式
      demoBtn[0].addEventListener('click', () => {
        demoBtn[0].style.display = 'none'
        chatMessageRight[0].style.display = 'flex'
        chatMessageLeft[1].style.display = 'block'
        demoBtn[1].style.display = 'block'
      })
      demoBtn[1].addEventListener('click', () => {
        demoBtn[1].style.display = 'none'
        chatMessageRight[1].style.display = 'flex'
        chatMessageLeft[2].style.display = 'block'
        demoBtn[2].style.display = 'block'
      })
      demoBtn[2].addEventListener('click', () => {
        demoBtn[2].style.display = 'none'
        chatMessageRight[2].style.display = 'flex'
        chatMessageRight[3].style.display = 'flex'
        demoBtn[3].style.display = 'block'
        chatMessageLeft[3].style.display = 'block'
      })
      demoBtn[3].addEventListener('click', () => {
        demoBtn[3].style.display = 'none'
        chatMessageRight[4].style.display = 'flex'
      })

      chatMessagesContentLeft.forEach((messages, index) => {
        setTimeout(() => {
          messages.classList.add('fadeInFromLeft')
        }, index)
      })

      chatMessageRight.forEach((messages, index) => {
        setTimeout(() => {
          messages.classList.add('fadeInFromRight')
        }, index)
      })


    })

    return {
      chatMessageLeft_1,
      chatMessageRight_1,
      chatMessageLift_2,
      chatMessageRight_2,
      chatMessageLeft_3,
      chatMessageRight_3,
      chatMessageLeft_4,
      chatMessageRight_4
    }
  },
}

</script>

<style> </style>