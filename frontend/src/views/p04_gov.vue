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
        <div class="div_p04_gov_card" v-for="content in contents">
            <a :href="content.link" target="_blank"><img :src="content.image"></a>
            <!-- <span class="span_p04_gov_cardVerticalLine"></span> -->
            <div class="div_04_gov_cardRight">
                <div class="div_p04_gov_cardBgShapeRightTop">
                  <a :href="content.link" target="_blank"><h6 class="text_title">{{content.cardTitle}}</h6></a>
                  <a :href="content.shareLink" target="_blank"><i class="fa-solid fa-share-from-square"></i></a>
                </div>
                <p class="paragraph">{{content.description}}</p>
              </div>
            </div>
          </div>
          <!-- footer -->
          <frontFooter />
        </main>
      </template>

<script>
  import frontNavbar from "@/components/f_nav.vue";
  import frontFooter from "@/components/f_footer.vue";
  
  
  export default{
    components: {
      frontNavbar,
      frontFooter,
    },
    data(){
      return{
        contents: [
          {
              cardTitle: '165 全民防詐騙網',
              description: '內政部警政署為加強預防詐欺犯罪，設立165全民防詐騙網，宣導防制詐騙並提供民眾諮詢。',
              image: require('../assets/img/p04_gov/165_logo.jpg'),
              shareLink: 'https://www.facebook.com/sharer.php?u=https://165.npa.gov.tw/',
              link: 'https://165.npa.gov.tw/',
          },
          {
              cardTitle: '台灣事實查核中心',
              description: '台灣事實查核中心參考國外具代表性的事實查核機制，並輔以我國的傳播生態需求，依循專業、透明、公正的原則，執行公共事務相關訊息之事實查核。',
              image: require('../assets/img/p04_gov/factCheck_logo.jpg'),
              shareLink: 'https://www.facebook.com/sharer.php?u=https://tfc-taiwan.org.tw/',
              link: 'https://tfc-taiwan.org.tw/',
          },
          {
              cardTitle: '證交所 - 反詐騙專區',
              description: '全台投資詐騙猖獗，為強化防範金融投資詐騙，證交所設立「證券投資反詐騙專區」，有反詐騙宣導、影片及資訊等，提供投資大眾，面對不明電話、簡訊、網頁等，應謹慎查證，維護自身投資權益及保障財產安全。',
              image: require('../assets/img/p04_gov/twse_logo.jpg'),
              shareLink: 'https://www.facebook.com/sharer.php?u=https://www.twse.com.tw/anti-fraud/zh/index.html',
              link: 'https://www.twse.com.tw/anti-fraud/zh/index.html',
          },
          {
              cardTitle: '金管會 - 防詐騙專區',
              description: '金管會積極推動金融防詐騙宣導工作，整合所轄業務局及金融周邊單位重要防詐宣導內容，設置金融防詐騙宣導專區，透過案例提醒民眾。',
              image: require('../assets/img/p04_gov/fsc_logo.jpg'),
              shareLink: 'https://www.facebook.com/sharer.php?u=https://moneywise.fsc.gov.tw/home.jsp?id=24&parentpath=0',
              link: 'https://moneywise.fsc.gov.tw/home.jsp?id=24&parentpath=0',
          },
          {
              cardTitle: '台哥大反詐戰警',
              description: '台灣大自主研發偵測偽冒網站服務，協助企業主動偵測可能危害客戶之釣魚網站。',
              image: require('../assets/img/p04_gov/taiwanmobile_logo.jpg'),
              shareLink: 'https://www.facebook.com/sharer.php?u=https://www.twmsolution.com/secguard/TWMAnti_phishing/',
              link: 'https://www.twmsolution.com/secguard/TWMAnti_phishing/',
          },
          {
              cardTitle: '趨勢科技 - 防詐達人',
              description: '趨勢科技團隊致力於研究各種詐騙行為、新聞與犯罪模型，並與警政署165防詐騙專線合作，擁有專門防詐騙的AI聊天機器人及全台最大詐騙資料庫。',
              image: require('../assets/img/p04_gov/trendmicro_logo.jpg'),
              shareLink: 'https://www.facebook.com/sharer.php?u=https://getdr.com/',
              link: 'https://getdr.com/',
          },
        ],
      }
    },
  }

  // let body = document.querySelector('body');
  // body.style.backgroundColor = '#00092E';
  
</script>

<style scoped>
/* @import url("../../src/assets/CSS/style.css");
@import url("../../src/assets/CSS/component.css");
@import url("../../src/assets/CSS/normalize.css");
@import url("../../src/assets/CSS/pages/p04_gov.css");  */
</style>