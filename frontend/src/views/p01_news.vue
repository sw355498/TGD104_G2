<template>
  <div>
    <div class="p01_news">
      <div class="banner_frame">
        <div class="banner_title h1">最新消息
          <div class="banner_title_en">NEWS</div>
        </div>
      </div>

      <div class="tab_p01_newsChoose">
        <div class="tab_p01_news_category">
          <select name="" id="">
            所有文章
          </select>
          <div class="wide_tab">
            <a href="#" :class="{ currentTab: isActive }">所有文章</a>　|　<a
              href="#"
              >網站詐騙</a
            >　|　<a href="#" >交友詐騙</a>　|　<a href="#">金融詐騙</a>
          </div>
        </div>
        <div class="input_p01_news_searchBar">
          <input type="text" placeholder="搜尋文章" />
          <div class="icon">
            <i class="fa-solid fa-magnifying-glass"></i>
          </div>
        </div>
      </div>

      <ul class="ul_p01_newsPost">
        <li v-for="(value,index) in object" class="li_p01_newsPost" :key="index">
          <a href="#"
            ><div class="newsImg">
              <img :src="value.image" />
            </div>

            <div class="newsContent">
              <div class="p01_news_title">
                <div class="p01_news_titleText h5">{{ value.name }}</div>
                <div class="p01_news_titleCollect">
                  <a data-href="" data-layout="button_count"
                    ><i class="fa-brands fa-facebook"></i
                  ></a>
                  <a><i class="fa-brands fa-line"></i></a> |
                  <a><i class="fa-solid fa-bookmark"></i>收藏</a>
                </div>
              </div>
              <div class="tag_p01_news_postDescription">
                <div class="tag_p01_news_postCategory">
                  {{ value.category }}
                </div>
                <div class="tag_p01_news_postDate">{{ value.date }}</div>
              </div>
              <div class="p01_news_article paragraph">{{ value.content }}</div>
            </div>
          </a>
        </li>

       
      </ul>

<!-- <div>
  <paging :current-page="currentPage" :total="120" :total-pages="11" @pagechanged="onPageChange"> </paging>
</div> -->
      
<nav aria-label="Page navigation example">
  <ul class="pagination justify-content-center">
    <li class="page-item">
      <a class="page-link pagination-dark" href="#" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
      </a>
    </li>
    <li class="page-item"><a class="page-link  pagination-dark" href="#">1</a></li>
    <li class="page-item"><a class="page-link  pagination-dark" href="#">2</a></li>
    <li class="page-item"><a class="page-link  pagination-dark" href="#">3</a></li>
    <li class="page-item">
      <a class="page-link pagination-dark" href="#" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
      </a>
    </li>
  </ul>
</nav>


    </div>
  </div>
</template>

 <script>
