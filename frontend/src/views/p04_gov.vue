<template>
  <main class="body_p04_gov_base">
    <!-- navgation -->
    <frontNavbar />

    <!-- 最上方標題 -->
    <div class="div_p04_gov_topTitle">
        <h3><i class="fa-regular fa-lightbulb"></i>政府相關連結</h3>
    </div>
  
    <!-- 政府卡片區 -->
    <div class="div_p04_gov_container">
      <div class="div_p04_gov_card" v-for="(content, index) in contents">
          <a :href="content.link" target="_blank"><img :src="content.image"></a>
          <!-- <span class="span_p04_gov_cardVerticalLine"></span> -->
          <div class="div_04_gov_cardRight">
              <div class="div_p04_gov_cardBgShapeRightTop">
                <a :href="content.link" target="_blank"><h6 class="text_title">{{content.cardTitle}}</h6></a>
                <a href="#" class="div_p04_gov_openShareButton" :class="'classButton-' + index" @click="openShareButton(index)"><i class="fa-solid fa-share-nodes"></i></a>
                <div class="div_p04_gov_shareButton" :class="'classBtn-' + index">
                  <a href="#" class="fadeInOut" target="_blank" @click="openShareWindow(content.facebookShareLink);"><i class="fa-brands fa-square-facebook"></i></a>
                  <a href="#" class="fadeInOut" target="_blank" @click="openShareWindow(content.lineShareLink);"><i class="fa-brands fa-line"></i></a>
                  <a href="#" class="fadeInOut" target="_blank" @click="openShareWindow(content.twitterShareLink);"><i class="fa-brands fa-square-twitter"></i></a>
                </div>
              </div>
              <p class="paragraph">{{content.description}}</p>
          </div>
      </div>
    </div>
  </main>
        
  <!-- footer -->
  <frontFooter />
</template>

