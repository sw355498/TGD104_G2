<template>

    <!-- 聊天框框 (左1) -->
    <div class="line_p07_demoLine_chatMessageLeft">
    <!-- 聊天框的大頭貼 -->            
    <img src="../assets/img/p07_demo/p07_demoLine/b_user_pic.png">
    <!-- 對話內容 (由程式產生對話的位置)-->
    <div class="line_p07_demoLine_chatMessagesContentLeft" v-for="contents in chatMessageLeft_1">
        <!-- 對話文字 -->
        <p class="line_p07_demoLine_chatMessagesText">{{ contents.content }}</p>
        <!-- 時間 -->
        <span class="line_p07_demoLine_chatMessageTimestamp">{{ contents.timestamp }}</span>
    </div>
    </div>

    <!-- 聊天框框 (右1) -->
    <div class="line_p07_demoLine_chatMessageRight" v-for="contents in chatMessageRight_1" style="display: none;">
    <span class="line_p07_demoLine_chatMessageTimestamp">{{ contents.timestamp }}</span>
    <p class="line_p07_demoLine_chatMessagesText"> {{ contents.content }}</p>
    </div>


    <!-- 聊天框框 (左2) -->
    <div class="line_p07_demoLine_chatMessageLeft" style="display: none;">      
    <img src="../assets/img/p07_demo/p07_demoLine/b_user_pic.png">
    <div class="line_p07_demoLine_chatMessagesContentLeft" v-for="contents in chatMessageLift_2">
        <p class="line_p07_demoLine_chatMessagesText">{{ contents.content }}</p>
        <span class="line_p07_demoLine_chatMessageTimestamp">{{ contents.timestamp }}</span>
    </div>
    </div>

    <!-- 聊天框框(右2) -->
    <div class="line_p07_demoLine_chatMessageRight" v-for="contents in chatMessageRight_2" style="display: none;">
    <span class="line_p07_demoLine_chatMessageTimestamp">{{ contents.timestamp }}</span>
    <p class="line_p07_demoLine_chatMessagesText"> {{ contents.content }}</p>
    </div>

    <!-- 聊天框框 (左3) -->
    <div class="line_p07_demoLine_chatMessageLeft" style="display: none;">      
    <img src="../assets/img/p07_demo/p07_demoLine/b_user_pic.png">
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
    <img src="../assets/img/p07_demo/p07_demoLine/b_user_pic.png">
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
    <button class="line_p07_demoLine_chatMessageButton">{{ chatMessageRight_1[0].content }}</button>
    <button class="line_p07_demoLine_chatMessageButton" style="display: none;">{{ chatMessageRight_2[0].content }}</button>
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
        content: '我喜歡和你相處的感覺',
        timestamp: '下午 08:23'
      },
      {
        content: '我不知道你心中還有沒有你前女友',
        timestamp: '下午 08:24'
      }
    ])

    // 右側第一組回覆
    const chatMessageRight_1 = ref([
      {
        content: '我不知道...',
        timestamp: '下午 08:27'
      },
      {
        content: '是真實的在跟妳相處，也不討厭和妳聊天的感覺',
        timestamp: '下午 08:28'
      }
    ])

    // 左側第二組對話
    const chatMessageLift_2 = ref([
      {
        content: '那就好了呀 你如果真的愛我就用一萬塊錢看清我',
        timestamp: '下午 08:34'
      },
      {
        content: '難道我連這一萬塊都不值嗎？',
        timestamp: '下午 08:34'
      },
    ])

    // 右側第二組回覆
    const chatMessageRight_2 = ref([
      {
        content: '嗯......再讓我想一下好嗎？',
        timestamp: '下午 08:44'
      },
      {
        content: '我盡力想幫你了',
        timestamp: '下午 08:45'
      }
    ])

    // 左側第三組對話
    const chatMessageLeft_3 = ref([
      {
        content: '如果你連一萬塊都不願意拿出來幫助我',
        timestamp: '下午 08:46'
      },
      {
        content: '那我憑什麼相信能和你一直走下去',
        timestamp: '下午 08:46'
      }
    ])

    // 右側第三組回覆
    const chatMessageRight_3 = ref([
      {
        content: '可是我現在沒有多餘的錢',
        timestamp: '下午 08:47'
      },
      {
        content: '妳給我一點時間...好嗎？',
        timestamp: '下午 08:47'
      }
    ])

    // 左側第四組對話
    const chatMessageLeft_4 = ref([
      {
        content: '那好吧..我會等你的',
        timestamp: '下午 08:48'
      },
      {
        content: '你要知道 我現在只剩你可以依靠了..',
        timestamp: '下午 08:48'
      }
    ])

    // 右側第四組回覆
    const chatMessageRight_4 = ref(
      {
        content: '嗯..我知道...',
        timestamp: '下午 08:52'
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
        chatMessageRight[1].style.display = 'flex'
        chatMessageLeft[1].style.display = 'block'
        demoBtn[1].style.display = 'block'
      })
      demoBtn[1].addEventListener('click', () => {
        demoBtn[1].style.display = 'none'
        chatMessageRight[2].style.display = 'flex'
        chatMessageRight[3].style.display = 'flex'
        chatMessageLeft[2].style.display = 'block'
        demoBtn[2].style.display = 'block'
      })
      demoBtn[2].addEventListener('click', () => {
        demoBtn[2].style.display = 'none'
        chatMessageRight[4].style.display = 'flex'
        chatMessageRight[5].style.display = 'flex'
        demoBtn[3].style.display = 'block'
        chatMessageLeft[3].style.display = 'block'
      })
      demoBtn[3].addEventListener('click', () => {
        demoBtn[3].style.display = 'none'
        chatMessageRight[6].style.display = 'flex'
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