// import paging from '../components/paging.vue';
export default {
  // components: { paging },
  
  data() {
    let id = 0,
      news = 85;
    return {
      isActive: true,
      object: [
        {
          ID: `${id++}`,
          name: "假冒銀行信用貸款簡訊",
          image: require("../assets/img/p01_news/pic01.jpg"),
          category: "金融詐騙",
          url: "https://tw.yahoo.com/",
          content:
            " 近日詐騙集團假冒銀行寄送信用貸款簡訊簡訊會用『免徵連保』、『免照會』、『快速撥款』等字眼，要求加Line進行貸款案件申請。之後該假冒人員會先透露部份個資等話術騙取您的信任，再誆稱授信審核已通過核貸，尚須繳交財力證明金、律師公證函費用等種種名目費用，要求民眾『先匯款或轉帳』才符合撥貸條件。165提醒您1.銀行人員不會透過私加Line 好友方式進行審核流程2.銀行人員不會在撥款前額外要求民眾做任何匯款或轉帳等行為如有疑問請撥打 165 反詐騙專線或銀行客服查證相關資訊是否屬實。",
          date: "2023/1/5",
          fblink: "https://tw.yahoo.com/",
          
        },
        {
          ID: `${id++}`,
          name: "請注意近期詐騙集團假冒CACO客服解除分期付款詐騙",
          image: require("../assets/img/p01_news/pic02.jpg"),
          category: "網站詐騙",
          url: "https://tw.yahoo.com/",
          content:
            "該假冒的客服人員會先透露曾經購買的衣服等交易個資取得信任後再誆稱因客服人員操作錯誤，誤『升級高級會員』、『分期付款』或『訂單錯誤』等理由需多次扣款，或是要求先匯款驗證等等....而要求操作『ATM』、『網路銀行APP』、『購買遊戲點數』或『提供個人帳戶資料、信用卡資料、簡訊驗證碼』來『解除』相關錯誤請勿聽信，因為這一定是詐騙。",
          date: "2022/6/17",
          fblink: "https://tw.yahoo.com/",
          
        },
        {
          ID: `${id++}`,
          name: "請注意近期詐騙集團假冒紓困調查騙取個資",
          image: require("../assets/img/p01_news/pic03.jpg"),
          category: "網站詐騙",
          url: "https://tw.yahoo.com/",
          content:
            "請各位鄉親朋友注意：近日衛生福利部社會及家庭署發現，民眾於網路查詢該署長官個人資訊時，卻被導向假冒紓困調查要求登錄個資請勿聽信，這一定是詐騙，勿隨意點選進入來路不明網站！如仍有疑問請撥打165反詐騙諮詢專線查證",
          date: "2022/6/1",
          fblink: "https://tw.yahoo.com/",
          
        },
        {
          ID: `${id++}`,
          name: "請注意近期詐騙集團假冒「民宿、旅店、露營區」客服解除分期付款詐騙",
          image: require("../assets/img/p01_news/pic04.jpg"),
          category: "網站詐騙",
          url: "https://tw.yahoo.com/",
          content:
            "近日詐騙集團開始假冒『各民宿、旅館、露營區』訂房客服稱您之前訂購的『某某民宿、旅店、露營』因為工作人員操作錯誤要求您操作『ATM』、『網路轉帳』及『購買遊戲點數』等方式來「協助您」解除分期付款設定接到此來電，請不要相信，掛斷電話，並立即聯繫訂房業者或撥打165反詐騙諮詢專線查證。",
          date: "2022/5/9",
          fblink: "https://tw.yahoo.com/",
          
        },
                {
          ID: `${id++}`,
          name: "請注意近期詐騙集團假冒衛生福利部人員來電",
          image: require("../assets/img/p01_news/pic11.jpg"),
          category: "網站詐騙",
          url: "https://tw.yahoo.com/",
          content:
            "請各位鄉親朋友注意：近日如有接獲詐騙集團假冒「衛生福利部」人員來電通知紓困專案10萬元已核撥至您帳戶請勿聽信，這一定是詐騙110年因應疫情擴大急難紓困實施計畫已於110年6月30日截止，現無與疫情相關紓困措施，且衛生福利部不會以電話主動通知民眾申請紓困金等核定結果，或向民眾詢問有關銀行帳號、身分證字號等個人資訊要求匯款或保管帳戶等情形如有接獲來電透露上述內容謹記1聽、2掛、3查證請聯繫衛生福利部(02)8590-6666或撥打165反詐騙諮詢專線查證",
          date: "2022/4/27",
          fblink: "https://tw.yahoo.com/",
          
        },
        {
          ID: `${id++}`,
          name: "請注意近期詐騙集團假冒博客來書局客服解除分期付款詐騙",
          image: require("../assets/img/p01_news/pic10.jpg"),
          category: "網站詐騙",
          url: "https://tw.yahoo.com/",
          content:
            "近日如有接獲詐騙集團假冒「博客來書局」客服人員來電該假冒的客服人員會先透露曾經所購買書籍等交易個資取得信任後再誆稱因客服人員操作錯誤誤『升級高級會員、經銷商』、『分期付款』、『訂單錯誤』等理由需多次扣款而要求操作『ATM』、『網路銀行APP』或『購買遊戲點數』來『解除』相關錯誤請勿聽信，這一定是詐騙如有接獲『+886』來電並電話中透露上述內容謹記1聽、2掛、3查證請聯繫博客來書局客服人員或撥打165反詐騙諮詢專線查證",
          date: "2022/4/11",
          fblink: "https://tw.yahoo.com/",
          
        },
        {
          ID: `${id++}`,
          name: "請注意近期詐騙集團假冒聯合勸募客服解除分期付款詐騙",
          image: require("../assets/img/p01_news/pic05.jpg"),
          category: "金融詐騙",
          url: "https://tw.yahoo.com/",
          content:
            "近日有詐騙集團假冒『聯合勸募』的工作人員來電該假冒人員會先透露曾經進行線上捐款及部份個資等話術騙取您的信任，再誆稱因系統設定或人員操作錯誤，『誤值捐款金額』、『定期/單筆設定錯誤』等理由衍生多次扣款情事，要求您提供詳細個資資訊或要求操作『ATM匯款』、『網路銀行APP』來『解除』相關錯誤， 請直接掛斷電話，因為這一定是詐騙。",
          date: "2022/4/7",
          fblink: "https://tw.yahoo.com/",
          
        },
        {
          ID: `${id++}`,
          name: "假冒高鐵公司寄送電子郵件，稱「填表單領回饋」無影謀?",
          image: require("../assets/img/p01_news/pic09.jpg"),
          category: "網站詐騙",
          url: "https://tw.yahoo.com/",
          content:
            "民眾向高鐵表示 接獲疑似台灣高鐵公司相近名稱之英文社交工程詐騙郵件，內容要求點選互動連結後可獲得免費車票/2300元回饋的真實性台灣高鐵澄清，實無相關活動或郵件寄送，請民眾切勿點選/操作，避免個資外洩或權益受損。",
          date: "2022/2/22",
          fblink: "https://tw.yahoo.com/",
          
        },
        
      ],
    };
  },
  methods: {},
  
};
// 以下為限制內文顯示字數
$(function () {
            var len = 180;
            $(".p01_news_article").each(function (i) {
                if ($(this).text().length > len) {
                    $(this).attr("title", $(this).text());
                    var text = $(this).text().substring(0, len - 1) + "...";
                    $(this).text(text);
                }
            });
        });
</script>

 <style lang="scss" scoped>
// @import url("../assets/Sass/style.scss");
</style>