<script>
  import { ref, onMounted } from 'vue'
  import frontNavbar from "@/components/f_nav.vue";
  import frontFooter from "@/components/f_footer.vue";
  
  export default{
    components: {
      frontNavbar,
      frontFooter,
    },
    setup(){
      const contents = ref([
        {
          cardTitle: '165 全民防詐騙網',
          description: '內政部警政署為加強預防詐欺犯罪，設立165全民防詐騙網，宣導防制詐騙並提供民眾諮詢。',
          image: require('../assets/img/p04_gov/165_logo.jpg'),
          facebookShareLink: 'https://www.facebook.com/sharer.php?u=https://165.npa.gov.tw/',
          lineShareLink: 'https://social-plugins.line.me/lineit/share?url=https://165.npa.gov.tw/',
          twitterShareLink: 'https://www.twitter.com/share?url=https://165.npa.gov.tw/',
          link: 'https://165.npa.gov.tw/',
        },
        {
          cardTitle: '台灣事實查核中心',
          description: '台灣事實查核中心參考國外具代表性的事實查核機制，並輔以我國的傳播生態需求，依循專業、透明、公正的原則，執行公共事務相關訊息之事實查核。',
          image: require('../assets/img/p04_gov/factCheck_logo.jpg'),
          facebookShareLink: 'https://www.facebook.com/sharer.php?u=https://tfc-taiwan.org.tw/',
          link: 'https://tfc-taiwan.org.tw/',
        },
        {
          cardTitle: '證交所 - 反詐騙專區',
          description: '全台投資詐騙猖獗，為強化防範金融投資詐騙，證交所設立「證券投資反詐騙專區」，有反詐騙宣導、影片及資訊等，提供投資大眾，面對不明電話、簡訊、網頁等，應謹慎查證，維護自身投資權益及保障財產安全。',
          image: require('../assets/img/p04_gov/twse_logo.jpg'),
          facebookShareLink: 'https://www.facebook.com/sharer.php?u=https://www.twse.com.tw/anti-fraud/zh/index.html',
          link: 'https://www.twse.com.tw/anti-fraud/zh/index.html',
        },
        {
          cardTitle: '金管會 - 防詐騙專區',
          description: '金管會積極推動金融防詐騙宣導工作，整合所轄業務局及金融周邊單位重要防詐宣導內容，設置金融防詐騙宣導專區，透過案例提醒民眾。',
          image: require('../assets/img/p04_gov/fsc_logo.jpg'),
          facebookShareLink: 'https://www.facebook.com/sharer.php?u=https://moneywise.fsc.gov.tw/home.jsp?id=24&parentpath=0',
          link: 'https://moneywise.fsc.gov.tw/home.jsp?id=24&parentpath=0',
        },
        {
          cardTitle: '台哥大反詐戰警',
          description: '台灣大自主研發偵測偽冒網站服務，協助企業主動偵測可能危害客戶之釣魚網站。',
          image: require('../assets/img/p04_gov/taiwanmobile_logo.jpg'),
          facebookShareLink: 'https://www.facebook.com/sharer.php?u=https://www.twmsolution.com/secguard/TWMAnti_phishing/',
          link: 'https://www.twmsolution.com/secguard/TWMAnti_phishing/',
        },
        {
          cardTitle: '趨勢科技 - 防詐達人',
          description: '趨勢科技團隊致力於研究各種詐騙行為、新聞與犯罪模型，並與警政署165防詐騙專線合作，擁有專門防詐騙的AI聊天機器人及全台最大詐騙資料庫。',
          image: require('../assets/img/p04_gov/trendmicro_logo.jpg'),
          facebookShareLink: 'https://www.facebook.com/sharer.php?u=https://getdr.com/',
          link: 'https://getdr.com/',
        },
      ])

      // 第一種方法
      // const shareButton_1 = ref([])
      // const shareButton_2 = ref([])
      // const shareButton_3 = ref([])
      // const shareButton_4 = ref([])
      // const shareButton_5 = ref([])
      // const shareButton_6 = ref([])
      
      // const shareBtn_1 = ref([])
      // const shareBtn_2 = ref([])
      // const shareBtn_3 = ref([])
      // const shareBtn_4 = ref([])
      // const shareBtn_5 = ref([])
      // const shareBtn_6 = ref([])

      // const fadeInOut = ref()
      
      // const openShareButton = () => {
      //   shareButton_1.value.addEventListener('click', (e) => {
      //     e.preventDefault();
      //     if(shareBtn_1.value.classList.contains('hover')){
      //       shareBtn_1.value.classList.remove('hover')
      //     }else{
      //         shareBtn_1.value.classList.add('hover')
      //     }
      //   })
      //   shareButton_2.value.addEventListener('click', (e) => {
      //     e.preventDefault();
      //     if(shareBtn_2.value.classList.contains('hover')){
      //       shareBtn_2.value.classList.remove('hover')
      //     }else{
      //         shareBtn_2.value.classList.add('hover')
      //       }
      //     })
      //     shareButton_3.value.addEventListener('click', (e) => {
      //         e.preventDefault();
      //     if(shareBtn_3.value.classList.contains('hover')){
      //       shareBtn_3.value.classList.remove('hover')
      //     }else{
      //         shareBtn_3.value.classList.add('hover')
      //       }
      //     })
      //     shareButton_4.value.addEventListener('click', (e) => {
      //         e.preventDefault();
      //         if(shareBtn_4.value.classList.contains('hover')){
      //             shareBtn_4.value.classList.remove('hover')
      //           }else{
      //               shareBtn_4.value.classList.add('hover')
      //             }
      //           })
      //           shareButton_5.value.addEventListener('click', (e) => {
      //               e.preventDefault();
      //               if(shareBtn_5.value.classList.contains('hover')){
      //                   shareBtn_5.value.classList.remove('hover')
      //                 }else{
      //                     shareBtn_5.value.classList.add('hover')
      //     }
      //   })
      //   shareButton_6.value.addEventListener('click', (e) => {
      //       e.preventDefault();
      //       if(shareBtn_6.value.classList.contains('hover')){
      //           shareBtn_6.value.classList.remove('hover')
      //     }else{
      //       shareBtn_6.value.classList.add('hover')
      //     }
      //   })
      // }
      
      // function openShareWindow(link){
      //     window.open(link, 'mywindow', 'width=700, height=400');
      //   }
        
      //   onMounted(() => {
      //   shareButton_1.value = document.querySelector('.classButton-0')
      //   shareButton_2.value = document.querySelector('.classButton-1')
      //   shareButton_3.value = document.querySelector('.classButton-2')
      //   shareButton_4.value = document.querySelector('.classButton-3')
      //   shareButton_5.value = document.querySelector('.classButton-4')
      //   shareButton_6.value = document.querySelector('.classButton-5')
      //   shareBtn_1.value = document.querySelector('.classBtn-0')
      //   shareBtn_2.value = document.querySelector('.classBtn-1')
      //   shareBtn_3.value = document.querySelector('.classBtn-2')
      //   shareBtn_4.value = document.querySelector('.classBtn-3')
      //   shareBtn_5.value = document.querySelector('.classBtn-4')
      //   shareBtn_6.value = document.querySelector('.classBtn-5')
      //   fadeInOut.value = document.querySelectorAll('.fadeInOut')
      //   openShareButton()
      // })

      // return {
      //     contents,
      //     shareButton_1,
      //     shareButton_2,
      //     shareButton_3,
      //     shareButton_4,
      //     shareButton_5,
      //     shareButton_6,
      //     shareBtn_1,
      //     shareBtn_2,
      //     shareBtn_3,
      //     shareBtn_4,
      //     shareBtn_5,
      //     shareBtn_6,
      //     openShareWindow,
      //     fadeInOut
      //   }
      
      
        
      const shareButton = [];
      const shareBtn = [];
      
      // 第二種方法
      // for (let i = 0; i < 6; i++) {
      //   shareButton[i] = ref();
      //   shareBtn[i] = ref();
        
      //   const openShareButton = () => {
      //     shareButton[i].value.addEventListener('click', (e) => {
      //         e.preventDefault();
      //         if (shareBtn[i].value.classList.contains('hover')) {
      //         shareBtn[i].value.classList.remove('hover');
      //       } else {
      //         shareBtn[i].value.classList.add('hover');
      //       }
      //     });
      //   };
      
      //   onMounted(() => {
      //     shareButton[i].value = document.querySelector(`.classButton-${i}`);
      //     shareBtn[i].value = document.querySelector(`.classBtn-${i}`);
      //     openShareButton();
      //   });
      // }

      // 第三種方法
      function openShareButton(index){
        if (shareBtn.value[index].classList.contains('hover')) {
          shareBtn.value[index].classList.remove('hover');
        } else {
          shareBtn.value[index].classList.add('hover');
        }
      }

      onMounted(() => {
        shareBtn.value = document.querySelectorAll('.div_p04_gov_shareButton')
      })
      
      function openShareWindow(link) {
        window.open(link, 'mywindow', 'width=700, height=400');
      }

      return {
        contents,
        shareButton,
        shareBtn,
        openShareWindow,
        openShareButton
      };
    },
  };
  
</script>

<style scoped></style>